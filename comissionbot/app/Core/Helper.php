<?php
namespace app\Core;
use \RedBeanPHP\R as R;
use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\{Message, CallbackQuery};

class Helper
{
    protected  Bot $bot;
    protected  $telegram;

    public function __construct(Message | CallbackQuery $telegram, Bot $bot)
    {
        $this->bot = $bot;
        $this->telegram = $telegram;

        $this->setUser($telegram->from);
        $this->getUser($telegram->from->id);

    }

    protected function setUser(object $user): void
    {
        $user_tg =  R::findOne('userstg', 'user_id = ?'[$user->id]);
        if(!$user_tg){
            $user_tg = R::dispense('userstg');
            $user_tg->user_id =  $user->id;
        }
        $user_tg->name = $user->first_name;
        R::store($user_tg);
    }

    protected function getUser(int $user_id)
    {
        $this->user = R::findOne('userstg', 'user_id = ?'[$user_id]);
    }
}
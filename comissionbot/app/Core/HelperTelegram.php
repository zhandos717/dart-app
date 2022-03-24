<?php
namespace app\Core;
use \RedBeanPHP\R as R;
use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\{Message, CallbackQuery};
use App\Core\Language;

class HelperTelegram
{
    protected  Language $lang;
    protected  Bot $bot;
    protected  Message | CallbackQuery $telegram;
    protected object $user;
    protected string $user_table;
    protected int $admin;

    public function __construct(Message | CallbackQuery $telegram, Bot $bot, string $user_table)
    {
        $this->bot = $bot;
        $this->admin = 480568670;
        $this->telegram = $telegram;
        $this->user_table = $user_table;
        $this->setUser($telegram->from);
        $this->getUser($telegram->from->id);
    }
    protected function setUser(object $user): void
    {
        $user_tg =  R::findOne($this->user_table, 'user_id = ?'[$user->id]);
        if(!$user_tg){
            $user_tg = R::dispense($this->user_table);
            $user_tg->user_id =  $user->id;
        }
        $user_tg->name = $user->first_name;
        R::store($user_tg);
    }
    protected function getUser(int $user_id): void
    {
        $this->user = R::findOne($this->user_table, 'user_id = ?'[$user_id]);
        $lang =  $this->user->lang ?? 'ru';
        $this->lang = new Language($lang);
        
    }
    protected function setLang(string $lang): void
    {
        $this->user->lang = $lang;
        R::store($this->user);
        $this->lang = new Language($lang);
    }
    protected function setCommand(string $command = null): void
    {
        $this->user->command = $command;
        R::store($this->user);
    }
    protected function setLogin(string $login = null): void
    {
        $this->user->status = 1;
        $this->user->login = $login;
        R::store($this->user);
    }
    protected function setStatus(int $user_id, int $status = 2): void
    {
        $user =  R::findOne($this->user_table, 'user_id = ?'[$user_id]);
        $user->status = $status;
        R::store($user);
    }
}
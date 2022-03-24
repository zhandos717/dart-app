<?php

    namespace App\Helpers\ReportBot;
    use DI\Container;
    use skrtdev\NovaGram\Bot;
    use skrtdev\Telegram\Message;

    class BotNotifications
    {   
        private Bot $bot;

        public function __construct(Container $c)
        {
            $this->bot = $c->get('ReportBot');;
        }
        
        public function main($post): void
        {

        $this->bot->debug($post);

        }
    }

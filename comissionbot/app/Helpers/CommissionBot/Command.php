<?php

namespace App\Helpers\CommissionBot;

use App\Core\HelperTelegram;
use skrtdev\Telegram\Message;
use skrtdev\NovaGram\Bot;

class Command extends HelperTelegram
{
    public function __construct(Message $message, Bot $Bot)
    {
        Parent::__construct($message, $Bot, 'reportbotusers');
    }
    public function main()
    {
        $message = $this->telegram;
        $user = $message->from;

        switch ($this->user->command) {
            case 'add_item':
                $patterns['item'] = '/{item}/';
                $replacements['item'] =  $message->text;
                $message->reply(preg_replace($patterns, $replacements, $this->lang->get('ADD_ITEM_NAME')), [
                    'disable_web_page_preview' => true,
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                ['text' => $this->lang->get('CLOSE'), 'callback_data' => 'close'],
                                ['text' => $this->lang->get('CONTINUE'), 'callback_data' => 'continue'],
                            ],
                        ]
                    ]
                ]);
                break;
            case 'add_sn':
                // $this->setCommand();
                $patterns['item'] = '/{item}/';
                $patterns['sn'] = '/{sn}/';

                $replacements['item'] =  'Apple iPhone 12 PRO MAX';
                $replacements['sn'] =  $message->text;

                $message->reply(preg_replace($patterns, $replacements, $this->lang->get('ADD_ITEM_SN')), [
                    'disable_web_page_preview' => true,
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                ['text' => $this->lang->get('SAVE'), 'callback_data' => 'close'],
                                ['text' => $this->lang->get('DELETED'), 'callback_data' => 'edit'],
                            ],
                        ]
                    ]
                ]);
                break;
            default:
                $this->bot->debug($this->user->command);
                break;
        }
    }
}

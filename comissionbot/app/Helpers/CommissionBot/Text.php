<?php
namespace App\Helpers\CommissionBot;

use App\Core\HelperTelegram;
use skrtdev\Telegram\Message;
use skrtdev\NovaGram\Bot;

class Text extends HelperTelegram
{   
    public function __construct(Message $message, Bot $Bot)
    {
        Parent::__construct($message, $Bot, 'reportbotusers');
    }
    public function main()
    {
        $message = $this->telegram;
        $user = $message->from;

        if($this->user->command){
          $command = new Command($message,$this->bot);
          $command->main();
          exit();
        }

        switch ($message->text) {
            case '/start':
                $message->reply($this->lang->get('WELCOME'), [
                        'reply_markup' => [
                            'keyboard' => [
                                [['text' => $this->lang->get('ADD_ITEM')],
                                ],
                                // [['text' => 'Поиск по ИИН'],
                                // ['text' => 'Поиск по IMEI'],
                                // ]
                                // ,

                                // [['text' => $this->lang->get('AVERAGE_PRICE')]],
                                [['text' => $this->lang->get('HELP')],
                                    ['text' => $this->lang->get('SETTINGS')],
                                ], [['text' => $this->lang->get('MY')]]
                            ]
                        ]
                    ]);
            break;
            case $this->lang->get('HELP'):
                $message->reply($this->lang->get('HELP_TEXT'), [
                    'disable_web_page_preview' => true,
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                ['text' => $this->lang->get('SUPPORT'), 'callback_data' => 'support'],
                                ['text' => $this->lang->get('BACK'), 'callback_data' => 'back'],
                            ],
                        ]
                    ]
                ]);
                break;
            case $this->lang->get('SETTINGS'):
                $message->reply("Добро пожаловать {$user->first_name} \n\r\n\r UID: `{$user->id}` ", [
                    'disable_web_page_preview' => true,
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                ['text' => 'support', 'callback_data' => 'support'],
                            ],
                        ]
                    ]
                ]);
            break;
            case $this->lang->get('ADD_ITEM'):
                $this->setCommand('add_item');
                $message->reply($this->lang->get('ADD_ITEM_TEXT'), [
                    'disable_web_page_preview' => true,
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                ['text' => $this->lang->get('CLOSE'), 'callback_data' => 'close'],
                            ],
                        ]
                    ]
                ]);
                break;
            case $this->lang->get('MY'):
                $message->reply("Добро пожаловать {$user->first_name} \n\r\n\r UID: `{$user->id}` ", [
                    'disable_web_page_preview' => true,
                    'reply_markup' => [
                        'inline_keyboard' => [

                            [
                                ['text' => $this->lang->get('MY_IMEI'), 'callback_data' => 'my_imei'],
                            ],
                            [   
                                ['text' => $this->lang->get('BACK'), 'callback_data' => 'back'],
                            ],
                        ]
                    ]
                ]);
                break;
            default:
                    $this->bot->debug($message);
            break;
        }
    }
}


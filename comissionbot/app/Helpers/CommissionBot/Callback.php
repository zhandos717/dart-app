<?php

namespace App\Helpers\CommissionBot;

use App\Core\HelperTelegram;
use skrtdev\Telegram\CallbackQuery;
use skrtdev\NovaGram\Bot;
class Callback extends HelperTelegram
{
    public function __construct(CallbackQuery $callback_query, Bot $Bot)
    {
        Parent::__construct($callback_query, $Bot,'reportbotusers');
    }
    public function main()
    {
        $callback_query = $this->telegram;
        $user = $callback_query->from;


        switch ($callback_query->data) {
            case 'back':
                $callback_query->message->editText(
                    $this->lang->get('NO_LINK'),
                    [
                        'disable_web_page_preview' => true,
                        'reply_markup' => [
                            'inline_keyboard' => [
                                [
                                    ['text' => $this->lang->get('CHANNELS'), 'callback_data' => 'Add_New'],
                                    ['text' => $this->lang->get('GROUPS'), 'callback_data' => 'Add_New'],
                                ],
                                [
                                    ['text' => $this->lang->get('BACK'), 'callback_data' => 'my'],
                                ],
                            ]
                        ]

                    ]
                );
            break;
            case 'support':
                $callback_query->message->editText(
                    $this->lang->get('ADMIN'),
                    [
                        'reply_markup' => [
                            'inline_keyboard' => [
                                [
                                    ['text' => $this->lang->get('BACK'), 'callback_data' => 'help'],
                                ],
                            ]
                        ]
                    ]
                );
                break;
            case 'my_imei':
                $callback_query->message->editText(
                    $this->lang->get('NO_IMEI'),
                    [
                        'reply_markup' => [
                            'inline_keyboard' => [
                                [
                                    ['text' => $this->lang->get('BACK'), 'callback_data' => 'help'],
                                ],
                            ]
                        ]
                    ]
                );
                break;
            case 'help':
                $callback_query->message->editText("Добро пожаловать {$user->first_name} \n\r\n\r UID: `{$user->id}` ", [
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

            case 'continue':
                $this->setCommand('add_sn');

                $callback_query->message->editText("Добро пожаловать {$user->first_name} \n\r\n\r UID: `{$user->id}` ", [
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

            case 'close':
                $this->setCommand();
                $callback_query->message->delete();
                break;
            default:
                $this->bot->debug($callback_query->data);
            break;
        }
    }
}
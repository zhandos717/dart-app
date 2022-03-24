<?php

namespace App\Helpers\ReportBot;
use App\Core\HelperTelegram;
use RedBeanPHP\R;
use skrtdev\Telegram\CallbackQuery;
use skrtdev\NovaGram\Bot;
class Callback extends HelperTelegram
{
    public function __construct(CallbackQuery $callback_query, Bot $Bot)
    {
        Parent::__construct($callback_query, $Bot,'commissionbotusers');
    }
    public function main()
    {
        $callback_query = $this->telegram;
        $user = $callback_query->from;


        $callback = json_decode($callback_query->data);


        if(is_object($callback)){
            $user_bot = R::findOne($this->user_table, 'user_id = :user_id',[':user_id'=> $callback->user_id]);
            $user_bot->status =2;
            R::store($user_bot);

            $callback_query->message->editText(
                'Пользователь '. $user_bot->name .'  авторизован !',
                [
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                ['text' => $this->lang->get('CLOSE'), 'callback_data' => 'close'],
                            ],
                        ]
                    ]
                ]
            );

            $this->bot->sendMessage(
                $user_bot->user_id,
                'Вы прошли верификацию',
                [
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                ['text' => 'Проверить почту', 'callback_data' => 'check_mail'],
                            ],
                        ]
                    ]
                ]
            );
            exit;
        }

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
                                    ['text' => $this->lang->get('BACK'), 'callback_data' => 'close'],
                                ],
                            ]
                        ]
                    ]
                );
                break;
            case 'save_mail':


                $this->bot->sendMessage($this->admin,'Пришла заявка на авторизаицию',
                [
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                ['text' => 'Авторизовать', 'callback_data' => '{"user_id":"'. $user->id. '","login":"'. $this->user->login. '"}' ],
                            ],
                        ]
                    ]
                ]);

                $replacements = [
                    'user' => $this->user->login
                ];
                $patterns = [
                    'user' => '/{login}/'
                ];
                $callback_query->message->editText(
                    preg_replace($patterns, $replacements, $this->lang->get('SAVE_LOGIN')),
                    [
                        'reply_markup' => false
                    ]
                );
                break;
            case 'check_mail':
                $mail = new MailReport($this->user->login);
                $callback_query->message->editText($mail->getAllMail(), [
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                ['text' => $this->lang->get('CLOSE'), 'callback_data' => 'close'],
                            ],
                        ]
                    ]
                ]);
                break;
            case 'setting':
                $patterns['user'] = '/{user}/';
                $replacements['user'] =  $user->first_name;

                $patterns['user_id'] = '/{user_id}/';
                $replacements['user_id'] =  $user->id;

                $callback_query->message->editText(preg_replace($patterns, $replacements, $this->lang->get('WELCOME_TO_USER')), [
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
<?php
namespace App\Helpers\ReportBot;
use App\Core\HelperTelegram;
use skrtdev\Telegram\Message;
use skrtdev\NovaGram\Bot;

class Text extends HelperTelegram
{   
    public function __construct(Message $message, Bot $Bot)
    {
        Parent::__construct($message, $Bot, 'commissionbotusers');
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

                if ($this->user->status == 1) {
                    $this->setCommand('add_mail');
                    $replacements = [
                        'user' => $user->first_name
                    ];
                    $patterns = [
                        'user' => '/{user}/'
                    ];

                    $message->reply(preg_replace($patterns, $replacements, $this->lang->get('WELCOME_ADD_MAIL')));
                    exit();
                }
                
                $message->reply($this->lang->get('WELCOME'), [
                    'reply_markup' => [
                        'keyboard' => [
                            [
                                ['text' => $this->lang->get('ALL_MAIL')],
                            ],
                            [   ['text' => $this->lang->get('MY')],
                                ['text' => $this->lang->get('HELP')],
                            ]
                        ]
                    ]
                ]);
            break;
            case $this->lang->get('HELP'):
                $message->reply($this->lang->get('HELP_TEXT_REPORT'), [
                    'disable_web_page_preview' => true,
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                ['text' => $this->lang->get('SUPPORT'), 'callback_data' => 'support'],
                                ['text' => $this->lang->get('CLOSE'), 'callback_data' => 'close'],
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
            case $this->lang->get('ALL_MAIL'):

                $mail = new MailReport('superadmin');
                $message->reply($mail->getAllMail(0), [
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
                $replacements = [
                    'user_id'=> $user->id,
                    'user'=> $user->first_name,
                    'login' => $this->user->login,
                ];
                
                $patterns = [
                    'user_id' => '/{user_id}/',
                    'user' => '/{user}/',
                    'login' => '/{login}/',
                ];
                
                $message->reply(preg_replace($patterns, $replacements, $this->lang->get('WELCOME_TO_USER')), [
                    'disable_web_page_preview' => true,
                    'reply_markup' => [
                        'inline_keyboard' => [
                            // [
                            //     ['text' => $this->lang->get('SETTINGS'), 'callback_data' => 'setting']
                            // ],
                            [
                                ['text' => $this->lang->get('CLOSE'), 'callback_data' => 'close'],
                            ],
                        ]
                    ]
                ]);
                break;
            default:
                    $this->bot->debug($this->admin);
            break;
        }
    }
}


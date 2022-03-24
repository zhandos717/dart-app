<?php

namespace App\Helpers\ReportBot;

use App\Core\HelperTelegram;
use skrtdev\Telegram\Message;
use skrtdev\NovaGram\Bot;

class Command extends HelperTelegram
{
    public function __construct(Message $message, Bot $Bot)
    {
        Parent::__construct($message, $Bot, 'commissionbotusers');
    }
    public function main()
    {
        $message = $this->telegram;
        $user = $message->from;

        switch ($this->user->command) {
            case 'add_mail':
                $patterns['login'] = '/{login}/';
                $replacements['login'] =  $message->text;
                $this->setLogin($message->text);
                $message->reply(preg_replace($patterns, $replacements, $this->lang->get('ADD_MAIL_TEXT')), [
                    'disable_web_page_preview' => true,
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                ['text' => $this->lang->get('CLOSE'), 'callback_data' => 'close'],
                                ['text' => $this->lang->get('SAVE'), 'callback_data' => 'save_mail'],
                            ],
                        ]
                    ]
                ]);
                break;
            case 'check_mail':
                $mail = new MailReport($this->user->login);
                $message->reply($mail->getAllMail(), [
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
            default:
                $this->bot->debug($this->user->command);
                break;
        }
    }
}

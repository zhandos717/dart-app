<?php
namespace application\models;
use application\core\Model;
use R;
class Bot extends Model{
    public $error;
    public function hook($output){ 
        if(isset($output['message'])){
            $this->message($output['message']);
        }elseif(isset($output['callback_query'])){
            $this->callback_query($output['callback_query']);
        }
    }
    private function getUser($user_id)
    {
        if (!empty($user_id)) {
            $user = R::findOneOrDispense('userbot', 'user_id=?', [$user_id]);
            $user->user_id = $user_id;
            R::store($user);
        }
        return [
            'user' => $user,
        ];
    }
    // Сообщения запросы
    private function message($message){
       
        ############################################################################
        $chat_id            = @$message['chat']['id'];                    // идентификатор чата
        $user_id            = @$message['from']['id'];                    // идентификатор пользователя
        $username           = @$message['from']['username'];              // username пользователя
        $first_name         = @$message['chat']['first_name'];            // имя собеседника
        $username           = @$message['chat']['username'];             // фамилию собеседника
        $chat_time          = @$message['date'];                          // дата сообщения
        $Message            = @$message['text'];                          // Выделим сообщение собеседника (регистр по умолчанию)
        $contact            = @$message['contact']['phone_number'];;       // Номер контакта
        $photo              = @$message['photo'];                         // Фото
        $file               = @$message['document'];                      // Документ 
        $document           = @$message['document']['file_name'];         // Имя документа
        $msg                = mb_strtolower(@$message['text'], "utf8");   // Выделим сообщение собеседника (нижний регистр)
        $user = $this->getUser($user_id);
        if($msg == '/start'){


            ob_start();
            var_dump($user_id);
            $test = ob_get_clean();
            file_put_contents('log.txt', $test, FILE_APPEND);
        
            $this->bot->sendMessage($user_id, 'Введите ваше имя');
            $user['user']->comand_name = 'lastname';
            R::store($user['user']);


            exit('ok');
        }
        else if ($user['user']->comand_name == 'lastname') {
            $this->bot->sendMessage($user_id, 'Введите ваше фамилию');
            $user['user']->lastname = $Message;
            $user['user']->comand_name = 'firstname';
            R::store($user['user']);
            exit('ok');
        }else if($user['user']->comand_name == 'firstname'){
            $this->bot->sendMessage($user_id, 'Введите ваше отчество');
            $user['user']->firstname = $Message;
            $user['user']->comand_name = 'patronymic';
            R::store($user['user']);
            exit('ok');
        }else if($user['user']->comand_name == 'patronymic'){
            $this->bot->sendMessage($user_id, 'Отправьте дату своего рождения (в формате 01.01.2020)');
            $user['user']->patronymic = $Message;
            $user['user']->comand_name = 'date_of_birth';
            R::store($user['user']);
            exit('ok');
        } else if ($user['user']->comand_name == 'date_of_birth') {
            $this->bot->sendMessage($user_id, 'Отправьте свое фото');
            $user['user']->date_of_birth = $Message;
            $user['user']->comand_name = 'photo';
            R::store($user['user']);
            exit('ok');
        } else if ($user['user']->comand_name == 'photo') {

            if($photo){
                $file = $this->bot->setFile($user_id, $photo);
                if($file['patch']){
                $this->bot->sendMessage($user_id, 'Фотография сохранена, вот ваша ссылка https://prankfriendsdiya.pp.ua/dia/'. $user_id);
                $user['user']->photo = $file['patch'];
                $user['user']->comand_name = 'photo';
                R::store($user['user']);
                }
            }
            exit('ok');
        }
    }
    //date_of_birth
    // callback запросы
    private function callback_query($callback_query){
        $data               = @$callback_query['data'];                             // callback данные для обработки inline кнопок
        $message_id         = @$callback_query['message']['message_id'];            // идентификатор последнего сообщения
        $chat_id_in         = @$callback_query['message']['chat']['id'];            // идентификатор чата

        $inline_button1 = ["text" => 'Вернуть', "callback_data" => '/start'];
        $this->bot->Message($chat_id_in, 'Привет', ["inline_keyboard" => [[$inline_button1]]]);
        exit('ok');
    }
}

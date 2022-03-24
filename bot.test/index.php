<?php
require_once './telegrambot.php';
BOT::setToken('5006373459:AAGKa18GuNOtIM8Jqbm2W9WJpeN17p2px4c');
$output = json_decode(file_get_contents('php://input'), true);  // Получим то, что передано 

BOT::logger($output);

if (isset($output)) {
   $chat_id            = @$output['message']['chat']['id'];                    // идентификатор чата
   $user_id            = @$output['message']['from']['id'];                    // идентификатор пользователя
   $username           = @$output['message']['from']['username'];              // username пользователя
   $first_name         = @$output['message']['chat']['first_name'];            // имя собеседника
   $last_name          = @$output['message']['chat']['last_name'];             // фамилию собеседника
   $chat_time          = @$output['message']['date'];                          // дата сообщения
   $message            = @$output['message']['text'];                          // Выделим сообщение собеседника (регистр по умолчанию)
   $document           = @$output['message']['document']['file_name'];
   $chat_name          = @$output['message']["chat"]["title"];
   $message_id1        = @$output['message']['message_id'];
   $reply_to_message   = @$output['message']["reply_to_message"]["from"]["first_name"];
   $reply_to_id        = @$output['message']["reply_to_message"]["from"]["id"];
   $first_name1        = @$output['message']["from"]["first_name"];
   $msg                = mb_strtolower(@$output['message']['text'], "utf8");   // Выделим сообщение собеседника (нижний регистр)
   $org_msg            =  @$output['message']['text'];
   $callback_query     = @$output['callback_query'];                             // callback запросы
   $data               = @$callback_query['data'];                              // callback данные для обработки inline кнопок
   $message_id         = @$callback_query['message']['message_id'];             // идентификатор последнего сообщения
   $chat_id_in         = @$callback_query['from']['id'];            // идентификатор чата

   $callback_chat_id  = @$callback_query['message']['chat']['id'];
   $photo              = @$output['message']['photo'];
   $file               = @$output['message']['document'];
}


if ($msg == '/start') {

   $answer =  BOT::sendMessage($chat_id, 'Привет :' . $user_id, [0]);
   $answer = json_decode($answer,true);


   BOT::sendMessage($chat_id, 'Id сообщения :'.$answer['result']['message_id'], [0]);

}

if ($msg == 'test') {
   $answer = BOT::getChatAdministrators($chat_id);
   $o = json_decode($answer, true);

   foreach($o["result"] as $admin){
      if($admin["user"]["id"] == $user_id){
         $answer =  BOT::sendMessage($chat_id, 'Привет :' . $admin["status"], [0]);
         exit;
      }
   }
   
   BOT::sendMessage($chat_id, 'Вы не админ', [0]);
}elseif($msg == 'удалить'){

   BOT::deleteMessage($chat_id, $reply_to_id);
}


?>
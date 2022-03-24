<?php
class BOT {
  static $token = '';
  static $url = 'https://api.telegram.org/bot';
  public static function setToken(string $token){
    self::$token = $token;
    self::$url .= $token;
  }
  /**
   * создаем метод sendMessage с аргументами
   * @param $chatid- ид получателя
   * @param $msg             - сообщение
   * @param $keyboard        - клавиатура
   * @param $keyboard_opt[0] - тип клавиатуры keyboard | inline_keyboard
   * @param $keyboard_opt[1] - спрятать клавиатуру при клике
   * @param $keyboard_opt[2] - авторазмер клавиатуры при клике
   * @param $parse_preview[0]- маркировка html| markdown
   * @param $parse_preview[1]- предпросмотр ссылок
   */
  public static function sendMessage($chat_id, $msg, $keyboard = [], $keyboard_opt = [], $parse_preview = ['html', false])
  {
      if(empty($keyboard_opt)) {
          $keyboard_opt[0] = 'keyboard';
          $keyboard_opt[1] = false;
          $keyboard_opt[2] = true;
          $keyboard_opt[3] = 'inline_keyboard';
      }
      $options = [ $keyboard_opt[0]    => $keyboard,
      'one_time_keyboard' => $keyboard_opt[1],
      'resize_keyboard'   => $keyboard_opt[2],
      ];
      $response = ['disable_web_page_preview'=> $parse_preview[1],
      'chat_id' => $chat_id,
      'parse_mode' => $parse_preview[0],
      'text'=> $msg,
      ];
        if($keyboard == [0]) 
          $response['reply_markup'] = json_encode(['remove_keyboard' => true]);
        else if($keyboard == []) { 

        } else 
        $response['reply_markup'] =  json_encode($options);
        
       return self::sendTelegram('sendMessage', $response );
  }
  public static function editMessageText($chat_id,$message_id,$message, $keyboard = []) 
  {
    $response = [
      'chat_id' => $chat_id,
      'message_id' => $message_id, 
      'text' => $message,
    ];
    $options = [
      'inline_keyboard'    => $keyboard,
      'one_time_keyboard' => false,
      'resize_keyboard'   => true,
    ];
    if($keyboard != [])
      $response['reply_markup'] =  json_encode($options);
  
    return self::sendTelegram('editMessageText',$response);
  }
  public static function sendReply($chat_id, $message, $reply_to_message_id)
  {
    $response = [
      'chat_id' => $chat_id,
      'text' => $message,
      'reply_to_message_id' => $reply_to_message_id
    ];
    return self::sendTelegram('sendMessage', $response);
  }

  public static function deleteMessage($chat_id, $message_id)
  {
    $response = [
      'chat_id' => $chat_id,
      'message_id' => $message_id,
    ];
   return self::sendTelegram('deleteMessage', $response);
  }
  public static function sendDocument($chat_id, $document,$caption = 'file', $reply_to_message_id = 0, $keyboard =[], $keyboard_opt = [])
  {
    $options = [
      $keyboard_opt[0]    => $keyboard,
      'one_time_keyboard' => $keyboard_opt[1],
      'resize_keyboard'   => $keyboard_opt[2],
    ];

    $response = [
      'chat_id'   => $chat_id,
      'document'     => $document,
      'parse_mode' => "HTML",
      'caption' => $caption,
      'reply_to_message_id' => $reply_to_message_id
    ];

    if ($keyboard == [0])
      $response['reply_markup'] = json_encode(['remove_keyboard' => true]);
    else if ($keyboard == []) {
    } else
      $response['reply_markup'] =  json_encode($options);


     return self::sendTelegram('sendDocument',$response);
  }

  public static function getChat($chat_id)
  {
    $response = [
      'chat_id'   => $chat_id,
    ];
    return self::sendTelegram('getChat', $response);
  }

  public static function getChatAdministrators($chat_id)
  {
    $response = [
      'chat_id'   => $chat_id,
    ];
    return self::sendTelegram('getChatAdministrators', $response);
  }

  public static function sendTelegram($method, $response)
  {
    $ch = curl_init(self::$url . '/' . $method);
    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $response);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
  }
  /**
   * @param array $array
   * @param int  $size 
   * @return array
   * 
   */
  public static function callback_data(array $array, int $size):array
  {
    $arr = [];
    foreach ($array as $k => $v) {
      $arr[] = ["text" => $v, "callback_data" => $k];
    }
    return array_chunk($arr, $size);
  }


  /**
   * @param array $array
   * @param string  $size 
   * @return void
   */
  public static function logger( $output,string $file_name = 'log.txt' ):void
  {
    ob_start();
    var_dump($output);
    $test = ob_get_clean();
    file_put_contents($file_name, $test, FILE_APPEND);
  }
}
?>


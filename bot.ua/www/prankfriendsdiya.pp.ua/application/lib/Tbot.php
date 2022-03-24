<?php
namespace application\lib;
/* 
* Создаем класс Tbot
* создаем метод sendMessage с аргументами
* $chatid          - ид получателя 
* $msg             - сообщение 
* $keyboard        - клавиатура
* $keyboard_opt[0] - тип клавиатуры keyboard | inline_keyboard
* $keyboard_opt[1] - спрятать клавиатуру при клике
* $keyboard_opt[2] - авторазмер клавиатуры при клике
* $parse_preview[0]- маркировка html| markdown
* $parse_preview[1]- предпросмотр ссылок
*/
class Tbot {
    protected $url = 'https://api.telegram.org/bot';
    protected $urlGetFile = 'https://api.telegram.org/file/bot';

    public function __construct(){
        $config = require 'application/config/bot.php';
        $this->url .= $config['token'];
        $this->urlGetFile .= $config['token'];
    }
    public function  sendMessage($chatid, $msg, $keyboard = [], $keyboard_opt = [], $parse_preview = ['html', false, 'Markdown']) {
        if(empty($keyboard_opt)) {
            $keyboard_opt[0] = 'keyboard';
            $keyboard_opt[1] = false;
            $keyboard_opt[2] = true;
            $keyboard_opt[3] = 'inline_keyboard';
        } 
        $options = [
            $keyboard_opt[0]    => $keyboard,
            'one_time_keyboard' => $keyboard_opt[1],
            'resize_keyboard'   => $keyboard_opt[2],
        ];
        $replyMarkups   = json_encode($options);
        $removeMarkups  = json_encode(['remove_keyboard' => true]);
        // если в массиве $keyboard передается [0], то клавиатура удаляется
        if($keyboard == [0]) { file_get_contents($this->url.'/sendMessage?disable_web_page_preview='.$parse_preview[1].'&chat_id='.$chatid.'&parse_mode='.$parse_preview[0].'&text='.urlencode($msg).'&reply_markup='.urlencode($removeMarkups)); }
        // или же если в массиве $keyboard передается [], то есть пустой массив, то клавиатура останется прежней
        else if($keyboard == []) { file_get_contents($this->url.'/sendMessage?disable_web_page_preview='.$parse_preview[1].'&chat_id='.$chatid.'&parse_mode='.$parse_preview[0].'&text='.urlencode($msg)); }
        // если вышеуказанные условия не соблюдены, значит в $keyboard передается клавиатура, которую вы создали
        else { file_get_contents($this->url.'/sendMessage?disable_web_page_preview='.$parse_preview[1].'&chat_id='.$chatid.'&parse_mode='.$parse_preview[0].'&text='.urlencode($msg).'&reply_markup='.urlencode($replyMarkups)); }
    }
    public function Message($chat_id, $message, $replyMarkup) {
        file_get_contents($this->url.'/sendMessage?chat_id='.$chat_id.'&text='.urlencode($message).'&reply_markup='.json_encode($replyMarkup));
    }
    public function editMessageText($chat_id, $message_id, $message, $replyMarkup=[]) {
        file_get_contents($this->url. '/editMessageText?chat_id='.$chat_id.'&message_id='.$message_id.'&text='.urlencode($message).'&parse_mode=Markdown&reply_markup='. json_encode($replyMarkup));
    }

    public function send($method, $response){
        $ch = curl_init($this->url . '/' . $method);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }


    public function setFile($user_id , $photo)
    {
        if (!empty($photo)) {

            $photo = array_pop($photo);

            $ch = curl_init($this->url . '/getFile');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('file_id' => $photo['file_id']));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $res = curl_exec($ch);
            curl_close($ch);

            $res = json_decode($res, true);

            if ($res['ok']) {
                $src  = $this->urlGetFile .'/' . $res['result']['file_path'];
                $dest = 'public/files/' . $user_id . '-' . basename($src);
                if(copy($src, $dest)){

                    return ['status' => 'Успех', 'message' => 'Файл сохранен!',
                 'patch'=> $dest];
                };
            }
        }
        return ['status'=>'Ошибка','message'=>'Файл не сохранен!'];
    }

}

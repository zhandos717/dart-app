<?php
    namespace application\models;
    use application\core\Model;
    use R;
class Main extends Model{
    public $error;
    public function loginValidate($post){
        $config = require 'application/config/admin.php';
        if ($config['login'] != $post['login'] or $config['password'] != $post['password']) {
            $this->error = 'Логин или пароль введен не верно';
            return \false;
        }
        return \true;
    }
    public function prizesValidate($post, $type){
        $nameLen = \iconv_strlen($post['name']);
        $count = \iconv_strlen($post['count']);
        if ($nameLen < 3 or $nameLen > 120) {
            $this->error = 'Название должно содержать от 3 до 120 симоволов';
            return \false;
        } else if ($count < 1 or $count > 1000) {
            $this->error = 'Количество должно содержать от 3 до 1000 симоволов';
            return \false;
        }
        return \true;
    }
    public function prizesAdd($post){
        $prizes = R::dispense('prizes');
        $prizes->name = $post['name'];
        $prizes->count = $post['count'];
        $prizes->date_reg = date('Y-m-d');
        $prizes->date_time = date('Y-m-d H:i:s');
        return R::store($prizes);
    }
    public function getArray($table,$where = \false, $params = []){
        if ($where)
            $array = R::findAll($table, $where, $params);
        else
            $array = R::findAll($table);
        return $array;
    }
    public function sendTelegram($data){
        if(!empty($data['user_id']) AND !empty($data['message'])){
            $this->bot->sendMessage($data['user_id'], $data['message']);
            return \true;
        }else{
            $this->error = 'Введите сообщение';
            return \false;
        }
    }
    public function getCountCodes(){
        $code_today = R::count('botcode', 'date_reg = ?',[date('Y-m-d')]);
        $total_count = R::count('botcode');
        $count_users = R::count('userbot');
        $users_today  = R::count('userbot', 'date_reg = ?',[date('Y-m-d')]);
        return [
            'code_today' => $code_today,
            'total_count' => $total_count,
            'count_users' => $count_users,
            'users_today' => $users_today, 
        ];
    }
    public function trashData($table,$id){
        $userbot = R::load($table, $id);
        if($table == 'lottery'){
            $winners = R::findAll('winners', 'id_lottery='. $id);
            if($winners){
                foreach ($winners as $winner) {
                    $win = R::load('botcode', $winner['code_id']);
                    $win->win = 0;
                    R::store($win);
                }
                R::trashAll($winners);
            }
        }elseif($table == 'messages'){
            unlink('public/files/'.$id.'.'. $userbot['extension']);
        };
        R::trash($userbot);
    }
    public function lotteryValidate($post){
       if(empty($post['week']) || empty($post['prize'])){
            $this->error = 'Выберите неделю и приз';
            return \false;
        } elseif(empty($post['major_winners'])){
            $this->error = 'Введите количество основных победителей';
            return \false;
        }
        return \true;
    }
    public function addLottery($post){

        $prize = R::load('prizes', $post['prize']);

        $lottery = R::dispense('lottery');
        $lottery->major_winners = $post['major_winners'];       # Основные победители
        $lottery->reserve_winners = $post['reserve_winners'];   # Запасные победители победители
        $lottery->prize_id = $post['prize'];
        $lottery->prize_uz = $prize['name_uz'];
        $lottery->prize_ru = $prize['name'];
        $lottery->week = $post['week'];                         # Неделя
        $lottery->date_reg = date('Y-m-d');
        $lottery->status = 1;
        $lottery->date_time = date('Y-m-d H:i:s');
        return R::store($lottery);
    }
    public function holdLottery($post, $id){
        $count = !empty($post['reserve_winners']) ? $post['major_winners']+$post['reserve_winners'] : $post['major_winners'];
        if($post['week'] === 'Все'){
            $sql = "SELECT * FROM botcode   GROUP BY user_id ORDER BY RAND()  LIMIT $count "; 
        }else{
            $sql = "SELECT * FROM botcode WHERE  week = {$post['week']} AND winner IS NULL  GROUP BY user_id  ORDER BY RAND()  LIMIT $count "; //
        }
        $winners = R::getAll($sql);   
        $i= 0;
        foreach($winners as $win){
            $i++;            
            $user = R::load('userbot', $win['table_id']);
            $winner                    = R::dispense('winners');
            $winner->table_id          = $win['table_id'];
            $winner->name              = $win['name'];
            $winner->notified          = 'Нет';
            $winner->user_name         = $win['user_name'];
            $winner->user_id           = $win['user_id'];           #   айди пользывателя
            $winner->user_code         = $win['user_code'];          #  Сам код
            $winner->code_id           = $win['id'];            # айди кода
            $winner->phone             = $user['contact'];             # телефон
            $winner->prize             = $post['prize'];             # приз
            $winner->week              = $post['week'];              # Неделя
            $winner->id_lottery        = $id;
            if($i <= $post['major_winners'])
                $winner->major_winners = 'Да';
            else
                $winner->major_winners = 'Нет';
            $winner->date_reg          = date('Y-m-d');
            $winner->date_time         = date('Y-m-d H:i:s');
            R::store($winner);
        }
        return \true;
    }
    public function newsAdd($post){
        $messages = R::dispense('messages');
        $messages->message = $post['message'];       # Сообщение
        $messages->note = $post['note'];             # Примечание
        $messages->date_reg = date('Y-m-d');
        $messages->date_time = date('Y-m-d H:i:s');
        return R::store($messages);
    }
    public function newsUploadFile($file,$id){
        ob_start();
        var_dump($file);
        $test = ob_get_clean();
        file_put_contents('log.txt', $test,FILE_APPEND);
        if ($file && $file["file"]["error"] == UPLOAD_ERR_OK) {
            $extension = pathinfo($file["file"]["name"], PATHINFO_EXTENSION);
            move_uploaded_file($file["file"]["tmp_name"], 'public/files/'.$id.'.'.$extension);
            $messages = R::load('messages', $id);
            $messages->extension = $extension;
            R::store($messages);
        return \true;
        }else{
            $this->error = 'Ошибка при загрузке файла';
        return \false;
        }
    }
    public function newsletterStart($id){
        $newsletter =R::load('messages',$id);
        $users = R::findAll('userbot');
        foreach ($users as $key) {
            if(file_exists('public/files/' . $id . '.' . $newsletter['extension'])){
                $this->bot->send('sendPhoto', [
                    'chat_id'   => $key['user_id'],
                    'photo'     => 'https://genesis-bot.uz/public/files/' . $id . '.' . $newsletter['extension'],
                    'caption' => $newsletter['message'],
                    'parse_mode' => "HTML",
                ]);
            }else{
                $this->bot->sendMessage($key['user_id'], $newsletter['message']);
            };
        }
    }
    public function approveWinner($post){
        $winner = R::load('winners', $post['id_winner']);
        
        $w = R::load('botcode', $winner['code_id']);
        $w->win = 1;
        $w->prize_id =  $winner['prize'];
       
        R::store($w);
        R::exec('UPDATE botcode SET winner = 1 WHERE week = '. $w->week .' AND chat_id =' . $w->chat_id);
      

        $winner->approve = $post['value_selected'];
        R::store($winner);
        return \true;
    }
    public function notifyVictory($id){
        $win = R::load('winners', $id);
        $user = R::load('userbot',$win['table_id']);
        $lang_table = 'lang'.$user['language'];
        $lang =R::load($lang_table,39);
        $prize = R::findOne($lang_table, 'id_prize='.$win->prize);
        $patterns[] = '/{check_id}/';
        $patterns[] = '/{%prizename%}/';
        $replacements[] = $win->user_code;
        $replacements[] = $prize['message'];
        $data = [
            'user_id'=> $win->user_id
            ,'message'=> preg_replace($patterns, $replacements, $lang['message']),
        ];
        if(!$this->sendTelegram($data)){
            return \false;
        };
        $win->notified = 'Да';
        R::store($win);
        return \true;
    }
    public function weekAdd($post){
        $week = R::load('week',$post['id_week']);
        $week->start = $post['start'];
        $week->end = $post['end'];
        R::store($week);
    }
    public function editMessage($post, $table){
            if(!empty($post['id'])){
                $languages = R::load($table, $post['id']);
            }else{
                $languages = R::dispense($table);
            } 
            $languages->name = $post['name'];
            $languages->message = $post['message'];
        R::store($languages);                     
        return \true;
    }
    public function getMessage($id, $table){
        $message = R::load($table, $id);
        return [
            'message' => $message
        ];
    }
}


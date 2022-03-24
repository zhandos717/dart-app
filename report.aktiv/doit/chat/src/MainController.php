<?php
use  R;

include_once __DIR__ . '/View.php';


class MainController{
    private function addMes(string $text):void
    {
        $message =  R::dispense('messages');
        $message->time_add  = date('Y-m-d H:i:s');
        $message->user_id  = $_SESSION['logged_user']->id;
        $message->text = trim(htmlentities($text, ENT_QUOTES));
        $message->who = $_SESSION['logged_user']->fio;
        $message->chat_id = 1;
        R::store($message);
    }

    private function getMessages(string $where = '', array $placeholder = []): array
    {       
       return R::getAll("SELECT *  FROM messages  $where ",
           $placeholder
        );
    }

    public function index(): void
    {
        View::render('inbox', 'Рабочий чат',[
            'messages'=>$this->getMessages('WHERE chat_id = :chat_id ORDER BY id ASC LIMIT 50', [':chat_id'=> 1]),
        ]);
    }
    public function addMessage(): void
    {   
        if($_POST['text'] != ''){
            $this->addMes($_POST['text']);
        }
        if(is_numeric($_POST['last_id'])){

                $messages = $this->getMessages('WHERE id > :id',[':id' => $_POST['last_id']]);
                exit(json_encode([
                'messages' => $messages, 
                'last_id' => array_pop($messages)['id'], 
                'post_id'=> $_POST['last_id'],  
                'user_id'=>$_SESSION['logged_user']->id,
                ]));
    
        }else{
            $messages = $this->getMessages(' ORDER BY id DESC LIMIT 1');

            exit(json_encode([
                'messages' => $messages,
                'last_id' => array_pop($messages)['id'], 
                'user_id' => $_SESSION['logged_user']->id,
            ]));

        }
    }
    public function getMessageAll(): void
    {
        $messages = $this->getMessages();
        $last_id = array_pop($messages)['id'];
        exit(json_encode(['messages' => $messages, 'last_id' => $last_id]));
    }
}

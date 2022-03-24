<?php
namespace App\Helpers\ReportBot;
use RedBeanPHP\R;

class MailReport{

    const  MAIL_REPORT = 'https://report.aktiv-market.kz/doit/api/';
    const TOKEN = 'VxLvvdw0M7GKwxVsEK0rjViWpuPYjxMcz7DWGq9BmY1YhWvm2caWZCQeHdPzbnks1pFKHCtQ3ZBgXwMKkyynueVXidjhvzdceHwb';

    protected $mail;

    public function __construct(string $mail){
        $this->mail = $mail;
    }
    public function getAllMail(int $status_read = 1):string
    {   
        $mails = $this->curl(self::MAIL_REPORT, [
            'login' => $this->mail,
            'token' => self::TOKEN,
            'status_read' => $status_read
        ]);

        $count_mails = count($mails);

        if($count_mails>9){
            $mailbox = "Я скачивал только последних 10 сообщений, для просмотра всех сообщений зайдите в свой кабинет.  \n\r";
        }else{
             $mailbox= " У вас $count_mails новых сообщений \n\r\n\r ";
        }
        
        $i = 1;
        foreach($mails as $mail){
            $mailbox .= $i++."._Сообщение_ от ` {$mail['fio']}` \n\r _Тема:_` {$mail['tema']}` \n\r";
        }
        return  $mailbox;
    }
    protected function curl(string $url,array $param){
        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($param)
        ));
        $response = json_decode(curl_exec($myCurl), true);
        curl_close($myCurl);
        return $response;
    }
}
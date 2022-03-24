<?php
class TgBot{

    const URL_BOT_TG = 'https://bot.commission2.kz/telegram/mail_reports';

    /**
     * Discriptions: Отправка сообщения в телегарм бот Актив репорт
     *  @param   string to_whom Кому сообщение 
     *  @param   string who от кого 
     *  @param   string message текст сообщения
     *  @param   string date дата отправки не обязательно
     *  @param   string time время отправки не обязательно
     * @return  void  ничего не возвращает
     */ 
    public static function send(string $to_whom,string $who, string $message, string $date = null, string $time = null):void
    {
        $param = json_encode([
            'message' => (object)[
                'to_whom' => $to_whom,
                'who' => $who,
                'message' => $message,
                'date_send' => $date,
                'time_send' => $time
            ]
        ]);

        $ch = curl_init(SELF::URL_BOT_TG);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length:' . strlen($param)
        ]);
        curl_exec($ch);
        curl_close($ch);
    }
}


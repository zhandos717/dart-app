<?php

namespace App\Support;

class Session
{
    /**
     * @return void
     */
    public function start():void
    {
        session_start();
    }

    /**
     * @param string $key
     * @param $value
     * @return void
     */
    public function setData(string $key, $value):void
    {
        $_SESSION[$key] =  $value;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getData(string $key)
    {
       return $_SESSION[$key] ?? null;
    }

    /**
     * @return void
     */
    public function save():void
    {
        session_write_close();
    }

    public function flush(string $key)
    {

    }

    /**
     * @param string $key
     * @return void
     */
    private function unset(string $key):void
    {
        unset($_SESSION[$key]);
    }
}
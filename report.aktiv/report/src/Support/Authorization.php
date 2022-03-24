<?php

namespace App\Support;
use \RedBeanPHP\R as R;
use App\Exceptions\AuthorizationExceprion;
use App\Support\Authenticator;
class Authorization
{   
 //   private Session $session;
    

    // public function  __construct(Session $session){
    //     $this->session = $session;
    // }
    /**
     * @param array $data
     * @return bool
     * @throws AuthorizationExceprion
     */
    public function login(array $data):bool
    {
        if(empty($data['login']))
            throw new AuthorizationExceprion('Email пользователя не может быть пустым');
        if(empty($data['password']))
            throw new AuthorizationExceprion('Пароль пользователя не может быть пустым');

        $authenticator = new Authenticator;
        if(!$authenticator($data))
            throw new AuthorizationExceprion('Логин или пароль не верный!');
            
        return true;
    }
    /**
     * @param array $data
     * @return bool
     * @throws AuthorizationExceprion
     */

    public function register(array $data):bool
    {
        if(empty($data['username']))
            throw new AuthorizationExceprion('Имя пользователя не может быть пустым');
        if(empty($data['email']))
            throw new AuthorizationExceprion('Email пользователя не может быть пустым');
        if(empty($data['password']))
            throw new AuthorizationExceprion('Пароль пользователя не может быть пустым');
        if($data['password'] == $data['confirm_password'])
            throw new AuthorizationExceprion('Пароли не совпадают');

        $user = R::getCol('SELECT fio, region,adress, status, root, phone FROM diruser WHERE login =  :login',[':login'=>$data['email']]  );

        return true;
    }

    public function __invoke(){

        return true;
    }
}
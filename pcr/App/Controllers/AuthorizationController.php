<?php

namespace App\Controllers;
use App\Core\Controller;
use \RedBeanPHP\R as R;


class AuthorizationController extends Controller
{

    public function loginAction(): void
    {
        $this->view->layout = 'authorization';
        $this->view->render('login');
    }

    public function authorizationAction(): void
    {
        $user = R::findOne('users', 'login=:login LIMIT 1', [':login'=> $_POST['login']]);

        if(!$user)
            $this->view->redirect('login', 'Не верный логин');

        if(!password_verify($_POST['password'], $user->password))
            $this->view->redirect('login', 'Не верный пароль');

        $_SESSION['admin'] = $user;
        $this->view->redirect('admin');
    }

    public function logoutAction(): void
    {
        unset($_SESSION['admin']);
        header('Location: /login');
    }
}

<?php

namespace App\Controllers;

use App\Core\Controller;
use \RedBeanPHP\R as R;
use App\Core\Router;

class UserController extends Controller
{
    public function usersAction()
    {

        $this->view->render('Все пользователи', [
            'users' => R::findAll('users')
        ]);
    }
    public function editUserAction()
    {
        $this->view->render('Редактирование', [
            'user' => R::load('users', $_GET['id'])
        ]);
    }
    public function deleteUserAction()
    {
        $user = R::load('users', $_GET['id']);
    }
    public function addUserAction()
    {
        if (isset($_POST['id']))
            $user = R::load('users', $_POST['id']);
        else
            $user = R::dispense('users');

        $user->name = $_POST['name'];
        $user->password  = \password_hash($_POST['password'], \PASSWORD_DEFAULT);
        $user->role = $_POST['role'];
        $user->login = $_POST['login'];
        $user->status = $_POST['status'];
        R::store($user);
        R::close();
        header('Location: /users');
    }
    public function userAddAction()
    {
        $this->view->render('Добавить', []);
    }
}

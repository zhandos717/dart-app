<?
namespace application\controllers;
use application\core\Controller;
use R;
class MainController extends Controller {
        public function diaAction()
        {
            $this->view->layout = 'dia';
            
            $vars = [
                'data' => R::findOne('userbot', 'user_id=?',[$this->route['id']] ),
            ];
            $this->view->render('Языки', $vars);
        }
        public function indexAction(){
            if (isset($_SESSION['admin'])) {
                $this->view->redirect('home');
            }
            if (!empty($_POST)) {
                if (!$this->model->loginValidate($_POST)) {
                    $this->view->message('error', $this->model->error);
                }
                $_SESSION['admin'] = true;
                $this->view->location('home');
            }
            $this->view->layout = 'login';
            $this->view->render('Вход');
        }
        public function homeAction(){
            $vars = [
                'data' => $this->model->getArray('botcode','ORDER BY id DESC LIMIT 10'),
                'count' => $this->model->getCountCodes(),
                'lottery' => $this->model->getArray('lottery'),
            ];
            $this->view->render('Главная страница',$vars);
        }
        public function participantsAction(){
            if (!empty($_POST)) {
                if (!$this->model->sendTelegram($_POST)) {
                    $this->view->message('error', $this->model->error);
                }
                $this->view->message('success', 'Сообщение отправлено');
            }
            $vars = [
                'data' => $this->model->getArray('userbot'),
            ];
            $this->view->render('Участники', $vars);
        }
        public function deleteAction(){
            if (!empty($_POST)) {
                $this->model->trashData($_POST['table'],$_POST['delete_id']);
                exit;
            }
        }
        public function logoutAction(){
            unset($_SESSION['admin']);
            $this->view->redirect('');
        }
    }
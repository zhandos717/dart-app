<?
namespace application\controllers;
use application\core\Controller;
class BotController extends Controller{
    public function botAction(){
        // Получим то, что передано скрипту ботом в POST-сообщении и распарсим
        $output = json_decode(file_get_contents('php://input'), true);


        $this->model->hook($output);

exit;
    }
}

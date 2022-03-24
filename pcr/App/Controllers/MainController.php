<?php
namespace App\Controllers;
use App\Core\Controller;
use \RedBeanPHP\R as R;
use Dompdf\Dompdf;
use App\Core\View;
use App\Helpers\Pcr;


class MainController extends Controller {

    public function indexAction(): void
    {   
        $vars = [
            'pcr' => R::findAll('pcr'),
        ];   
        $this->view->render('ПЦР тесты',$vars);
    }
    public function addPcrAction(): void
    {
        $this->view->render('Add PCR',[
            'barcode'=> $this->getRandomBarcode(),
        ]);
    }
    public function deleteTestAction(){
        $pcr = R::load('pcr',$_GET['id']);
        R::trash($pcr);
        header('Location: /admin');
    }
    public function errorAction(): void
    {
        View::errorCode(404,'Нет');
    }
    public function viewPdfAction()
    {   
        if(isset($_GET['id'])){
            $vars = [
                'pcr' => R::load('pcr', $_GET['id']),
            ];
            $this->view->layout = 'pdf';
            $this->view->render('PCR test', $vars);
        }else{
            View::errorCode(404, 'Нет');
        }
    }
    public function PcrTestAction(){
            if(isset($_GET['barcode'])){     
            $pcr = R::findOne('pcr', 'barcode=:barcode', [':barcode' => $_GET['barcode']]);

            if(!$pcr) header('Location: https://tr.gov.enabiz.pw/Account/PcrTestSonucuDogrula/?barcode='. $_GET['barcode']);
        
            list($lastname,$firstname) = explode(' ', $pcr['lastname']);

            $vars = [
                'pcr' => $pcr,
                'passport' => substr_replace($pcr['passport'], '*****', -strlen($pcr['passport']) , strlen($pcr['passport'])/1.8),
                'lastname' => substr_replace($lastname, '***', strlen($lastname)/2 , strlen($lastname) / 1.5) .'  '. substr_replace($firstname, '***', strlen($firstname) / 2 , strlen($lastname)),
            ];
            $this->view->layout = 'pcr';
            $this->view->render('Elektronik Tahlil Sonucu Doğrulama', $vars);
            }else{
                header('Location: https://tr.gov.enabiz.pw/Account/PcrTestSonucuDogrula/?barcode=');}
    }
    public function resultAction()
    {   
        $this->view->render('ПДФ тест');
    }
    // public function getResultAction(){
    //     $html = file_get_contents('https://enabiz.site/viwe_pdf?id=11');
    //     $dompdf = new Dompdf();
    //     $dompdf->loadHtml($html, 'UTF-8');
    //     // $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();
    //     // Вывод файла в браузер:
    //     $dompdf->stream('schet-10'); 
    // }
    public function editTestAction(){

        if (isset($_GET['id'])) {
            $vars = [
                'pcr' => R::load('pcr', $_GET['id']),
            ];

            $this->view->render('PCR test', $vars);
        
        } else {
            View::errorCode(404, 'Нет');
        }
    }
    public function addTestAction(): void
    {   
        if(isset($_POST['id']))
            $pcr = R::load('pcr', $_POST['id']);
        else
        $pcr = R::dispense('pcr');

        $pcr->lastname = $_POST['lastname'];
        // $pcr->personal_id = $_POST['personal_id'];
        $pcr->barcode = $_POST['barcode'];
        // $pcr->affiliation = $_POST['affiliation'];
        $pcr->result  = $_POST['result'];
        $pcr->passport  = $_POST['passport'];
        $pcr->test_date =  date('Y-m-d H:i:s', strtotime($_POST['test_date']));
        // $pcr->download_date = $_POST['download_date'];
        // $pcr->downloader = $_POST['downloader'];
        $pcr->gender = $_POST['gender'];
        $pcr->birthday = $_POST['birthday'];

        $pcr->sample_received = date('Y-m-d H:i:s', strtotime("+3 hours +" . rand(1, 60) . " minute", strtotime($_POST['test_date'])));
        
        $pcr->result_time = date('Y-m-d H:i:s', strtotime("+6 hours +" . rand(1, 60) . " minute", strtotime($_POST['test_date'])));
        
        R::store($pcr);
        R::close(); 

       header('Location: /admin');
    }

    private function getRandomBarcode()
    {
        $chars = "1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";    
        $small1 = 4;

        $size = StrLen($chars) - 1;
        $pp1 = '';

        while ($small1--)
            $pp1 .= $chars[rand(0, $size)];

        return $pp1 . '-' . rand(1000,9999) . '-' . rand(10,99) ;
    }
}

<?php 

namespace App\Helpers;
use \RedBeanPHP\R as R;


Class Pcr {


    public function addTestAction($post): void
    {
        if (isset($post['id']))
            $pcr = R::load('pcr', $post['id']);
        else
            $pcr = R::dispense('pcr');

        $pcr->lastname = $post['lastname'];
        // $pcr->personal_id = $_POST['personal_id'];
        $pcr->barcode = $post['barcode'];
        // $pcr->affiliation = $_POST['affiliation'];
        $pcr->result  = $post['result'];
        $pcr->passport  = $post['passport'];
        $pcr->test_date =  date('Y-m-d H:i:s', strtotime($post['test_date']));
        // $pcr->download_date = $_POST['download_date'];
        // $pcr->downloader = $_POST['downloader'];
        $pcr->gender = $post['gender'];
        $pcr->birthday = $post['birthday'];

        $pcr->sample_received = date('Y-m-d H:i:s', strtotime("+3 hours +" . rand(1, 60) . " minute", strtotime($post['test_date'])));

        $pcr->result_time = date('Y-m-d H:i:s', strtotime("+6 hours +" . rand(1, 60) . " minute", strtotime($post['test_date'])));

        R::store($pcr);
        R::close();

    }

    public function getRandomBarcode()
    {
        $chars = "1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $small1 = 4;

        $size = StrLen($chars) - 1;
        $pp1 = '';

        while ($small1--)
            $pp1 .= $chars[rand(0, $size)];

        return $pp1 . '-' . rand(1000, 9999) . '-' . rand(10, 99);
    }

}
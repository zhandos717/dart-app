<?

use Mpdf\Tag\Em;

include ("../../../bd.php");
if(empty($region))
    header('Location:/');



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getIp()
{
    $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
    ];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = trim(end(explode(',', $_SERVER[$key])));
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
}

$data = $_POST;





if (R::findOne(
    'reports',
    'data=? AND region=? AND adress = ? ',
    [$data['data'], $region, $adress]
)){
    header('Location: ../viewmyreports.php?month=' . date('m', strtotime($data['data'])));
exit;
}

var_dump($region);

if (isset($data['nalvzaloge'])) {

    $user = R::dispense('reports');
    $user->ip = getIp();
    $user->data = $data['data'];

    $user->fio = $fio;
    $user->region = $region;
    $user->adress = $adress;

    $user->dl = $data['dl'];
    $user->dm = $data['dm'];
    $user->dop = $data['dop'];
    $user->dk = $data['dk'];

    $user->dohod = $user->dl + $user->dm + $user->dop;
    // $user->stabrashod = $data['stabrashod'];
    // $user->tekrashod = $data['tekrashod'];
    $user->allclients = $data['allclients'];
    $user->newclients = $data['newclients'];
    $user->vzs = $data['vzs'];
    $user->vozvrat = $data['vozvrat'];
    $user->nakladnoy = $data['nakladnoy'];

    $user->chv = $user->vzs - $user->vozvrat - $user->nakladnoy;
    $user->auktech = $data['auktech'];
    $user->aukshubs = $data['aukshubs'];
    $user->nalvzaloge = $data['nalvzaloge'];
    $reg_date2 = date("d-m-Y");
    $reg_date = date("d-m-Y в H:i");
    $reg_date3 = date("H:i");
    $segdata = date("Y-m-d H:i:s");
    $user->reg_date = $reg_date;
    $user->reg_date2 = $reg_date2;
    $user->reg_date3 = $reg_date3;
    $user->comment = $data['comment'];
    $user->segdata = $segdata;
    R::store($user);

    header('Location: ../viewmyreports.php?month='.date('m',strtotime($data['data'])));
    exit;
}


if ($data['comiss_rashod']) {
    $user = R::dispense('comisstest');
    $user->fio = $fio;
    $user->region = $region;
    $user->adress = $adress;
    $user->ip = $ip;
    $user->data = $data['data'];
    $user->tekrashod = $data['tekrashod'];
    $user->message = $data['message'];
    $user->datatime = date("Y-m-d H:i:s");
    R::store($user);
    header('Location: ../index.php');
};

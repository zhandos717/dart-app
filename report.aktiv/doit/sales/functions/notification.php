<?

$d = date('Y.m.d');
$date = DateTime::createFromFormat('Y.m.d', $d);
$date->sub(new DateInterval('P10D'));
$date_10 = $date->format('Y-m-d');

// 2019-05-25
$city = ['Нур-Султан','Костанай','Кокшетау','Костанай','Караганда'];

if(in_array($region,$city)){
    $res = R::getAll("SELECT SUM(cena_pr),COUNT(*) as count 
    FROM tickets 
    WHERE (status = 10 OR status = 14 OR status = 15) 
    AND region = '$region' 
    AND dv < '$date_10'  ");
    $res = $res[0];
};
<?
$d = date('Y.m.d');
$date = DateTime::createFromFormat('Y.m.d', $d);
$date->sub(new DateInterval('P9D'));
$date_10 = $date->format('Y-m-d');
// 2019-05-25
//$city = ['Нур-султан','Костанай','Кокшетау','Костанай','Караганда'];
$res = R::getAll("SELECT SUM(cena_pr),COUNT(*) as count 
FROM tickets 
WHERE (`status` = 10 OR `status` = 14 OR `status` = 15)
AND dv < '$date_10'
AND (region = 'Нур-султан' OR region = 'Караганда'  OR region = 'Костанай' OR region = 'Кокшетау') ");
$res = $res[0];
<?php
include("../../bd.php");

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


    $result = R::getAll('SELECT 
        t1.dl, t1.dm, t1.dop, t1.dohod, t1.newclients,t1.allclients,t1.chv, t1.region, 
        t2.summarf , t3.pribl, (t3.remainder - t3.summaprihod) as income_score, t3.countsale, t4.auktech,
        t4.aukshubs, t4.nalvzaloge FROM
        (SELECT region, 
        SUM(dl) as dl,
        SUM(dm) as dm,
        SUM(dop) as dop,
        SUM(dohod) as dohod,
        SUM(newclients) as newclients,
        SUM(allclients) as allclients,
        SUM(chv) as chv
        FROM reports  GROUP BY region ORDER BY SUM(dl) ) t1
        INNER JOIN 
        (SELECT  SUM(summarf) as summarf , region FROM rashodfillial 
        WHERE datez BETWEEN  (SELECT MIN(data) FROM reports ) AND  
        (SELECT MAX(data) FROM reports ) 
        GROUP BY region ) t2 
        ON t1.region = t2.region
        INNER JOIN 
        (SELECT SUM(pribl) as pribl,SUM(remainder) as remainder, SUM(summaprihod) as summaprihod, COUNT(*) as countsale, region FROM sales 
        WHERE fromtovar = 1  AND data BETWEEN (SELECT MIN(data) FROM reports) AND  
        (SELECT MAX(data) FROM reports)  AND statustovar IS NULL GROUP BY region) t3 
        ON t2.region = t3.region 
        INNER JOIN 
        (SELECT SUM(auktech) as auktech ,SUM(aukshubs) as aukshubs ,SUM(nalvzaloge) as nalvzaloge, region FROM reports 
        WHERE  data = (SELECT MAX(data) FROM reports)  GROUP BY region) t4
        ON t3.region = t4.region ');
?>
<pre>
<? var_dump($result); ?>
</pre>
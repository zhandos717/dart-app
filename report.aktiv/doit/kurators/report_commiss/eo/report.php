<? include_once '../../../../bd.php';

$search = R::findAll('tickets','eo = :eo AND dataseg BETWEEN :date1 AND :date2 ORDER BY dataseg DESC LIMIT 10',[':eo'=>$_POST['eo'],':date1'=>$_POST['date1'],':date2'=>$_POST['date2']]);


foreach ($search as $value) {?>
<table class="table">
    <thead>
        <tr>
            <th>
                <?$value['nomerzb'];?>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>

        </tr>
    </tbody>
</table>
<?}
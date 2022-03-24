<?php
include("../bd.php");
      if ($_POST['login'] && $_POST['password']) {
          $user = R::findOne('diruser', 'login = :login', [':login'=>$_POST['login']]);
          if (empty($user))
               $error = 'Пользователь не найден!';
          else if(password_verify($_POST['password'], $user->password)){
               $_SESSION['logged_user'] = $user;
               $_SESSION['logged_user']['status'] = $user->status;
               $_SESSION['id_user'] = $user->id;
               if ($user->status > 0) {
                    $route = [
                         1 => 'doit/dirfil/report.php',
                         2 => 'doit/regdir/edo',
                         3 => 'doit/adm/',
                         4 => 'doit/fortest/',
                         5 => 'doit/sales/',
                         6 => 'doit/store_administrator/',
                         7 => 'doit/komdir/',
                         8 => 'doit/ezhournal/',
                         9 => 'doit/kurators/',
                         10 => 'doit/buh/',
                         11 => 'doit/fin/',
                         12 => 'doit/video_surveillance_department/tabel',
                         13 => 'doit/revizor',
                         14 => 'doit/call_center/',
                         15 => 'doit/dirfil/shift_supervisor.php/',
                         16 => 'doit/personnel_department/employeecard',
                         17 => 'doit/fiscalizer',
                         18 => 'doit/hr/edo',
                         19 => 'doit/comdir/edo',
                         33 => 'doit/superadm/test.php',
                    ];
                    $out = ['url' => $route[$user->status],];
               } else {
                    $error = 'Доступ закрыт!';
               }
          }else
               $error = 'Пароль неверный!';
     }else{
          $error = 'Введите логин или пароль!';
     };
     if($error){
          $out = ['message' => $error];
     }
     exit(json_encode($out));

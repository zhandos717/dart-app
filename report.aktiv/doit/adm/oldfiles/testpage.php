<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <input type="button" onclick = "notifSet()" value="Notification">
    <script>
      function notifMe() {
        var notification = new Notification("пришло служебное письмо", {
          tag: "ache-mail",
          body: "Пора сделать паузу и отдохнуть",
          icon: "https://report.aktiv-market.kz/doit/adm/notify.png"
        });
      }

      function notifSet() {
        if(!("Notification" in window))
          alert("Ваш браузер не поддерживает уведомления");
          else if(Notification.permission==="granted")
            setTimeout(notifMe, 2000);
          else if (Notification.permission!=="denied"){
            Notification.requestPermission (function (permission){
              if(!('permission' in Notification))
                  Notification.permission = permission;
              if(permission==="granted")
                setTimeout(notifMe, 2000);
            });
          }
      }

    </script>
  </body>
</html>
<?
// echo json_encode([
//     'surname'=> 'Мухамбеталинов',
//     'name'=> 'Мухамбеталинов',
//     'patronymic'=> 'Серикович',
//     'dateOfBirth' => '16 декабря 1982г.(38 лет)',
//  ]);

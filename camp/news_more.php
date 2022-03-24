<?php
include __DIR__ . '/admin/functions/main.php';

$news = R::load('news', $_GET['id']);

?>
<!doctype html>
<html lang="ru">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="icon" href="/favicon.ico" type="image/x-icon">
   <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
   <title><?= $news['title'] ?></title>
   <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap&subset=cyrillic-ext" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,500,600,700&display=swap&subset=cyrillic-ext" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
   <link rel="stylesheet" type="text/css" href="/css/style.min.css">
   <link rel="stylesheet" type="text/css" href="/css/responsive.css">
   <link rel="stylesheet" type="text/css" href="/css/colorbox.css">
   <link rel="stylesheet" type="text/css" href="/css/news.css?v=1">


   <meta name="description" lang="ru" content="<?= $news['description'] ?>" />
   <meta name="keywords" content="<?= $news['keywords'] ?>">
   <meta http-equiv="Content-Language" content="ru" />
   <link rel="canonical" href="https://campjunior.ru/news.html">
   <meta name="og:image" content="/favicon.ico">


</head>

<body>
   <header>
      <div class="header_top">
         <div class="container d-flex align-items-center">
            <a href="#" class="logo"><img loading="lazy" src="/images/logo.svg" loading="lazy" alt=""></a><a href="#" class="mobile_logo"><img src="images/mobile_logo.svg" loading="lazy" alt=""></a>
            <a href="#" class="burger">
               <svg width="28" height="22" viewBox="0 0 28 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect width="28" height="2" rx="1" fill="white" />
                  <rect y="10" width="28" height="2" rx="1" fill="white" />
                  <rect y="20" width="28" height="2" rx="1" fill="white" />
               </svg>
            </a>
            <nav class="header_menu">
               <ul>
                  <li><a href="/index.html" class="scrollto">Главная</a></li>
                  <li><a href="/index.html#prices" class="scrollto">Цены</a></li>
                  <li><a href="/index.html#about" class="scrollto">О месте</a></li>
                  <li><a href="/index.html#programm" class="scrollto">Программа</a></li>
                  <li><a href="/index.html#contacts" class="scrollto">Контакты</a></li>
               </ul>
               <a href="#" class="arrow_top"></a>
            </nav>
            <div class="header_tel">
               <a href="tel:79205133958">+7 (920) 513 39 58</a>
               <a href="https://wa.me/79205133958" target="_blank">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="30px" height="30px">
                     <path fill="#fff" d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z" />
                     <path fill="#fff" d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z" />
                     <path fill="#cfd8dc" d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z" />
                     <path fill="#40c351" d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z" />
                     <path fill="#fff" fill-rule="evenodd" d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z" clip-rule="evenodd" />
                  </svg>
               </a>
            </div>
         </div>
      </div>
   </header>
   <div class="base" id="about">
      <div class="container">
         <div class="base_title">
            <h1 class='mb-5'>
            <?= $news['header'] ?>
            </h1>
         </div>
         <div class="base_inner d-flex">
            <div class="image">
               <div class="image__inner">
                  <img class="news_image" src="files/<?= $news['photo'] ?>" alt="<?=$news['header'];?>">
               </div>
            </div>
            <div class="base_inner_text">
               <p> <?= str_replace("\r\n", "", nl2br($news['text'])); ?></p>
            </div>
         </div>
      </div>
   </div>
   <div class="schedule" id="prices">
      <div class="container">
         <a href="news.html" class="cashback_title">Другие новости</a>
      </div>
   </div>
   <div class="order_block" id="contacts">
      <div class="container">
         <div class="order_block_title">Оставить заявку</div>
         <div class="row">
            <div class="col-lg-4">
               <div class="order_form">
                  <div class="mobile_footer_title">Оставить заявку</div>
                  <div class="order_form_title">Заполните форму для обратного звонка</div>
                  <div class="answer">

                  </div>
                  <form class="ajax-contact-form">
                     <input maxlength="40" type="text" placeholder="Имя" name="name" class="input input_name">

                     <input type="tel" placeholder="Телефон" name="phone" min="10" autocomplete="off" class="input phone_input" required>

                     <textarea placeholder="Комментарий" name="comm" class="input"></textarea>
                     <div class="check"><input type="checkbox" class="check" id="check" checked="checked"><label for="check"><span>Я согласен на обработку персональных данных</span></label></div>
                     <input type="submit" onclick="ym(64951555,'reachGoal','submit'); return true;" value="Записаться" class="btn btn-form"><br>
                     <div style="color: #003a70;" class="note"></div>
                  </form>
               </div>
            </div>
            <div class="col-lg-8">
               <div class="cashback">
                  <div class="cashback_title"><i></i> <span>Цена действительна только до 10.03.2022</span></div>
                  <div class="cashback_inner d-flex align-items-end">
                     <img src="images/cashback_img.png" loading="lazy" alt="">
                     <div class="txt">
                        <p>Часть расходов на детский лагерь компенсирует организатор —&nbsp;футбольная школа Юниор.
                           Компенсация предоставляется жителям Санкт-Петербурга.</p>
                        <p>Если у вас нет городской прописки, позвоните нам, и мы постараемся помочь вам получить
                           компенсацию <br>и сэкономить часть средств.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <footer>
      <div class="container d-flex">
         <a href="#" class="footer_logo"><img src="images/footer_logo.svg" loading="lazy" alt=""></a>
         <nav class="footer_menu">
            <div class="footer_menu_title">Детская футбольная школа «Юниор»</div>
            <ul class="d-flex justify-content-between">
               <li><a href="#prices" class="scrollto">Цены</a></li>
               <li><a href="#about" class="scrollto">О месте</a></li>
               <li><a href="#programm" class="scrollto">Программа</a></li>
               <li><a href="#contacts" class="scrollto">Контакты</a></li>
            </ul>
         </nav>
         <div class="footer_contacts">
            <div class="footer_contacts-wrapp">
               <a href="https://docs.google.com/document/d/1MR1UIYkbJkQo_BEFD1YJ2sbaNQtTQVWpCm9VYKE4nC0/edit?usp=sharing" target="_blank">Договор публичной оферты</a>
               <p>Режим работы: 10:00 - 17:00</p>
            </div>
            <div class="footer_contacts-wrapp">
               <p>Почта: <a class="mail-button-link" href="mailto:admin@campjunior.com">admin@campjunior.com</a></p>
               <p>Телефон: <a href="tel:+79205133958" class="header-phone-contact">+7 (920) 513-39-58</a></p>
            </div>
         </div>
         <a class="copy align-items-center" href="https://addvi.ru/" target="_blank">
            <div><img src="images/sign.svg" loading="lazy" alt=""></div>
            <span>Сайт разработан компанией <br>Addvi Business Solutions, 2022</span>
         </a>
      </div>
   </footer>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script src="js/swipe.js"></script>
   <script src="js/jquery.fancybox.min.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>
   <script src="js/jquery.inputmask.min.js"></script>
   <script src="js/jquery.bxslider.min.js"></script>
   <script src="js/jquery.colorbox-min.js"></script>
   <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
   <script src="js/main.js"> </script>
   <script>

   </script>
   <!-- <script>(function (w, d, s, l, i){w[l]=w[l] || []; w[l].push({'gtm.start':new Date().getTime(), event: 'gtm.js'}); var f=d.getElementsByTagName(s)[0],j=d.createElement(s), dl=l !='dataLayer' ? '&l=' + l : ''; j.async=true; j.src='https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);})(window, document, 'script', 'dataLayer', 'GTM-K4PMW8X');</script><script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(64951555, "init",{clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true});</script>  -->
   <!-- <noscript>
         <div><img src="https://mc.yandex.ru/watch/64951555" style="position:absolute; left:-9999px;" alt=""/></div>
      </noscript> -->
   <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-170788894-1"></script><script>window.dataLayer=window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-170788894-1');</script>  -->
   <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K4PMW8X" height="0" width="0"style="display:none;visibility:hidden"></iframe></noscript> -->
   <script type="text/javascript">
      /* CSS #2 */
      let giftofspeed = document.createElement('link');
      giftofspeed.rel = 'stylesheet';
      giftofspeed.href = 'css/_libraries.min.css';
      giftofspeed.type = 'text/css';
      let godefer = document.getElementsByTagName('link')[0];
      godefer.parentNode.insertBefore(giftofspeed, godefer);
   </script>
</body>

</html>
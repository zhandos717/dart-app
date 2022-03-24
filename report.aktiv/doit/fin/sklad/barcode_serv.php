<?php
// Определение переменной для предотвращения взлома
define('IN_CB',true);
include ("includes/db.php");
// Включая все необходимые классы
require('barcode/class/index.php');
require('barcode/class/FColor.php');
require('barcode/class/BarCode.php');
require('barcode/class/FDrawing.php');

// включая технологию штрих-кода
include('barcode/class/code39.barcode.php');

// Создание некоторого цвета (аргументы R, G, B)
$color_black = new FColor(0,0,0);
$color_white = new FColor(255,255,255);

/* Вот список аргументов:
1 - Толщина
2 - Цвет полос
3 - Цвет пространств
4 - Разрешение
5 - Текст
6 - Шрифт текста (0-5) */
$code_generated = new code39(30,$color_black,$color_white,1,'5550',2);

/* Here is the list of the arguments
1 - Width
2 - Height
3 - Filename (empty : display on screen)
4 - Background color */ 
$drawing = new FDrawing(1024,1024,'',$color_white);
$drawing->init(); // You must call this method to initialize the image
$drawing->add_barcode($code_generated);
$drawing->draw_all();
$im = $drawing->get_im();

// Next line create the little picture, the barcode is being copied inside
$im2 = imagecreate($code_generated->lastX,$code_generated->lastY);
imagecopyresized($im2, $im, 0, 0, 0, 0, $code_generated->lastX, $code_generated->lastY, $code_generated->lastX, $code_generated->lastY);
$drawing->set_im($im2);

// Header that says it is an image (remove it if you save the barcode to a file)
header('Content-Type: image/png');

// Draw (or save) the image into PNG format.
$drawing->finish(IMG_FORMAT_PNG);
?>

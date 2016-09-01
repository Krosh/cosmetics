<?php
$recepient = "dialoggg1994@gmail.com";
$sitename = "Косметика123";

$name = trim($_POST["modal__name"]);
$city = trim($_POST["modal__city"]);
$rating = trim($_POST["modal__rating"]);
$message = "Имя: $name \n Город: $city \n Рейтинг $rating";

$pagetitle = "Новая заявка с сайта \"$sitename\"";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");
<?php
$recepient = "dialoggg1994@gmail.com";
$sitename = "���������123";

$name = trim($_POST["modal__name"]);
$city = trim($_POST["modal__city"]);
$rating = trim($_POST["modal__rating"]);
$message = "���: $name \n �����: $city \n ������� $rating";

$pagetitle = "����� ������ � ����� \"$sitename\"";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");
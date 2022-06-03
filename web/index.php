<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оптимизация работы скорой помощи</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
$link = mysqli_connect('localhost', 'root', '','ambulance');


$result = mysqli_query($link, 'SELECT * FROM vysov');

$data = mysqli_fetch_array($result);

?>

<div class="top">

</div>

<div class="main">
<p>Число вызовов</p>

</div>

</body>
</html>
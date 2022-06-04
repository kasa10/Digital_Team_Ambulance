<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Оптимизация работы скорой помощи</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<?php
$link = mysqli_connect('localhost', 'root', '','ambulance');


$result = mysqli_query($link, 'SELECT * FROM predict');

$data = mysqli_fetch_array($result);

?>

<div class="back">

    <div class="logo">
        <a href="index.php"><img src="img/logo.png"></a>
    </div>
    
</div>

<div class="main">




    <div class="block">
        <p>вызовы сегодня/прогноз</p>
        <h1></h1>
    </div>

    <div class="block">
        <p>Прогноз на завтра</p>
        <h1></h1>
    </div>

    <br/>

    <div class="block">
        <p>Количество бригад в работе/в простое</p>
        <h1></h1>
    </div>

    <div class="block">
        <p>Рекомнедуемое количество бригад на 08.06.22</p>
        <h1></h1>
    </div>

    <div class="dop">
        <h3 class="t1">Дополнительные факторы</h3>
        <a class="p1">Обслуживание машин</a>
        <a class="p2">Отпуск</a>
        <a class="p3">Другое</a>
        <img src="img/dop.png" style="width: 460px; height: 180px; margin-top: 30px; display: block">
    </div>

    <table id="calendar2">
        <thead>
        <tr><td>‹<td colspan="5"><td>›
        <tr><td>Пн<td>Вт<td>Ср<td>Чт<td>Пт<td>Сб<td>Вс
        <tbody>
    </table>

    <script>
        function Calendar2(id, year, month) {
            var Dlast = new Date(year,month+1,0).getDate(),
                D = new Date(year,month,Dlast),
                DNlast = new Date(D.getFullYear(),D.getMonth(),Dlast).getDay(),
                DNfirst = new Date(D.getFullYear(),D.getMonth(),1).getDay(),
                calendar = '<tr>',
                month=["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"];
            if (DNfirst != 0) {
                for(var  i = 1; i < DNfirst; i++) calendar += '<td>';
            }else{
                for(var  i = 0; i < 6; i++) calendar += '<td>';
            }
            for(var  i = 1; i <= Dlast; i++) {
                if (i == new Date().getDate() && D.getFullYear() == new Date().getFullYear() && D.getMonth() == new Date().getMonth()) {
                    calendar += '<td class="today">' + i;
                }else{
                    calendar += '<td>' + i;
                }
                if (new Date(D.getFullYear(),D.getMonth(),i).getDay() == 0) {
                    calendar += '<tr>';
                }
            }
            for(var  i = DNlast; i < 7; i++) calendar += '<td>&nbsp;';
            document.querySelector('#'+id+' tbody').innerHTML = calendar;
            document.querySelector('#'+id+' thead td:nth-child(2)').innerHTML = month[D.getMonth()] +' '+ D.getFullYear();
            document.querySelector('#'+id+' thead td:nth-child(2)').dataset.month = D.getMonth();
            document.querySelector('#'+id+' thead td:nth-child(2)').dataset.year = D.getFullYear();
            if (document.querySelectorAll('#'+id+' tbody tr').length < 6) {  // чтобы при перелистывании месяцев не "подпрыгивала" вся страница, добавляется ряд пустых клеток. Итог: всегда 6 строк для цифр
                document.querySelector('#'+id+' tbody').innerHTML += '<tr><td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;';
            }
        }
        Calendar2("calendar2", new Date().getFullYear(), new Date().getMonth());
        // переключатель минус месяц
        document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(1)').onclick = function() {
            Calendar2("calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)-1);
        }
        // переключатель плюс месяц
        document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(3)').onclick = function() {
            Calendar2("calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)+1);
        }
    </script>

</div>


</body>
</html>
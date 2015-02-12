<?php
//今月のcalendar

$timeStanp = time();

//最終日？

$lastDay = date("t",$timeStanp);

//１日は何曜日？
//0: sum......6: sat

$youbi = date("w", mktime(0,0,0,date("m",$timeStanp),1,date("y",$timeStanp)));

//var_dump($lastDay);
//var_dump($youbi);


$weeks = array();
$week = '';

$week .= str_repeat('<td></td>>', $youbi);

for ($day = 1; $day <= $lastDay; $day++, $youbi++) {
    $week .= sprintf('<td class="youbi_%d">%d</td>', $youbi % 7, $day);

    if ($youbi % 7 == 6 OR $day == $lastDay) {
        if ($day == $lastDay){
            $week .= str_repeat('<td></td>', 6 - ($youbi % 7 ));
        }
        $weeks[] = '<tr>' . $week . '</tr>';
        $week = '';
    }


}





















?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset = "utf-8">
    <title>カレンダー</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
    <table>
        <thead>
            <tr>
                <th><a href="">&laquo;</a></th>
                <th colspan="5">2015-02</th>
                <th><a href="">&raquo;</a></th>
            </tr>
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                    }
            ?>

        </tbody>
    </table>
</body>
</html>
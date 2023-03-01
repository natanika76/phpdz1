<?php
    $title = "Задача про календарь";
    require "./header.php";
    
?>

   <div class="container mt-2">
    <h1>Календарь</h1>
    <form method="POST">
        <label for="month">Месяц</label>
        <input type="text" name="month" placeholder="M" class="form-control"><br>
        <input type="submit" value="Show" class="btn btn-success"><br>
    </form>
    </div>

    <?php
    $month = "";
    $year = 2023;

    $month= $_POST['month'];
    $text_bgcolor = '#fff';
    $highlight_today = 1;
    $today_bgcolor = '#2f2f2f';
    $today_txtcolor = '#fff';
    $column_width = 22;

    function genSet_Stop($month, $year) {
        if($month == '12') {
            $month = 1;
            $year++;
        } else {
           $month++; 
        }
        $stop = date("d", mktime(0,0,0, $month, 0, $year));
        return $stop;
    }

    function genCalendar_Month($month, $year, $stop, $column_width) {
        global $today_bgcolor, $highlight_today, $today_txtcolor;

        $month = (intval($month));
        if($month == 12) {
            $prev_month = $month -1;
            $prev_year = $year;
            $next_month = 1;
            $next_year = $year + 1; 
        }
        elseif ($month == 1) {
            $prev_month = 12;
            $prev_year = $year-1;
            $next_month = $month + 1;
            $next_year = $year; 
        }
        else {
            $prev_month = $month - 1;
            $prev_year = $year;
            $next_month = $month + 1;
            $next_year = $year; 
        }
        
        $Month_Text['1'] = 'Январь';
        $Month_Text['2'] = 'Февраль';
        $Month_Text['3'] = 'Март';
        $Month_Text['4'] = 'Апрель';
        $Month_Text['5'] = 'Май';
        $Month_Text['6'] = 'Июнь';
        $Month_Text['7'] = 'Июль';
        $Month_Text['8'] = 'Август';
        $Month_Text['9'] = 'Сентябрь';
        $Month_Text['10'] = 'Октябрь';
        $Month_Text['11'] = 'Ноябрь';
        $Month_Text['12'] = 'Декабрь';

        $string = '<tr>'.
        '<td colspan="7">'.$year.'г-'.$Month_Text["$month"].'<td>'.
        '</tr>'.
        '<tr><td width="'.$column_width.'">Пн</td>'.
        '<td width="'.$column_width.'">Вт</td>'.
        '<td width="'.$column_width.'">Ср</td>'.
        '<td width="'.$column_width.'">Чт</td>'.
        '<td width="'.$column_width.'">Пт</td>'.
        '<td width="'.$column_width.'" style="color: #f63e3e;">Сб</td>'.
        '<td width="'.$column_width.'" style="color: #f63e3e;">Вс</td>'.
        '</tr>';

        $start = date("w", mktime(0,0,0, $month, 1, $year)) - 1;
        if($start == -1) $start = 6;
        for($i = 0; $i < $start; $i++) $string .='<td>&nbsp;</td>';

        $frame = $start -1;
        for($i = 1; $i < $stop; $i++){
            $day = mktime(0,0,0, date("m"), $i, date("Y"));
            $frame++;
            if($frame > 6) {
                $string.='</tr>';
                if($i < $stop) $string.='<tr>';
                $frame = 0;
            }
            if($month == date("m", $day) && $year == date("Y", $day) && date("d") == date("d", $day) && $highlight_today == 1) {
                $string.='<td width='.$column_width.' style="background:'.$today_bgcolor.'; color:'.$today_txtcolor.';">'.$i.'</td>';
                continue;
            }
            if ($frame == 5 || $frame == 6) {
                $string .='<td width='.$column_width.' style="color:#f63e3e;">'.$i.'</td>';
            }
            else {
                $string .='<td width='.$column_width.' style="color:#666;">'.$i.'</td>';
            }
        }
        for($i = 1; $frame < 6; $frame++) $string .= '<td>&nbsp;</td>';
        if($frame < 6) $string .= '</tr>';
        return $string; 
    }
    ?>
<style type='text/css'>
    td{text-align:center;}
</style>

<table cellpadding="0" cellspacing="0" style="margin-top:5px; margin-bottom:10px; width:180; height:140;">
<?php
if(!$month){
$month = date('m');
$year = date('Y');
}
$day_number = genSet_Stop($month, $year);
print $mid_html = genCalendar_Month($month, $year, $day_number, $column_width);
?>
</table>

    <?php
    require_once "./footer.php";
    ?>



    
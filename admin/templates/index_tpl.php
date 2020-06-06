<?php
$count_online = count_online();
/* Set the default timezone */
date_default_timezone_set('Asia/Ho_Chi_Minh');

/* Set the date */
if($_GET['datepicker']!=''){
    $date = strtotime($_GET['datepicker']);
} else {
    $date = strtotime(date('y-m-d'));
} 

$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);
$firstDay = mktime(0,0,0,$month, 1, $year);
$lastDay = mktime(1,1,1,$month, 0, $year);
$title = strftime('%B', $firstDay);
$dayOfWeek = date('D', $firstDay);
$daysInMonth = cal_days_in_month(0, $month, $year);
/* Get the name of the week days */
$timestamp = strtotime('next Sunday');
$weekDays = array();
for ($i = 0; $i < 7; $i++) {
    $weekDays[] = strftime('%a', $timestamp);
    $timestamp = strtotime('+1 day', $timestamp);
}
$blank = date('w', strtotime("{$year}-{$month}-01"));
?>

<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Thống kê truy cập tháng : <?php echo $month ?> - <?php echo $year ?> '
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Arial'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Số người truy cập'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Tổng : <b>{point.y:.1f} Lượt truy cập</b>'
            },
            series: [{
                name: 'Population',
                data: [
                <?php //echo date('d/m/Y',1514653201).'|'.date('d/m/Y',1514739600);
                for($i = 1; $i <= $daysInMonth; $i++):
                    if($i == 1){
                        $end = (strtotime($year.'-'.$month.'-'.$i) + 86400) - 1;
                        $begin = strtotime($year.'-'.$month.'-'.$i) + 1;
                    }
                    elseif($i == $daysInMonth){
                        $end = strtotime($year.'-'.$month.'-'.$i) + 86400 - 1;
                        $begin = strtotime($year.'-'.$month.'-'.$i) + 1;
                    } else {
                        $k = $i+1;
                        $end = strtotime($year.'-'.$month.'-'.$k);
                        $begin = strtotime($year.'-'.$month.'-'.$i);
                    }

                    $query             =    "SELECT COUNT(*) AS todayrecord FROM table_counter WHERE tm>='$begin' and tm<'$end' "; 
                    $todayrc  = _fetch_array($query); 
                    $today_visitors     =    $todayrc['todayrecord']; 

                    ?>
                    ['<?=$i?>', <?=$today_visitors?>],
                <?php endfor; ?>


                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Arial'
                }
            }
        }]
    });
        $( "#datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true,
          showButtonPanel: true,
          dateFormat: 'yy-mm',
          onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
    });
</script>


<div class="wrapper">
    <form name="supplier" id="validate" class="form" action="index.php" method="get" enctype="multipart/form-data">

        <div class="widget">
           <div class="title"><h6>Chào mừng bạn đến với Administrator - HỆ THỐNG QUẢN TRỊ NỘI DUNG WEBSITE</h6><div class="clear"></div></div>
           <div class="clear"></div>

           <div class="formRow">
            <label>Thống kê theo tháng</label>
            <div class="formRight">
                <input type="text" id="datepicker" name="datepicker" placeholder="yyyy-mm-dd" value="<?=$_GET['datepicker']?>">
                <input type="submit" class="blueB xemthongke" onclick="TreeFilterChanged2(); return false;" value="Xem thống kê" />
            </div>
            <div class="clear"></div>
        </div>

        <div class="clear"></div>

        <div id="container" style="width: 100%; height: 400px; margin: 0 auto"></div>
        <div class="clear"></div>
        <!-- 2 columns widgets -->

    </div>
    <div class="clear"></div>
    <?php echo $today = date("d-m-y H:i a");  ?>
</form>
<div class="clear"></div>
</div>
<script src="js/highcharts/highcharts.js"></script>
<script src="js/highcharts/modules/exporting.js"></script>


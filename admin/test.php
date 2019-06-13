<?php
// $ddate = "2012-10-18";
// $date = new DateTime($ddate);
// $week = $date->format("W");
// echo "Weeknummer: $week";

/* =========================*/
// $date_string = "2012-10-18";
// $date_int = strtotime($date_string);
// $date_date = date($date_int);
// $week_number = date('W', $date_date);
// echo "Weeknumber: {$week_number}.";

// function getStartAndEndDate($week, $year) {
//   $dto = new DateTime();
//   $dto->setISODate($year, $week);
//   $ret['week_start'] = $dto->format('Y-m-d');
//   $dto->modify('+6 days');
//   $ret['week_end'] = $dto->format('Y-m-d');
//   return $ret;
// }

// // $week_array = getStartAndEndDate(52,2018);
// // print_r($week_array);

//  $startOfWeek = date("Y-m-d", strtotime("Monday this week"));

//    for ($i=0; $i<7;$i++){
//        echo date("l, d M", strtotime($startOfWeek . " + $i day"))."<br />";
//    }


//    function weekOfMonth($qDate) {
//     $dt = strtotime($qDate);
//     $day  = date('j',$dt);
//     $month = date('m',$dt);
//     $year = date('Y',$dt);
//     $totalDays = date('t',$dt);
//     $weekCnt = 1;
//     $retWeek = 0;
//     for($i=1;$i<=$totalDays;$i++) {
//         $curDay = date("N", mktime(0,0,0,$month,$i,$year));
//         if($curDay==7) {
//             if($i==$day) {
//                 $retWeek = $weekCnt+1;
//             }
//             $weekCnt++;
//         } else {
//             if($i==$day) {
//                 $retWeek = $weekCnt;
//             }
//         }
//     }
//     return $retWeek;
// }

// echo weekOfMonth(date('2018-05-06'));

//echo " sub" . substr('2018-12-10', 0,4);

?>
<?php
$a=array("Volvo"=>"XC90","BMW"=>"X5");
if (array_key_exists("Volvo",$a) =="x5")
  {
  echo "Key exists!";
  }
else
  {
  echo "Key does not exist!";
  }
?>
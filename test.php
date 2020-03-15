<?php

$begin = new DateTime( '2012-08-25' );
$end = new DateTime( '2012-08-31' );
$end = $end->modify( '+1 day' );

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);
$i=0;
foreach($daterange as $date){
    $i++;
}
echo $i;
?>




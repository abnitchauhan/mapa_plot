<?php

list($day, $month, $year) = explode('-', '22-09-2008');
$timedate =  mktime(0, 0, 0, $month, $day, $year);
?>

<script>

var timedate = <?php echo json_encode($timedate) ; ?>;
timedate = timedate*1000;
var stringdate = new Date(timedate);

finalDate = stringdate.getDate()+'/'+ (stringdate.getMonth()+1)+ '/'+stringdate.getYear();
console.log(finalDate);

</script>
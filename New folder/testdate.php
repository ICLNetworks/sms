<?php

/*$date = '02.20.1986';
$parts = explode('.', $date);
$mydate = mktime(0, 0, 0, $parts[0], $parts[1], $parts[2]);
$printdate = date('F d, Y', $mydate);
echo $printdate;
echo date("F");*/

echo date("M jS", strtotime("2011-10-03"));


?>
<script>
var numbers = [1, 2, 3, 4, 5];

for (var i=0;i<numbers.length;i++){
   $('<option/>').val(numbers[i]).html(numbers[i]).appendTo('#items');
}
</script>
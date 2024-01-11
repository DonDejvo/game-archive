<?php
$mena = 'CZK';
if(isset($_GET['c'])) {
    $c = $_GET['c'];
    if($c == 'CZK' || $c == 'USD') {
        $mena = $c;
    }
}

setcookie('mena', $mena);
echo $mena;
?>
<?php
include "./lib/init.php";

$commonObj->SetSession("lids",'','-4200');
$commonObj->SetSession("lnams",'','-4200');
$commonObj->SetSession("lutys",'','-4200');

$commonObj->RedirectTo('index.php?i=2');

?>

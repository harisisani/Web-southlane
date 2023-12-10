<?php

$date = new DateTime("now", new DateTimeZone('Asia/Karachi') );
echo $date->format("Y-m-d");
?>
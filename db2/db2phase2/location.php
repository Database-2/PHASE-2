<?php
//http://www.developphp.com/video/PHP/GeoPlugin-Tutorial-Get-User-Location-Information-IP-Detection
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=?"));
$city = $geo["geoplugin_city"];
$state = $geo["geoplugin_region"];
$loc = $city. ',' .$state;
echo $loc;
?>
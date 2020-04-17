<?php
 $urlTemplate = 'http://api.ip2location.com/?' . 'ip=%s&key=demo' . '&package=WS24&format=json';
 $host= gethostname();
 $ipAddress = gethostbyname($host);
 
 // replace the "%s" with real IP address
 $urlToCall = sprintf( $urlTemplate, $ipAddress);
 
 $rawJson = file_get_contents( $urlToCall );
 
 $geoLocation = json_decode( $rawJson, true );
 
 if(isset($geoLocation['city_name'])){
 
    if($geoLocation['city_name']!="-"){
        echo '<script language="javascript">';
        echo 'alert("Welcome Visitors from '.$geoLocation['city_name'].'")';
        echo '</script>';
    }else
    {
        echo '<center>You are in local server!</center><br>';
        echo '<script language="javascript">';
        echo 'alert("You are in local server!")';
        echo '</script>';
    }
 }else{
     echo 'IP Address parsing error!';
 }
?>
<html>
<head>
<title>IP2Location Web Service</title>
    </head>
<body>
<div>
<center>Hello World!</center><br>
</div>
<div>
<center>Your IP address <?php echo $ipAddress; ?></center>
      <center>
      <?php
      if(isset($geoLocation['country_code'])&&isset($geoLocation['country_name'])&&isset($geoLocation['region_name'])&&isset($geoLocation['city_name'])&&isset($geoLocation['latitude'])&&isset($geoLocation['longitude'])&&isset($geoLocation['zip_code'])&&isset($geoLocation['time_zone'])){
        echo '<br>Country Code:'."\n". $geoLocation['country_code'] . "\n<br>";
        echo 'Country Name:'."\n". $geoLocation['country_name'] . "\n<br>";
        echo 'Region Name:'."\n". $geoLocation['region_name'] . "\n<br>";
        echo 'City Name:'."\n". $geoLocation['city_name'] . "\n<br>";
        echo 'Latitude:'."\n". $geoLocation['latitude'] . "\n<br>";
        echo 'Longitude:'."\n". $geoLocation['longitude'] . "\n<br>";
        echo 'Zip code:'."\n". $geoLocation['zip_code'] . "\n<br>";
        echo 'Time zone:'."\n". $geoLocation['time_zone'] . "\n<br>";
      }else{
          echo 'IP Address parsing error!';
      }
      ?>
      </center>
</div>
</body>
</html>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="table.css">

  <title>Tracking Result</title>
  <style>
.gdot {
    height: 25px;
    width: 25px;
    background-color: green;
    border-radius: 50%;
    display: inline-block;
   
}
.rdot {
    height: 25px;
    width: 25px;
    background-color: red;
    border-radius: 50%;
    display: inline-block;
   
}
/*  
  Side Navigation Menu V2, RWD
  ===================
  License:
  https://goo.gl/EaUPrt
  ===================
  Author: @PableraShow

 */

@charset "UTF-8";
@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,700);

.dot {
    height: 25px;
    width: 25px;
    background-color: green;
    border-radius: 50%;
    display: inline-block;
    color:green;
body {
  font-family: 'Open Sans', sans-serif;
  font-weight: 300;
  line-height: 1.42em;
  color:#A7A1AE;
  background-color:#1F2739;
}

h1 {
  font-size:3em; 
  font-weight: 300;
  line-height:1em;
  text-align: center;
  color: #4DC3FA;
}

h2 {
  font-size:1em; 
  font-weight: 300;
  text-align: center;
  display: block;
  line-height:1em;
  padding-bottom: 2em;
  color: #FB667A;
}

h2 a {
  font-weight: 700;
  text-transform: uppercase;
  color: #FB667A;
  text-decoration: none;
}

.blue { color: #185875; }
.yellow { color: #FFF842; }

.container th h1 {
    font-weight: bold;
    font-size: 1em;
  text-align: left;
  color: #185875;
}

.container td {
    font-weight: normal;
    font-size: 1em;
  -webkit-box-shadow: 0 2px 2px -2px #0E1119;
     -moz-box-shadow: 0 2px 2px -2px #0E1119;
          box-shadow: 0 2px 2px -2px #0E1119;
}

.container {
    text-align: left;
    overflow: hidden;
    width: 80%;
    margin: 0 auto;
  display: table;
  padding: 0 0 8em 0;
}

.container td, .container th {
    padding-bottom: 2%;
    padding-top: 2%;
  padding-left:2%;  
}

/* Background-color of the odd rows */
.container tr:nth-child(odd) {
    background-color: #323C50;
}

/* Background-color of the even rows */
.container tr:nth-child(even) {
    background-color: #2C3446;
}

.container th {
    background-color: #1F2739;
}

.container td:first-child { color: #FB667A; }

.container tr:hover {
   background-color: #464A52;
-webkit-box-shadow: 0 6px 6px -6px #0E1119;
     -moz-box-shadow: 0 6px 6px -6px #0E1119;
          box-shadow: 0 6px 6px -6px #0E1119;
}

.container td:hover {
  background-color: #FFF842;
  color: #403E10;
  font-weight: bold;
  
  box-shadow: #7F7C21 -1px 1px, #7F7C21 -2px 2px, #7F7C21 -3px 3px, #7F7C21 -4px 4px, #7F7C21 -5px 5px, #7F7C21 -6px 6px;
  transform: translate3d(6px, -6px, 0);
  
  transition-delay: 0s;
    transition-duration: 0.4s;
    transition-property: all;
  transition-timing-function: line;
}

@media (max-width: 800px) {
.container td:nth-child(4),
.container th:nth-child(4) { display: none; }
}
</style>

</head>
<body>
<h1> <span class="yellow">Tracking Tool</span></h1>

<table class="container">

  <thead>
    <tr>
      <th><h1>IP</h1></th>
      <th><h1>Country</h1></th>
      <th><h1>Region</h1></th>
      <th><h1>City</h1></th>
      <th><h1>Status </h1></th>
      <th><h1>Longitude</h1></th>
      <th><h1>Latitude</h1></th>
      <th><h1>Page Viewed</h1></th>

      <th><h1>Time Spent</h1></th>
      <th><h1>Clicked/Typed</h1></th>

    </tr>  
  </thead> 
  <?php

    include("connect.php");
    $query="SELECT Distinct * FROM user_location_info group by ip order by ip";
     $run = mysqli_query($con,$query);
     $ip;
                while ($row=mysqli_fetch_array($run))
                 {
                        $ip=$row['ip'];
                        
                     
                     
                        ?>
   <tbody>

    <tr>
      <td><?php echo $row['ip'];?></td>
      <td><?php echo $row['country'];?></td>
      <td><?php echo $row['region'];?></td>
      <td><?php echo $row['city'];?></td>
        <?php
        if($row['active_status']==1){
        ?>
      <td ><span class="gdot"></span> </td>
      <?php }
      else { ?> 
      <td class="dot"><span class="rdot"></span></td>
     <?php } ?>
      
      <td><?php echo $row['longitude'];?></td>
      <td><?php echo $row['latitude'];?></td>
      <td><?php echo $row['page'];?></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <?php
      
                            $query1="SELECT DISTINCT l.min,l.sec,t.text_c from log l JOIN user_click t on l.ip=t.ip and l.ip='$ip' and t.ip='$ip'";
                             $run1 = mysqli_query($con,$query1);
                             $text="";
                             $min="";
                             $texts=array();
                             $count=0;
                             while ($row1=mysqli_fetch_array($run1)) {
                             	$texts[$count]=$row1['text_c'];
                             	$count++;
                             }
                             $size=count($texts);
                             $count=0;
                             $run1 = mysqli_query($con,$query1);
                             while ($row1=mysqli_fetch_array($run1)) {
                             	if($min!=$row1['min']){
                                        
                                    
                              $min= $row1['min'];
                              $sec= $row1['sec'];
                              if($count<$size)
                                $text= $texts[$count];
                              else
                                $text="";
                              $count++;
                              	
                       
      ?> 
      <td></td>
      <td></td>
       <td></td>
      <td></td>
       <td></td>
      <td></td>
       <td></td>
      <td></td>
       <td><?php echo  $min . ":" .$sec;?></td>
      <td><?php echo  $text;?></td>
    </tr>



      <?php } }} ?>
     
   
  </tbody>
</table>
</body>
</html> 
<?php

		include('connect.php');
		session_start();
		$query="SELECT DISTINCT * from user_location_info GROUP by ip order by ip";
		 $run = mysqli_query($con,$query);
                       while ($row=mysqli_fetch_assoc($run)) {
                           if($row['referal'])
                            echo "User Referal :".$row['referal']."<br/>\n\n";
                            else
                            echo "New User: Yes<br/>\n\n";                                
                       			$ip=$row['ip'];
                       			$active=$row['active_status'];
                       			if($active=='1')
                       			{
                       			    	echo "<h1 style='color: green;'>Online</h1>";
                       			}
                       			else
                       				echo "<h1 style='color: red;'>Offline</h1>";
                       			echo "<br/>\n\n";	
                       			
                       			$country= $row['country'];
                       			$city= $row['city'];
                       			$user_browser=$row['user_browser'];
                       			$page=$row['page'];
                       			$long=$row['longitude'];
                       			$lat=$row['latitude'];
                                $cookie_value=$row['cookie'];
                       			echo " User IP :" .$ip;
                       			echo " Cookie value based on first ip :.$cookie_value";
                       			
                       			echo " User Browser: ". $user_browser. "<br/>\n";
	                            $region= $row['region'];
                       			echo " User Country :".$country;
                       			echo " User Region :".$region;
                       			echo " User City :".$city;
                       			
                       			echo " Page Visited :".$page;
                       			echo "<br />\n";
                       			echo " Longitude :".$long;
                       			echo " Latitude :".$lat;
                                echo "<br />\n"; 
                                
                                $query2="SELECT DISTINCT * from user_click where ip='$cookie_value'";
                       			 $run2 = mysqli_query($con,$query2);
                       			 while ($row2=mysqli_fetch_assoc($run2)) {

                       			 	$text= $row2['text_c'];
                       			 	$type= $row2['type'];
                       			 	
                       			 	if($type==0)
                       			 	    echo " User Clicked: ". $text . "<br/>\n";
                       			 	else
                       			 	    echo " User Entered: ". $text . "<br/>\n";
                       			 	
                       			 

}
                                
                                
                       			$query1="SELECT DISTINCT * from log where ip='$cookie_value'";
                       			 $run1 = mysqli_query($con,$query1);
                       			 $count=0;
                       			 while ($row1=mysqli_fetch_assoc($run1)) {
                                        
                                    $count++;
                       			 	$min= $row1['min'];
                       			 	$sec= $row1['sec'];
                       			 	echo " Time spent: ". $min . ":" .$sec;
                       			 	echo "<br />\n";
                       			 
                       			 	
                       			 	
                       			 	

}
                                	if($count>1)
                       			 	    echo " User Type: Returning";
                       			 	else
                       			 	    echo " User Type: Not Returning";
                       			 	echo "<br />\n";  

                                $query3="SELECT DISTINCT * from user_scroll where ip='$cookie_value'";
                       			 $run3 = mysqli_query($con,$query3);
                       			 while ($row3=mysqli_fetch_assoc($run3)) {

                       			 	$min= $row3['scroll'];
                       			 	
                       			 	echo " User Scrolled : ".$min;
                       			 	
                       			 	
                       			 	echo "<br />\n";  
                       			 	
                       			 	
                       			 	

}
                       
                                echo "<br />\n"; 


                       }
                          
?>
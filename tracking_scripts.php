<?php
ob_start();
                                $cookie_value="empty";
			                    //cookie
			                    if(!isset($_COOKIE['cookie_ip'])) {
			                    $cookie_name = "cookie_ip";
                                $ip_address = getUserIP();
                                if(setcookie('cookie_ip', $ip_address ,time() + (86400 * 30), '/')) // 86400 = 1 day
			                        {
			                            ?>
			                        <script>alert("cookie set");</script>
			                        <?php  
			                        }
			                        else
			                         ?>
			                        <script>alert("cookie not setting up due to doamin");</script>
			                        <?php 
			                    }
			                    else
			                    {
			                        $cookie_value=$_COOKIE['cookie_ip'];
			                        
			                    }
			                    
			                    
			                    
			                    //
                                include('getBrowser.php');
                                include("connect.php");
                                $browser = getBrowser();
                                $user_agent = ($browser['name']) ; //user browser
			                    $ip_address = getUserIP();     // user ip adderss
			                   
			                    
			                    $query="Select * from user_location_info where ip='$cookie_value' and user_browser='$user_agent'";
			                    $run = mysqli_query($con,$query);
                       if (!$row=mysqli_fetch_assoc($run))
                       {
			        $page_name = $_SERVER["SCRIPT_NAME"];      // page the user looking
			        $query_string = $_SERVER["QUERY_STRING"];   // what query he used
			        $current_page = $page_name."?".$query_string; 
			        
			        try {
			        	
			       
					// get location 
				       $url = json_decode(file_get_contents(//your key here from http://api.ipinfodb.com
				   ));
				        $country=$url->countryName;  // user country
				        $city=$url->cityName;       // city
				        $region=$url->regionName;   // regoin
				        $latitude=$url->latitude;    //lat and lon
				        $longitude=$url->longitude;
				        $referal= $_SERVER["HTTP_REFERER"];

				        

				        $query= "INSERT INTO user_location_info (ip,cookie,active_status,user_browser,referal,country,city,region,longitude,latitude,page) VALUES ('$ip_address','$cookie_value','1','$user_agent','$referal','$country','$city','$region','$longitude','$latitude','$current_page')";

				         $runs = mysqli_query($con,$query);
				         	if (!$runs) {
				         		?>
				         		<script type="text/javascript">alert("Fails")</script>
				         		<?php
				         	}

				         } catch (Exception $e) {
				         	echo $e;
			        	
			        }
                       }
                       else
                       {
                            $referal= $_SERVER["HTTP_REFERER"];
                         if($referal)
                           {
                           $query1="Update user_location_info SET active_status='1',referal='$referal',cookie='$cookie_value' where ip='$ip_address' and user_browser='$user_agent'";
                           $runs1 = mysqli_query($con,$query1);
                               	if (!$runs1) {
				         		?>
				         		<script type="text/javascript">alert("Failed")</script>
				         		<?php
				         	}
                           }
                           else
                           {
                               $query1="Update user_location_info SET active_status='1',cookie='$cookie_value' where ip='$cookie_value' and user_browser='$user_agent'";
                           $runs1 = mysqli_query($con,$query1);
                           	if (!$runs1) {
				         		?>
				         		<script type="text/javascript">alert("Failed")</script>
				         		<?php
				         	}
                           }
				         
                       }
			        
			        function getUserIP() 
			        {
                                        if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) 
                                        {
                                            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) 
                                            {
                                                $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
                                                return trim($addr[0]);
                                            } 
                                            else 
                                            {
                                                return $_SERVER['HTTP_X_FORWARDED_FOR'];
                                            }
                                        }
                                        else 
                                        {
                                            return $_SERVER['REMOTE_ADDR'];
                                        }
                    }
			            
?>
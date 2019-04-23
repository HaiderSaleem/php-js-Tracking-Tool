<?php

include 'connect.php';
include('getBrowser.php');
                                
                                $browser = getBrowser();
                                $user_agent = ($browser['name']) ; //user browser
			                    $ip_address = getUserIP();     // user ip adderss
			                    $query1="Update user_location_info SET active_status='0' where ip='$ip_address' and user_browser='$user_agent'";
                           $runs1 = mysqli_query($con,$query1);
				         	if (!$runs1) {
				         		?>
				         		<script type="text/javascript">alert("Failed")</script>
				         		<?php
				         	}

                            $minute = $_POST['em'];
                             $sec=$_POST['es'];
                             if($minutes<0 )
                                $minutes*=-1;
                             if($sec<0 )
                                $sec*=-1;    
                             $ip_address = $_SERVER["REMOTE_ADDR"];
                            
                            
                              $t_query="INSERT INTO log (ip,min,sec) VALUES ('$ip_address','$minute','$sec')"; 
                                                    $runs = mysqli_query($con,$t_query);
                                                    if(!$runs){
                            						echo "not registered";
                            						
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
<h3 style="display: none;" id="none1">Done</h3>
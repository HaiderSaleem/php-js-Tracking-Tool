<?php

						include 'connect.php';

						@$text = $_POST['text'];
						if($text)
						{

						 $ip_address = $_SERVER["REMOTE_ADDR"];


						  $t_query="INSERT INTO user_click (ip,type,text_c) VALUES ('$ip_address','0','$text')"; 
						                        $runs = mysqli_query($con,$t_query);
						                        if(!$runs)
						                        {
													echo "not registered";
												
												}
						}
						else
						{
							$text=$_POST['enter'];
							 $ip_address = $_SERVER["REMOTE_ADDR"];


						  $t_query="INSERT INTO user_click (ip,type,text_c) VALUES ('$ip_address','1','$text')"; 
						                        $runs = mysqli_query($con,$t_query);
						                        if(!$runs)
						                        {
													echo "not registered";
												
												}
						

						}


?>
<h3 style="display: none;" id="none1">Done</h3>
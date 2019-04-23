<?php

	include ('connect.php');


// Create table
						


						    $scroll_height = $_POST['scroll'];
						 
						 	$ip_address = $_SERVER["REMOTE_ADDR"];
						 	$t_query1="SELECT * FROM user_scroll  where ip='$ip_address'"; 
						                        $runs1 = mysqli_query($con,$t_query1);
						                        if ($row=mysqli_fetch_assoc($runs1)) 
						                        {

						                        	if($row['scroll']<$scroll_height)
						                        	{
						                        		$id= $row['id'];
								                        $t_query="UPDATE user_scroll SET scroll='$scroll_height' where id='$id' and ip='$ip_address'"; 
								                        $runs = mysqli_query($con,$t_query);
								                        if(!$runs)
								                        {
														echo "not registered";
													
														}
						                        	}

						                        }
						                       else
						                        {
						                        	 $t_query="INSERT INTO user_scroll (ip,scroll) VALUES ('$ip_address','$scroll_height')"; 
								                        $runs = mysqli_query($con,$t_query);
								                        if(!$runs)
								                        {
														echo "not registered";
													
														}
						                        	
						                        }
						               

?>
<h3 style="display: none;" id="none1">Done</h3>
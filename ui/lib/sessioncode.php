<?php
header("Expires: Thu, 17 May 2001 10:17:17 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0
	
session_start();
	
	if (!isset($_SESSION['LOGGED'])) 
	{
		echo "YOU HAVE NOT LOGGED IN !";
		echo "<br /><a href='/Apex/ui/index.php'>Click Here</a> to log in.";
		exit();
    }
    
?>

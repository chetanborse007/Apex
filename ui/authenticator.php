<?php

$username =  $_POST['name'];
$password = $_POST['password'];
$isRemember = $_POST['remember'];
$attempts =  $_POST['attempts'];

$maxAttempts = 3;

	// Escape User Input to help prevent SQL Injection

$username = addslashes($username);
$password = addslashes($password);
$isRemember = addslashes($isRemember);


require_once('../conf/mysql.php');


//build query

if(is_numeric($username))
{
	$query = "SELECT * FROM userdata WHERE phone = '$username'";
}
else
{
$query = "SELECT * FROM userdata WHERE username = '$username' ";
}
//Execute query

$qry_result = mysql_query($query) or die(mysql_error());

if(mysql_affected_rows() == 0)
{
echo "Invalid Username !";
}

	
while($row = mysql_fetch_assoc($qry_result))
{
	
if( $row['locked']=="locked" )
{
echo "Locked !";
exit();
}

	
	if($row['password'] == $password && $row['usertype'] == "user")
	{
	echo "Accepted.";
	
	setcookie("remember", $isRemember, time()+60*60*24*7); 
	setcookie("username", $username, time()+60*60*24*7); 
	
	
	session_start();
	$_SESSION['LOGGED'] = true ;
	$_SESSION['usertype'] = "user";
	$_SESSION['userid'] = $row['serialnum'];
	}
	else if($row['password'] == $password && $row['usertype'] == "admin" )
	{
	echo "AcceptedAdmin";
	
	setcookie("remember", $isRemember, time()+60*60*24*7); 
	setcookie("username", $username, time()+60*60*24*7); 

	session_start();
	$_SESSION['LOGGED'] = true ;
	$_SESSION['usertype'] = "admin";
	$_SESSION['userid'] = $row['serialnum'];


	}
	else
	{

echo "Username and Password didn't match !";

if($attempts >= $maxAttempts && $row['locked'] == "open")
{
	$tempquery = "UPDATE `apex`.`userdata` SET `locked` = 'locked' WHERE `userdata`.`serialnum` = '".$row['serialnum']."'";
	
	$tempresult = mysql_query($tempquery) or die(mysql_error());

	setcookie("locked",$row['username'],time()+60*60*24*7*365);
}


	}
	
}


mysql_close($myconnection);
exit();
?>

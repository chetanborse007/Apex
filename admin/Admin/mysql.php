<?php
		$db_host='localhost';
		$db_port=3306;
		$db_user='root';
		$db_password='swap';
		$db_name='dbApex';
		
			mysql_connect("$db_host:$db_port",$db_user,$db_password);
			mysql_select_db($db_name);
?>

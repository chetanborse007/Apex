<?php
    if(isset($_GET['mainType']) && isset($_GET['subType']) && isset($_GET['changedPrefix']) && isset($_GET['year']) && isset($_GET['month']))
    {
		$mainType = $_GET['mainType'];
		$subType = $_GET['subType'];
		$changedPrefix = $_GET['changedPrefix'];
		$year = $_GET['year'];
		$month = $_GET['month'];
	}
    else
    {
		print_r($_GET);
        die('Died');
    }
    

	$fileDir = "../output/static/"."$mainType"."/"."$subType";
		
		
    for($i=1; $i<=31; $i++)
	{
		if($i < 10)
			$day = "0"."$i";
		else
			$day = $i;
	
					
		if($subType == "MuAng" || $subType == "WtPlot")
		{
			$compressedFilename = "$changedPrefix"."$year"."$month"."$day"."_"."$year"."$month"."$day".".ps.gz";
			$psFilename = "$changedPrefix"."$year"."$month"."$day"."_"."$year"."$month"."$day".".ps";
		}
		else if($subType == "ScPlot")
		{
			$compressedFilename = "$changedPrefix"."$year"."$month"."$day"."-"."$year"."$month"."$day".".ps.gz";
			$psFilename = "$changedPrefix"."$year"."$month"."$day"."-"."$year"."$month"."$day".".ps";
		}
		else
		{
			$compressedFilename = "$changedPrefix"."$year"."$month"."$day".".ps.gz";
			$psFilename = "$changedPrefix"."$year"."$month"."$day".".ps";
		}
		
		$filename = "$fileDir"."/"."$compressedFilename";
	
		
		if(is_file($filename))
		{
			$temp = "<input type='button' class='file' id='".$i."' name='".$fileDir."' value='".$psFilename."' onclick='wayToDisDown(this);'/>";
			echo "$temp";
	
			$break = "<br/>";
			echo "$break";
		}
	}		
?>

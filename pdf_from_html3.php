
<?php

	$rawHTML = $_POST["customHTML"];

	$currTimeStap = time();
	$uniqueFileName = "TempFilesDirectory/tempHTML".$currTimeStap.".html";

	$myfile = fopen($uniqueFileName, "w") or die("Unable to open file!");

	fwrite($myfile, $rawHTML);

	fclose($myfile);



	$path = "wkhtmltopdf\bin\wkhtmltopdf.exe";
    //$fixURL = "http://localhost:81/phpToPDF/examples/";
	$fixURL = "http://members.launchmyempire.com/";
	
	$url = $fixURL.$uniqueFileName;
    //echo "URL = " . $url;
	$fileNamePDF = "YourEBook" . $currTimeStap . ".pdf";
    
	$output_path = "TempFilesDirectory/" . $fileNamePDF;

	$fileDownloadLink = $fixURL.$output_path;
	
    shell_exec("$path $url $output_path");
	
	echo "<br/><br/><h1>Your e-Book is Generated Successfully. Click Here to Download:</h1> <br/><br/> <a href='$fileDownloadLink' target='_blank'>Download Your eBook!</a>";
?>
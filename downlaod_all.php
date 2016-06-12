<?php

include_once("zipper.php");
if(!isset($_GET['dnames']))
	{
	return;
	}
$dnames=$_GET['dnames'];


	//var_dump($dnames);
	
$createZipFile=new CreateZipFile;

$directoryToZip="d_i/".$dnames;
$outputDir="d_o";
$zipName=$dnames.".zip";

define("ZIP_DIR",1); //


if(ZIP_DIR)
{
//Code toZip a directory and all its files/subdirectories
$createZipFile->zipDirectory($directoryToZip,$outputDir);
}else
{
	$fileToZip1="files/File1.txt";
	$fileToZip2="files/File2.txt";
	$createZipFile->addFile(file_get_contents($fileToZip1),$fileToZip1);
	$createZipFile->addFile(file_get_contents($fileToZip2),$fileToZip2);
	$createZipFile->addFile(file_get_contents($fileToZip3),$fileToZip3);
}

$fd=fopen($zipName, "wb");
$out=fwrite($fd,$createZipFile->getZippedfile());
fclose($fd);
$createZipFile->forceDownload($zipName);
@unlink($zipName);

?>
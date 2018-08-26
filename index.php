<?php
/*
# Made by Sam Wattoo
# Copyright WapKiz Ltd
# Version: 1.1
*/

error_reporting(NULL);
 header('Content-Encoding: none;');

        set_time_limit(0);
ob_start();
$TAB = 'WP';

// Main include
include($_SERVER['DOCUMENT_ROOT']."/inc/main.php");
 // header('Content-Type: application/json');
   

if (isset($_SESSION['user'])) {
	echo '<!DOCTYPE html>
<html lang="en">
<head>
  <title>Wordpress Installer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/css/styles.min.css">


</head>
<body>
  ';


echo '<div class="container"><h2>Wordpress Installer</h2>';
	exec (VESTA_CMD . "v-list-user ".$user." json", $outputi, $return_vari);
	$datai = json_decode(implode('', $outputi), true);
$dati = array_reverse($datao,true);
$email=$dati["$user"]['CONTACT'];
	
	exec (VESTA_CMD."v-list-web-domains $user json", $output, $return_var);
$data = json_decode(implode('', $output), true);
$data = array_reverse($data,true);
echo '<form action="" method="post">
    <div class="form-group">
      <label for="domain">Domain:</label>';
echo '<select name="domain" class="form-control">';
foreach($data as $dm=>$key){
echo '<option value="'.$dm.'">'.$dm.'</option>';
 
}
echo'</select></div>';
echo "\n";
echo ' <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter custom email" name="email"></div>  <button type="submit" class="btn btn-default">Install</button>
  </form>';
	
	$rootdir = dirname(__FILE__);
	if(isset($_POST['domain'])){
		$domain=$_POST['domain'];
		if(!empty($_POST['email'])){
		$email=$_POST['email'];}
  $command='/usr/bin/sudo /usr/local/vesta/bin/v-sam-create-wp "'.$domain.'" "'.$email.'" "'.$user.'"   2>&1'; 

        $handle = popen($command, "r");
$x=1;
        if (ob_get_level() == 0) 
            ob_start();

        while(!feof($handle)) {

            $buffer = fgets($handle);
           $buffer = trim(htmlspecialchars($buffer));
		   $ddata.=$buffer.'<br/>';
		  
		  
		    ob_flush();
            flush();
			$x++;
           
        }
		$ot=explode('~~~~',$ddata);
		if(!empty($ot['1'])){
			echo ' <div class="panel panel-info">
    <div class="panel-heading">Install Detail</div>
    <div class="panel-body">';
		print_r($ot['1']);
		echo '</div>
  </div>';
		 ob_flush();
            flush();
		}
}} else {
    header("Location: /login/");
}
?>

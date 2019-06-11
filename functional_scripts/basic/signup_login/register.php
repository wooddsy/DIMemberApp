<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//include_once("config.php");
include_once("../Config/Setup.php");

if(isset($_POST['submit']))
{
	$diId = $_POST['diId'];
	$diName = $_POST['diName'];
	$userName = $_POST['userName'];
    $password = $_POST['password'];

    $passwordHash = md5($password);
    $createDate = date('Y-m-d H:i:s');

	$query = "INSERT INTO users (roleId, diId, diName, userName, passwordHash, createDate, status) VALUES (:roleId, :diId, :diName, :userName, :passwordHash, :createDate, :status)";
	$dbInstance->prepare($query)->execute([
		'roleId' => 2,
		'diId' => $diId, 
		'diName' => $diName,
		'userName' => $userName,
		'passwordHash' => $passwordHash,
		'createDate' => $createDate,
		'status' => 'NEW'
	]);

	if($query)
	{
		echo "<script>alert('Registration successful, please wait until and admin has activated your account.');</script>";
		echo "<script>window.location = 'login.php';</script>";;
	}
	else
	{
		echo "<script>alert('Data not inserted');</script>";
	}
}
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Signup Form Email Verification PHP | W3tweaks</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>

	<body style="background-color:pink">
<div class="container-fluid">
  <div class="col-sm-6">
    <div class="row">
      <div class="col-xs-12">
        
		<form name="insert" action="" method="post">
    <table width="100%"  border="0">
    <tr>
    	<th height="62" scope="row">Username </th>
    	<td width="71%"><input type="text" name="userName" id="userName" value=""  class="form-control" required /></td>
  	</tr>  
  	<tr>
    	<th height="62" scope="row">DamageInc id </th>
    	<td width="71%"><input type="text" name="diId" id="diId" value=""  class="form-control" required /></td>
  	</tr>
  	<tr>
    	<th height="62" scope="row">DamageInc username </th>
    	<td width="71%"><input type="text" name="diName" id="diName" value=""  class="form-control" required /></td>
  	</tr>
  	<tr>
    	<th height="62" scope="row">Password </th>
    	<td width="71%"><input type="password" name="password" id="password" value=""  class="form-control" required /></td>
  	</tr>
	<tr>
    	<th height="62" scope="row"></th>
    	<td width="71%"><input type="submit" name="submit" value="Submit" class="btn-group-sm" /> </td>
  	</tr>
	</table>
 </form>
      </div>
    </div>
  </div>
</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//include_once("config.php");
include_once("../Config/Setup.php");

session_start();
if(isset($_POST['login']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];

  userLogin($username, $password);
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
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>

<div class="container-fluid">

  <div class="col-sm-6">
    <div class="row">
      <div class="col-xs-12">
        <h3>Login page</h3>
		<hr >
		<form name="insert" action="" method="post">
     <table width="100%"  border="0">
     <tr>
      <?php if(isset($_SESSION['action1'])){ ?><td colspan="2"><font color="#FF0000"><?php echo $_SESSION['action1']; ?><?php echo $_SESSION['action1']="";?></font></td><?php } ?>
  </tr>
  <tr>
    <th height="62" scope="row">Username </th>
    <td width="71%"><input type="text" name="username" id="username" value="" class="form-control" required /></td>
  </tr>
  <tr>
    <th height="62" scope="row">Password </th>
    <td width="71%"><input type="password" name="password" id="password" value="" class="form-control" required /></td>
  </tr>
 <tr>
    <th height="62" scope="row"></th>
    <td width="71%"><input type="submit" name="login" value="Submit" class="btn-group-sm" /> </td>
  </tr>
</table>
 </form>
      </div>
    </div>
    <hr>
  </div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
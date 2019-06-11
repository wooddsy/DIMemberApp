<?php
session_start();
include_once("config.php");
if($_SESSION['login'])
{
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Welcome to our Dashboard</title>
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
        <h3>This is your Area</h3>
		<hr >
		<form name="insert" action="" method="post">
     <table width="100%"  border="0">
     <tr><th>Welcome to our Dashboard:
    <td ><font color="#FF0000"><?php echo $_SESSION['name']; ?></font> ||   <a style="font-size:20px" href="logout.php">Logout</a></td>
  </tr>
  <tr>
    <th height="62" scope="row"> </th>
    <td width="71%"></td>
  </tr>
 
</table>
 </form>
<div>Thanks for register us in email</div><br/>
<p><span style="color:red">Note:</span>If you have any doubts regarding this feel free to contact me, this is my personal mail-id <span style="color:blue">w3tweaks.@gmail.com</span></p>
      </div>
    </div>
    <hr>
  </div>
</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

	</body>
</html>
<?php
} else {
header('location:logout.php');	
}

?>
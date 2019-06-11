<?php
include 'config.php';
if(!empty($_GET['code']) && isset($_GET['code']))
{
	$code=$_GET['code'];
  $sql=mysql_query("SELECT * FROM userregistration WHERE activationcode='$code'");
  $num=mysql_fetch_array($sql);
if($num>0)
  {
  
  $st=0;
  $result =mysql_query("SELECT id FROM userregistration WHERE activationcode='$code' and status='$st'");
$result4=mysql_fetch_array($result);   
 
if($result4>0) 
  {

    $st=1;
    $result1=mysql_query("UPDATE userregistration SET status='$st' WHERE activationcode='$code'");
    $msg="Your account is successfully activated"; 
    }
    else
    {
  $msg ="Your account is already active, no need to activate again";
    }
    }
    else
    {
  $msg ="Wrong activation code.";
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
	<body>

<div class="container-fluid">
  
  <!--center-->
  <div class="col-sm-6">
    <div class="row">
      <div class="col-xs-12">
        <h3 style="color:green">SUCCESS!!</h3>
		<hr >
	<p><?php echo htmlentities($msg); ?></p>
   <p> Now you can login</p>
   <p>For login <a href="login.php">Click Here</a></p>
<!-- newone21 -->
      </div>
    </div>
    <hr>
        
   
  </div><!--/center-->

  <hr>
</div><!--/container-fluid-->
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
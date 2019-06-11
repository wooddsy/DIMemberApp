<?php
function setActivationCode()
{
	return md5('CasNs5gt');
}

function initiateLoginPage()
{
	$dbInstance = getDbInstance();
    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        userLogin($username, $password);
    }
}

function userLogin($username, $password)
{
	$dbInstance = getDbInstance();
	$passwordHash = md5($password);
	$lastLoginDate = date('Y-m-d H:i:s');

	$query = "SELECT * FROM users WHERE userName='" . $username . "'";
	$user = $dbInstance->query($query)->fetch(PDO::FETCH_ASSOC);


	if(isset($user['userId']) && $user['passwordHash'] == $passwordHash && $user['status'] == 'ACTIVE') {
		$_SESSION['login'] = $username;
		$_SESSION['userId'] = $user['userId'];
		$_SESSION['userRole'] = $user['roleId'];
		$_SESSION['userName'] = $user['userName'];
		$_SESSION['diName'] = $user['diName'];
		$extra = "dashboard";
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		exit();
	}
	elseif(isset($user['userId']) && $user['passwordHash'] == $passwordHash && $user['status'] == 'NEW') {
		$_SESSION['action1'] = 'Your account is awaiting activation. Please try again later or contact an admin.';
		$extra = "login";
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		exit();
	}
	else {
		$_SESSION['action1'] = 'The submitted credentials are incorrect.';
		$extra = "login";
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		exit();
	}
}
?>
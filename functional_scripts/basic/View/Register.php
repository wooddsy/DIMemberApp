<?php
    if(isset($_POST['submit']))
    {
        $diId = $_POST['diId'];
        $diName = $_POST['diName'];
        $userName = $_POST['username'];
        $activationCode = $_POST['activationCode'];
        $password = $_POST['password'];
    
        $activationCodeHash = md5($activationCode);

        $currentActivationCode = getActivationCode();

        $passwordHash = md5($password);
        $createDate = date('Y-m-d H:i:s');
    
        $query = "INSERT INTO users (roleId, diId, diName, userName, passwordHash, createDate, status) VALUES (:roleId, :diId, :diName, :userName, :passwordHash, :createDate, :status)";
        $dbInstance = getDbInstance();
        $dbInstance->prepare($query)->execute([
            'roleId' => 2,
            'diId' => $diId, 
            'diName' => $diName,
            'userName' => $userName,
            'passwordHash' => $passwordHash,
            'createDate' => $createDate,
            'status' => ($activationCodeHash === $currentActivationCode ? 'ACTIVE' : 'NEW')
        ]);
    
        if($query)
        {
            if($activationCodeHash !== $currentActivationCode) {
                echo "<script>alert('Registration successful, please wait until an admin has activated your account.');</script>";
            }
            else {
                $_SESSION['action1'] = 'Thank you for registering, your account has been activated. Please login using the form.';
            }
            echo "<script>window.location = 'http://projects.subatomisch.nl/di_tools/functional_scripts/basic/';</script>";
        }
        else
        {
            echo "<script>alert('Registration failed, please contact the admin.');</script>";
        }
    }
?>

<div class="container-fluid">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <h3 class="login-heading mb-4">Well hello! Register down below</h3>
                            <p>After you have submitted your registration an admin will activate your account. Only after activation you can login to the app.</p>
                            <?php 
                                //if(isset($_SESSION['action1'])) { 
                                //    echo '<h5 class="login-heading mb-4">' . $_SESSION['action1'] . '</h5>';
                                //    unset($_SESSION['action1']);
                                //}
                            ?>
                            <!--<form name="insert" action="" method="post" id="loginForm">-->
                            <form name="insert" action="" method="post">
                                <div class="form-label-group">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                                    <label for="username">Username</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="text" id="diId" name="diId" class="form-control" placeholder="Damage Inc User id" required>
                                    <label for="diId">Damage Inc User id</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="text" id="diName" name="diName" class="form-control" placeholder="DamageInc username" required>
                                    <label for="diName">DamageInc username</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="activationCode" name="activationCode" class="form-control" placeholder="Activation code" required>
                                    <label for="activationCode">Activation code</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                    <label for="inputPassword">Password</label>
                                </div>

                                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" name="submit" value="Submit">Register</button>
                                <div class="text-center">
                                    <!--<a class="small" href="#">Forgot password?</a>-->
                                    <a class="small" href="http://projects.subatomisch.nl/di_tools/functional_scripts/basic/">Already have an account? Login!</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
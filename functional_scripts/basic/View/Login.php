<div class="container-fluid">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto mb-4">
                            <img src="/di_tools/functional_scripts/basic/View/img/logos/brand/banner/banner-dark-red.png" class="di-login-logo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <h3 class="login-heading mb-4">Welcome back!</h3>
                            <?php 
                                if(isset($_SESSION['action1'])) { 
                                    echo '<h5 class="login-heading mb-4">' . $_SESSION['action1'] . '</h5>';
                                    unset($_SESSION['action1']);
                                }
                            ?>
                            <form name="insert" action="" method="post" id="loginForm">
                                <div class="form-label-group">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
                                    <label for="inputEmail">Username</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                    <label for="inputPassword">Password</label>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember password</label>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" name="login" value="Submit">Sign in</button>
                                <div class="text-center">
                                    <!--<a class="small" href="#">Forgot password?</a>-->
                                    <a class="small" href="http://projects.subatomisch.nl/di_tools/functional_scripts/basic/register">Register</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
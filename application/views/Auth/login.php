<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="English">
        <meta name="author" content="FDCI Contact System">

        <title>Login</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
        <link href="<?=base_url();?>assets/css/styles.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <input type="hidden" id="base_url" value="<?=base_url();?>">
    </head>
    <body>
        <div class="login-container">
            <div class="login-wrapper">
                <form id="login-form">
                    <div class="form-wrapper">
                        <div class="form-group">
                            <div class="login-heading-icon"><i class="fa fa-user"></i></div>
                            <h1>Login</h1>
                        </div>
                        <div id="error-msg"></div>
                        <div class="form-group form-with-icon">
                            <span class="form-icon"><i class="fa-solid fa-at"></i></span>
                            <input type="email" name="email" id="email" class='form-control' placeholder='Email' required />
                        </div>
                        <div class="form-group form-with-icon">
                            <span class="form-icon"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password" id="password" class='form-control' placeholder='Password' required />
                        </div>
                        <div class="form-group">
                            <button class="primary-btn" id="submit-button" type="button" onclick="loginUser(this, 'login-form')"> Login</button>
                        </div>
                        <div class="form-group text-center">
                            <p>Don't have an Account? <a href="<?=base_url();?>register">Register</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- jQuery  -->
        <script src="<?=base_url();?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/js/init_auth.js" type="text/javascript"></script>
	
	</body>
</html>
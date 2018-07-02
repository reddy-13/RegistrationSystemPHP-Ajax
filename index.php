<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <script src="js/jquery-3.3.1.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

	<title>FORM</title>

	<!-- custom js -->


	<style>
				body{
					font-family: "Verdana";
					font-size: 16px;
					font-weight: bold;
/*					background-color:darkgrey;*/
				}
				.panel{
					border: 0;
				}
				form{
					padding: 0 10px;
				}
				.addon-dif-color{
					background-color: #f0ad43;
					color: white
				}
        .panel-title{
            color: #f0ad4e;
            font-weight: bolder;
        }
        .sign-up ,.forgot-pass{
            display: none;
        }
		.alert{
			display: none;
		}
	</style>

</head>

<body>

	<div class="container">
           
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
								<div class="alert alert-danger">
										<div id="result"></div>
								</div>
					</div>
					<div class="col-md-6 col-md-offset-3 sign-up">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title text-center">SIGN UP</h3>
							</div>
							<div class="panel-body">
								<form action="" class="form-horizontal" id="signup-form" role="form">
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon addon-dif-color">
														<span class="glyphicon glyphicon-user"></span>
													</div>
													<input type="text" class="form-control" id="fname" name="fname" placeholder="Full Name">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon addon-dif-color">
														<span class="glyphicon glyphicon-earphone"></span>
													</div>
													<input type="text" class="form-control" id="mobno" name="mobno" placeholder="Mobile Number">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon addon-dif-color">
														<span class="glyphicon glyphicon-envelope"></span>
													</div>
													<input type="text" class="form-control" id="uemail" name="uemail" placeholder="Email Address">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon addon-dif-color">
														<span class="glyphicon glyphicon-lock"></span>
													</div>
													<input type="password" class="form-control" id="passwd" name="passwd" placeholder="Password">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon addon-dif-color">
														<span class="glyphicon glyphicon-lock"></span>
													</div>
													<input type="password" class="form-control" id="cpasswd" name="cpasswd" placeholder="Confirm Password">
												</div>
											</div>
											<div class="form-group">
												<input type="submit" value="REGISTER"  id="register" class="btn btn-warning btn-block">
											</div>
											<div class="form-group">
												<div class="col-md-12 control">
													<div style="border-top:1px solid #888; padding-top:15px; font-size:85%">
														Already have account!
														<a href="#" onclick="$('.sign-up').hide(); $('.sign-in').show()">Sign in Here</a>
													</div>
												</div>
											</div>
                                </form>
							</div>
						</div>
					</div>
		
					
				</div>
				<div class="col-md-6 col-md-offset-3 sign-in">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title text-center">SIGN IN FORM</h3>
								<div style="float:right; font-size:80%; position:relative; top:-10px;">
								    <a href="#" onclick="$('.sign-in').hide(); $('.forgot-pass').show()">Forgot Password</a>
								</div>
							</div>
							<div class="panel-body">
								<form action="" class="form-horizontal" id="sign-in-frm">
											
											
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon addon-dif-color">
														<span class="glyphicon glyphicon-envelope"></span>
													</div>
													<input type="text" class="form-control" id="email" name="email" placeholder="Email Address">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon addon-dif-color">
														<span class="glyphicon glyphicon-lock"></span>
													</div>
													<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
												</div>
											</div>
										    <div class="form-group">
                                             <div class="input-group">
                                                      <label><input type="checkbox"  name="remember-me"value=""> Remember me</label>
                                        </div>
                                       </div>
											<div class="form-group">
												<input type="submit" value="LOGIN"  id="login" class="btn btn-warning btn-block">
											</div>
											<div class="form-group">
												<div class="col-md-12 control">
													<div style="border-top:1px solid #888; padding-top:15px; font-size:85%">
														Don't have an account?
														<a href="#" onclick="$('.sign-in').hide(); $('.sign-up').show()">Sign up Here</a>
													</div>
												</div>
											</div>
                                </form>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-md-offset-3 forgot-pass">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title text-center">RECOVER YOUR PASSWORD</h3>
								<div style="float:right; font-size:80%; position:relative; top:-10px;">
								    <a href="#" onclick="$('.forgot-pass').hide(); $('.sign-in').show()">Sign In</a>
								</div>
							</div>
							<div class="panel-body">
								<form action="" class="form-horizontal" id="forgot-pass-frm" role="form">
											
											
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon addon-dif-color">
														<span class="glyphicon glyphicon-envelope"></span>
													</div>
													<input type="text" class="form-control" id="remail" name="remail" placeholder="Email Address">
												</div>
											</div>
									    
											<div class="form-group">
												<input type="submit" value="GENERATE NEW PASSWORD"  id="reset" name="reset" class="btn btn-warning btn-block">
											</div>
											
											
											
                                </form>
							</div>
						</div>
					</div>

	</div>



	
	
	<script src="js/main.js"></script>
	<script>
	</script>

</body>

</html>

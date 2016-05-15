<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/header.php"); ?>
</head>
<body class="login-back">
	<div class="container vert-offset-top-2">
		<div class="row">
			<div class="col-md-4 ">
				<img class="img-responsive" src="images/logo.png" width=100%>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-5 col-sm-offset-3">
				<div
					class="login-panel panel-Transparent panel-default  vert-offset-top-8">
					<div class="panel-heading">
						<h3 class="panel-title">LOGIN</h3>
					</div>
					<div class="panel-body">
						<form role="form">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Senha" name="password"	type="password" value="">
								</div>
								<div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me">Lembrar-me
									</label>
								</div>
								<!-- Change this to a button or input when using this as a form -->
								<a href="index.php" class="btn btn-lg btn-success btn-block">Login</a>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div style="position: fixed; bottom: 10px; right: 10px;">
			<a href="http://www.freepik.com"> Selected by freepik</a>
		</div>
	</div>
</body>
</html>
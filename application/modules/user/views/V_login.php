<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ĐĂNG NHẬP HỆ THỐNG</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css" media="screen">
			.error{
				color: red;
			}
		</style>
	</head>
	<body>
		<div class="container" style="padding-top:80px">
		    <div class="row">
				<div class="col-md-4 col-md-offset-4">
		    		<div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Please sign in</h3>
					 	</div>
					  	<div class="panel-body">
					  		<?= form_open('user/active_login'); ?>
					    	
		                    <fieldset>
					    	  	<div class="form-group">
					    	  	<?php echo form_error('sdt','<div class="error">', '</div>'); ?>
					    	  		<?= form_input($sdt); ?>
					    		</div>
					    		<div class="form-group">
					    		<?php echo form_error('mat_khau','<div class="error">', '</div>'); ?>
					    			<?= form_input($mat_khau); ?>
					    		</div>
					    		<div class="checkbox">
						    	    	<label>
						    	    		<div class="error"><?= $v_error ?></div>
						    	    	</label>
						    	    </div>
					    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
					    	</fieldset>
					      	</form>
					    </div>
					</div>
				</div>
			</div>
		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</body>
</html>
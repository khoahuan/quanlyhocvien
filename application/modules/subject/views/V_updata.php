<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>FORM UPDATA</title>

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
	<div class="container">
	  <!-- Stack the columns on mobile by making one full-width and the other half-width -->
		<?php echo form_open('subject/'.$cap_nhat,'class="navbar-form "'); ?>
		<div class="row">
			<h1 class="text-center ">
				<a href="<?= base_url('/home'); ?>">FORM CẬP NHẬT MÔN HỌC</a>
			</h1>
			<div class="col-xs-8 col-sm-4 col-md-5">
				<h5>Mã môn:</h5>
				<?= form_error('ma_mon','<div class="error">', '</div>'); ?>
				<?= form_input($ma_mon); ?>
				<h5>Tên môn:</h5>
				<?= form_error('ten_mon','<div class="error">', '</div>'); ?>
				<?= form_input($ten_mon); ?>
			</div>

			
		</div>
		</br>
		<div>
			<?=  form_submit($sm); ?>
		</div>
		</form>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-7">
				<div class="table-responsive">
				<table class="table table-bordered table-hover">
			      <thead>
			        <tr>
			          <th>STT</th>
			          <th>Mã môn</th>
			          <th>Tên môn</th>
			          <th></th>
			        </tr>

			      </thead>
			      <tbody>
			        <?= $str ?>
			      </tbody>
			    </table>
		    </div>
			</div>
		</div>
	<div>
		
		

		
		
		
		


		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</body>
</html>
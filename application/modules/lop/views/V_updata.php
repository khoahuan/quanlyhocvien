<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CẬP NHẬT LỚP</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
		<script src="<?= base_url('public/js/function.js'); ?>" async defer></script>
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
			.tbl_more{
				display: none;
			}
			.click-show-more{
				position: absolute;
				top: 0px;
				right: 0px;
			}
		</style>
	</head>
	<body>
	<div class="container">
	  <!-- Stack the columns on mobile by making one full-width and the other half-width -->
		<?php echo form_open('lop/'.$cap_nhat,'class="navbar-form "'); ?>
		<div class="row">
			<h1 class="text-center ">
				<a href="<?= base_url('/home'); ?>">CẬP NHẬT LỚP</a><button type="button" class="btn btn-default btn-xs click-show-more ">Ẩn ▲</button>
			</h1>
			<div class="col-xs-8 col-sm-4 col-md-3 tbl_up">
				<h5>Mã lớp:</h5>
				<?= form_error('ma_lop','<div class="error">', '</div>'); ?>
				<?= form_input($ma_lop); ?>
			</div>
			<div class="col-xs-8 col-sm-4 col-md-5 tbl_up">
				<h5>Tên lớp:</h5>
				<?= form_error('ten_lop','<div class="error">', '</div>'); ?>
				<?= form_input($ten_lop); ?>
			</div>

			
		</div>
		</br>
		<div>
			<?=  form_submit($sm); ?>
		</div>
		</form>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-7">
				<h3><span>DANH SÁCH LỚP:</span></h3>
				<div class="table-responsive">
				<table class="table table-bordered table-hover">
			      <thead>
			        <tr>
			          <th>STT</th>
			          <th>Mã lớp</th>
			          <th>Tên lớp</th>
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
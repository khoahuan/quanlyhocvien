<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>FORM UPDATA</title>

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
		</style>
	</head>
	<body>
	<div class="container">
	  <!-- Stack the columns on mobile by making one full-width and the other half-width -->
		<?php echo form_open('student/'.$cap_nhat,'class="navbar-form "'); ?>
		<div class="row">
			<h1 class="text-center ">
				<a href="<?= base_url('/home'); ?>">FORM CẬP NHẬT HỌC VIÊN</a>
			</h1>
			<div class="col-xs-12 col-sm-5 col-md-5">
				<h5>Mã học viên:</h5>
				<?= form_error('ma_hocvien','<div class="error">', '</div>'); ?>
				<?= form_input($ma_hocvien); ?>
				<h5>Họ:</h5>
				<?= form_error('ho_hocvien','<div class="error">', '</div>'); ?>
				<?= form_input($ho_hocvien); ?>
				<h5>Tên:</h5>
				<?= form_error('ten_hocvien','<div class="error">', '</div>'); ?>
				<?= form_input($ten_hocvien); ?>
				
				
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5">
				<h5>Khóa:</h5>
				<?= form_error('ma_khoa','<div class="error">', '</div>'); ?>
				<?= form_dropdown('ma_khoa', $khoa_hoc, $v_khoa_hoc ,'class="form-control" id="ma_khoa_student" ') ?>
				<h5>Lớp:</h5>
				<?= form_error('ma_lop','<div class="error">', '</div>'); ?>
				<?= form_dropdown('ma_lop', $lop_hoc, $v_lop_hoc ,'class="form-control" id="ma_lop_student"') ?>
				<h5>Tình trạng học:</h5>
				<?= form_dropdown('tinh_trang', $tinh_trang, $v_tinh_trang ,'class="form-control" ') ?>
				
			</div>

			
		</div>
		</br>
		<div>
			<?=  form_submit($sm); ?>
		</div>
		</form>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-10">
				<h3><span id="class_name">DS LỚP <?= $v_lop_hoc.'_'.$v_khoa_hoc ?>:</span></h3>
				<div class="table-responsive">
				<table class="table table-bordered table-hover">
			      <thead>
			        <tr>
			          <th>STT</th>
			          <th>Mã học viên</th>
			          <th>Họ </th>
			          <th>Tên</th>
			          <th>Tình Trạng Học</th>
			          <th></th>
			        </tr>

			      </thead>
			      <tbody id="main_student">
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
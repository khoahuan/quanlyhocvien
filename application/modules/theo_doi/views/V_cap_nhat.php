<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>FORM UPDATA</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<style type="text/css" media="screen">
			.error{
				color: red;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
		<script src="<?= base_url('public/js/function.js'); ?>" async defer></script>
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	<div class="container">
	  <!-- Stack the columns on mobile by making one full-width and the other half-width -->
		
		<?php echo form_open('theo_doi/'.$cap_nhat,'class="navbar-form "'); ?>
		<div class="row">
			<h1 class="text-center "><a href="<?= base_url('/home'); ?>">FORM NHẬP SỔ THEO DÕI</a></h1>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<?php
					if (isset($ngay)) {
						echo form_hidden('ngay', $ngay);
					}
				?>
				<h5 >Khóa</h5>
				<?php
					if ($cap_nhat=="sua") {
							echo form_input($ma_khoa);
						}else{
							echo form_dropdown('ma_khoa', $khoa,$v_khoa ,'class="form-control" id="ma_khoa"');
						}
				?>
				<h5>Lớp</h5>
				<?php echo form_error('ma_lop','<div class="error">','</div>'); ?>
					<?php
					if ($cap_nhat=="sua") {
							echo form_input($ma_lop);
						}else{
							echo form_dropdown('ma_lop', $lop, $v_lop ,'class="form-control" id="ma_lop" ');
						}
				?>
					
				<h5>Môn</h5>
					<?php
					if ($cap_nhat=="sua") {
							echo form_input($ma_mon);
						}else{
							echo form_dropdown('ma_mon', $mon,$v_mon ,'class="form-control" ');
						}
				?>
					
				<h5>Phòng</h5>
					<?= form_dropdown('ma_phong', $phong, $v_phong,'class="form-control"');	?>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<h5>Buổi:</h5>
				<?php
					if ($cap_nhat=="sua") {
							echo form_input($ma_buoi);
						}else{
							echo form_dropdown('ma_buoi', $buoi, $v_buoi ,'class="form-control" ');
						}
				?>
				<h5>Quân số</h5>
				<?php echo form_error('quan_so','<div class="error">','</div>'); ?>
				<?= form_input($quan_so); ?>

				<h5>Hiện diện</h5>
				<?= form_error('hien_dien','<div class="error">','</div>'); ?>
				<?= form_error('check_hien_dien','<div class="error">','</div>'); ?>
				<?= form_input($hien_dien); ?>



				

			</div>
			<div class="col-xs-6 col-sm-4 col-md-4">
				<h5>Đề cương</h5>
				<?php echo form_error('de_cuong'); ?>
				<?= form_checkbox($de_cuong); ?> Có

				<h5>Giáo án</h5>
				<?php echo form_error('giao_an'); ?>
				<?= form_checkbox($giao_an); ?> Có

				<h5>Sổ tay</h5>
				<?php echo form_error('so_tay'); ?>
				<?= form_checkbox($so_tay); ?> Có

				<h5>Ghi chú</h5>
				<?php echo form_error('ghi_chu'); ?>
				<?= form_textarea($ghi_chu); ?>

			</div>
		</div>

		<div>
			<?=  form_submit($sm); ?>
		</div>
		
		</form>
		
	</div>

		
		
		
		


		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</body>
</html>
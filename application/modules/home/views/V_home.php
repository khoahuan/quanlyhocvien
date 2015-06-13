<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Control Panel</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			body { padding-top:20px; }
			.panel-body .btn:not(.btn-block) { width:100px;margin-bottom:10px;margin-right:10px; }
		</style>
	</head>
	<body>
		<div class="container">
		    <div class="row">
		        <div class="col-md-6">
		            <div class="panel panel-primary">
		                <div class="panel-heading">
		                    <h3 class="panel-title">
		                        <span class="glyphicon glyphicon-bookmark"></span> Control Panel || <?= $mail ?>
		                    </h3>
		                </div>
		                <div class="panel-body">
		                    <div class="row">
		                        <div class="col-xs-6 col-md-6">
		                          <a href="<?= base_url("theo_doi/them"); ?>" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-plus"></span> <br/>ADD </a>
		                          <a href="<?= base_url("course"); ?>" class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-file"></span> <br/>Course</a>
		                          <a href="<?= base_url("subject"); ?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon  glyphicon-book"></span> <br/>Subject</a>
		                          <a href="<?= base_url("lop"); ?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-calendar"></span> <br/>Class</a>
		                          <a href="<?= base_url("classroom"); ?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-list"></span> <br/>Room</a>
		                          <a href="<?= base_url("student"); ?>" class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-file"></span> <br/>Student</a>
		                          
		                        </div>
		                        <div class="col-xs-6 col-md-6">
		                          <a href="<?= base_url("/user/profile"); ?>" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Users</a>
		                          <a href="<?= base_url("division"); ?>" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Division</a>
		                          <a href="<?= base_url("homeroom"); ?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon  glyphicon-log-out"></span> <br/>HomeR</a>
		                          <a href="<?= base_url("user/updata"); ?>" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Teacher</a>
		                          <a href="<?= base_url("user/logout"); ?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon  glyphicon-log-out"></span> <br/>Logout</a>
		                        </div>
		                    </div>
		                    <a href="javascript:void(0)" class="btn btn-success btn-lg btn-block" role="button"><span class="glyphicon glyphicon-globe"></span> Tìm sổ theo dõi</a>
		                    <div class="row">
		                    	<?= form_open('home/search','class="navbar-form "'); ?>
		                    	<div class="col-xs-6 col-md-6">
									<h5>Tháng</h5>
									<select name="thang" class="form-control">
										<option value="01">Tháng 1</option>
										<option value="02">Tháng 2</option>
										<option value="03">Tháng 3</option>
										<option value="04">Tháng 4</option>
										<option value="05">Tháng 5</option>
										<option value="06">Tháng 6</option>
										<option value="07">Tháng 7</option>
										<option value="08">Tháng 8</option>
										<option value="09">Tháng 9</option>
										<option value="10">Tháng 10</option>
										<option value="11">Tháng 11</option>
										<option value="12">Tháng 12</option>
									</select>
									<h5>Môn</h5>
									<?=  form_dropdown('ma_mon', $mon,'' ,'class="form-control" '); ?>
										
		  			  				<h5>Lớp</h5>
									<?=  form_dropdown('ma_lop', $lop,'' ,'class="form-control" '); ?>
									<h5>Tùy chọn</h5>
									<input type="checkbox" name="print" aria-label="In" value="1"> Print
									
									</br></br>
										<button type="submit" class="btn btn-default">Tìm</button>
									
		                    	</div>
		                    	<div class="col-xs-6 col-md-6">
		                    		<h5>Năm</h5>
									<select name="nam" class="form-control">
										<option value="2015">Năm 2015</option>
										<option value="2016">Năm 2016</option>
										<option value="2017">Năm 2017</option>
										<option value="2018">Năm 2018</option>
									</select>
									<h5>Khóa</h5>
		  			  				<?=  form_dropdown('ma_khoa', $khoa,'' ,'class="form-control " '); ?>
									
										  
		                        </div>
							</form>	
		                    </div>
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
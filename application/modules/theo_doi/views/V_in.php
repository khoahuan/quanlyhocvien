<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?= base_url('public/css/style.css'); ?>" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<h1 class="text-center"><a href="<?= base_url('/home'); ?>">SỔ THEO DÕI</a></h1>
		<div class="container">
				<table class="table table-bordered" style="max-width:290px">
			      <tbody>
			        <tr>
			          <th scope="row" style="width:70px">Lớp</th>
			          <td><?= $ten_lop ?></td>
			        </tr>
			        <tr>
			          <th scope="row" style="width:70px">Khóa</th>
			          <td><?= $ten_khoa ?></td>
			        </tr>
			        <tr>
			          <th scope="row" style="width:70px">Tháng</th>
			          <td><?= $ngay ?></td>
			        </tr>
			      </tbody>
			    </table>
			
		    <div class="table-responsive">
				<table class="table table-bordered table-hover">
			      <thead>
			        <tr>
			          <th rowspan="2">Ngày</th>
			          <th rowspan="2">Buổi</th>
			          <th rowspan="2">QS</th>
			          <th rowspan="2">HD</th>
			          <th rowspan="2">V</th>
			          <th rowspan="2">Tên HV vắng</th>
			          <th rowspan="2">Môn Học</th>
			          <th rowspan="2">Phòng Học</th>
			          <th colspan="3">Giáo viên</th>
			          <th rowspan="2">Ký Tên</th>
			          <th rowspan="2">Ghi chú</th>
			          
			        </tr>
			        <tr>
			          <th>ĐC</th>
			          <th>GA</th>
			          <th>ST</th>
			        </tr>

			      </thead>
			      <tbody>
			        <?= $str ?>
			      </tbody>
			    </table>
		    </div>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</body>
</html>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Profile</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css" media="screen">
			.card {
			    padding-top: 20px;
			    margin: 10px 0 20px 0;
			    background-color: rgba(214, 224, 226, 0.2);
			    border-top-width: 0;
			    border-bottom-width: 2px;
			    -webkit-border-radius: 3px;
			    -moz-border-radius: 3px;
			    border-radius: 3px;
			    -webkit-box-shadow: none;
			    -moz-box-shadow: none;
			    box-shadow: none;
			    -webkit-box-sizing: border-box;
			    -moz-box-sizing: border-box;
			    box-sizing: border-box;
			}

			.card .card-heading {
			    padding: 0 20px;
			    margin: 0;
			}

			.card .card-heading.simple {
			    font-size: 20px;
			    font-weight: 300;
			    color: #777;
			    border-bottom: 1px solid #e5e5e5;
			}

			.card .card-heading.image img {
			    display: inline-block;
			    width: 46px;
			    height: 46px;
			    margin-right: 15px;
			    vertical-align: top;
			    border: 0;
			    -webkit-border-radius: 50%;
			    -moz-border-radius: 50%;
			    border-radius: 50%;
			}

			.card .card-heading.image .card-heading-header {
			    display: inline-block;
			    vertical-align: top;
			}

			.card .card-heading.image .card-heading-header h3 {
			    margin: 0;
			    font-size: 14px;
			    line-height: 16px;
			    color: #262626;
			}

			.card .card-heading.image .card-heading-header span {
			    font-size: 12px;
			    color: #999999;
			}

			.card .card-body {
			    padding: 0 20px;
			    margin-top: 20px;
			}

			.card .card-media {
			    padding: 0 20px;
			    margin: 0 -14px;
			}

			.card .card-media img {
			    max-width: 100%;
			    max-height: 100%;
			}

			.card .card-actions {
			    min-height: 30px;
			    padding: 0 20px 20px 20px;
			    margin: 20px 0 0 0;
			}

			.card .card-comments {
			    padding: 20px;
			    margin: 0;
			    background-color: #f8f8f8;
			}

			.card .card-comments .comments-collapse-toggle {
			    padding: 0;
			    margin: 0 20px 12px 20px;
			}

			.card .card-comments .comments-collapse-toggle a,
			.card .card-comments .comments-collapse-toggle span {
			    padding-right: 5px;
			    overflow: hidden;
			    font-size: 12px;
			    color: #999;
			    text-overflow: ellipsis;
			    white-space: nowrap;
			}

			.card-comments .media-heading {
			    font-size: 13px;
			    font-weight: bold;
			}

			.card.people {
			    position: relative;
			    display: inline-block;
			    width: 170px;
			    height: 300px;
			    padding-top: 0;
			    margin-left: 20px;
			    overflow: hidden;
			    vertical-align: top;
			}

			.card.people:first-child {
			    margin-left: 0;
			}

			.card.people .card-top {
			    position: absolute;
			    top: 0;
			    left: 0;
			    display: inline-block;
			    width: 170px;
			    height: 150px;
			    background-color: #ffffff;
			}

			.card.people .card-top.green {
			    background-color: #53a93f;
			}

			.card.people .card-top.blue {
			    background-color: #427fed;
			}

			.card.people .card-info {
			    position: absolute;
			    top: 150px;
			    display: inline-block;
			    width: 100%;
			    height: 101px;
			    overflow: hidden;
			    background: #ffffff;
			    -webkit-box-sizing: border-box;
			    -moz-box-sizing: border-box;
			    box-sizing: border-box;
			}

			.card.people .card-info .title {
			    display: block;
			    margin: 8px 14px 0 14px;
			    overflow: hidden;
			    font-size: 16px;
			    font-weight: bold;
			    line-height: 18px;
			    color: #404040;
			}

			.card.people .card-info .desc {
			    display: block;
			    margin: 8px 14px 0 14px;
			    overflow: hidden;
			    font-size: 12px;
			    line-height: 16px;
			    color: #737373;
			    text-overflow: ellipsis;
			}

			.card.people .card-bottom {
			    position: absolute;
			    bottom: 0;
			    left: 0;
			    display: inline-block;
			    width: 100%;
			    padding: 10px 20px;
			    line-height: 29px;
			    text-align: center;
			    -webkit-box-sizing: border-box;
			    -moz-box-sizing: border-box;
			    box-sizing: border-box;
			}

			.card.hovercard {
			    position: relative;
			    padding-top: 0;
			    overflow: hidden;
			    text-align: center;
			    background-color: rgba(214, 224, 226, 0.2);
			}

			.card.hovercard .cardheader {
			    background: url("http://lorempixel.com/850/280/nature/4/");
			    background-size: cover;
			    height: 135px;
			}

			.card.hovercard .avatar {
			    position: relative;
			    top: -50px;
			    margin-bottom: -50px;
			}

			.card.hovercard .avatar img {
			    width: 100px;
			    height: 100px;
			    max-width: 100px;
			    max-height: 100px;
			    -webkit-border-radius: 50%;
			    -moz-border-radius: 50%;
			    border-radius: 50%;
			    border: 5px solid rgba(255,255,255,0.5);
			}

			.card.hovercard .info {
			    padding: 4px 8px 10px;
			}

			.card.hovercard .info .title {
			    margin-bottom: 4px;
			    font-size: 24px;
			    line-height: 1;
			    color: #262626;
			    vertical-align: middle;
			}

			.card.hovercard .info .desc {
			    overflow: hidden;
			    font-size: 12px;
			    line-height: 20px;
			    color: #737373;
			    text-overflow: ellipsis;
			}

			.card.hovercard .bottom {
			    padding: 0 20px;
			    margin-bottom: 17px;
			}
			.error{
				color: red;
			}
			.btn{ border-radius: 50%; width:32px; height:32px; line-height:18px;  }
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">

				<div class="col-lg-6 col-sm-6">
					<h2 class="text-center"><a href="<?= base_url("home") ?>">PROFILE USER</a></h2>
		            <div class="card hovercard">
		                <div class="cardheader">

		                </div>
		                <div class="avatar">
		                    <img alt="" src="http://www.localcrimenews.com/wp-content/uploads/2013/07/default-user-icon-profile.png">
		                </div>
		                <div class="info">
		                    <div class="title">
		                        <a href="javascript:void(0)"><?= $info->ho.' '.$info->ten ?></a>
		                    </div>
		                    <div class="desc"><?= $info->mail ?></div>
		                    <?= form_open('user/set_pass','class="navbar-form "'); ?>
		                    	
		                    	<?= "<p class='error'>".$error."</p>" ?>
		                    	
		                    	<?= form_error('mat_khau','<div class="error">', '</div>'); ?>
		                    	<?= form_input($mat_khau);  ?>
		                    	<?= form_error('mat_khau_2','<div class="error">', '</div>'); ?>
		                    	<?= form_input($mat_khau_2); ?>
		                    	<?= form_error('mat_khau_cu','<div class="error">', '</div>'); ?>
		                    	<?= form_input($mat_khau_cu); ?>
		                    	</br></br>
		                    	<?=  form_submit($sm); ?>
		                    </form>
		                </div>
		                <div class="bottom">
		                    <a class="btn btn-primary btn-twitter btn-sm" href="javascript:void(0)">
		                        <i class="fa fa-twitter"></i>
		                    </a>
		                    <a class="btn btn-danger btn-sm" rel="publisher"
		                       href="javascript:void(0)">
		                        <i class="fa fa-google-plus"></i>
		                    </a>
		                    <a class="btn btn-primary btn-sm" rel="publisher"
		                       href="javascript:void(0)">
		                        <i class="fa fa-facebook"></i>
		                    </a>
		                    <a class="btn btn-warning btn-sm" rel="publisher" href="javascript:void(0)">
		                        <i class="fa fa-behance"></i>
		                    </a>
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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Amin web developer - http://aminwd.ir">
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl;?>/theme/img/favicon.png">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl;?>/theme/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl;?>/theme/css/bootstrap.rtl.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo Yii::app()->request->baseUrl;?>/theme/css/main.css" rel="stylesheet">
 
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <?php Yii::app()->clientScript->registerCoreScript('jquery');?>

  </head>

  <body class="<?php if($this->getUniqueId() == 'ads' && $this->action->id == 'index')echo ' back-blue';?>">

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><b><?php echo CHtml::encode(Yii::app()->name); ?></b></a>
        </div>
        <div class="navbar-collapse collapse">
          <?php 
          $login = '<a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-log-in"></i>ورود<strong class="caret"></strong></a>
				<div class="dropdown-menu">
					<form method="post" action="'.Yii::app()->createUrl('/site/login').'" accept-charset="UTF-8" autocomplete="off">
						 <div class="form-group form-group-sm">
						    <label for="username">نام کاربری</label>
						    <div class="input-group input-group-sm">
							  <input type="text" name="LoginForm[username]" class="form-control" id="username" placeholder="Username" aria-describedby="sizing-addon3">
							  <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
							</div>
						</div>

						 <div class="form-group form-group-sm">
						    <label for="password">رمز عبور</label>
						    <div class="input-group input-group-sm">
							  <input type="password" name="LoginForm[password]" class="form-control" id="password" placeholder="password" aria-describedby="sizing-addon3">
							  <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
							</div>
						</div>


						<input style="float: right; margin-left: 10px;" type="checkbox" name="LoginForm[rememberMe]" id="remember-me" value="1">
						<label class="string optional" for="remember-me">مرا به یاد داشته باش</label>
						<input class="btn btn-primary btn-block" type="submit" id="sign-in" name="yt0" value="ورود">
						&nbsp;
					</form>
				</div>';
          $this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'<i class="glyphicon glyphicon-home"></i>صفحه اصلی', 'encodeLabel' => false,'url'=>array('/ads/index')),
					array('label'=>'<i class="glyphicon glyphicon-expand"></i>درباره','encodeLabel' => false, 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'<i class="glyphicon glyphicon-envelope"></i>تماس با ما','encodeLabel' => false, 'url'=>array('/site/contact')),
					array('label'=>'<i class="glyphicon glyphicon-dashboard"></i>پنل مدیریت','encodeLabel' => false, 'url'=>array('/admin'), 'visible'=> (!Yii::app()->user->isGuest && Yii::app()->user->isAdmin)),
					array('label'=>'<i class="glyphicon glyphicon-off"></i>ارسال رایگان آگهی','encodeLabel' => false, 'url'=>array('/ads/create')),
	
					array('label'=>$login,'encodeLabel' => false, 'url' => 'notHref','htmlOptions' => array( 'class'=>"dropdown", 'id' => 'aa'), 'visible'=>Yii::app()->user->isGuest),

					array('label'=>'<i class="glyphicon glyphicon-user"></i>ثبت نام','encodeLabel' => false ,'url'=>array('/register'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'<i class="glyphicon glyphicon-log-out"></i>خروج ('.Yii::app()->user->name.')','encodeLabel' => false,'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				),
				'htmlOptions' => array('class' => 'nav navbar-nav navbar-left'),
			)); ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<div class="container-fluid page-content col-xs-12 no-padding">
		<?php echo $content; ?>
	</div>
	<div class="footer centered col-xs-12">
		کلیه حقوق برای تاس کباب محفوظ است. طراحی و اجرا توسط <a href="http://aminwd.ir/" title="امین وب دولپر - AminWebDeveloper" data-toggle="tooltip" data-placement="top" > امین </a>
	</div><!-- /container -->
	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo Yii::app()->request->baseUrl;?>/theme/js/bootstrap.min.js"></script>
    <link href="<?php echo Yii::app()->request->baseUrl;?>/theme/select/select2.css" rel="stylesheet" />
	<script src="<?php echo Yii::app()->request->baseUrl;?>/theme/select/select2.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl;?>/theme/select/select2_locale_fa.js"></script>

	<script type="text/javascript">
    	$(function () {
		  $('[data-toggle="tooltip"]').tooltip();
		  var val = $("a[href=notHref]").remove();
		});
		$("#select-status").select2({
		  allowClear: true,
		  language: "fa",
		  dir: "rtl"
		});
		$("#searchAll_price_type").select2({
		  allowClear: true,
		  language: "fa",
		  dir: "rtl"
		});
		$("#searchAll_category_id").select2({
		  allowClear: true,
		  language: "fa",
		  dir: "rtl"
		});
		$('.dropdown-menu input, .dropdown-menu').click(function(e) {
        e.stopPropagation();
   		 });
    </script>
  </body>
</html>

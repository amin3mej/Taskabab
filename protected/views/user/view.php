<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'پنل مدیریت'=>array('/admin'),
	'مدیریت کاربران'=>array('index'),
	$model->username,
);

$this->menu=array(
	array('label'=>'مدیریت کاربران', 'url'=>array('index')),
	array('label'=>'حذف کاربر', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'برای حذف کردن این آیتم اطمینان کامل دارید؟')),
);
?>

<h1>مشاهده کاربر #<?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'email',
		array('name' => 'status','value' => $model->statusText),
		'activation_code',
		'fullname',
		'phone',
		'address',
		array('name' => 'last_login_time', 'value' => $model->j_last_login_time),
		array('name' => 'create_time', 'value' => $model->j_create_time),
		),
)); ?>

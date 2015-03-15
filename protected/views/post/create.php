<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'پنل مدیریت'=>array('/admin'),
	'مدیریت مطالب'=>array('index'),
	'افزودن',
);

$this->menu=array(
	array('label'=>'مدیریت مطالب', 'url'=>array('index')),
);
?>

<h1>نوشتن مطلب</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
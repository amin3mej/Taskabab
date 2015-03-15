<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'پنل مدیریت'=>array('/admin'),
	'مدیریت موضوعات'=>array('index'),
	'افزودن',
);

$this->menu=array(
	array('label'=>'مدیریت موضوعات', 'url'=>array('index')),
);
?>

<h1>افزودن موضوع</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
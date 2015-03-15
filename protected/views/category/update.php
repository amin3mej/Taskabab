<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'پنل مدیریت'=>array('/admin'),
	'مدیریت موضوعات'=>array('index'),
	$model->name=>array('/category/view/'.$model->id),
	'ویرایش',
);

$this->menu=array(
	array('label'=>'مدیریت موضوعات', 'url'=>array('index')),
	array('label'=>'افزودن موضوع', 'url'=>array('create')),
	array('label'=>'مشاهده موضوع', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>ویرایش موضوع شماره #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
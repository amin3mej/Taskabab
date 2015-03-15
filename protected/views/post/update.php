<?php
/* @var $this PostController */
/* @var $model Post */
$this->breadcrumbs=array(
	'پنل مدیریت'=>array('/admin'),
	'مدیریت مطالب'=>array('index'),
	$model->title=>array('/post/view/'.$model->id),
	'ویرایش',
);

$this->menu=array(
	array('label'=>'مدیریت مطالب', 'url'=>array('index')),
	array('label'=>'نوشتن مطلب جدید', 'url'=>array('create')),
	array('label'=>'مشاهده این مطلب', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>بروزرسانی <?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
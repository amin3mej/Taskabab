<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'پنل مدیریت'=>array('/admin'),
	'مدیریت موضوعات'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'مدیریت موضوعات', 'url'=>array('index')),
	array('label'=>'افزودن موضوع', 'url'=>array('create')),
	array('label'=>'ویرایش موضوع', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'حذف موضوع', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'برای حذف کردن این آیتم اطمینان کامل دارید؟')),
);
?>

<h1>مشاهده موضوع شماره #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		array('name' => 'parent_id','value' => $model->catText),
	),
)); ?>

<?php
/* @var $this SettingsController */
/* @var $model Settings */

$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'ویرایش', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'مدیریت تنظیمات', 'url'=>array('/admin/setting')),
);
?>

<h1>مشاهده "<?php echo $model->FaTitle; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('name' => 'key','value' => $model->FaTitle),
		array('name' => 'value','value' => nl2br($model->value),'type' => 'RAW')
	),
)); ?>

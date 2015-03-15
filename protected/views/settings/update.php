<?php
/* @var $this SettingsController */
/* @var $model Settings */

$this->breadcrumbs=array(
	'پنل مدیریت'=>array('/admin'),
	'تنظیمات'=>array('/admin/settings'),
	$model->id=>array('view','id'=>$model->id),
	'ویرایش',
);

$this->menu=array(
	array('label'=>'مشاهده', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'مدیریت تنظیمات', 'url'=>array('/admin/setting')),
);
?>

<h1>ویرایش "<?php echo $model->FaTitle; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
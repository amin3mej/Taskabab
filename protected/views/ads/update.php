<?php
/* @var $this AdsController */
/* @var $model Ads */
$this->pageTitle = Yii::app()->name.' - بروزرسانی '.$model->name;

$this->breadcrumbs=array(
	'آگهی'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'بروزرسانی',
);

$this->menu=array(
	array('label'=>'همه آگهی ها', 'url'=>array('/index')),
	array('label'=>'مشاهده آگهی', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>بروزرسانی آگهی <i><?php echo $model->name; ?></i></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
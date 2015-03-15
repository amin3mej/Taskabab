<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'پنل مدیریت'=>array('/admin'),
	'مدیریت مطالب',
);
$this->menu=array(
	array('label'=>'نوشتن مطلب جدید', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#post-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>مدیریت مطالب</h1>

<p>
شما همچنین می توانید از عملگر های مقایسه (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
یا <b>=</b>) در ابتدای هرخانه استفاده کنید.
</p>

<?php echo CHtml::link('جستجو پیشرفته','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'content',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

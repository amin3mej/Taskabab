<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'پنل مدیریت'=>array('/admin'),
	'مدیریت موضوعات',
);

$this->menu=array(
	array('label'=>'افزودن موضوع', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>مدیریت موضوعات</h1>

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
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'description',
		array('name' => 'parent_id','value' => '$data->catText'),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'پنل مدیریت'=>array('/admin'),
	'مدیریت کاربران'=>array('index'),
	'مدیریت',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>مدیریت کاربران</h1>

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
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		'email',
		array('name' => 'status','value' => '$data->statusText'),
		'fullname',
		'phone',/*
		'address',
		'last_login_time',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
		*/
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}{delete}'
		),
	),
)); ?>

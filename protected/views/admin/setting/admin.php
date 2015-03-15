<?php
/* @var $this SettingsController */
/* @var $model Settings */

$this->breadcrumbs=array(
	'پنل مدیریت'=>array('index'),
	'تنظیمات',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#settings-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>تنظیمات اصلی</h1>

<p>
شما همچنین می توانید از عملگر های مقایسه (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
یا <b>=</b>) در ابتدای هرخانه استفاده کنید.
</p>

<?php echo CHtml::link('جستجو پیشرفته','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('//admin/setting/_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'settings-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name' => 'key','value' => '$data->FaTitle','filter' => false),
		array('name' => 'value','filter' => false),
		array(
            'template'=>'{view}{update}',
	        'updateButtonUrl' => 'Yii::app()->createUrl("/settings/update",array("id"=>$data["id"]))',
	        'viewButtonUrl' => 'Yii::app()->createUrl("/settings/view",array("id"=>$data["id"]))',
			'class'=>'CButtonColumn',
		),
	),
)); ?>

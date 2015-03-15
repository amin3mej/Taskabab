<?php
/* @var $this AdsController */
/* @var $model Ads */
$this->pageTitle = Yii::app()->name.' - مشاهده '.$model->name;
$this->breadcrumbs=array(
	'آگهی'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'اصلاح آگهی', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'حذف آگهی', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/theme/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js');
$cs->registerScriptFile($baseUrl.'/theme/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5');
$cs->registerScriptFile($baseUrl.'/theme/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5');
$cs->registerScriptFile($baseUrl.'/theme/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6');
$cs->registerScriptFile($baseUrl.'/theme/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7');

$cs->registerCssFile($baseUrl.'/theme/js/fancybox/source/jquery.fancybox.css?v=2.1.5');
$cs->registerCssFile($baseUrl.'/theme/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5');
$cs->registerCssFile($baseUrl.'/theme/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7');

?>
<h1>مشاهده آگهی <i><?php echo $model->name; ?></i></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		array(        
			'name'=>'description',
			'type' => 'raw',
    		'value'=>$model->description,
    	),
		array(
			'name' => 'price',
			'value' => $model->price.' <b>'.$model->priceText.'</b>',
			'visible' => ($model->price_type < 3),
			'type' => 'raw',
		),
		array(
			'name' => 'وضعیت',
			'value' => $model->priceText,
			'visible' => ($model->price_type > 2),
			'type' => 'raw',
		),
		array(
			'name' => 'category_id',
			'value' => $model->catText,
		),
		array(
			'name' => 'create_time',
			'value' => $model->JCreateTime,
		),
		array(
			'name' => 'state',
			'value' => $model->stateText,
		),
		array(
			'name' => 'نام نویسنده',
			'value' => $model->author->fullname,
		),
		array(
			'name' => 'شماره موبایل',
			'value' => $model->author->phone,
		),
		array(
			'name' => 'ایمیل',
			'value' => $model->author->email,
		),
	)
));
if(count($model->images) > 0){
	echo " <div class=\"pictures\"><b>تصاویر</b> : <br>";
	foreach ($model->images as $value) {
		echo "<a class=\"fancybox\" rel=\"group\" href=\"".Yii::app()->request->baseUrl.'/images/'.$model->id.'/'.$value->photo_name."\"><img src=\"".Yii::app()->request->baseUrl.'/images/'.$model->id.'/thumbnail_'.$value->photo_name."\" alt=\"\" /></a>";
	}
	echo "</div>";
}?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>
<div class="alarm centered">
	<p>
	<b>پیام پلیس فتا:</b><br>
	لطفا پیش از انجام معامله و هر نوع پرداخت وجه، از صحت کالا یا خدمات ارائه شده، به صورت حضوری اطمینان حاصل نمایید.
	</p>
	<p><b>پیام وبسایت:</b><br>
	این وبسایت هیچ‌گونه منفعت و مسئولیتی در قبال معامله شما ندارد.<br>
	<a href="<?php echo $this->createUrl('/ads/create');?>" class="btn btn-primary">شما نیز آگهی ارسال کنید</a><br>
	</p>
</div>

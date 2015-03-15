<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="col-sm-3 col-md-2 sidebar">
<?php 	
$a=Yii::app()->cache->get('postAll');
if($a===false)
{
	ob_start();
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'آخرین مطالب سایت',
	));
	$this->widget('zii.widgets.CMenu', array(
		'items'=>Post::model()->CMenu,
		'htmlOptions'=>array('class'=>'operations nav nav-sidebar'),
	));
	$this->endWidget();
	$a = ob_get_contents();
	ob_end_clean();
	Yii::app()->cache->set('postAll',$a,120);
}
echo $a;
?>
</div><div class="col-sm-9 col-md-10 main">
	<?php 
	if(isset($this->breadcrumbs) && count($this->breadcrumbs) > 0){
		echo '<ul class="breadcrumb"><li><a href="'.Yii::app()->request->baseUrl.'">صفحه اصلی</a></li>';
		foreach ($this->breadcrumbs as $key => $value) {
			if(is_array($value)){
				echo '<li>'.CHtml::link($key, $this->createUrl($value[0])).'</li>';
			}
			else{
				echo '<li>'.$value.'</li>';
			}

		}
		echo '</ul>';
	}
?>
<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>
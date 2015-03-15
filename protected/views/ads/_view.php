<?php
/* @var $this AdsController */
/* @var $data Ads */
?>

<div class="view">

	<span class="text right">
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
	<br />
	<?php
		if($data->price_type < 3)
			echo '<b>قیمت:</b> '.CHtml::encode($data->price.' ');
		else
			echo '<b>وضعیت:</b> ';
	?><b><?php echo CHtml::encode($data->getPriceText()); ?></b>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->getCatText()); ?>
	<br />
	<?php
	if(!Yii::app()->user->isGuest && Yii::app()->user->id == $data->author->id){
	echo "آگهی من!";
	}
	?>
	</span>
	<div class="picture left">
		<?php 
			if(count($data->images) > 0){
				$img = array_shift(array_values($data->images));
				echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/images/'.$data->id.'/thumbnail_'.$img->photo_name, CHtml::encode($data->name)), array('view', 'id'=>$data->id));
			}else{
				echo "<img src=\"".Yii::app()->request->baseUrl."/images/noProduct.jpg\" alt=\"\" />";				
			}
		?>
	</div>

</div>
<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<table>
	<tr>
		<td><?php echo $form->label($model,'id'); ?></td>
		<td><?php echo $form->textField($model,'id',array('class' => 'form-control')); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'name'); ?></td>
		<td><?php echo $form->textField($model,'name',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?></td>
	</tr> 
	<tr>
		<td colspan="2"><?php echo CHtml::submitButton('جستجو',array('class' => 'btn btn-default')); ?></td>
	</tr>
</table>
<?php $this->endWidget(); ?>

</div><!-- search-form -->
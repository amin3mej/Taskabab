<?php
/* @var $this SettingsController */
/* @var $model Settings */
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
		<td><?php echo $form->label($model,'key'); ?></td>
		<td><?php echo $form->textField($model,'key',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'value'); ?></td>
		<td><?php echo $form->textArea($model,'value',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?></td>
	</tr> 

	<tr>
		<td colspan="2"><?php echo CHtml::submitButton('جسجتو',array('class' => 'btn btn-default')); ?></td>
	</tr>
</table>
<?php $this->endWidget(); ?>

</div><!-- search-form -->
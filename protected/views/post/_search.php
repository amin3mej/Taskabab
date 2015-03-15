<?php
/* @var $this PostController */
/* @var $model Post */
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
		<td><?php echo $form->label($model,'title'); ?></td>
		<td><?php echo $form->textField($model,'title',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'content'); ?></td>
		<td><?php echo $form->textArea($model,'content',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?></td>
	</tr> 

	<tr>
		<td colspan="2"><?php echo CHtml::submitButton('Search',array('class' => 'btn btn-default')); ?></td>
	</tr>
</table>
<?php $this->endWidget(); ?>

</div><!-- search-form -->
<?php
/* @var $this SettingsController */
/* @var $model Settings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">فیلد های <span class="required">*</span> دار الزامیند.</p>

	<?php echo $form->errorSummary($model); ?>
<table>
	<tr class="<?php echo $model->getError('key')  ? 'has-error' : '' ?>">
		<td><?php echo $form->labelEx($model,'key'); ?></td>
		<td><?php echo $model->getAttributeLabel($model->key);?></td>
		<td><?php echo $form->error($model,'key'); ?></td>
	</tr>

	<tr class="<?php echo $model->getError('value')  ? 'has-error' : '' ?>">
		<td><?php echo $form->labelEx($model,'value'); ?></td>
		<td><?php echo $form->textArea($model,'value',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?></td>
		<td><?php echo $form->error($model,'value'); ?></td>
	</tr>


	<tr>
		<td colspan="3"><?php echo CHtml::submitButton($model->isNewRecord ? 'ساخت' : 'بروزرسانی',array('class' => 'btn btn-primary')); ?>
</td>
	</td>
</table>
<?php $this->endWidget(); ?>

</div><!-- form -->
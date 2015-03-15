<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">فیلد های <span class="required">*</span> دار الزامیند.</p>

	<?php echo $form->errorSummary($model); ?>
<table>
	<tr class="<?php echo $model->getError('name')  ? 'has-error' : '' ?>">
		<td><?php echo $form->labelEx($model,'name'); ?></td>
		<td><?php echo $form->textField($model,'name',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?></td>
		<td><?php echo $form->error($model,'name'); ?></td>
	</tr>

	<tr class="<?php echo $model->getError('description')  ? 'has-error' : '' ?>">
		<td><?php echo $form->labelEx($model,'description'); ?></td>
		<td><?php echo $form->textArea($model,'description',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?></td>
		<td><?php echo $form->error($model,'description'); ?></td>
	</tr>

	<tr class="<?php echo $model->getError('parent_id')  ? 'has-error' : '' ?>">
		<td><?php echo $form->labelEx($model,'parent_id'); ?></td>
		<td><?php echo $form->dropDownList($model,'parent_id',$model->catOptions,array('class' => 'form-control')); ?></td>
		<td><?php echo $form->error($model,'parent_id'); ?></td>
	</tr>


	<tr>
		<td colspan="3"><?php echo CHtml::submitButton($model->isNewRecord ? 'ساخت' : 'بروزرسانی',array('class' => 'btn btn-primary')); ?>
</td>
	</td>
</table>
<?php $this->endWidget(); ?>

</div><!-- form -->
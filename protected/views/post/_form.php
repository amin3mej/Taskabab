<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'enctype' => 'multipart/form-data',
	)
)); ?>

	<p class="note">فیلد های <span class="required">*</span> دار الزامیند.</p>

	<?php echo $form->errorSummary($model); ?>
<table>
	<tr class="<?php echo $model->getError('title')  ? 'has-error' : '' ?>">
		<td><?php echo $form->labelEx($model,'title'); ?></td>
		<td><?php echo $form->textField($model,'title',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?></td>
		<td><?php echo $form->error($model,'title'); ?></td>
	</tr>

	<tr class="<?php echo $model->getError('content')  ? 'has-error' : '' ?>">
		<td><?php echo $form->labelEx($model,'content'); ?></td>
		<td><?php echo $form->textArea($model,'content',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?></td>
		<td><?php echo $form->error($model,'content'); ?></td>
	</tr>

	<tr>
		<td><label for="attachment">ضمیمه</label></td>
		<td><a class="btn btn-default" onclick="document.getElementsByName('attachment[]')[0].click();" >ضمیمه فایل</a><?php
			$this->widget('CMultiFileUpload', array(
				'name' => 'attachment', 
				'attribute' => 'attachment', 
				'duplicate' => 'فایل تکراری است!', // useful, i think
		        'remove' => '<i class="glyphicon glyphicon-trash"></i>',
		        'htmlOptions' => array('style' =>'color: transparent;width:0;height:0;', 'multiple' => 'multiple', 'size' => 25 ),
				)
			);?>
		</td>
	</tr>
	<tr>
		<td colspan="3"><?php echo CHtml::submitButton($model->isNewRecord ? 'ساخت' : 'بروزرسانی',array('class' => 'btn btn-primary')); ?>
</td>
	</td>
</table>
<?php $this->endWidget(); ?>

</div><!-- form -->
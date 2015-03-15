<?php
/* @var $this UserController */
/* @var $model User */
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
		<td><?php echo $form->label($model,'username'); ?></td>
		<td><?php echo $form->textField($model,'username',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'email'); ?></td>
		<td><?php echo $form->textField($model,'email',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'status'); ?></td>
		<td><?php echo $form->textField($model,'status',array('class' => 'form-control')); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'activation_code'); ?></td>
		<td><?php echo $form->textField($model,'activation_code',array('class' => 'form-control')); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'fullname'); ?></td>
		<td><?php echo $form->textField($model,'fullname',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'phone'); ?></td>
		<td><?php echo $form->textField($model,'phone',array('class' => 'form-control','size'=>11,'maxlength'=>11)); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'address'); ?></td>
		<td><?php echo $form->textArea($model,'address',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'last_login_time'); ?></td>
		<td><?php echo $form->textField($model,'last_login_time',array('class' => 'form-control')); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'create_time'); ?></td>
		<td><?php echo $form->textField($model,'create_time',array('class' => 'form-control')); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'create_user_id'); ?></td>
		<td><?php echo $form->textField($model,'create_user_id',array('class' => 'form-control')); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'update_time'); ?></td>
		<td><?php echo $form->textField($model,'update_time',array('class' => 'form-control')); ?></td>
	</tr> 

	<tr>
		<td><?php echo $form->label($model,'update_user_id'); ?></td>
		<td><?php echo $form->textField($model,'update_user_id',array('class' => 'form-control')); ?></td>
	</tr> 

	<tr>
		<td colspan="2"><?php echo CHtml::submitButton('جستجو',array('class' => 'btn btn-default')); ?></td>
	</tr>
</table>
<?php $this->endWidget(); ?>

</div><!-- search-form -->
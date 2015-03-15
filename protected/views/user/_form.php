<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">فیلد های <span class="required">*</span> دار الزامیند.</p>

	<table>
		<tr class="<?php echo $model->getError('fullname')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'fullname'); ?></td>
			<td><?php echo $form->textField($model,'fullname',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?></td>
			<td><?php echo $form->error($model,'fullname'); ?></td>
		</tr>

		<tr class="<?php echo $model->getError('username')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'username'); ?></td>
			<td><?php echo $form->textField($model,'username',array('class' => 'form-control ltr', 'size'=>60,'maxlength'=>255)); ?></td>
			<td><?php echo $form->error($model,'username'); ?></td>
		</tr>

		<tr class="<?php echo $model->getError('password')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'password'); ?></td>
			<td><?php echo $form->passwordField($model,'password',array('class' => 'form-control ltr', 'size'=>60,'maxlength'=>255)); ?></td>
			<td><?php echo $form->error($model,'password'); ?></td>
		</tr>

		<tr class="<?php echo $model->getError('password_repeat')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'password_repeat'); ?></td>
			<td><?php echo $form->passwordField($model,'password_repeat',array('class' => 'form-control ltr', 'size'=>60,'maxlength'=>255)); ?></td>
			<td><?php echo $form->error($model,'password_repeat'); ?></td>
		</tr>

		<tr class="<?php echo $model->getError('email')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'email'); ?></td>
			<td><?php echo $form->textField($model,'email',array('class' => 'form-control ltr', 'size'=>60,'maxlength'=>255)); ?></td>
			<td><?php echo $form->error($model,'email'); ?></td>
		</tr>

		<tr class="<?php echo $model->getError('phone')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'phone'); ?></td>
			<td><?php echo $form->textField($model,'phone',array('class' => 'form-control ltr', 'size'=>60,'maxlength'=>11)); ?></td>
			<td><?php echo $form->error($model,'phone'); ?></td>
		</tr>

		<tr class="<?php echo $model->getError('address')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'address'); ?></td>
			<td><?php echo $form->textArea($model,'address',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?></td>
			<td><?php echo $form->error($model,'address'); ?></td>
		</tr>
	<?php if(CCaptcha::checkRequirements()): ?>
		<tr class="<?php echo $model->getError('verifyCode')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'verifyCode'); ?></td>
			<td>		<?php $this->widget('CCaptcha', array(
		    'showRefreshButton' => true,
		    // 'clickableImage' => true,
		    'imageOptions' => array('class' => 'captcha-img'),
		)); ?>
		<?php echo $form->textField($model,'verifyCode',array('class' => 'form-control')); ?>
		</td>
			<td><?php echo $form->error($model,'verifyCode'); ?></td>
		</tr>
	<?php endif; ?>
    </table>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'ثبت نام' : 'ذخیره',array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
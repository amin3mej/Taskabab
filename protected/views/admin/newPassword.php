<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - تغییر رمز عبور';

?>

<h1>تغییر رمز عبور مدیریت</h1>

<?php if(Yii::app()->user->hasFlash('changeAdmin')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('changeAdmin'); ?>
</div>

<?php else: ?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'change-admin',
)); ?>

	<p class="note">برای ارائه نظر، انتقاد، پیشنهاد ، تماس با مدیر و یا سفارش ثبت تبلیغات می توانید از طریق زیر اقدام فرمایید.</p>

	<div>
	<table>
		<tr class="<?php echo $model->getError('oldpassword')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'oldpassword'); ?></td>
			<td><?php echo $form->textField($model,'oldpassword',array('class' => 'ltr form-control')); ?></td>
			<td><?php echo $form->error($model,'oldpassword'); ?></td>
		</tr>
		<tr class="<?php echo $model->getError('password')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'password'); ?></td>
			<td><?php echo $form->passwordField($model,'password',array('class' => 'ltr form-control')); ?></td>
			<td><?php echo $form->error($model,'password'); ?></td>
		</tr>
		<tr class="<?php echo $model->getError('password_repeat')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'password_repeat'); ?></td>
			<td><?php echo $form->passwordField($model,'password_repeat',array('class' => 'ltr form-control')); ?></td>
			<td><?php echo $form->error($model,'password_repeat'); ?></td>
		</tr>

		<tr>
			<td colspan="3" class="centered">
				<div class="row buttons">
					<?php echo CHtml::submitButton('ارسال',array('class' => 'btn btn-primary')); ?>
				</div>
			</td>
	</tr>
	</table>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
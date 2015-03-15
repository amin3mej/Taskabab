<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - تماس با ما';
$this->breadcrumbs=array(
	'تماس با ما',
);
?>

<h1>تماس با ما</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">برای ارائه نظر، انتقاد، پیشنهاد ، تماس با مدیر و یا سفارش ثبت تبلیغات می توانید از طریق زیر اقدام فرمایید.</p>

	<div>
	<table>
		<tr class="<?php echo $model->getError('name')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'name'); ?></td>
			<td><?php echo $form->textField($model,'name',array('class' => 'form-control')); ?></td>
			<td><?php echo $form->error($model,'name'); ?></td>
		</tr>

		<tr class="<?php echo $model->getError('email')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'email'); ?></td>
			<td><?php echo $form->textField($model,'email',array('class' => 'form-control')); ?></td>
			<td><?php echo $form->error($model,'email'); ?></td>
		</tr>

		<tr class="<?php echo $model->getError('subject')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'subject'); ?></td>
			<td><?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128,'class' => 'form-control')); ?></td>
			<td><?php echo $form->error($model,'subject'); ?></td>
		</tr>

		<tr class="<?php echo $model->getError('mobile')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'mobile'); ?></td>
			<td><?php echo $form->textField($model,'mobile',array('size'=>60,'maxlength'=>11,'class' => 'form-control')); ?></td>
			<td><?php echo $form->error($model,'mobile'); ?></td>
		</tr>

		<tr class="<?php echo $model->getError('body')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'body'); ?></td>
			<td><?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50,'class' => 'form-control')); ?></td>
			<td><?php echo $form->error($model,'body'); ?></td>
		</tr>

	<?php if(CCaptcha::checkRequirements()): ?>
		<tr class="<?php echo $model->getError('verifyCode')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'verifyCode'); ?></td>
			<td>		<?php $this->widget('CCaptcha', array(
		    'showRefreshButton' => false,
		    'clickableImage' => true,
		    'imageOptions' => array('class' => 'captcha-img'),
		)); ?>
		<?php echo $form->textField($model,'verifyCode',array('class' => 'form-control')); ?>
		</td>
			<td><?php echo $form->error($model,'verifyCode'); ?></td>
		</tr>

	<?php endif; ?>
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
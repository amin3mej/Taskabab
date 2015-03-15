<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - ورود';
$this->breadcrumbs=array(
	'ورود',
);
?>

<h1>ورود به سایت</h1>


<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<table>
		<tr class="<?php echo $model->getError('username')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'username'); ?></td>
			<td><?php echo $form->textField($model,'username',array('class' => 'form-control ltr')); ?></td>
			<td><?php echo $form->error($model,'username'); ?></td>
		</tr>
		<tr class="<?php echo $model->getError('password')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'password'); ?></td>
			<td><?php echo $form->passwordField($model,'password',array('class' => 'form-control ltr')); ?></td>
			<td><?php echo $form->error($model,'password'); ?></td>
		</tr>
		<tr class="<?php echo $model->getError('rememberMe')  ? 'has-error' : '' ?>">
			<td colspan="2" class="centered"><?php echo $form->checkBox($model,'rememberMe'); ?>&nbsp;<?php echo $form->label($model,'rememberMe'); ?></td>
			<td><?php echo $form->error($model,'rememberMe'); ?></td>
		</tr>
		<tr>
			<td colspan="3" class="centered"><?php echo CHtml::submitButton('ورود',array('class' => 'btn btn-primary')); ?></td>
		</tr>
	</table>
<?php $this->endWidget(); ?>
</div><!-- form -->

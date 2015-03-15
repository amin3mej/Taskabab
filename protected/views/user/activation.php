<?php
?>
<div class="form">
<?php if(Yii::app()->user->hasFlash('activation')):?>
     <div class="errorMessage">
	      <?php echo Yii::app()->user->getFlash('activation'); ?>
	 </div><br>
<?php endif; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'activation-form',
	'enableAjaxValidation'=>false,
)); ?>
<h1>فعال سازی حساب کاربری</h1>
<span>برای فعال سازی حساب کاربری خود کافی است کد ارسالی به گوشی خود را اینجا وارد کنید.</span><br><br>
<table>
	<tr>
		<td><label for="Activation_code" class="required">کد فعال سازی <span class="required">*</span></label></td>
		<td><input size="60" maxlength="6" class="form-control" name="activationForm[code]" id="Activation_code" type="number"></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" class="btn btn-primary" value="فعال سازی"></td>
	</tr>
</table>
</div>
<?php $this->endWidget(); ?>

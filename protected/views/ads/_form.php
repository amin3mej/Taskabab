<?php
/* @var $this AdsController */
/* @var $model Ads */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/theme/wysiwyg/summernote.js');
$cs->registerScriptFile($baseUrl.'/theme/wysiwyg/summernote-fa-IR.js');
$cs->registerScriptFile($baseUrl.'/theme/wysiwyg/summernote-fa-IR.js');
$cs->registerCssFile($baseUrl.'/theme/wysiwyg/summernote.css');
$cs->registerCssFile('http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');
?>
<div class="form">
<?php if(Yii::app()->user->hasFlash('error')):?>
     <div class="errorMessage">
	      <?php echo Yii::app()->user->getFlash('error'); ?>
	 </div><br>
<?php endif; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ads-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array( 'multiple' => 'multiple', 'enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">فیلد های <span class="required">*</span> دار الزامیند.</p>

	<table>

		<tr class="<?php echo $model->getError('category_id')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'category_id'); ?></td>
			<td><?php echo $form->DropDownList($model,'category_id',  $model->getCatOptions(),array('ajax' => array('type'=>'POST','url'=>CController::createUrl('Ads/dynamicText'),'update'=>'#cat_text'),'class'=>"form-control",'encode' => false)); ?></td>
			<td><?php echo $form->error($model,'category_id'); ?></td>
		</tr>
		<tr id="cat_text">
		</tr>
		<tr class="<?php echo $model->getError('state')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'state'); ?></td>
			<td><?php echo $form->DropDownList($model,'state',$model->getStateOptions(),array('class' => 'form-control')); ?></td>
			<td><?php echo $form->error($model,'state'); ?></td>
		</tr>

		<tr class="<?php echo $model->getError('type')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'type'); ?></td>
			<td><?php echo $form->DropDownList($model,'type',$model->getTypeOptions(),array('class' => 'form-control')); ?></td>
			<td><?php echo $form->error($model,'type'); ?></td>
		</tr>
		
		<tr class="<?php echo $model->getError('name')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'name'); ?></td>
			<td><?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?></td>
			<td><?php echo $form->error($model,'name'); ?></td>
		</tr>

		<tr class="<?php echo $model->getError('description')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'description'); ?></td>
			<td><?php echo $form->textArea($model,'description',array('class' => 'form-control'));?></td>
			<td><?php echo $form->error($model,'description'); ?></td>
		</tr>

		<tr class="form-inline <?php echo $model->getError('price')  ? 'has-error' : '' ?>">
			<td><?php echo $form->labelEx($model,'price'); ?></td>
			<td><span id="price"><?php echo $form->textField($model,'price',array('class' => 'form-control')) .'</span>&nbsp;'.$form->DropDownList($model,'price_type', $model->priceOptions,array('encode'=>false,'class' => 'form-control')); ?></td>
			<td><?php echo $form->error($model,'price').'&nbsp;'.$form->error($model,'price_type'); ?></td>
		</tr>
		<tr>
		<td><?php echo $form->labelEx($model,'images'); ?>
		<td><?php
			$this->widget('CMultiFileUpload', array(
				'name' => 'images', 
				'attribute' => 'images', 
				'accept' => 'jpeg|jpg|gif|png', // useful for verifying files
				'duplicate' => 'فایل تکراری است!', // useful, i think
				'denied' => 'فقط می توانید عکس ارسال کنید.', // useful, i think
		        'max' => 3,
		        'remove' => '<i class="glyphicon glyphicon-trash"></i>',
		        'htmlOptions' => array('style' =>'color: transparent;', 'multiple' => 'multiple', 'size' => 25 ),
				)
			);echo '</td></tr>';
		if(!$model->isNewRecord){
		?>
			<tr>
				<?php
				if(is_array($model->images))
					{
						$i = 0;
						foreach ($model->images as $key => $value) {
							echo '<td style="text-align:center;" id="ads_image_'.$value->id.'">';
							echo "<a class=\"fancybox\" rel=\"group\" href=\"".Yii::app()->request->baseUrl.'/images/'.$model->id.'/'.$value->photo_name."\"><img src=\"".Yii::app()->request->baseUrl.'/images/'.$model->id.'/thumbnail_'.$value->photo_name."\" alt=\"\" /></a>";
							echo "<br>";
							echo CHtml::ajaxLink(
							    '<button class="btn btn-default ajax-delete">حذف</button>', 
							    array('/Ads/deleteImage','id'=>$value->id),
							    array (
							        'type'=>'POST',
							        'dataType'=>'json',
							      ) );
								echo "<script type=\"text/javascript\">jQuery('body').on('click','#yt".($i++).'\',function(){$("td#ads_image_'.$value->id."\").css({\"display\": \"none\"});});</script>";
							echo "</td>";
						}
					}
				?>			
		</tr>
	<?php } ?>
	<tr>
		<td colspan="3" class="centered"> <?php echo CHtml::submitButton($model->isNewRecord ? 'ارسال' : 'ذخیره',array('class' => 'btn btn-primary')); ?></td>
	</tr>
	</table>
	<script type="text/javascript">
			function getFile(){
	        document.getElementById("images").click();
	    }
	    $(document).ready(function() {
	      $('#Ads_description').summernote({
	        height: 200,
	        tabsize: 2,
	        lang: 'fa-IR',
	        direction: 'rtl',
	      });
	    });
	    var valeyr = '';
		$("#Ads_price_type").change(
			function () {
			var val = $('select#Ads_price_type').find(":selected").val();
			if(val > 2){
				valeyr = $('#Ads_price').val();
				$('#Ads_price').val("0");
				$("span#price").css({"display": "none"});
			}else{
				$('#Ads_price').val( valeyr );
				$("span#price").css({"display": "inline"});
			}
		});
		var val = $('select#Ads_price_type').find(":selected").val();
			if(val > 2){
				valeyr = $('#Ads_price').val();
				$('#Ads_price').val("0");
				$("span#price").css({"display": "none"});
			}
	</script>
<?php $this->endWidget(); ?>

</div><!-- form -->
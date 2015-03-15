<?php
$a=Yii::app()->cache->get('adsIndex');
if($a===false || Yii::app()->user->hasFlash('activation'))
{
	ob_start();
?>
		<div id="headerwrap">
				<div class="col-xs-12 centered">
					<?php if(Yii::app()->user->hasFlash('activation')):?>
					     <h4>
						      <?php echo Yii::app()->user->getFlash('activation'); ?>
						 </h4>
					<?php endif;?>
					<?php echo CHtml::image($this->createUrl('/theme/img/logo.png'),'تاس کباب',array('class' => 'img-responsive logo')); ?><br>
					<h2 class="big-text"><?php echo Yii::app()->params['description'];?></h2>
					<form class="form-inline" method="POST" action="<?php echo $this->createUrl('/ads/searchAll'); ?>" role="form">

					    <div class="col-md-6 col-xs-12 border-radius-5">
							<div class="col-md-4 col-xs-10 margin-down ">
						    	<select name="searchAll[state]" class="form2-control" id="select-status">
						    		<option value="-1">همه استان ها &nbsp;</option>
						    		<?php 
						    			$m = Ads::model();
						    			$mm = $m->stateOptions;
						    			unset($mm[0]);
						    			foreach ($mm as $key => $value) {
						    				echo "<option value='$key'>".$value."</option>".PHP_EOL;
						    			}
						    		?>
						    	</select>
						    </div>
						    
						    <div class="col-md-4 col-xs-10 margin-down">
						    		<?php $mm = $m->getCatOptions(false);$mm[0] = 'همه موضوعات';?>
						    	<?php echo CHtml::dropDownList('searchAll[price_type]','', $mm,array('ajax' => array('type'=>'POST','url'=>CController::createUrl('Ads/dynamicCat'),'update'=>'#searchAll_category_id'),'class'=>"form2-control")); ?>
						    </div>
						    <div class="col-md-4 col-xs-10 margin-down">
						    	<?php echo CHtml::dropDownList('searchAll[category_id]','', array('همه زیر موضوعات'),array('class'=>"form2-control"));?>
						    </div>
					    </div>

					    <div class="col-md-5 col-xs-12 centered margin-down">
					    	<input name="searchAll[name]" type="search" class="form-control" id="search" placeholder="جستجو . . .">
					    </div>

					    <div class="col-md-1 col-xs-12 margin-down">
					 		<button type="submit" class="btn btn-warning btn-lg">جستجو!</button>
					    </div>

					</form>					
				</div>
				<div class="content adve">
					<div class="col-xs-12 col-md-6 posts">
						آخرین مطالب سایت: 
						<?php 
						$this->widget('zii.widgets.CMenu', array(
							'items'=>Post::model()->getCMenu(9999),
							'htmlOptions'=>array('class'=>'operations nav nav-sidebar'),
						));
						?>
					</div>
					<div class="col-xs-12 col-md-6 ads">
					<?php 
					for ($i=1; $i < 20; $i++) { 
						if(Yii::app()->params['ads'.$i.'-img'].Yii::app()->params['ads'.$i.'-img'] != ''){
							echo ($i > 1 ? '<br>':'').CHtml::link(CHtml::image((Yii::app()->params['ads'.$i.'-img']),'تبلیغات',array('class' => 'img-responsive')),Yii::app()->params['ads'.$i.'-link']);
						}
					}
					?>
					</div>					
				</div>
		</div><!-- /container -->
<?php
	$a = ob_get_contents();
	ob_end_clean();
	Yii::app()->cache->set('adsIndex',$a,120);
}
echo $a;
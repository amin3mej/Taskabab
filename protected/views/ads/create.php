<?php
/* @var $this AdsController */
/* @var $model Ads */

$this->breadcrumbs=array(
	'ارسال آگهی',
);

?>

<h1>ارسال آگهی</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
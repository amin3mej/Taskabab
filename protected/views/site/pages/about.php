<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - درباره';
$this->breadcrumbs=array(
	'درباره',
);
?>
<h1 class="page-header">درباره</h1>
<?php
echo Yii::app()->params['about'];
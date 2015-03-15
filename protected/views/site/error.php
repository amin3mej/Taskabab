<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - خطا';
$this->breadcrumbs=array(
	'خطا',
);
?>

<h2>خطای <?php echo $code; ?></h2>

<div class="error">
<?php echo ($message); ?>
</div>
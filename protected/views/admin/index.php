<?php
/* @var $this AdminController */

$this->breadcrumbs=array(
	'پنل مدیریت',
);
?>
<h1>به پنل مدیریت خوش آمدید.</h1>

<p>
	برای ورود به هر یک از قسمت های زیر روی آن کلیک کنید.<br>
	<ul>
		<li><?php echo CHtml::link(CHtml::encode('تنظیمات'), array('/admin/setting')); ?></li>
		<li><?php echo CHtml::link(CHtml::encode('مدیریت مطالب'), array('/admin/post')); ?></li>
		<li><?php echo CHtml::link(CHtml::encode('مدیریت کاربران'), array('/admin/user')); ?></li>
		<li><?php echo CHtml::link(CHtml::encode('مدیریت موضوعات'), array('/admin/category')); ?></li>
		<li><?php echo CHtml::link(CHtml::encode('مدیریت آگهی ها'), array('/admin/ads')); ?></li>
		<li><?php echo CHtml::link(CHtml::encode('مدیریت نسخه پشتیبانی'), array('/admin/backup')); ?></li>
		<li><?php echo CHtml::link(CHtml::encode('تغییر رمز عبور مدیریت'), array('/admin/changeAdmin')); ?></li>
	</ul>
</p>

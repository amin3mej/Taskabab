<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'پنل مدیریت'=>array('/admin'),
	'مدیریت مطالب'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'مدیریت مطالب', 'url'=>array('/post')),
	array('label'=>'نوشتن مطلب جدید', 'url'=>array('create')),
	array('label'=>'ویرایش این مطلب', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'حذف مطلب', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'برای حذف کردن این آیتم اطمینان کامل دارید؟')),
);
?>

<h1>مشاهده <?php echo $model->title; ?></h1>
<blockquote class="blockquote">نوشته شده در <?php echo $model->JCreateTime; ?> توسط <?php echo $model->author->username;?></blockquote>
<p><?php echo $model->content; ?></p>
فایل های ضمیمه: <ul>
	<?php if($model->attachments == null){echo '<li>هیچ فایل ضمیمه ای یافت نشد.</li>';}foreach ($model->attachments as $value) {
		echo "<li>".CHtml::link($value->attachment_name,array('/upload/'.$value->attachment_name))."</li>";
	}?>
</ul>
<hr />
<p>همچنین بخوانید: <ul>
	<?php 
		$nextPost = Post::model()->findByPk($model->id+1);
		if($nextPost !== NULL){
			echo '<li>خبر بعدی: '.CHtml::link($nextPost->title,array('/post/view/'.$nextPost->id)).'</li>';
		}
		$prevPost = Post::model()->findByPk($model->id-1);
		if($prevPost !== NULL){
			echo '<li>خبر قبلی: '.CHtml::link($prevPost->title,array('/post/view/'.$prevPost->id)).'</li>';
		}
	?></ul>
</p>
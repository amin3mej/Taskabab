<?php
/* @var $this AdsController */
/* @var $model Ads */

$this->breadcrumbs=array(
    'مدیریت' => array('/admin'),
    'مدیریت آگهی ها',
);

$this->menu=array(
    array('label'=>'List Ads', 'url'=>array('index')),
    array('label'=>'Create Ads', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#ads-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>مدیریت آگهی ها</h1>

<p>
همچنین شما می توانید از عملگر ها (<b>&lt;</b>، <b>&lt;=</b>، <b>&gt;</b>، <b>&gt;=</b>، <b>&lt;&gt;</b> یا <b>=</b>) در ابتدای جستجوهای خود استفاده کنید.
</p>

<?php echo CHtml::link('جستجوی پیشرفته','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('//admin/ads/_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'ads-grid',
    'dataProvider'=>$model->search(), 
    'filter'=>$model,
    'columns'=>array(
        'id',
        'name',
        array(
            'name' => 'price',
            'value' => '$data->fullPriceText',
        ),
        array(
            'name' => 'create_user_id',
            'value' => '$data->author->fullname',
            'sortable'=>false,
        ),
        array(
            'name' => 'status',
            'value' => '$data->statusText',
            'filter' => false,
        ),
        array(
            'name' => 'state',
            'value' => '$data->stateText',
            'filter' => false,
        ),

        array(
            'class' => 'CButtonColumn',
            'updateButtonUrl' => 'Yii::app()->createUrl("/ads/update",array("id"=>$data["id"]))',
            'viewButtonUrl' => 'Yii::app()->createUrl("/ads/view",array("id"=>$data["id"]))',
            'template'=>'{approve}{unapprove}{view}{update}',
            'buttons'=> 
            array( // custom buttons options here...
               'approve' => array(
                    'visible'=> '$data->status == 0', // <-- SHOW IF ROW INACTIVE
                    'imageUrl' => Yii::app()->baseUrl . '/theme/img/Approve.png',
                    'type' => 'raw',
                    'click'=>"function(){
                                            $.fn.yiiGridView.update('ads-grid', {
                                                type:'POST',
                                                url:$(this).attr('href'),
                                                success:function(data) {
                                                      $('#AjFlash').html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut('slow');
         
                                                      $.fn.yiiGridView.update('ads-grid');
                                                }
                                            })
                                            return false;
                                      }
                             ",
                    'url'=>'Yii::app()->controller->createUrl("Approve",array("id"=>$data->id))',
                ),
                'unapprove' => array(
                    'visible'=> '$data->status == 1', // <-- SHOW IF ROW INACTIVE
                    'imageUrl' => Yii::app()->baseUrl . '/theme/img/Unapprove.png',
                    'type' => 'raw',
                    'click'=>"function(){
                                            $.fn.yiiGridView.update('ads-grid', {
                                                type:'POST',
                                                url:$(this).attr('href'),
                                                success:function(data) {
                                                      $('#AjFlash').html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut('slow');
         
                                                      $.fn.yiiGridView.update('ads-grid');
                                                }
                                            })
                                            return false;
                                      }
                             ",
                    'url'=>'Yii::app()->controller->createUrl("Approve",array("id"=>$data->id))',
                 ),
            ),

        ),
    ),
)); ?>

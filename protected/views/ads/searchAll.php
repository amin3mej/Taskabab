<?php
$result = $model->searchAll();
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'student-grid',
    'itemsCssClass' => 'table table-striped table-hover',
    'dataProvider'=>$result,
    'columns'=>array(
	    array(
	        'header'=>'#',
	        'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
	    ),
	    array(
    		'header' => 'نام',
    		'value' => '$data["name"]',
    	),
    	array(
    		'name' => 'قیمت',
    		'value' => '$data->getFullPriceText()',
    		'type' => 'raw',
    	),
    	array(
    		'header' => 'استان',
    		'value' => '$data->stateText',
    		'type' => 'raw',
    	),
    	array(
    		'header' => 'موضوع',
    		'value' => '$data->catText',
    		'type' => 'raw',
    	),
    	array(
    		'name' => 'مشاهده',
    		'value' => '"<a class=\"btn btn-small btn-info\" href=\"".Controller::createUrl("/ads/view/".$data["id"])."\">مشاهده</a>"',
    		'type' => 'raw',
    	),
    ),
));?>
تاس کباب در خصوص محتوای آگهی هیچ مسئولیتی ندارد و توصیه می کند معاملات با احتیاط ودر مکانی امن انجام گیرد.
<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'تاس کباب',
	'Language' => 'fa_ir',
	'defaultController' => 'ads', 

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
	    'ePdf' => array(
	        'class'         => 'ext.yii-pdf.EYiiPdf',
	        'params'        => array(
	            'mpdf'     => array(
	                'librarySourcePath' => 'application.vendor.mpdf.*',
	                'constants'         => array(
	                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
	                ),
	                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
	                'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
	                    'mode'              => '', //  This parameter specifies the mode of the new document.
	                    'format'            => 'A4', // format A4, A5, ...
	                    'default_font_size' => 0, // Sets the default document font size in points (pt)
	                    'default_font'      => '', // Sets the default font-family for the new document.
	                    'mgl'               => 15, // margin_left. Sets the page margins for the new document.
	                    'mgr'               => 15, // margin_right
	                    'mgt'               => 16, // margin_top
	                    'mgb'               => 16, // margin_bottom
	                    'mgh'               => 9, // margin_header
	                    'mgf'               => 9, // margin_footer
	                    'orientation'       => 'P', // landscape or portrait orientation
	                )
	            ),
	            'HTML2PDF' => array(
	                'librarySourcePath' => 'application.vendor.html2pdf.*',
	                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
	                'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
	                    'orientation' => 'P', // landscape or portrait orientation
	                    'format'      => 'A4', // format A4, A5, ...
	                    'language'    => 'en', // language: fr, en, it ...
	                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
	                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
	                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
	               		'setDefaultFont' => 'yekan',
	                )
	            )
	        ),
	    ),

		'widgetFactory' => array(
            'widgets' => array(
                'CLinkPager' => array(
                    'header' => '<div class="pagination pagination-centered">',
                    'footer' => '</div>',
                    'nextPageLabel' => '> بعدی',
                    'prevPageLabel' => '< قبلی',
                    'selectedPageCssClass' => 'active',
                    'hiddenPageCssClass' => 'disabled',
                    'htmlOptions' => array(
                        'class' => '',
                    )
                )
            )
        ),
        'bootstrap'=>array(
       		'class'=>'bootstrap.components.Bootstrap',
        ),
        'cache'=>array( 
		    'class'=>'system.caching.CFileCache',
		),
        'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		    'stateKeyPrefix'=>'taskabab_',
		),
        'simpleImage'=>array(
                'class' => 'application.components.CSimpleImage',
        ),
        'jdate' => array(
		    'class' => 'ext.jdate.JDateTime',
		    'convert' => false,
		    'jalali' => true,
		    'timezone' => 'Asia/Tehran',
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'register' => 'user/register',
				'sitemap.xml' => 'site/sitemap',
				'login' => 'site/login',
				'logout' => 'site/logout',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<type:\w+>/<id:\w+>'=>'<controller>/<action>',
			),
		),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>true,
		'title' => true,
		'about' => true,
		'smsuser' => true,
		'smspass' => true,
		'smsnumber' => true,
		'description' => true,
		///////////////////
		'ads1-img' => true,		
		'ads2-img' => true,		
		'ads3-img' => true,		
		'ads4-img' => true,		
		'ads5-img' => true,		
		'ads6-img' => true,		
		'ads7-img' => true,		
		'ads8-img' => true,		
		'ads9-img' => true,		
		'ads10-img' => true,		
		'ads11-img' => true,		
		'ads12-img' => true,		
		'ads13-img' => true,		
		'ads14-img' => true,		
		'ads15-img' => true,		
		'ads16-img' => true,		
		'ads17-img' => true,		
		'ads18-img' => true,		
		'ads19-img' => true,
		////////////////////
		'ads1-link' => true,		
		'ads2-link' => true,		
		'ads3-link' => true,		
		'ads4-link' => true,		
		'ads5-link' => true,		
		'ads6-link' => true,		
		'ads7-link' => true,		
		'ads8-link' => true,		
		'ads9-link' => true,		
		'ads10-link' => true,		
		'ads11-link' => true,		
		'ads12-link' => true,		
		'ads13-link' => true,		
		'ads14-link' => true,		
		'ads15-link' => true,		
		'ads16-link' => true,		
		'ads17-link' => true,		
		'ads18-link' => true,		
		'ads19-link' => true,		
		
	),
);

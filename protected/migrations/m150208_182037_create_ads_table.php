<?php

class m150208_182037_create_ads_table extends CDbMigration
{
	public function up()
	{
		$this->createTable(
			'{{ads}}',
			array(
				'id' => 'pk',
	            'name' => 'string NOT NULL',
	            'description' => 'text NOT NULL',
	            'price' => 'int(10) DEFAULT NULL',
	            'price_type' => 'TINYINT(1) DEFAULT \'0\'',
	            'img' => 'string DEFAULT NULL',
	            'category_id' => 'int(10) DEFAULT NULL',
				'create_time' => 'datetime DEFAULT NULL',
				'create_user_id' => 'int(11) DEFAULT NULL',
				'update_time' => 'datetime DEFAULT NULL',
				'update_user_id' => 'int(11) DEFAULT NULL',
			),
			'ENGINE=InnoDB'
		);
		$this->createTable(
			'{{category}}',
			array(
				'id' => 'pk',
	            'name' => 'string NOT NULL',
	            'description' => 'text DEFAULT NULL',
	            'parent_id' => 'int(11) DEFAULT NULL',
			),
			'ENGINE=InnoDB'
		);	
		$this->addForeignKey("fk_ads_category", "{{ads}}", "category_id", "{{category}}", "id", "RESTRICT", "RESTRICT");
		$this->addForeignKey("fk_ads_owner", "{{ads}}", "create_user_id", "{{user}}", "id", "RESTRICT", "RESTRICT");
		$this->addForeignKey("fk_ads_update_user", "{{ads}}", "update_user_id", "{{user}}", "id", "RESTRICT", "RESTRICT");
		
		$this->addForeignKey("fk_category_parent", "{{category}}", "parent_id", "{{category}}", "id", "RESTRICT", "RESTRICT");


	}

	public function down()
	{

	}


}
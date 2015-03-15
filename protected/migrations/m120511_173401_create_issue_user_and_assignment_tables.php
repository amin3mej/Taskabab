<?php

class m120511_173401_create_issue_user_and_assignment_tables extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{

		//create the user table
		$this->createTable('tbl_user', array(
			'id' => 'pk',
			'username' => 'string NOT NULL',
		    'email' => 'string NOT NULL',
		    'password' => 'string NOT NULL',
			'last_login_time' => 'datetime DEFAULT NULL',
			'create_time' => 'datetime DEFAULT NULL',
			'create_user_id' => 'int(11) DEFAULT NULL',
			'update_time' => 'datetime DEFAULT NULL',
			'update_user_id' => 'int(11) DEFAULT NULL',
		 ), 'ENGINE=InnoDB');
				
	}

	public function safeDown()
	{
		$this->truncateTable('tbl_user');
		$this->dropTable('tbl_user');
	}
	
}
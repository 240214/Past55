<?php

use yii\db\Migration;

/**
 * Class m220216_002700_modify_user_table
 */
class m220216_002700_modify_user_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->renameTable('user', 'users');
		
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->renameTable('users', 'user');
	}
	
}

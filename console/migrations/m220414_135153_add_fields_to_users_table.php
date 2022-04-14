<?php

use yii\db\Migration;

/**
 * Class m220414_135153_add_fields_to_users_table
 */
class m220414_135153_add_fields_to_users_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('users', 'role', $this->string(50)->notNull()->defaultValue('subscriber')->after('rating'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('users', 'role');
	}
	
}

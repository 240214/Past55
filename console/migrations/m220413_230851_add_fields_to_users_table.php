<?php

use yii\db\Migration;

/**
 * Class m220413_230851_add_fields_to_users_table
 */
class m220413_230851_add_fields_to_users_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('users', 'rating', $this->integer(1)->notNull()->defaultValue(0)->after('address'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('users', 'rating');
	}
	
}

<?php

use yii\db\Migration;

/**
 * Class m220308_224601_modify_users_table
 */
class m220308_224601_modify_users_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->dropColumn('users', 'favourites');
		$this->dropColumn('users', 'role');
		$this->dropColumn('users', 'deal_property_type');
		$this->dropColumn('users', 'agent_type');
		$this->dropColumn('users', 'dealing_in');
		$this->dropColumn('users', 'languages');
		$this->dropColumn('users', 'price_min');
		$this->dropColumn('users', 'price_max');
		$this->dropColumn('users', 'status');
		$this->dropColumn('users', 'profile_status');
		$this->addColumn('users', 'active', $this->integer(1)->notNull()->defaultValue(1)->after('address'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		echo "m220308_224601_modify_users_table cannot be reverted.\n";
		
		return false;
	}
	
}

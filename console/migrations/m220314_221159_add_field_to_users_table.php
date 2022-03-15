<?php

use yii\db\Migration;

/**
 * Class m220314_221159_add_field_to_users_table
 */
class m220314_221159_add_field_to_users_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('users', 'position', $this->string(255)->after('name'));
		$this->addColumn('users', 'social_tw', $this->string(255)->after('address'));
		$this->addColumn('users', 'social_in', $this->string(255)->after('address'));
		$this->addColumn('users', 'social_fb', $this->string(255)->after('address'));
		$this->addColumn('users', 'social_yt', $this->string(255)->after('address'));
		$this->addColumn('users', 'social_vm', $this->string(255)->after('address'));
		$this->addColumn('users', 'social_ig', $this->string(255)->after('address'));
		$this->addColumn('users', 'social_gp', $this->string(255)->after('address'));
		$this->addColumn('users', 'social_tb', $this->string(255)->after('address'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('users', 'position');
		$this->dropColumn('users', 'social_tw');
		$this->dropColumn('users', 'social_in');
		$this->dropColumn('users', 'social_fb');
		$this->dropColumn('users', 'social_yt');
		$this->dropColumn('users', 'social_vm');
		$this->dropColumn('users', 'social_ig');
		$this->dropColumn('users', 'social_gp');
		$this->dropColumn('users', 'social_tb');
	}
	
}

<?php

use yii\db\Migration;

/**
 * Class m210301_001500_change_distace_field_in_nearby_places_table
 */
class m210301_001500_change_distace_field_in_nearby_places_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->alterColumn('nearby_places', 'distance', $this->float()->notNull()->defaultValue(0));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->alterColumn('nearby_places', 'distance', $this->integer(10)->notNull()->defaultValue(0));
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210301_001500_change_distace_field_in_nearby_places_table cannot be reverted.\n";

		return false;
	}
	*/
}

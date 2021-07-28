<?php

use yii\db\Migration;

/**
 * Class m210728_150214_add_nearby_cities_filed_to_cities_table
 */
class m210728_150214_add_nearby_cities_filed_to_cities_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%cities}}', 'nearby_cities', $this->text());
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%cities}}', 'nearby_cities');
	}
	
}

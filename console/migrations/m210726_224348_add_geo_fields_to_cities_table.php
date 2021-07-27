<?php

use yii\db\Migration;

/**
 * Class m210726_224348_add_geo_fields_to_cities_table
 */
class m210726_224348_add_geo_fields_to_cities_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%cities}}', 'lat', $this->float([20, 15])->notNull()->defaultValue('0.000000000000000'));
		$this->addColumn('{{%cities}}', 'lng', $this->float([20, 15])->notNull()->defaultValue('0.000000000000000'));
		
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%cities}}', 'lat');
		$this->dropColumn('{{%cities}}', 'lng');
	}
	
}

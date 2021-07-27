<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer_addresses}}`.
 */
class m210215_142748_create_customer_addresses_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->createTable('{{%customer_addresses}}', [
			'id' => $this->primaryKey(),
			'sid' => $this->string(32),
			'user_id' => $this->integer(11)->notNull()->defaultValue(0),
			'property_id' => $this->integer(11)->notNull()->defaultValue(0),
			'title'   => $this->string(255)->null(),
			'address'   => $this->string(255)->null(),
			'lat'   => $this->string(60)->notNull()->defaultValue(0),
			'lng'   => $this->string(60)->notNull()->defaultValue(0),
			'distance' => $this->float()->notNull()->defaultValue(0),
			'distance_type' => $this->string(10)->notNull()->defaultValue('m'),
			'updated_at' => $this->timestamp(),
			'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
		]);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropTable('{{%customer_addresses}}');
	}
}

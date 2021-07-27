<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%settings}}`.
 */
class m210116_234234_create_settings_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->createTable('{{%settings}}', [
			'id'    => $this->primaryKey(),
			'setting_name'  => $this->string(255)->null(),
			'setting_value' => $this->string(255)->null(),
			'field_type' => $this->string(255)->null(),
			'field_options' => $this->text()->null(),
		]);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropTable('{{%settings}}');
	}
}

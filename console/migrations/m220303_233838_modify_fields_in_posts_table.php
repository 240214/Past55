<?php

use yii\db\Migration;

/**
 * Class m220303_233838_modify_fields_in_posts_table
 */
class m220303_233838_modify_fields_in_posts_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->alterColumn('posts', 'image', $this->string(255)->defaultValue(''));
		$this->alterColumn('posts', 'user_id', $this->integer(11)->notNull()->defaultValue(0));
		$this->alterColumn('posts', 'created_at', $this->integer(11)->notNull()->defaultValue(0));
		#$this->alterColumn('posts', 'category_id', $this->integer(11)->notNull()->defaultValue(0));
		#$this->alterColumn('posts', 'meta_description', $this->string(255)->notNull()->defaultValue(''));
		#$this->alterColumn('posts', 'slug', $this->string(255)->notNull()->defaultValue(''));
		#$this->alterColumn('posts', 'type', $this->string(255)->notNull()->defaultValue(''));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		echo "m220303_233838_modify_fields_in_posts_table cannot be reverted.\n";
		
		return true;
	}
	
}

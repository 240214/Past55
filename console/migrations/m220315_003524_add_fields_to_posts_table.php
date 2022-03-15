<?php

use yii\db\Migration;

/**
 * Class m220315_003524_add_fields_to_posts_table
 */
class m220315_003524_add_fields_to_posts_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('posts', 'ccl_title', $this->string(255)->after('category_id'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('posts', 'ccl_title');
	}
	
}

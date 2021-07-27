<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_link}}`.
 */
class m201221_123054_create_category_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_link}}', [
            'id' => $this->primaryKey(),
	        'category_id' => $this->integer(11)->unsigned()->notNull()->defaultValue(0),
	        'property_id' => $this->integer(11)->unsigned()->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category_link}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m210110_125454_modify_icon_field_in_category_table
 */
class m210110_125454_modify_icon_field_in_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->alterColumn('category', 'icon', $this->string(255)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210110_125454_modify_icon_field_in_category_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210110_125454_modify_icon_field_in_category_table cannot be reverted.\n";

        return false;
    }
    */
}

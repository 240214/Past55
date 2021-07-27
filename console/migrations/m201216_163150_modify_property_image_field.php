<?php

use yii\db\Migration;

/**
 * Class m201216_163150_modify_property_image_field
 */
class m201216_163150_modify_property_image_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->alterColumn('properties', 'image', 'varchar(255)');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201216_163150_modify_property_image_field cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201216_163150_modify_property_image_field cannot be reverted.\n";

        return false;
    }
    */
}

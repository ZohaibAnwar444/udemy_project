<?php

use yii\db\Migration;

/**
 * Class m220727_095506_create_table_place
 */
class m220727_095506_create_table_place extends Migration
{
    /**
     * {@inheritdoc}
     */
    // public function safeUp()
    // {

    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function safeDown()
    // {
    //     echo "m220727_095506_create_table_place cannot be reverted.\n";

    //     return false;
    // }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('place',[
            'id' => $this->primaryKey()->unsigned(),
            'place_id'=> $this->string(45)->notNull(),
            'lat' => $this->string(45)->notNull(),
            'lang' => $this->string(45)->notNull(),
            'country_code' => $this->string(2)->notNull(),
            'is_country' => $this->boolean()->notNull(),
        ]);
    }

    public function down()
    {
       $this->dropTable('place');
    }

}

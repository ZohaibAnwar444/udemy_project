<?php

use yii\db\Migration;

/**
 * Class m220727_103306_create_table_currency
 */
class m220727_103306_create_table_currency extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('currency', [
            'id' => $this->primaryKey()->unsigned(),
            'code' => $this->string(3)->unique()->notNull(),
            'sign_format' => $this->string(45)->notNull()
        ]);

        $this->batchInsert('currency', ['code', 'sign_format'], [
            ['AUD' , 'A$ [price]'],
            ['BGN' , '[price] лв.'],
            ['BRL' , 'R$ [price]'],
            ['CAD' , 'C$ [price]'],
            ['CHF' , '[price] CHF'],
            ['CZK' , 'Kč [price]'],
            ['DKK' , 'dkr [price]'],
            ['EUR' , '€ [price]'],
            ['GBP' , '£ [price]'],
            ['HRK' , '[price] kn'],
            ['HUF' , 'Ft [price]'],
            ['JPY' , '¥ [price]'],
            ['KRW' , '₩ [price]'],
            ['NOK' , 'nkr [price]'],
            ['PLN' , '[price] zł'],
            ['RUB' , '[price] руб'],
            ['SEK' , 'skr [price]'],
            ['TRY' , '[price] TL'],
            ['USD' , '$ [price]'],
        ]);
    }

    public function safeDown() {
        $this->delete('currency');

        $this->dropTable('currency');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220727_103306_create_table_currency cannot be reverted.\n";

        return false;
    }
    */
}

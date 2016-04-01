<?php

use yii\db\Migration;

class m160331_102106_rename_2_reservation extends Migration
{
    public function up()
    {
        $this->renameTable('{{%reservations}}', '{{%reservation}}');
    }

    public function down()
    {
        $this->renameTable('{{%reservation}}', '{{%reservations}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

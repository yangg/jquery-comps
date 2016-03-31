<?php

use yii\db\Migration;

class m160331_074158_create_reservations extends Migration
{
    public function up()
    {
        $this->createTable('reservations', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'start' => $this->integer(10)->notNull(),
            'end' => $this->integer(10),
            'room_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('reservations');
    }
}

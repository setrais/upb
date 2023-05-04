<?php

use yii\db\Migration;

class m181208_125819_add_column_floor_to_agents_table extends Migration
{
    /**
     * Add column floor
     */
    public function safeUp()
    {
        $this->addColumn('agents', 'floor', 'TINYINT(1) NULL COMMENT \'Пол: 1 - мужской 2 - женский\' AFTER `o`');
    }

    /**
     * Drop column floor
     */
    public function safeDown()
    {
        $this->dropColumn('agents', 'floor');
    }
}

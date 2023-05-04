<?php

use yii\db\Migration;

class m181208_120845_add_columns_fio_to_agents_table extends Migration
{
    /**
     * Add Columns f + i + o
     */
    public function safeUp()
    {
        $this->addColumn('agents', 'f', 'VARCHAR(25) NULL COMMENT \'Фамилия\'');
        $this->addColumn('agents', 'i', 'VARCHAR(25) NULL COMMENT \'Имя\'');
        $this->addColumn('agents', 'o', 'VARCHAR(25) NULL COMMENT \'Отчество\'');
    }

    /**
     * Drop columns f + i + o
     */
    public function safeDown()
    {
        $this->dropColumn('agents', 'f');
        $this->dropColumn('agents', 'i');
        $this->dropColumn('agents', 'o');
    }
}

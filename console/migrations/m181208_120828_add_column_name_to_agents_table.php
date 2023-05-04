<?php

use yii\db\Migration;

class m181208_120828_add_column_name_to_agents_table extends Migration
{
    /**
     * Add column name
     */
    public function safeUp()
    {
        $this->addColumn('agents', 'name', 'VARCHAR(75) NULL COMMENT \'Наименование агента\' AFTER `agent_kinds_id`');
    }

    /**
     * Drop column name
     */
    public function safeDown()
    {
        $this->dropColumn('agents', 'name');
    }
}

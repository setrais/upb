<?php

use yii\db\Migration;

class m181208_121518_add_index_name_to_agents_table extends Migration
{
    /**
     * Creates index for column `name`
     */
    public function up()
    {
        // creates index for column `name`
        $this->createIndex(
            'agents-name',
            'agents',
            'name'
        );

    }

    /**
     * Drop index for column `name`
     */
    public function down()
    {
        // drop index for column `name`
        $this->dropIndex('agents-name');
    }
}

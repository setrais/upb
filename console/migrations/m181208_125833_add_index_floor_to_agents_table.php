<?php

use yii\db\Migration;

class m181208_125833_add_index_floor_to_agents_table extends Migration
{
    /**
     * Creates index for column `floor`
     */
    public function up()
    {
        // creates index for column `floor`
        $this->createIndex(
            'agents-floor',
            'agents',
            'floor'
        );

    }

    /**
     * Drop index for column `floor`
     */
    public function down()
    {
        // drop index for column `floor`
        $this->dropIndex('agents-floor');
    }
}

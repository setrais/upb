<?php

use yii\db\Migration;

class m181208_121529_add_index_fio_to_agents_table extends Migration
{
    /**
     * Creates index for columns `f`+`i`+`o
     *
     */
    public function up()
    {
        // creates index for columns `f`+`i`+`o`
        $this->createIndex(
            'agents-fio',
            'agents',
            array('f','i','o')
        );
    }

    /**
     * Drop index for column `name`
     *
     */
    public function down()
    {
        // drop index for column `name`
        $this->dropIndex('agents-fio');
    }
}

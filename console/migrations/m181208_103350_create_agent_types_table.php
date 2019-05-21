<?php

use yii\db\Migration;

/**
 * Handles the creation of table `agent_types`.
 */
class m181208_103350_create_agent_types_table extends Migration
{
    /**
     * Create table agents_types
     */
    public function safeUp()
    {
        $this->createTable('agent_types',
             array( 'id' => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.типа агента'",
                    'name' => "VARCHAR(75) COMMENT 'Наименование типа агента'",
                    'PRIMARY KEY (`id`)'),
            'ENGINE=INNODB
                     AUTO_INCREMENT = 1
                     CHARACTER SET utf8
                     COLLATE utf8_general_ci
                     COMMENT = \'Таблица типов агента\'');
    }

    /**
     * Drop table agents_types
     */
    public function safeDown()
    {
        $this->dropTable('agent_types');
    }
}

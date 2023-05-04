<?php

use yii\db\Migration;

/**
 * Handles the creation of table `agents`.
 */
class m181208_114211_create_agents_table extends Migration
{

    /**
     * Create table agents
     */
    public function safeUp()
    {
        $this->createTable('agents',
            array( 'id' => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.агента'",
                'agent_types_id' => "INT(11) COMMENT 'Ид.типа агента'",
                'agent_kinds_id' => "INT(11) COMMENT 'Ид.вида агента'",
                'PRIMARY KEY (`id`)',
                'INDEX (`agent_types_id`)',
                'INDEX (`agent_kinds_id`)',
                'FOREIGN KEY (`agent_types_id`) REFERENCES `agent_types`(`id`) ON UPDATE CASCADE ON DELETE CASCADE, FOREIGN KEY (`agent_kinds_id`) REFERENCES `agent_kinds`(`id`)' ),
            'ENGINE=INNODB
                     AUTO_INCREMENT = 1
                     CHARACTER SET utf8
                     COLLATE utf8_general_ci
                     COMMENT=\'Таблица агентов\'');
    }

    /**
     * Drop table agents
     */
    public function safeDown()
    {
        $this->dropTable('agents');
    }

}

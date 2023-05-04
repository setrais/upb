<?php

use yii\db\Migration;

class m181208_113852_create_agent_kinds_table extends Migration
{
    /**
     * Create table agent_kinds
     */
    public function safeUp()
    {
        $this->createTable('agent_kinds',
            array( 'id' => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.вида агента'",
                'name' => "VARCHAR(75) COMMENT 'Наименование вида агента'",
                'PRIMARY KEY (`id`)'),
            'ENGINE=INNODB
                     AUTO_INCREMENT = 1
                     CHARACTER SET utf8
                     COLLATE utf8_general_ci
                     COMMENT = \'Таблица видов агента\'');
    }

    /**
     * Drop table agent_kinds
     */
    public function safeDown()
    {
        $this->dropTable('agent_kinds');
    }
}

<?php

/**
 * Image install migration
 * Класс миграций для модуля Slide
 *
 * @category YupeMigration
 * @package  yupe.modules.slide.install.migrations
 * @author Valek Vergilyush <v.vergilyush@gmail.com>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @link http://green-s.pro
 **/
class m000000_000000_slide_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{slide_slide}}',
            array(
                'id'            => 'pk',
                'name'          => 'varchar(250) NOT NULL',
                'description'   => 'text',
                'file'          => 'varchar(250) NOT NULL',
            	'url'          => 'varchar(250) NOT NULL',
                'slideshow_identifier'          => 'varchar(250) NULL',
                'creation_date' => 'datetime NOT NULL',
                'user_id'       => 'integer DEFAULT NULL',
                'status'        => "integer NOT NULL DEFAULT '1'",
            	'sort'			=> 	"integer NOT NULL DEFAULT '1'",
            ),
            $this->getOptions()
        );

        //ix
        $this->createIndex("ix_{{slide_slide}}_status", '{{slide_slide}}', "status", false);
        $this->createIndex("ix_{{slide_slide}}_user", '{{slide_slide}}', "user_id", false);


        //fk

        $this->addForeignKey(
            "fk_{{slide_slide}}_user_id",
            '{{slide_slide}}',
            'user_id',
            '{{user_user}}',
            'id',
            'SET NULL',
            'NO ACTION'
        );

    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{slide_slide}}');
    }
}

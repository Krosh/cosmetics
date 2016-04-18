<?php
/**
 * Aramba install migration
 * Класс миграций для модуля Aramba:
 *
 * @category YupeMigration
 * @package  yupe.modules.aramba.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     http://yupe.ru
 **/
class m000000_000000_aramba_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
  /*      $this->createTable(
            '{{aramba}}',
            [
                'id'             => 'pk',
                'apiId' => "varchar(30) NOT NULL",
                'senderId' => "varchar(60) NULL",
            ],
            $this->getOptions()
        );
*/    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
//        $this->dropTableWithForeignKeys('{{aramba}}');
    }
}

<?php

class m161102_161201_add_views_count extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{news_news}}', 'views_count', 'integer DEFAULT 0');
    }

    public function safeDown()
    {

    }
}
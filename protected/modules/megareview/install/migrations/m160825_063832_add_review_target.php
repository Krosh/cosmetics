<?php

class m160825_063832_add_review_target extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{megareview_review}}", "review_target", "INT");
    }

    public function safeDown()
    {

    }
}
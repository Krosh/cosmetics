<?php

class m160825_053721_add_moderation_status extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{megareview_review}}", "moderation_status", "INT");
    }

    public function safeDown()
    {

    }
}
<?php

class m160823_151724_add_id_from_social extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{megareview_user}}", "id_from_social", "VARCHAR(40)");

    }

    public function safeDown()
    {

    }
}
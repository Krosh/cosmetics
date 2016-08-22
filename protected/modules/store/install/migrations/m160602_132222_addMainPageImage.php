<?php

class m160602_132222_addMainPageImage extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{store_product}}', 'main_page_image', "VARCHAR(200) default null");
    }

	public function safeDown()
	{

	}
}
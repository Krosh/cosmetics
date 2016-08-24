<?php

class m160823_121205_init extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->createTable(
            '{{megareview_user}}',
            [
                'id' => 'pk',
                'id_user' => 'INT',
                'social_type' => 'INT',
                'social_link' => 'VARCHAR(150)',
                'avatar_path' => 'VARCHAR(150)',
                'fio' => 'VARCHAR(150)',
                'adres' => 'VARCHAR(150)',
            ],
            $this->getOptions()
        );
        $this->createTable(
            '{{megareview_review}}',
            [
                'id' => 'pk',
                'id_mega_user' => 'INT',
                'rating' => 'DECIMAL(2,1)',
                'text' => 'varchar(300)',
                'date_add' => 'DATETIME',
                'has_audio' => 'BOOLEAN',
                'audio_file' => 'VARCHAR(150)',
                'has_video' => 'BOOLEAN',
                'video_file' => 'VARCHAR(150)',
                'video_preview' => 'VARCHAR(150)'
            ],
            $this->getOptions()
        );
    }

    public function safeDown()
    {

    }
}
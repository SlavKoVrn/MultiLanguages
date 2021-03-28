<?php

use yii\db\Migration;

/**
 * Class m210328_162822_item_lang
 */
class m210328_162822_item_lang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%language}}', [
            'id'     => $this->string(5),
            'name'   => $this->string(64),
            'locale' => $this->string(5),
            'PRIMARY KEY (id)'
        ], $tableOptions);

        $this->insert('{{%language}}',[
            'id'   => 'ru',
            'name' => 'Russian',
            'locale' => 'ru-RU',
        ]);

        $this->insert('{{%language}}',[
            'id'   => 'en',
            'name' => 'English',
            'locale' => 'en-GB',
        ]);

        $this->createTable('{{%item}}', [
            'id'    => $this->primaryKey(),
            'name'  => $this->string(64),
        ], $tableOptions);

        $this->insert('{{%item}}',[
            'id'    => 1,
            'name' => 'Translation',
        ]);

        $this->createTable('{{%item_translation}}', [
            'item_id' => $this->integer(11),
            'language_id'  => $this->string(5),
            'title' => $this->string(255),
            'description' => $this->text(),
            'PRIMARY KEY (item_id,language_id)'
        ], $tableOptions);

        $this->insert('{{%item_translation}}',[
            'item_id' => 1,
            'language_id'  => 'ru',
            'title' => 'Название',
            'description' => 'Описание',
        ]);

        $this->insert('{{%item_translation}}',[
            'item_id' => 1,
            'language_id'  => 'en',
            'title' => 'Title',
            'description' => 'Description',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%language}}');
        $this->dropTable('{{%item}}');
        $this->dropTable('{{%item_translation}}');
    }

}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%itemtranslation}}".
 *
 * @property int $itemId
 * @property string $languageId
 * @property string $title
 * @property string|null $description
 *
 * @property Item $item
 * @property Language $language
 */
class ItemTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%item_translation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['itemId', 'languageId', 'title'], 'required'],
            [['item_id'], 'integer'],
            [['language_id'], 'string', 'max' => 5],
            [['title'], 'string', 'max' => 64],
            [['description'], 'string'],
            [['item_id', 'language_id'], 'unique', 'targetAttribute' => ['item_id', 'language_id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['item_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('item', 'Item ID'),
            'language_id' => Yii::t('item', 'Language ID'),
            'title' => Yii::t('item', 'Title'),
            'description' => Yii::t('item', 'Description'),
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }

    /**
     * Gets query for [[Language]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::class, ['id' => 'language_id']);
    }
}

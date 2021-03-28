<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%language}}".
 *
 * @property string $id
 * @property string $name
 * @property string $locale
 *
 * @property Itemtranslation[] $itemtranslations
 * @property Item[] $items
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%language}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'locale'], 'required'],
            [['id', 'locale'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 64],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('item', 'ID'),
            'name' => Yii::t('item', 'Name'),
            'locale' => Yii::t('item', 'Locale'),
        ];
    }

    /**
     * Gets query for [[Itemtranslations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemtranslations()
    {
        return $this->hasMany(ItemTranslation::class, ['language_id' => 'id']);
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['id' => 'item_id'])->viaTable('{{%item_translation}}', ['language_id' => 'id']);
    }
}

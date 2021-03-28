<?php

namespace common\models;

use Yii;
use yii2tech\ar\variation\VariationBehavior;

/**
 * This is the model class for table "{{%item}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property Itemtranslation[] $itemtranslations
 * @property Language[] $languages
 */
class Item extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'translations' => [
                'class' => VariationBehavior::class,
                'variationsRelation' => 'translations',
                'defaultVariationRelation' => 'defaultTranslation',
                'variationOptionReferenceAttribute' => 'language_id',
                'optionModelClass' => Language::class,
                'defaultVariationOptionReference' => function() {return Yii::$app->language;},
                'variationAttributeDefaultValueMap' => [
                    'title' => 'name'
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(ItemTranslation::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getDefaultTranslation()
    {
        return $this->hasDefaultVariationRelation(); // convert "has many translations" into "has one defaultTranslation"
    }

    /**
     * Gets query for [[Itemtranslations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemtranslations()
    {
        return $this->hasMany(ItemTranslation::class, ['item_id' => 'id']);
    }

    /**
     * Gets query for [[Languages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(Language::class, ['id' => 'language_id'])->viaTable('{{%item_translation}}', ['item_id' => 'id']);
    }
}

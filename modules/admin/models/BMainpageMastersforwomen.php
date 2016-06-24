<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_mainpage_mastersforwomen".
 *
 * @property integer $site
 * @property string $text
 * @property string $keywords
 * @property string $descriprion
 */
class BMainpageMastersforwomen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_mainpage_mastersforwomen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site', 'text'], 'required'],
            [['site'], 'integer'],
            [['text', 'keywords', 'description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'site' => 'Сайт',
            'text' => 'Текст',
            'keywords' => 'Мета теги',
            'description' => 'Описание',
        ];
    }
}

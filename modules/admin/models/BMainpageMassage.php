<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_mainpage_massage".
 *
 * @property integer $site
 * @property string $text
 * @property string $keywords
 * @property string $description
 */
class BMainpageMassage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_mainpage_massage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site', 'text', 'keywords', 'description'], 'required'],
            [['site'], 'integer'],
            [['text', 'keywords', 'description'], 'string'],
            [['site'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'site' => 'Site',
            'text' => 'Описание',
            'keywords' => 'Ключевые слова',
            'description' => 'Описание для поиска',
        ];
    }
}

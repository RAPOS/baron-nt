<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_vacancy".
 *
 * @property integer $site
 * @property string $title
 * @property string $text
 * @property string $keywords
 * @property string $description
 */
class BVacancy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_vacancy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site', 'title', 'text', 'keywords', 'description'], 'required'],
            [['site'], 'integer'],
            [['text', 'keywords', 'description'], 'string'],
            [['title'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'site' => 'Site',
            'title' => 'Заголовок',
            'text' => 'Описание',
            'keywords' => 'Ключевые слова',
            'description' => 'Описание для поиска',
        ];
    }
}

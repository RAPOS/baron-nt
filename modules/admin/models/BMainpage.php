<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_mainpage".
 *
 * @property integer $site
 * @property string $title_h1
 * @property string $title_h2
 * @property string $text_1
 * @property string $text_2
 */
class BMainpage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_mainpage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site', 'title_h1', 'title_h2', 'text_1', 'text_2'], 'required'],
            [['site'], 'integer'],
            [['text_1', 'text_2'], 'string'],
            [['title_h1', 'title_h2'], 'string', 'max' => 64],
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
            'title_h1' => 'Title H1',
            'title_h2' => 'Title H2',
            'text_1' => 'Text 1',
            'text_2' => 'Text 2',
        ];
    }
}

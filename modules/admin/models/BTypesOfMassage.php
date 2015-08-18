<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_types_of_massage".
 *
 * @property integer $id_massage
 * @property string $name
 * @property string $description
 * @property integer $duration
 * @property string $keywords
 */
class BTypesOfMassage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_types_of_massage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'keywords'], 'required'],
            [['description'], 'string'],
            [['duration'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['keywords'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_massage' => 'Id Massage',
            'name' => 'Название',
            'description' => 'Описание',
            'duration' => 'Длительность',
            'keywords' => 'Ключевые слова',
        ];
    }
}

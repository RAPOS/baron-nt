<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_reviews".
 *
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $text
 * @property string $date
 * @property string $verifyCode
 * @property string $section
 * @property integer $moderate
 * @property string $ip
 */
class BReviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'name', 'text', 'verifyCode'], 'required'],
            [['text'], 'string'],
            [['moderate'], 'integer'],
            [['email', 'name', 'date', 'verifyCode', 'section', 'ip'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'E-mail',
            'name' => 'Имя',
            'text' => 'Текст',
            'date' => 'Date',
            'verifyCode' => 'Код подтверждения',
            'section' => 'Section',
            'moderate' => 'Moderate',
            'ip' => 'Ip',
        ];
    }
}

<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_feedback".
 *
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $subject
 * @property string $text
 * @property string $date
 * @property string $verifyCode
 */
class BFeedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'name', 'subject', 'text', 'date', 'verifyCode'], 'required'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['email', 'name', 'subject', 'verifyCode'], 'string', 'max' => 64]
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
            'subject' => 'Тема',
            'text' => 'Текст',
            'date' => 'Дата',
            'verifyCode' => 'Проверочный код',
        ];
    }
}

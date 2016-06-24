<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_mastersforwomen".
 *
 * @property integer $id_master
 * @property string $name
 * @property string $translate
 * @property string $images
 * @property integer $sort
 * @property integer $age
 * @property integer $growth
 * @property integer $weight
 * @property integer $new
 * @property integer $tour
 * @property string $keywords
 * @property string $description
 */
class BMastersforwomen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_mastersforwomen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'age', 'growth', 'weight', 'keywords', 'description'], 'required'],
            [['images', 'description'], 'string'],
            [['sort', 'age', 'growth', 'weight', 'new', 'tour'], 'integer'],
            [['name', 'translate'], 'string', 'max' => 64],
            [['keywords'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_master' => 'ID',
            'name' => 'Имя',
            'translate' => 'Транслит',
            'images' => 'Изобрадение',
            'sort' => 'Сортировка',
            'age' => 'Возраст',
            'growth' => 'Рост',
            'weight' => 'Вес',
            'new' => 'Новый',
            'tour' => 'Гастроли',
            'keywords' => 'Мета теги',
            'description' => 'Описание',
        ];
    }
	
	/**/
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			$this->translate = Yii::$app->general->translate($this->name);
			
			if($this->isNewRecord){
				$sort_count = self::find()->count();
				$this->sort = $sort_count + 1;
			}
			return true;
		} else {
			return false;
		}
	}
}

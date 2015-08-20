<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_types_of_massage".
 *
 * @property integer $id_massage
 * @property string $name
 * @property string $translate
 * @property string $description
 * @property integer $duration
 * @property string $keywords
 * @property string $images
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
            [['name', 'description', 'duration', 'keywords'], 'required'],
            [['description', 'images'], 'string'],
            [['duration'], 'integer'],
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
            'id_massage' => 'Id Massage',
            'name' => 'Name',
            'translate' => 'Translate',
            'description' => 'Description',
            'duration' => 'Duration',
            'keywords' => 'Keywords',
            'images' => 'Images',
        ];
    }
	
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			$converter = array(
				'а' => 'a',   'б' => 'b',   'в' => 'v',
				'г' => 'g',   'д' => 'd',   'е' => 'e',
				'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
				'и' => 'i',   'й' => 'y',   'к' => 'k',
				'л' => 'l',   'м' => 'm',   'н' => 'n',
				'о' => 'o',   'п' => 'p',   'р' => 'r',
				'с' => 's',   'т' => 't',   'у' => 'u',
				'ф' => 'f',   'х' => 'h',   'ц' => 'c',
				'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
				'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
				'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
				
				'А' => 'A',   'Б' => 'B',   'В' => 'V',
				'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
				'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
				'И' => 'I',   'Й' => 'Y',   'К' => 'K',
				'Л' => 'L',   'М' => 'M',   'Н' => 'N',
				'О' => 'O',   'П' => 'P',   'Р' => 'R',
				'С' => 'S',   'Т' => 'T',   'У' => 'U',
				'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
				'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
				'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
				'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
			);
			// переводим в транслит
			$str = strtr($this->name, $converter);
			// в нижний регистр
			$str = strtolower($str);
			// заменям все ненужное нам на "-"
			$str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
			// удаляем начальные и конечные '-'
			$str = trim($str, "-");
			
			$this->translate = $str;
			return true;
		} else {
			return false;
		}
	}
}

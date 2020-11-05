<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.04.19
 * Time: 12:41
 */
namespace app\models;

use yii\db\ActiveRecord;

class Phones extends ActiveRecord
{
    public static function tableName()
    {
        return 'phones'; //имя таблицы
    }

    public function rules()
    {
        return [
            [['name','about'], 'string', 'max' => 255],
            [['prise', 'id'], 'integer'],
        ];
    }
}
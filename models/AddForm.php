<?php

namespace app\models;

use yii\base\Model;
use app\models\Phones;

class AddForm extends Phones
{
    public $name;
    public $prise;
    public $about;

    public function rules()
    {
        return [
            [['name', 'prise', 'about'], 'required'],
        ];
    }
}
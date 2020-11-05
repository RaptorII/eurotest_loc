<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.04.19
 * Time: 21:14
 */

namespace app\models\search;

use app\models\Phones;
use yii\data\ActiveDataProvider;

class PhonesSearch extends Phones
{

    public function rules()
    {
        return [
            [['prise'], 'integer'],
            ['name', 'string'],
        ];
    }

    public function search($data)
    {
        $queryBuilder = Phones::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $queryBuilder,
             'sort' => [
                'attributes' => ['name', 'prise']
            ],
        ]);

        if ($this->load($data) && !$this->validate()) {
            return $dataProvider;
        }

        $queryBuilder->andFilterWhere(['like', 'name', $this->name]);
        $queryBuilder->andFilterWhere(['prise' => $this->prise]);

        return $dataProvider;
    }
}
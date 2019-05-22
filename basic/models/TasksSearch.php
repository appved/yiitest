<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Description of TasksSearch
 *
 * @author max
 */
class TasksSearch extends Tasks
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['worker', 'todo', ], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
    static public function tableName(): string
    {
        return '{{%tasks}}';
    }

    public function search($params)
    {
        $query = Tasks::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'worker', $this->worker])
              ->andFilterWhere(['like', 'todo', $this->todo]);

        return $dataProvider;
    }
}

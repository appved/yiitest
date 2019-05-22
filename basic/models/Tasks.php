<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Description of Task
 *
 * @author max
 * 
 * @property int $id
 * @property string $worker
 * @property string $todo
 * @property string $added
 * @property string $deadline
 */
class Tasks extends ActiveRecord
{
    public function rules()
    {
        return [
            [['worker', 'todo', 'added', 'deadline'], 'required'],
            
            [['added'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['added'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['deadline'], 'date', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }
}
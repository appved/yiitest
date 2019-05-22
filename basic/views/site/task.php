<?php
/* @var $model app\models\Tasks */
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Просмотр задачи';
?>

<?php

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'worker',
            'label' => 'Работник',
            'format'    => 'raw',
        ],
        [
            'attribute' => 'todo',
            'label' => 'Задание',
            'format'    => 'text',
        ],
        [
            'attribute' => 'added',
            'label' => 'Дата начала',
            'format'    => 'datetime',
        ],
        [
            'attribute' => 'deadline',
            'label' => 'Дедлайн',
            'format'    => 'datetime',
        ],
    ],
]);
?>
<?php echo Html::a('Редактировать', ['site/update', 'id' => $model->id], ['class'=>'btn btn-primary']) ?>
<?php echo Html::a('Удалить', ['site/delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Вы действительно хотите удалить задачу?',
        ],
    ]) ?>


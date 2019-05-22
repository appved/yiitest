<?php
use yii\grid\GridView;
use app\models\Tasks;
use yii\helpers\Html;

$this->title = 'Задачи';
?>

<?php
echo Html::a('Добавить задание', ['site/create'], ['class'=>'btn btn-primary']);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns'      => [
        [
            'attribute' => 'id',
            'label' => '#',
            'format'    => 'raw',
            'value'     => function (Tasks $model) {
                return Html::encode($model->id);
            },
        ],
        [
            'attribute' => 'worker',
            'label' => 'Работник',
            'format'    => 'raw',
            'value'     => function (Tasks $model) {
                if ($model->worker != null) {
                    return Html::encode($model->worker);
                } else {
                    return '';
                }
            },
        ],
        [
            'attribute' => 'todo',
            'label' => 'Задание',
            'format'    => 'text',
            'value'     => function (Tasks $model) {
                if ($model->todo != null) {
                    return Html::encode($model->todo);
                } else {
                    return '';
                }
            },
        ],
        [
            'attribute' => 'added',
            'label' => 'Дата начала',
            'format'    => 'datetime',
            'value'     => function (Tasks $model) {
                if ($model->added != null) {
                    return Html::encode($model->added);
                } else {
                    return '';
                }
            },
        ],
        [
            'attribute' => 'deadline',
            'label' => 'Дедлайн',
            'format'    => 'datetime',
            'value'     => function (Tasks $model) {
                if ($model->deadline != null) {
                    return Html::encode($model->deadline);
                } else {
                    return '';
                }
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::a('', $url, ['class' => 'glyphicon glyphicon-trash', 'data' => [
                        'confirm' => 'Вы действительно хотите удалить задачу?',
                    ]]);
                },
            ],
        ],
    ],
]);
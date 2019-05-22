<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

if ($add)
{
    $this->title = 'Добавление задачи';
}
else
{
    $this->title = 'Изменение задачи';
}
?>

<?php
$form = ActiveForm::begin([
    'id' => 'task-edit',
    'options' => ['class' => ''],
]) ?>
<table class="table table-striped table-bordered detail-view">
    <tbody>
        <tr>
            <th>Работник</th>
            <td>
                <?php echo $form->field($model, 'worker')->label(false)->textInput(); ?>
            </td>
        </tr>
        <tr>
            <th>Задание</th>
            <td>
                <?php echo $form->field($model, 'todo')->label(false)->textarea(); ?>
            </td>
        </tr>
        <tr>
            <th>Дата начала</th>
            <td>
                <?php echo $form->field($model, 'added')->label(false)->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => 'Начало работы...'],
                    'removeButton' => false,
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'php:Y-m-d H:i:s'
                    ]
                ]);
                ?>
            </td>
        </tr>
        <tr>
            <th>Дедлайн</th>
            <td>
                <?php echo $form->field($model, 'deadline')->label(false)->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => 'Завершение работы...'],
                    'removeButton' => false,
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'php:Y-m-d H:i:s'
                    ]
                ]);
                ?>
            </td>
        </tr>
    </tbody>
</table>
<div class="form-group">
    <?php echo Html::submitButton($add?'Добавить':'Сохранить', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end() ?>

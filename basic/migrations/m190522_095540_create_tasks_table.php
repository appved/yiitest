<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 */
class m190522_095540_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'worker' => $this->string()->notNull(),
            'todo' => $this->text(),
            'added' => $this->dateTime()->notNull(),
            'deadline' => $this->dateTime()->notNull(),
        ]);
        
        $taskData = [
            'Степан' => 'Убрать крошки из клавиатуры',
            'Фёдор' => 'Вынести мусор',
            'Юрий' => 'Взять интервью у Максима',
            'Людмила' => 'Сварить борщ',
            'Александр' => 'Пойти погулять',
            'Евгений' => 'Удалить номер Елены из телефона',
            'Игорь' => 'Включить рубильник',
            'Иван' => 'Радить девченку',
            'Светлана' => 'Выгнать мужа из дома',
            'Елена' => 'Приютить мужа Светланы',
            'Антон' => 'Проверить создание задачь',
            'Екатерина' => 'Взять телефон',
            'Дмитрий' => 'Взять зонтик',
            'Филип' => 'Встала и ушла',
            'Шарик' => 'Фас',
        ];
        foreach ($taskData as $name => $todo)
        {
            $this->insert('{{%tasks}}', [
                'worker' => $name,
                'todo' => $todo,
                'added' => date('Y-m-d H:i:s'),
                'deadline' => date('Y-m-d H:i:s', time() + rand(1, 5)*60*60*24),
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tasks}}');
    }
}

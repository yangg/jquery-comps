<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reservations".
 *
 * @property integer $id
 * @property string $title
 * @property integer $start
 * @property integer $end
 * @property integer $room_id
 */
class Reservations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'start'], 'required'],
            [['start', 'end', 'room_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'start' => 'Start',
            'end' => 'End',
            'room_id' => 'Room ID',
        ];
    }
}

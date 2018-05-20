<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property string $question_id 问题id
 * @property string $questionName 问题名称
 * @property string $questionAnswer 答案
 * @property int $status 审核状态值：0、提交待审核  1、审核通过
 * @property int $isDel 删除状态值：0、正常  1、已删除
 * @property int $admin_id 添加人
 * @property int $createTime 创建时间
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['questionAnswer'], 'string'],
            [['status', 'isDel', 'admin_id', 'createTime'], 'integer'],
            [['questionName'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'question_id' => 'Question ID',
            'questionName' => 'Question Name',
            'questionAnswer' => 'Question Answer',
            'status' => 'Status',
            'isDel' => 'Is Del',
            'admin_id' => 'Admin ID',
            'createTime' => 'Create Time',
        ];
    }
}

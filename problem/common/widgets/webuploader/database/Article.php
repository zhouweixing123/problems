<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "my_article".
 *
 * @property string $article_id 文章ID
 * @property string $admin_id 管理员ID
 * @property string $article_content 文章内容
 * @property string $article_img 文章图片ID
 * @property string $article_cover 文章封面
 * @property string $article_time 文章添加时间
 * @property string $article_browsing_volume 文章浏览量
 * @property string $article_tags 标签
 * @property string $article_type 文章的分类
 * @property string $article_title 文章标题
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'article_content', 'article_tags', 'article_type'], 'required'],
            [['admin_id', 'article_browsing_volume', 'article_tags', 'article_type'], 'integer'],
            [['article_content'], 'string'],
            [['article_img', 'article_cover'], 'string', 'max' => 50],
            [['article_time'], 'string', 'max' => 12],
            [['article_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'article_id' => 'Article ID',
            'admin_id' => 'Admin ID',
            'article_content' => 'Article Content',
            'article_img' => 'Article Img',
            'article_cover' => 'Article Cover',
            'article_time' => 'Article Time',
            'article_browsing_volume' => 'Article Browsing Volume',
            'article_tags' => 'Article Tags',
            'article_type' => 'Article Type',
            'article_title' => 'Article Title',
        ];
    }
}

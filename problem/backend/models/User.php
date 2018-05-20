<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $id 主键
 * @property string $username 用户名
 * @property string $password_hash 加密密码
 * @property string $password_reset_token 重置密码
 * @property string $auth_key key值
 * @property string $email 用户邮箱
 * @property int $role 角色等级
 * @property int $status 状态
 * @property int $is_show 是否被选中
 * @property string $created_at 添加时间
 * @property string $updated_at 修改时间
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    // 定义状态的常量
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'status','is_show','is_naming'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 25],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'auth_key' => 'Auth Key',
            'email' => 'Email',
            'role' => 'Role',
            'status' => 'Status',
            'is_show' => 'Is Show',
            'is_naming' => 'Is Naming',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id,'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /*
     *  查询用户名
     * */
    public static function findByUserName($username){
        return static::findOne(['username' => $username,'status' => self::STATUS_ACTIVE]);
    }

    /*
     *  重置密码验证令牌
     * */
    public static function findByPasswordResetToken($token){
        if (!static::isPasswordResetTokenValid($token)){
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE
        ]);
    }

    /*
     *  重置密码令牌验证
     * 返回的是boolean
     * */
    public static function isPasswordResetTokenValid($token){
        if (empty($token)){
            return false;
        }
        $timestamp = (int) substr($token,strrpos($token,"_") + 1);
        $expire = Yii::$app -> params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /*
     *  获取ID
     * */
    public function getId(){
        return $this -> getPrimaryKey();
    }

    /*
     *  获取AuthKey
     * */
    public function getAuthKey()
    {
        return $this -> auth_key;
    }

    /*
     *  验证Auth_key
     * 返回的是boolean
     * */
    public function validateAuthKey($authKey)
    {
        return $this -> getAuthKey() === $authKey;
    }

    /*
     *  验证密码
     * */
    public function validatePassword($password){
        return Yii::$app -> security -> validatePassword($this -> password_hash,$password);
    }

    /*
     *  设置密码
     * */
    public function setPassword($password){
        $this -> password_hash = Yii::$app -> security -> generatePasswordHash($password);
    }

    /*
     *  加密AuthKey
     * */
    public function generateAuthKey(){
        $this -> auth_key = Yii::$app -> security -> generateRandomKey();
    }

    /*
     *  加密重置密码Key
     * */
    public function generatePasswordResetToken(){
        $this -> password_reset_token = Yii::$app -> security -> generateRandomKey() . "_" . time();
    }

    /*
     *  删除重置密码令牌
     * */
    public function removePasswordResetToken(){
        $this -> password_reset_token = null;
    }

    /*
     *  通过用户ID获取用户名称
     * */
    public static function getNameById($id){
        return static::find() -> select('username') -> where(['id' => $id]) -> one();
    }
}

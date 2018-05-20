<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/19
 * Time: 22:30
 */

namespace backend\models\form;


use backend\models\User;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = false;

    public $_user = null;

    /*
     *  表单的规则
     * */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }

    /*
     *  密码的验证
     * */
    public function validatePassword($attribute, $params)
    {
        if ($this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, "用户名或密码错误");
            }
        }
    }

    /*
     *  登录
     * */
    public function login()
    {
        if ($this->validate()) {
            return \Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /*
     *  获取用户
     * */
    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUserName($this->username);
        }
        return $this->_user;
    }
}
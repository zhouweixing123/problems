<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/19
 * Time: 23:15
 */

namespace backend\models\form;


use backend\models\User;
use yii\base\Model;

class SignupForm extends Model
{
    // 定义属性
    public $username;
    public $password;
    public $email;
    public $created_at;
    public $updated_at;

    /*
     *  定义对数据的校验规则
     * */
    public function rules()
    {
        return [
            // 对username的值进行两边去空格操作
            ['username','filter','filter' => 'trim'],
            // 用户名不能为空
            ['username','required','message' => '用户名不能为空'],
            // 用户名必须唯一
            ['username','unique','targetClass' => '\backend\models\User','message' => '用户名已存在'],
            // 定义用户名的长度
            ['username','string','min' => 2,'max' => 10],
            // 对邮箱的校验规则
            ['email','filter','filter' => 'trim'],
            ['email','required','message' => '邮箱不能为空'],
            ['email','email'],
            ['email','string','max' => 100],
            ['email','unique','targetClass' => '\backend\models\User','message' => '该邮箱已被添加'],
            // 对密码的校验规则
            ['password','filter','filter' => 'trim'],
            ['password','string','min' => 6,'tooShort' => '请填写最少6位的密码'],
            // 添加时间和修改时间默认自动添加
            [['created_at','updated_at'],'default','value' => date('Y-m-d H:i:s',time())],
        ];
    }
    /*
     *  添加的方法
     * */
    public function signup(){
        // 调用validate对表单的验证
        if (!$this -> validate()){
            return null;
        }
        // 实现入库的操作
        $user = new User();
        $user -> username = $this -> username;
        $user -> email = $this -> email;
        $user -> created_at = $this-> created_at;
        $user -> updated_at = $this -> updated_at;
        // 设置加密密码
        $user -> setPassword($this -> password);
        // 生成记住我的认证KEY
        $user -> generateAuthKey();
        // save(false) 不进行调用User中的数据校验，直接入库
        return $user -> save(false);
    }
    /*
     *  返回时间
     * */
    public function dateTime(){

    }
}
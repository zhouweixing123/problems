<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/27
 * Time: 1:02
 */

namespace backend\models\form;


use backend\models\User;
use yii\base\Model;

class UpdatePwdForm extends Model
{
    // 定义属性
    public $OldPassword;
    public $NewPassword;
    public $OkPassword;
    public $updated_at;
    public function rules()
    {
        return [
            // 对username的值进行两边去空格操作
            ['OldPassword','filter','filter' => 'trim'],
            // 用户名不能为空
            ['OldPassword','required','message' => '原密码不能为空'],
            // 定义用户名的长度
            ['OldPassword','string','min' => 6,'tooShort' => '请填写最少6位的密码'],
            // 对邮箱的校验规则
            ['NewPassword','filter','filter' => 'trim'],
            ['NewPassword','required','message' => '新密码不能为空'],
            ['NewPassword','string','min' => 6,'tooShort' => '请填写最少6位的密码'],
            // 对密码的校验规则
            ['OkPassword','filter','filter' => 'trim'],
            ['OkPassword','required','message' => '确认密码不能为空'],
            ['OkPassword','string','min' => 6,'tooShort' => '请填写确认密码'],
            // 添加时间和修改时间默认自动添加
            ['updated_at','default','value' => date('Y-m-d H:i:s',time())],
        ];
    }

    /*
     *  添加的方法
     * */
    public function UpdatePwd(){
        // 实现入库的操作
        $userInfo = User::findIdentity(\Yii::$app -> user -> id);
        $pwd = $userInfo -> password_hash;
        if (\Yii::$app -> getSecurity() -> validatePassword($this -> OldPassword,$pwd)){
            if ($this -> OkPassword === $this -> NewPassword){
                $newpwd = \Yii::$app -> getSecurity() -> generatePasswordHash($this -> NewPassword);
                $userInfo -> password_hash = $newpwd;
                if ($userInfo -> save(false)){
                    return 200;
                }else{
                    return 300;
                }
            }else{
                return 500;
            }
        }else{
            return 400;
        }
        /*$a = $user -> setPassword($this -> OldPassword);
        var_dump($a);die;
        var_dump($user -> validatePassword($this -> OldPassword));die;
        if (!$user -> validatePassword($this -> OldPassword)){
            return 400;
        }
        if ($this -> NewPassword !== $this -> OkPassword){
            return 500;
        }
//        $userInfo -> password_hash = $this-> NewPassword;
        $userInfo -> updated_at = $this -> updated_at;
        // 设置加密密码
        $userInfo -> password_hash = $userInfo -> setPassword($this -> NewPassword);
        // save(false) 不进行调用User中的数据校验，直接入库
        if ($userInfo -> save(false)){
            return 200;
        }else{
            return 300;
        }*/
    }
}
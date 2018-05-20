<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/22
 * Time: 23:21
 */

namespace backend\components;


use backend\models\form\UpdatePwdForm;
use backend\models\User;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\UnauthorizedHttpException;
class AdminController extends Controller
{
    protected $session;
    protected $cookie;
    protected $auth;
    protected $username;
    protected $ObjUpdate;

    public function beforeAction($action)
    {
//        \Yii::$app -> session -> remove();die;
        if (!parent::beforeAction($action)){
            return false;
        }
        $userId = \Yii::$app -> user -> id;
        $controller = \Yii::$app -> controller -> id;
        $action = \Yii::$app -> controller -> action -> id;
        $permissionName = $controller . "/" . $action;
        if (\Yii::$app -> user -> isGuest && $permissionName != 'site/login'){
            echo "<script>alert('您还未登录,请先登录');</script>";
            return $this -> redirect('/site/login');
        }
        $userId = \Yii::$app -> user ->id;
        $username = User::getNameById($userId);
        $this -> username = $username['username'];
        $item_name = \Yii::$app -> authManager ->getPermissionsByUser($userId);
        $names = [];
        foreach ($item_name as $v){
                $names[] = $v -> name;
        }
        if ($permissionName === 'site/login' || $permissionName === 'site/index' || in_array("all",$names) || $controller=='site' && $permissionName !== 'site/signup'){
            return true;
        }
        if($permissionName === 'question/upload'){
            return true;
        }
        if (!\Yii::$app -> user -> can($permissionName) && \Yii::$app -> getErrorHandler() -> exception === null){
            echo "<script>alert('您无此权限,请联系管理员');window.location.href='".\Yii::$app -> urlManager -> createAbsoluteUrl('site/index')."'</script>";
            return $this -> returnJump('您无此权限,请联系管理员','/site/index');
        }
        return true;
    }

    public function init(){
        $this -> session = \Yii::$app -> session;
        $this -> cookie = new Cookie();
        $this -> auth = \Yii::$app -> authManager;
        $this -> ObjUpdate = new UpdatePwdForm();
    }
    protected function returnJump($message,$url = ""){
        if ($url === ""){
            $url = \Yii::$app -> homeUrl;
        }else{
            $url = \Yii::$app -> urlManager -> createUrl($url);
        }
        return "<script>alert(".$message.");window.location.href='".$url."'</script>";
    }
}

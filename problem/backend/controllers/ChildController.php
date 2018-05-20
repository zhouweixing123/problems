<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/22
 * Time: 23:40
 */

namespace backend\controllers;


use backend\components\AdminController;
use backend\models\AuthAssignment;
use yii\db\Query;

class ChildController extends AdminController
{
    public function actionIndex(){
        $name = \Yii::$app -> getRequest() -> get('name','');
        $data = $this -> getRoleUser($name);
        return $this -> render('index',['data' => $data,'username' => $data[0]['username'],"model" => $this -> ObjUpdate]);
    }

    protected function getRoleUser($name){
        $query = new Query();
        $id = $this -> session -> get("userId");
        $data = $query -> select('a.*,u.id,u.username') -> from(['a' => 'auth_assignment','u' => 'user']) -> where("a.user_id = u.id and a.item_name='{$name}'") -> all();
        return $data;
    }

    public function actionDel(){
        $name = \Yii::$app -> getRequest() -> get('name','');
        $user_id = \Yii::$app -> getRequest() -> get('id','');
        $auth_assignment = new AuthAssignment();
        $bol = $auth_assignment::findOne(['user_id' => $user_id,'item_name' => $name]) -> delete();
        if ($bol){
            \Yii::$app -> getSession() -> setFlash('success','删除成功');
            return $this -> redirect('/child/index?name='.$name);
        }else{
            \Yii::$app -> getSession() -> setFlash('error','删除失败');
            return $this -> redirect('/child/index?name='.$name);
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/22
 * Time: 23:37
 */

namespace backend\controllers;


use backend\components\AdminController;
use yii\rbac\Item;

class PowerController extends AdminController
{
    /*
     *  权限列表
     * */
    public function actionIndex(){
        $data = $this -> auth -> getPermissions();
        return $this -> render('index',['data' => $data,"username" => $this -> username,"model" => $this -> ObjUpdate]);
    }

    /*
     *  创建权限
     * */
    public function actionCreate(){
        if (\Yii::$app -> getRequest() -> getIsGet()){
            return $this -> render('create',['username' => $this -> username,"model" => $this -> ObjUpdate]);
        }
        $name = \Yii::$app -> getRequest() -> post('name','');
        if ($name === ''){
            \Yii::$app->getSession()->setFlash('error', '请添加权限名称');
            return $this -> render('create',['username' => $this -> username,"model" => $this -> ObjUpdate]);
        }
        $createPost = $this -> auth -> createPermission($name);
        $createPost -> description = "创建了{$name}权限";
        $createPost -> type = 2;
        $bol = $this -> auth -> add($createPost);
        if ($bol){
            \Yii::$app->getSession()->setFlash('success', '权限添加成功');
            return $this -> redirect(['index']);
        }else{
            \Yii::$app->getSession()->setFlash('error', '权限添加失败');
            return $this -> render('create',['username' => $this -> username,"model" => $this -> ObjUpdate]);
        }
    }

    /*
     *  删除权限
     * */
    public function actionDel(){
        $name = \Yii::$app -> getRequest() -> get('name','');
        $permission = $this -> auth -> getPermission($name);
        if ($this -> auth -> remove($permission)){
            \Yii::$app->getSession()->setFlash('success', '权限删除成功');
        }else{
            \Yii::$app -> getSession() -> setFlash('error','权限删除失败');
        }
        return $this -> redirect(['/power/index']);
    }

    /*
     *  权限修改
     * */
    public function actionUpdate(){
        $name = \Yii::$app -> getRequest() -> get('name','');
        $permission = $this -> auth -> getPermission($name);
        if (\Yii::$app -> getRequest() -> getIsGet()){
            return $this -> render('update',['data' => $permission,'username' => $this -> username]);
        }
        if (\Yii::$app -> getRequest() -> getIsPost()){
            $newName = \Yii::$app -> getRequest() -> post('name','');
            if ($newName === ''){
                \Yii::$app -> getSession() -> setFlash('error','请添加权限名称');
            }
            $permission -> name = $newName;
            $permission -> description = "添加{$newName}权限";
            $bol = $this -> auth -> update($name,$permission);
            if ($bol){
                \Yii::$app -> getSession() -> setFlash('success','权限名称修改成功');
            }else{
                \Yii::$app -> getSession() -> setFlash('error','权限名称修改失败');
            }
            return $this -> redirect(['/power/index']);
        }
    }
}
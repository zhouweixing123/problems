<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/22
 * Time: 23:33
 */

namespace backend\controllers;


use backend\components\AdminController;
use yii\db\Query;
use backend\models\User;

class RoleController extends AdminController
{
    public function actionIndex(){
        $data = $this -> auth -> getRoles();
        return $this -> render('index',['data' => $data,'username' => $this -> username,"model" => $this -> ObjUpdate]);
    }

    public function actionCreate(){
        if (\Yii::$app -> getRequest() -> getIsGet()){
            return $this -> render('create',['username' => $this -> username,"model" => $this -> ObjUpdate]);
        }
        if (\Yii::$app -> getRequest() -> getIsPost()) {
            $name = \Yii::$app->getRequest()->post('name','');
            $role = $this -> auth -> createRole($name);
            $role -> description = "创建了{$name}角色";
            $role -> type = 1;
            $bol = $this -> auth -> add($role);
            if ($bol){
                \Yii::$app -> getSession() -> setFlash('success','角色创建成功');
                return $this -> redirect(['/role/index']);
            }else{
                \Yii::$app -> getSession() -> setFlash('error','角色创建失败');
                return $this -> render(['create']);
            }
        }
    }

    public function actionDel(){
        $name = \Yii::$app -> getRequest() -> get('name','');
        if ($name === ''){
            Yii::$app->getSession()->setFlash('error', '请选择要删除的角色名称');
        }else{
            $role = \Yii::$app -> authManager -> getRole($name);
            if ($this -> auth -> remove($role)){
                \Yii::$app->getSession()->setFlash('success', '角色删除成功');
            }else{
                \Yii::$app -> getSession() -> setFlash('error','角色删除失败');
            }
            return $this -> redirect(['/role/index']);
        }
    }

    /*
    *  角色修改
    * */
    public function actionUpdate(){
        $name = \Yii::$app -> getRequest() -> get('name','');
        $role = $this -> auth -> getRole($name);
        if (\Yii::$app -> getRequest() -> getIsGet()){
            $data = $this -> auth -> getRole($name);
            return $this -> render('update',['data' => $data,"username" => $this -> username,"model" => $this -> ObjUpdate]);
        }
        if (\Yii::$app -> getRequest() -> getIsPost()){
            $newName = \Yii::$app -> getRequest() -> post('name','');
            if ($newName === ''){
                \Yii::$app -> getSession() -> setFlash('error','请添加角色名称');
            }
            $role -> name = $newName;
            $role -> description = "添加{$newName}角色";
            $bol = $this -> auth -> update($name,$role);
            if ($bol){
                \Yii::$app -> getSession() -> setFlash('success','角色名称修改成功');
            }else{
                \Yii::$app -> getSession() -> setFlash('error','角色名称修改失败');
            }
            return $this -> redirect(['/role/index']);
        }
    }

    /*
     *  将与角色添加到用户
     * */
    public function actionAddUser(){
        $name = \Yii::$app -> getRequest() -> get('name','');
        $role = '';
        if (!empty($name) && \Yii::$app -> getRequest() -> getIsPost()){
            $role = $this -> auth -> getRole($name);
            // 首先删除该角色下面的所有用户
            $query = new Query();
            $a = $query -> createCommand() -> delete('auth_assignment',['item_name' => $name]) -> execute();
            $users = \Yii::$app -> getRequest() -> post('users',[]);
            if ($users){
                foreach ($users as $row){
                    $data[] = [
                        'user_id' => $row,
                        'item_name' => $name,
                        'created_at' => time()
                    ];
                }
                // 采用自带的插入多条数据的方法
                $res = $query -> createCommand() -> batchInsert('auth_assignment',['user_id','item_name','created_at'],$data) -> execute();
                if ($res){
                    return $this -> redirect(['child/index','name' => $name]);
                }
                $error = '添加失败';
            }
        }else{
            $error = '请正确访问';
        }
        $roleUser = $this -> auth -> getUserIdsByRole($name);
        $users = User::find() -> all();
        return $this -> render(
            'add_user',
            ['users' => $users,'role' => $role,'roleUser' => $roleUser,'error' => $error,'username' => $this -> username,"model" => $this -> ObjUpdate]
        );
    }

    public function actionPermission(){
        $name = \Yii::$app -> getRequest() -> get('name','');
        if (!$name){
            $data = $this -> auth -> getRoles();
            \Yii::$app -> getSession() -> setFlash('error','请使用正确的姿势访问');
            return $this -> redirect('/role/index',['data' => $data]);
        }
        $role = $this -> auth -> getRole($name);
        if (!$role){
            $data = $this -> auth -> getRoles();
            \Yii::$app -> getSession() -> setFlash('error','请使用正确的角色');
            return $this -> redirect('/role/index',['data' => $data]);
        }
        if (\Yii::$app -> getRequest() -> getIsPost()){
            $per = \Yii::$app -> getRequest() -> post('permissions',[]);
            $query = new Query();
            $query->createCommand()->delete('auth_item_child', ['parent' => $name])->execute();
            if ($per){
                foreach ($per as $v){
                    $permissions = $this -> auth -> getPermission($v);
                    $this -> auth -> addChild($role,$permissions);
                }
            }
            return $this -> redirect('/role/index');
        }
        $permissions = $this -> auth -> getPermissions();
        $rolePermissions = $this -> auth -> getPermissionsByRole($name);  // 获取角色对应权限列表
        return $this -> render('permission',['permissions' => $permissions,'rolePermissions' => array_keys($rolePermissions),'username' => $this -> username,"model" => $this -> ObjUpdate]);
    }
}
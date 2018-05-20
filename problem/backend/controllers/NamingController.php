<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/23
 * Time: 0:46
 */

namespace backend\controllers;


use backend\components\AdminController;
use yii\db\Query;

class NamingController extends AdminController
{
    public function actionIndex(){
        if (\Yii::$app -> getRequest() -> getIsGet()){
            return $this -> render('index',['username' => $this -> username,"model" => $this -> ObjUpdate]);
        }
        $data = (new Query()) -> from("user") -> select(['username','id']) -> where(['is_show' => 1,'is_naming' => 1]) -> all();
        if (empty($data) || count($data) == 1 || count($data) == 0){
            #\Yii::$app -> db -> createCommand() -> update('user',['is_show' => 1]) -> where('is_naming', 1) -> execute();
	    \Yii::$app -> db -> createCommand() -> update('user',['is_show' => 1],'is_naming = 1') -> execute();
        }
        $data = (new Query()) -> from("user") -> select(['username','id']) -> where(['is_show' => 1,'is_naming' => 1]) -> all();
        $id = $this -> getId($data);
        $ids = array_rand(array_flip($id),5);
        $data = (new Query()) -> from('user') -> select(['username']) -> where(['is_show' => 1,'is_naming' => 1]) -> andWhere(['in','id',$ids]) -> all();
        $ids = implode(",",$ids);
        $bol = \Yii::$app -> db -> createCommand("UPDATE `user` SET is_show = 0 WHERE id IN ({$ids})") -> execute();
        $arr = [];
        if ($bol){
            if ($data){
                $arr['code'] = 1;
                $arr['data'] = $data;
            }else{
                $arr['code'] = 0;
                $arr['msg']  = '未查询到人名';
            }
        }else{
            $arr['code'] = 0;
            $arr['msg']  = '出现错误';
        }

        return $this -> asJson($arr);
    }

    private function getId($arr,$array=[]){
        foreach ($arr as $k=>$v){
            $array[] = $v['id'];
        }
        return $array;
    }
    private function getQid($arr,$array=[]){
        foreach ($arr as $k=>$v){
            $array[] = $v['question_id'];
        }
        return $array;
    }
    private function getName($arr,$array=[]){
        foreach ($arr as $k=>$v){
            $array[] = $v['name'];
        }
        return $array;
    }

    /*
     *  获取一个人员和一个问题
     * */
    public function actionQuestion(){
        if (\Yii::$app -> getRequest() -> getIsGet()){
            return $this -> render('question',['username' => $this -> username,"model" => $this -> ObjUpdate]);
        }
        // 获取所有的用户
        $data = (new Query()) -> from("user") -> select(['username','id']) -> where(['is_naming' => 1]) -> all();
        // 获取所有问题
        $question_all = (new Query()) -> from("question") -> select(['questionName','question_id']) ->where(['isDel' => 0,'status' => 1]) -> all();
        // 判断用户个数如果大于1则进行随机抽取,如果小于1则直接获取用户的信息
        if (count($data) > 1){
            $id = $this -> getId($data);
            $id = array_rand(array_flip($id),1);
        }else if (count($data) == 0){
            $arr['msg'] = '暂无候选人员,请联系管理员添加人员';
            $arr['code'] = 0;
            return $this -> asJson($arr);
        }else if (count($data) == 1) {
            $id = $data[0]['id'];
        }
        $username = (new Query()) -> from('user') -> select(['username']) -> where(['id' => $id]) -> one();
        $question_count = (new Query()) -> from('question') -> where(['isDel' => 0,'status' => 1]) -> count();
        if ($question_count <= 1){
            $question = (new Query()) -> from("question") -> select(['questionName','question_id']) -> where(['isDel' => 0,'status' => 1]) -> one();
        }else{
            $question_id = $this -> getQid($question_all);
            $q_id = array_rand(array_flip($question_id),1);
            $question = (new Query()) -> from('question') -> select(['questionName','question_id']) -> where(['isDel' => 0,'status' => 1,'question_id' => $q_id]) -> one();
        }
        if(!$question){
            $arr['msg'] = '查询失败,请添加问题';
            $arr['code'] = 0;
            return $this -> asJson($arr);
        }
        $info = array_merge($username,$question);
        $arr = [];
        if (count($info) > 0){
            $arr['msg'] = '查询成功';
            $arr['code'] = 1;
            $arr['data'] = $info;
        }else{
            $arr['msg'] = '查询失败';
            $arr['code'] = 0;
        }
        return $this -> asJson($arr);
    }
}

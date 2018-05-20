<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/22
 * Time: 23:35
 */

namespace backend\controllers;


use backend\components\AdminController;
use backend\models\Question;
use yii\data\Pagination;

class QuestionController extends AdminController
{

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config' => [
                    'imageUrlPrefix' => 'http://problem.zhouweixing.top',//文件访问的路径前缀
                    'imagePathFormat' => '/../upload/{yyyy}{mm}{dd}/{time}{rand:6}',//文件的上传路径
                    'imageRoot' => \Yii::getAlias("@webroot"),
                    'fileFieldName' => 'upBase64',
                ],
            ],
            #'WebUpload' => [
             #   'class' => 'common\widgets\webuploader\UploaderAction',
              #  'config' => [
               #     'maxSize' => 5*1024*1024,  // 上传大小限制, 单位B, 默认5MB, 注意修改服务器的大小限制
                #    'allowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'],  // 上传图片格式显示
                 #   'thumbStatus' => false,  // 是否生成缩略图
                  #  'thumbWidth' => 300,  // 缩略图宽度
                   # 'thumbHeight' => 200,  // 缩略图高度
                   # 'thumbCut' => 1,  // 生成缩略图的方式, 0:留白, 1:裁剪
                   # 'pathFormat' => '../../frontend/web/upload/{yyyy}{mm}{dd}/{time}{rand:6}',  // 上传保存路径, 可以自定义保存路径和文件名格式
                   # 'saveDatabase' => false,  // 保存上传信息到数据库
               # ]
            #],
        ];
    }

    /*
     *  展示
     * */
    public function actionIndex(){
        $model = new Question();
        if (\Yii::$app -> getRequest() -> getIsGet()){
            $count = Question::find() -> where(['isDel' => 0,'status' => 1,'admin_id' => $this -> session -> get('userId')]) -> count();
            $page = new Pagination(['totalCount' => $count,'pageSize' => 6]);
            $questionInfo = Question::find() -> offset($page -> offset) -> where(['isDel' => 0,'admin_id' => $this -> session -> get('userId')]) -> limit($page -> limit) -> asArray() -> all();
        }
        if (\Yii::$app -> getRequest() -> getIsPost()){
            $name = \Yii::$app -> getRequest() -> post('name','');
            $count = Question::find()->where(['isDel'=>0,'admin_id' => $this -> session -> get('userId')])->andwhere(['and', ['like','questionName',$name],])->count();//获取满足条件的总条数
            $page = new Pagination(['totalCount' => $count,'pageSize'=>'6']);
            $questionInfo = Question::find()
                ->offset($page->offset)
                ->where(['isDel'=>0])
                ->andwhere(['and', ['like','questionName',$name],])
                ->limit($page->limit)
                ->asArray()
                ->all();
        }
        return $this -> render('index',['questionInfo' => $questionInfo,'model' => $model,'pages' => $page,'username' => $this -> username,"model" => $this -> ObjUpdate]);
    }

    /*
     *  审核
     *
     * */
    public function actionExamine(){
        $model = new Question();
        if (\Yii::$app -> getRequest() -> getIsGet()){
            $count = Question::find() -> where(['isDel' => 0,'status' => 0]) -> count();
            $page = new Pagination(['totalCount' => $count,'pageSize' => 6]);
            $questionInfo = Question::find() -> offset($page -> offset) -> where(['isDel' => 0,'status' => 0]) -> limit($page -> limit) -> asArray() -> all();
        }
        if (\Yii::$app -> getRequest() -> getIsPost()){
            $name = \Yii::$app -> getRequest() -> post('name','');
            $count = Question::find()->where(['isDel'=>0])->andwhere(['and', ['like','questionName',$name],])->count();//获取满足条件的总条数
            $page = new Pagination(['totalCount' => $count,'pageSize'=>'6']);
            $questionInfo = Question::find()
                ->offset($page->offset)
                ->where(['isDel'=>0])
                ->andwhere(['and', ['like','questionName',$name],])
                ->limit($page->limit)
                ->asArray()
                ->all();
        }
        return $this -> render('examine',['questionInfo' => $questionInfo,'model' => $model,'pages' => $page,'username' => $this -> username,"model" => $this -> ObjUpdate]);
    }

    /*
     *  修改审核状态
     * */
    public function actionStatus(){
        $userId = $this -> session -> get("userId");
        $data = [];
        if ($userId !== 1){
            $data['msg'] = "您暂无该权限,请联系管理员！！！！";
            $data['code'] = 0;
            return $this -> asJson($data);
        }
        $id = \Yii::$app -> getRequest() -> post('id');
        $result = \Yii::$app -> db -> createCommand() -> update('question',['status' => 1],['question_id' => $id]) -> execute();
        if ($result){
            $data['msg'] = "审核成功";
            $data['code'] = 1;
            $data['status'] = 0;
        }else{
            $data['msg'] = "审核失败";
            $data['code'] = 0;
        }
        return $this -> asJson($data);
    }

    /*
     *  删除数据
     * */
    public function actionDel(){
        $queston_id = trim(\Yii::$app->getRequest()->post('id'),',');
        $resault = \Yii::$app->db->createCommand("update question set isDel = 1 where  question_id in($queston_id)")->execute();
        $data = [];
        if ($resault){
            $data['code'] = 1;
            $data['msg']  = '删除成功';
        }else{
            $data['code'] = 0;
            $data['msg'] = "删除失败";
        }
        return $this -> asJson($data);
    }

    /*
     *  数据添加
     * */
    public function actionAdd(){
        $model = new Question();
        if (\Yii::$app -> getRequest() -> getIsGet()){
            return $this -> render('add',['model' => $model,'username' => $this -> username,"model" => $this -> ObjUpdate]);
        }
        if (\Yii::$app -> getRequest() -> getIsPost()){
            $questionName = \Yii::$app -> getRequest() -> post('name','');
            $questionAnswer = \Yii::$app -> getRequest() -> post('w0','');
            $questionNameInfo = \Yii::$app->db->createCommand("select questionName from question where questionName like '$questionName%'")->queryOne();
            if (empty($questionAnswer)){
                \Yii::$app -> session -> setFlash('答案不能为空！');
                return $this->redirect('/question/add');
            }
            if (empty($questionNameInfo['questionName'])){
                $id = $this -> session -> get("userId");
                $resault = \Yii::$app->db->createCommand()->insert('question',['questionName'=>$questionName,'questionAnswer'=>$questionAnswer,'admin_id' => $id,'createTime'=>time()])->execute();
                if ($resault){
                    \Yii::$app -> session -> setFlash('保存成功');
                    return $this->redirect('/question/index');
                }
            } else {
                \Yii::$app -> session -> setFlash("该问题已存在，请重新添加！");
                return $this->redirect('/question/add');
            }
        }
    }

    public function actionUpdate(){
        $model = new Question();
        $question_id = \Yii::$app->request->get('id');
        $questionInfo = Question::find()
            ->where(['question_id' => $question_id])
            ->asArray()
            ->one();
        if (\Yii::$app -> getRequest() -> getIsGet()){
            return $this -> render('update',['data' => $questionInfo,'username' => $this -> username,"model" => $this -> ObjUpdate]);
        }

        if (\Yii::$app->getRequest()->getIsPost()){
            $question_id = \Yii::$app->request->post('question_id');
            $questionName = \Yii::$app->request->post('name');//问题
            $questionAnswer = \Yii::$app->request->post('w0');//答案
            $questionNameInfo = \Yii::$app->db->createCommand("select questionName from question where questionName = '$questionName'")->queryOne();
            if (empty($questionAnswer) || empty($questionName)){
                \Yii::$app -> session -> setFlash("值不能是空白的");
                return $this->redirect('/question/update?id='.$question_id);
            }
            if (!empty($questionNameInfo['questionName'])){
                $resault = \Yii::$app->db->createCommand()->update('question',['questionName'=>$questionName,'questionAnswer'=>$questionAnswer],['question_id'=>$question_id])->execute();
                if ($resault){
                    \Yii::$app -> session ->setFlash('修改成功！');
                    return $this->redirect('/question/index');
                }else{
		    echo "<script>alert('未修改值');</script>";
		    return $this -> redirect('/question/index');
                }
            } else {
                return $this->redirect('/question/update&id='.$question_id);
            }
        }
    }
}

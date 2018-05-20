<?php

namespace backend\controllers;

use backend\components\AdminController;
use backend\models\form\UpdatePwdForm;
use backend\models\Question;
use backend\models\User;
use Yii;
use common\models\LoginForm;
use backend\models\form\SignupForm;
use yii\db\Query;
use yii\data\Pagination;

/**
 * Site controller
 */
class SiteController extends AdminController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $uModel = new SignupForm();
        $model = new Question();
        if (\Yii::$app->getRequest()->getIsGet()) {
            // 获取用户名称
            // 获取用户人数
            $count = (new Query())->from('user')->count();
            $questionCount = (new Query())->from('question')->where(['isDel' => 0, 'status' => 1])->count();
            $page = new Pagination(['totalCount' => $questionCount, 'pageSize' => 6]);
            $questionInfo = Question::find()->offset($page->offset)->where(['isDel' => 0, 'status' => 1])->limit($page->limit)->asArray()->all();
        }
        if (\Yii::$app->getRequest()->getIsPost()) {
            $name = \Yii::$app->getRequest()->post('name', '');
            $count = Question::find()->where(['isDel' => 0, 'status' => 1])->andwhere(['and', ['like', 'questionName', $name],])->count();//获取满足条件的总条数
            $page = new Pagination(['totalCount' => $count, 'pageSize' => '6']);
            $questionInfo = Question::find()
                ->offset($page->offset)
                ->where(['isDel' => 0])
                ->andwhere(['and', ['like', 'questionName', $name],])
                ->limit($page->limit)
                ->asArray()
                ->all();
        }
        return $this->render('index', ['count' => $count, 'questionCount' => $questionCount, 'questionInfo' => $questionInfo, 'pages' => $page,'username' => $this -> username,"model" => $this -> ObjUpdate]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/site/index');
        } else {
            // 展示登录页面
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout(false);
        $this -> session -> remove("username");
        return $this->goHome();
    }

    /*
     *  用户添加
     * */
    public function actionSignup()
    {
        // 实例化一个表单模型，这个表单模型我们还没有创建，等一下后面再创建
        $model = new SignupForm();
        // 下面这一段if是我们刚刚分析的第二个小问题的实现，下面让我具体的给你描述一下这几个方法的含义吧
        // $model->load() 方法，实质是把post过来的数据赋值给model的属性
        // $model->signup() 方法, 是我们要实现的具体的添加用户操作
        if ($model->load(\Yii::$app->request->post()) && $model->signup()) {
            // 添加完用户之后，我们跳回到index操作即列表页
            return $this->redirect('index');
        }

        // 下面这一段是我们刚刚分析的第一个小问题的实现
        // 渲染添加新用户的表单
        return $this->render('signup', [
            'usermodel' => $model,'username' => $this -> username,"model" => $this -> ObjUpdate
        ]);
    }

    /*
     *  密码修改
     * */
    public function actionUpdatePwd(){
        if (Yii::$app -> getRequest() -> getIsPost()){
            $model = new UpdatePwdForm();
            $data = [];
            $model -> OldPassword = Yii::$app -> getRequest() -> post("old",'');
            $model -> NewPassword = Yii::$app -> getRequest() -> post('new','');
            $model -> OkPassword = Yii::$app -> getRequest() -> post('ok','');
            $bol = $model -> UpdatePwd();
            if ($bol === 200){
                $data['msg'] = "修改成功";
                $data['code'] = 1;
            }else if ($bol === 300){
                $data['msg'] = "修改失败";
                $data['code'] = 0;
            }else if ($bol === 400){
                $data['msg'] = "原始密码不正确";
                $data['code'] = 0;
            }else if ($bol === 500){
                $data['msg'] = "两次输入的密码不一致,请重新输入";
                $data['code'] = 0;
            }
            return $this -> asJson($data);
        }
    }

    /*
    *  问题详情
    * */
    public function actionInfo()
    {
        $id = Yii::$app->getRequest()->get('id', '');
        $question = (new Query())->select(['questionName', 'questionAnswer'])->from('question')->where(['question_id' => $id])->one();
        return $this->render('info', ['data' => $question,'username' => $this -> username,"model" => $this -> ObjUpdate]);
    }
}

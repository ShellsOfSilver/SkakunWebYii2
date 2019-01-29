<?php

namespace app\modules\admin\controllers;

use app\models\Comment;
use yii\web\Controller;

class CommentController extends Controller
{
    public function actionIndex()
    {
        $comments = Comment::find()->orderBy('id desc')->all();

        return $this->render('index', ['comments'=>$comments]);
    }

    public function actionDelete($id)
    {
        $comments = Comment::findOne($id);
        if($comments->delete()){
            return $this->redirect(['comment/index']);
        }
    }

    public function actionAllow($id)
    {
        $comments = Comment::findOne($id);
        if($comments->allow()){
            return $this->redirect(['index']);
        }
    }

    public function actionDisallow($id)
    {
        $comments = Comment::findOne($id);
        if($comments->disallow()){
            return $this->redirect(['index']);
        }
    }


}
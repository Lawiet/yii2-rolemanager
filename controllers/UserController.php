<?php

namespace lawiet\rbac\controllers;

use Yii;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use lawiet\rbac\models\User;
use lawiet\rbac\models\UserSearch;
use lawiet\rbac\models\RoleUser;
use lawiet\rbac\web\Controller;

/**
* UsersController implements the CRUD actions for Users model.
*/
class UserController extends Controller
{
    /**
    * @inheritdoc
    */
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
    * Lists all Users models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Displays a single Users model.
    * @param integer $id
    * @return mixed
    */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
    * Creates a new Users model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new User();
        $postData = Yii::$app->request->post();
        $save = true;

        if ($postData) {
            if ($model->load($postData)) {
                $roles = $postData['User']['roles'];
                $model->date_modified = new Expression('NOW()');
                $model->date_created = new Expression('NOW()');

                if(strrpos($model->password, "$2y$") < 0){
                    $model-setPassword($model->password);
                }

                $transaction = Yii::$app->db->beginTransaction();

                try {
                    if(!$model->save())
                    $save = false;

                    RoleUser::deleteAll(['id_role'=>$id]);

                    if(!empty($roles))
                    foreach($roles as $role){
                        $gr = new RoleUser();
                        $gr->id_user = $id;
                        $gr->id_role = $role;

                        if(!$gr->save())
                        $save = false;
                    }

                    if ($save) {
                        $transaction->commit();

                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
    * Updates an existing Users model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $postData = Yii::$app->request->post();
        $save = true;

        if ($postData) {
            if ($model->load($postData)) {
                $roles = $postData['User']['roles'];
                $model->date_modified = new Expression('NOW()');
                $model->date_created = new Expression('NOW()');

                if(strrpos($model->password, "$2y$") < 0){
                    $model-setPassword($model->password);
                }

                $transaction = Yii::$app->db->beginTransaction();

                try {
                    if(!$model->save())
                    $save = false;

                    RoleUser::deleteAll(['id_role'=>$id]);

                    if(!empty($roles))
                    foreach($roles as $role){
                        $gr = new RoleUser();
                        $gr->id_user = $id;
                        $gr->id_role = $role;

                        if(!$gr->save())
                        $save = false;
                    }

                    if ($save) {
                        $transaction->commit();

                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
    * Deletes an existing Users model.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * @param integer $id
    * @return mixed
    */
    public function actionDelete($id)
    {
        if($id < 2) {
            throw new NotFoundHttpException(Yii::t('app', 'This item can not be delete.'));
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
    * Finds the Users model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Users the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

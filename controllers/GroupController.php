<?php

namespace lawiet\rbac\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use lawiet\rbac\models\GroupRole;
use lawiet\rbac\models\Role;
use lawiet\rbac\models\RoleSearch;
use lawiet\rbac\models\Group;
use lawiet\rbac\models\GroupSearch;
use lawiet\rbac\web\Controller;
use yii\helpers\ArrayHelper;

/**
 * GroupController implements the CRUD actions for Group model.
 */
class GroupController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
		$this->layout = parent::getLayout();

		return parent::behaviors();
    }

    /**
     * Lists all Group models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Group model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Group();
        $modelRole = Role::find()->select(['id', 'name'])->all();
        $modelGroupRole = new GroupRole();
        $postData = Yii::$app->request->post();

        if ($postData) {
            if ($model->load($postData)) {
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelRole' => ArrayHelper::map($modelRole, 'id', 'name'),
            'modelGroupRole' => $modelGroupRole,
        ]);
    }

    /**
     * Updates an existing Group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelRole = Role::find()->select(['id', 'name'])->all();
        $modelGroupRole = new GroupRole();
        $postData = Yii::$app->request->post();

        if ($postData) {
            if ($model->load($postData['Group'])) {
				print_r($postData);
                //if($model->save()){
                    //return $this->redirect(['view', 'id' => $model->id]);
                //}
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelRole' => ArrayHelper::map($modelRole, 'id', 'name'),
            'modelGroupRole' => $modelGroupRole,
        ]);
    }

    /**
     * Deletes an existing Group model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Group::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

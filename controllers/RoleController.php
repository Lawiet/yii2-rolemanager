<?php

namespace lawiet\rbac\controllers;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use lawiet\rbac\models\Role;
use lawiet\rbac\models\RoleSearch;
use lawiet\rbac\models\Permission;
use lawiet\rbac\models\PermissionRole;
use lawiet\rbac\web\Controller;

/**
 * RolesController implements the CRUD actions for Roles model.
 */
class RoleController extends Controller
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
     * Lists all Roles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Roles model.
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
     * Creates a new Roles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Assignment();
        $modelPermissionRole = new PermissionRole();
        $modelPermission = ArrayHelper::map(Permission::find()->all(), 'id', 'name');

        if ( $model->load(Yii::$app->request->post()) ) {
			$model->date_modified = new Expression('NOW()');
			$model->date_created = new Expression('NOW()');
			
			if( $model->save() ){
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }
		
		return $this->render('create', [
			'model' => $model,
			'modelPermission' => $modelPermission,
			'modelPermissionRole' => $modelPermissionRole,
		]);
    }

    /**
     * Updates an existing Roles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelPermissionRole = PermissionRole::find()->where(['id_rol'=>$id])->all();
        //$modelPermissionRole = ArrayHelper::map(PermissionRole::find()->where(['id_rol'=>$id])->all(), 'id_rol', 'id_permission');
		//print_r($modelPermissionRole);
        $modelPermission = ArrayHelper::map(Permission::find()->all(), 'id', 'name');

        if ( $model->load(Yii::$app->request->post()) ) {
			$model->date_modified = new Expression('NOW()');
			
			if( $model->save() ){
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }
		
		return $this->render('update', [
			'model' => $model,
			'modelPermission' => $modelPermission,
			'modelPermissionRole' => $modelPermissionRole,
		]);
    }

    /**
     * Deletes an existing Roles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Roles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Roles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

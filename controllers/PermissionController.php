<?php

namespace lawiet\rbac\controllers;

use Yii;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use lawiet\rbac\models\Permission;
use lawiet\rbac\models\PermissionSearch;
use lawiet\rbac\web\Controller;

/**
 * PermissionController implements the CRUD actions for Permission model.
 */
class PermissionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
		return parent::behaviors();
    }

    /**
     * Lists all Permission models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Permission model.
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
     * Creates a new Permission model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Permission();

        if ( $model->load(Yii::$app->request->post()) ) {
			$model->date_modified = new Expression('NOW()');
			$model->date_created = new Expression('NOW()');
			
			if( $model->save() ){
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }
		
		return $this->render('create', [
			'model' => $model,
		]);
    }

    /**
     * Updates an existing Permission model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ( $model->load(Yii::$app->request->post()) ) {
			$model->date_modified = new Expression('NOW()');
			
			if( $model->save() ){
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }
		
		return $this->render('update', [
			'model' => $model,
		]);
    }

    /**
     * Deletes an existing Permission model.
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
     * Finds the Permission model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Permission the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Permission::findOne($id)) !== null) {
            return $model;
        }

		throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

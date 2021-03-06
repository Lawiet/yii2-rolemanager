<?php

namespace lawiet\rbac\controllers;

use Yii;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use lawiet\rbac\models\Assignment;
use lawiet\rbac\models\AssignmentSearch;
use lawiet\rbac\web\Controller;

/**
 * AssignmentController implements the CRUD actions for Assignment model.
 */
class AssignmentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
		return parent::behaviors();
    }

    /**
     * Lists all Assignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Assignment model.
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
     * Creates a new Assignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Assignment();

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
     * Updates an existing Assignment model.
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
     * Deletes an existing Assignment model.
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
     * Finds the Assignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Assignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Assignment::findOne($id)) !== null) {
            return $model;
        }

		throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

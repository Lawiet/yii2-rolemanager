<?php

namespace lawiet\rbac\controllers;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use lawiet\rbac\models\Organization;
use lawiet\rbac\models\OrganizationSearch;
use lawiet\rbac\models\Group;
use lawiet\rbac\web\Controller;

/**
 * OrganizationsController implements the CRUD actions for Organizations model.
 */
class OrganizationController extends Controller
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
     * Lists all Organizations models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrganizationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Organizations model.
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
     * Creates a new Organizations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Organization();
        $modelGroup = Group::find()->all();
        $postData = Yii::$app->request->post();

        if ( $model->load(Yii::$app->request->post()) ) {
			$model->date_modified = new Expression('NOW()');
			$model->date_created = new Expression('NOW()');
			
			if( $model->save() ){
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }
		
		return $this->render('create', [
			'model' => $model,
            'modelGroup' => ArrayHelper::map($modelGroup, 'id', 'name'),
		]);
    }

    /**
     * Updates an existing Organizations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelGroup = Group::find()->all();
        $postData = Yii::$app->request->post();

        if ( $model->load(Yii::$app->request->post()) ) {
			$model->date_modified = new Expression('NOW()');
			
			if( $model->save() ){
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }
		
		return $this->render('update', [
			'model' => $model,
            'modelGroup' => ArrayHelper::map($modelGroup, 'id', 'name'),
		]);
    }

    /**
     * Deletes an existing Organizations model.
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
     * Finds the Organizations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Organizations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Organization::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

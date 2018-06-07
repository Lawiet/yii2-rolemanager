<?php

namespace lawiet\rbac\controllers;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use lawiet\rbac\models\Audit;
use lawiet\rbac\web\Controller;

/**
 * AuditsController implements the CRUD actions for Audit model.
 */
class AuditController extends Controller
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
     * Lists all Audits models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuditSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Audits model.
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
     * Creates a new Audits model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Audit();
        $modelPermission = Permission::find()->all();
        $postData = Yii::$app->request->post();
		$save = true;

        if ($postData) {
            if ($model->load($postData)) {
				$permissions = $postData['Role']['permissions'];
				$model->date_modified = new Expression('NOW()');
				$model->date_created = new Expression('NOW()');
				
				$transaction = Yii::$app->db->beginTransaction();

				try {
					if(!$model->save())
						$save = false;
					
					PermissionRole::deleteAll(['id_role'=>$id]);
					
					if(!empty($permissions))
						foreach($permissions as $permission){
							$gr = new PermissionRole();
							$gr->id_role = $id;
							$gr->id_permission = $permission;
							
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
            'modelPermission' => ArrayHelper::map($modelPermission, 'id', 'name'),
		]);
    }

    /**
     * Updates an existing Audits model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelPermission = Permission::find()->all();
        $postData = Yii::$app->request->post();
		$save = true;

        if ($postData) {
            if ($model->load($postData)) {
				$permissions = $postData['Role']['permissions'];
				$model->date_modified = new Expression('NOW()');
				
				$transaction = Yii::$app->db->beginTransaction();

				try {
					if(!$model->save())
						$save = false;
					
					PermissionRole::deleteAll(['id_role'=>$id]);
					
					if(!empty($permissions))
						foreach($permissions as $permission){
							$gr = new PermissionRole();
							$gr->id_role = $id;
							$gr->id_permission = $permission;
							
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
            'modelPermission' => ArrayHelper::map($modelPermission, 'id', 'name'),
		]);
    }

    /**
     * Deletes an existing Audits model.
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
     * Finds the Audits model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Audits the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Audit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

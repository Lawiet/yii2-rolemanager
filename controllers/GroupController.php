<?php

namespace lawiet\rbac\controllers;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use lawiet\rbac\models\GroupRole;
use lawiet\rbac\models\Role;
use lawiet\rbac\models\RoleSearch;
use lawiet\rbac\models\Group;
use lawiet\rbac\models\GroupSearch;
use lawiet\rbac\web\Controller;

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
        $postData = Yii::$app->request->post();
		$save = true;

        if ($postData) {
            if ($model->load($postData)) {
				$roles = $postData['Group']['rols'];
				$model->date_modified = new Expression('NOW()');
				$model->date_created = new Expression('NOW()');
				
				$transaction = Yii::$app->db->beginTransaction();

				try {
					if(!$model->save())
						$save = false;
					
					GroupRole::deleteAll(['id_group'=>$id]);
					
					if(!empty($roles))
						foreach($roles as $rol){
							$gr = new GroupRole();
							$gr->id_group = $id;
							$gr->id_rol = $rol;
							
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
            'modelRole' => ArrayHelper::map($modelRole, 'id', 'name'),
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
        $postData = Yii::$app->request->post();
		$save = true;

        if ($postData) {
            if ($model->load($postData)) {
				$roles = $postData['Group']['rols'];
				$model->date_modified = new Expression('NOW()');
				
				$transaction = Yii::$app->db->beginTransaction();

				try {
					if(!$model->save())
						$save = false;
					
					GroupRole::deleteAll(['id_group'=>$id]);
					
					if(!empty($roles))
						foreach($roles as $rol){
							$gr = new GroupRole();
							$gr->id_group = $id;
							$gr->id_rol = $rol;
							
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
            'modelRole' => ArrayHelper::map($modelRole, 'id', 'name'),
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

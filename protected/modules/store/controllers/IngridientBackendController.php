<?php

class IngridientBackendController extends yupe\components\controllers\BackController
{
    public function accessRules()
    {
        return [
            ['allow', 'roles' => ['admin']],
            ['allow', 'actions' => ['index']],
            ['deny'],
        ];
    }

    public function actions()
    {
        return [
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'Ingredient'
            ]
        ];
    }

    public function actionIndex()
    {
        $model = new Ingredient('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Ingredient'])) {
            $model->attributes = $_GET['Ingredient'];
        }
        $this->render('index', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new Ingredient();

        if (Yii::app()->getRequest()->getIsPostRequest() && Yii::app()->getRequest()->getPost('Ingredient')) {

            $attributes = Yii::app()->getRequest()->getPost('Ingredient');
            $model->attributes = $attributes;

            if ($model->save()) {

                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('StoreModule.store', 'Record was created!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        ['create']
                    )
                );
            } else {
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                    Yii::t('StoreModule.store', 'Failed to save product!')
                );
            }
        }
        $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getIsPostRequest() && Yii::app()->getRequest()->getPost('Ingredient')) {

            $attributes = Yii::app()->getRequest()->getPost('Ingredient');
            $model->attributes = $attributes;

            if ($model->save()) {

                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('StoreModule.store', 'Record was created!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        ['update']
                    )
                );
            } else {
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                    Yii::t('StoreModule.store', 'Failed to save product!')
                );
            }
        }
        $this->render('update', ['model' => $model]);
    }

    /**
     * @param $id
     * @return Product
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Ingredient::model()->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, Yii::t('StoreModule.store', 'Page not found!'));
        }

        return $model;
    }

}

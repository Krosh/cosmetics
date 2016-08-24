<?php
/**
 * Класс MegauserBackendController:
 *
 * @category Yupe\yupe\components\controllers\BackController
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
class MegauserBackendController extends \yupe\components\controllers\BackController
{
    /**
     * Отображает пользователя по указанному идентификатору
     *
     * @param integer $id Идинтификатор пользователя для отображения
     *
     * @return void
     */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }

    /**
     * Создает новую модель пользователя.
     * Если создание прошло успешно - перенаправляет на просмотр.
     *
     * @return void
     */
    public function actionCreate()
    {
        $model = new Megauser;

        if (Yii::app()->getRequest()->getPost('Megauser') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Megauser'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('MegareviewModule.megareview', 'Запись добавлена!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        [
                            'update',
                            'id' => $model->id
                        ]
                    )
                );
            }
        }
        $this->render('create', ['model' => $model]);
    }


    /**
     * Редактирование пользователя.
     *
     * @param integer $id Идинтификатор пользователя для редактирования
     *
     * @return void
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('Megauser') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Megauser'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('MegareviewModule.megareview', 'Запись обновлена!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        [
                            'update',
                            'id' => $model->id
                        ]
                    )
                );
            }
        }
        $this->render('update', ['model' => $model]);
    }

    /**
     * Удаляет модель пользователя из базы.
     * Если удаление прошло успешно - возвращется в index
     *
     * @param integer $id идентификатор пользователя, который нужно удалить
     *
     * @return void
     */
    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            // поддерживаем удаление только из POST-запроса
            $this->loadModel($id)->delete();

            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('MegareviewModule.megareview', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('MegareviewModule.megareview', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }

    /**
     * Управление пользователями.
     *
     * @return void
     */
    public function actionIndex()
    {
        $model = new Megauser('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('Megauser') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('Megauser'));
        $this->render('index', ['model' => $model]);
    }

    /**
     * Возвращает модель по указанному идентификатору
     * Если модель не будет найдена - возникнет HTTP-исключение.
     *
     * @param integer идентификатор нужной модели
     *
     * @return void
     */
    public function loadModel($id)
    {
        $model = Megauser::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('MegareviewModule.megareview', 'Запрошенная страница не найдена.'));

        return $model;
    }
}

<?php
namespace backend\controllers;

use src\Core\Infrastructure\Mapper\Mapper;
use src\Modules\Category\Domain\Entity\Category;
use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */


class SiteController extends Controller
{
    /**
     * @var CategoryRepositoryInterface
     */
    /**
     * @var CategoryItemRepositoryInterface
     */
    private $categoryRepository;
    private $categoryItemRepository;
    private $mapper;

    public function __construct($id, $module,
                                CategoryRepositoryInterface $categoryRepository,
                                CategoryItemRepositoryInterface $categoryItemRepository,
                                Mapper $mapper,
                                $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->categoryRepository = $categoryRepository;
        $this->categoryItemRepository = $categoryItemRepository;
        $this->mapper = $mapper;
    }



    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
//                    [
//                        'actions' => ['logout', 'index'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */

//http://admin.phpmyownadmin.test/index.php?r=site%2Flogin

    public function actionDel()
    {
        $newCategory = Yii::$app->request->post();
        $category_1 = $this->mapper->map($newCategory, new Category());
        $this->categoryRepository->delete($category_1);
        Yii::$app->session->setFlash('success', 'Category was deleted!');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAddCategory()
    {
        $newCategory = Yii::$app->request->post();

        $category_1 = $this->mapper->map($newCategory, new Category());

        $this->categoryRepository->save($category_1);

        Yii::$app->session->setFlash('success', 'New category was added!'); // работает (в лейауте должно быть включено виджет)
        return $this->redirect(Yii::$app->request->referrer);

    }

    public function actionLogin()
    {
        $this->view->params['test'] = 'Пример пробрасывания из контроллера в лейаут';

        $categories = $this->categoryRepository->findAll();
        $categoryItems = $this->categoryItemRepository->findAll();

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
                'categories' => $categories,
                'categoryItems' => $categoryItems,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

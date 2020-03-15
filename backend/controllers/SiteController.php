<?php
namespace backend\controllers;

use src\Core\Infrastructure\Mapper\Mapper;
use src\Modules\Category\Domain\Entity\Category;
use src\Modules\Category\Domain\Entity\CategoryItem;
use src\Modules\Category\Domain\Entity\ItemUrl;
use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use Yii;
use yii\web\Controller;
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
     *
     * @param $id
     * @param $module
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CategoryItemRepositoryInterface $categoryItemRepository
     * @param array $config
     */
    private $categoryRepository;
    private $categoryItemRepository;
    private $mapper;
    private $itemUrlRepository;

    public function __construct(
        $id,
        $module,
        CategoryRepositoryInterface $categoryRepository,
        CategoryItemRepositoryInterface $categoryItemRepository,
        ItemUrlRepositoryInterface $itemUrlRepository,
        Mapper $mapper,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->categoryRepository = $categoryRepository;
        $this->categoryItemRepository = $categoryItemRepository;
        $this->mapper = $mapper;
        $this->itemUrlRepository = $itemUrlRepository;
    }

//    public function actionIndex()
//    {
//        return $this->redirect('site/login');
//    }

//http://admin.phpmyownadmin.test/index.php?r=site%2Flogin

    public function actionDelItem()
    {
        $delItem = Yii::$app->request->post();

        if ($delItem['item_name'] == '')
        {
            Yii::$app->session->setFlash('success', 'Пытаешься удалить? Тут пусто!');
        }else
        {
            $delItemMap = $this->mapper->map($delItem, new CategoryItem());
            $this->categoryItemRepository->deleteItem($delItemMap);
            Yii::$app->session->setFlash('success', 'Item was deleted!');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionDel()
    {
        $newCategory = Yii::$app->request->post();

        if ($newCategory['category_name'] == '')
        {
            Yii::$app->session->setFlash('success', 'Пытаешься удалить? Тут пусто!');
        }else
        {
            $category_1 = $this->mapper->map($newCategory, new Category());
            $this->categoryRepository->delete($category_1);
            Yii::$app->session->setFlash('success', 'Category was deleted!');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAddCategoryItem()
    {
        $newItem = Yii::$app->request->post();

        if ($newItem['item_name'] == '' || $newItem['category_name'] == '')
        {
            Yii::$app->session->setFlash('success', 'Поле не заполнено!');
        }else
        {
            $categories = $this->categoryRepository->findOneByCategoryName($newItem['category_name']);
            $id_category = $categories->id; //Тут хранится id соответствующей категории

            $categoryItem_1 = $this->mapper->map($newItem, new CategoryItem());
            $categoryItem_1->id_category = $id_category;

            $this->categoryItemRepository->save($categoryItem_1);
            Yii::$app->session->setFlash('error', 'Готово, item добавлен!');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionAddCategory()
    {
        $newCategory = Yii::$app->request->post();

        if ($newCategory['category_name'] == '')
        {
            Yii::$app->session->setFlash('success', 'Поле не заполнено!');
        }else
        {
            $category_1 = $this->mapper->map($newCategory, new Category());

            $this->categoryItemRepository->save($category_1);
            Yii::$app->session->setFlash('success', 'New category was added!'); // работает (в лейауте должно быть включено виджет)
        }

        return $this->redirect(Yii::$app->request->referrer);

    }

    public function actionLogin()
    {
        $a = "Пример пробрасывания";



        $itemUrl = $this->itemUrlRepository->findAll();

        $categories = $this->categoryRepository->findAll();
        $categoryItems = $this->categoryItemRepository->findAll();

        $this->view->params['categories'] = $categories;
        $this->view->params['categoryItems'] = $categoryItems;
        $this->view->params['itemUrl'] = $itemUrl;

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

}

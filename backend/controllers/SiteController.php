<?php
namespace backend\controllers;

use src\Core\Infrastructure\Mapper\Mapper;
use src\Modules\Category\Domain\Entity\Category;
use src\Modules\Category\Domain\Entity\CategoryItem;
use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use Yii;

/**
 * Class SiteController
 * @package backend\controllers
 */

class SiteController extends MyBeforeController
{
    private $mapper;
    private $categoryRepository;
    private $categoryItemRepository;
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
        parent::__construct($id, $module, $categoryRepository, $categoryItemRepository, $itemUrlRepository, $config);
        $this->mapper = $mapper;
        $this->categoryRepository = $categoryRepository;
        $this->categoryItemRepository = $categoryItemRepository;
        $this->itemUrlRepository = $itemUrlRepository;
    }

    public function actionDelItem()
    {
        $delItem = Yii::$app->request->post();

        if ($delItem['item_name'] == '')
        {
            Yii::$app->session->setFlash('error', 'Пытаешься удалить? Тут пусто!');
        }else
        {
            $item = $this->categoryItemRepository->findOneByItemName($delItem['item_name']);

            $this->categoryItemRepository->delete($item);
            Yii::$app->session->setFlash('success', 'Item was deleted!');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDel()
    {
        $newCategory = Yii::$app->request->post();

        if ($newCategory['category_name'] == '')
        {
            Yii::$app->session->setFlash('error', 'Пытаешься удалить? Тут пусто!');
        }else
        {
            $category = $this->categoryRepository->findOneByCategoryName($newCategory['category_name']);
            $this->categoryRepository->delete($category);
            Yii::$app->session->setFlash('success', 'Category was deleted!');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAddCategoryItem()
    {
        $newItem = Yii::$app->request->post();

        if ($newItem['item_name'] == '' || $newItem['category_name'] == '')
        {
            Yii::$app->session->setFlash('error', 'Поле не заполнено!');
        }else
        {
            $categories = $this->categoryRepository->findOneByCategoryName($newItem['category_name']);
            $id_category = $categories->id; //Тут хранится id соответствующей категории

            $categoryItem_1 = $this->mapper->map($newItem, new CategoryItem());
            $categoryItem_1->id_category = $id_category;

            $this->categoryItemRepository->save($categoryItem_1);
            Yii::$app->session->setFlash('success', 'Готово, item добавлен!');
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
        $categories = $this->categoryRepository->findAll();
        $categoryItems = $this->categoryItemRepository->findAll();

        $this->view->params['categories'] = $categories;
        $this->view->params['categoryItems'] = $categoryItems;

        return $this->render('login', [
            'categories' => $categories,
            'categoryItems' => $categoryItems,
        ]);
    }
}

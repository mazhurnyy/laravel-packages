<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 01.10.2017
 * Time: 22:50
 */

namespace Mazhurnyy\Http\Controllers;

use Mazhurnyy\Models\Article as ArticleModel;

/**
 * Class Entities
 * Статья
 *
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{

    /**
     * @var object результаты выборки
     */
    private $article;
    /**
     * @var string
     */
    private $alias;
    /**
     * @var int номер страницы для вывода потомков
     */
    private $page = 1;


    /**
     * Entities constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index($alias)
    {
        $this->alias = $alias;

        $this->getModel();
        $this->setParam();

        // todo облагородить построение крошек
 //       $this->getBreadcrumbs();

        return view('section.article', [
            'article' => $this->article,
            'catalog' => [
                'amount'   => $this->getAmount(),
                'selected' => $this->getAmount(),
                'results'  => $this->getDescendants(),
                'type'     => 'article',
            ],
        ]);
    }

    /**
     * кнопка показать еще
     *
     * @param $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMore($alias)
    {
        $this->page = request()->input('page');

        $this->alias = $alias;

        $this->getModel();

        return view('partials.catalog.cards', [
            'catalog' => [
                'results' => $this->getDescendants(),
                'type'    => 'article',
            ],
        ]);

    }

    /**
     * Находим данные в базе, только опубликованные статьи, если статья в черновике или нет такого алиаса
     * - error проверяем по логу редиректов - нет 404
     */
    private function getModel()
    {
        $this->article = ArticleModel::whereAlias($this->alias)->published()->first();

        if ($this->article === NULL) {
            if (ArticleModel::whereAlias($this->alias)->archive()->first()) {
                abort(403);
            } else {
                abort(404);
            }
        }
    }

    private function setParam()
    {
        \SiteMeta::setMetaTitle($this->article->title);
        \SiteMeta::setMetaDescription($this->article->description);
        \SiteMeta::setMetaKeywords($this->article->keywords);
    }

    /**
     * получаем информацию о потомках статьи
     */
    private function getDescendants()
    {
        return $this->article
            ->getDescendants()
            ->sortBy('position')
            ->forPage($this->page, config('biatron.limit.article'));
    }

    /**
     * Всего количество записей
     * @return mixed
     */
    private function getAmount()
    {
        return $this->article->countDescendants();
    }

    // todo универсальные крошки для универсальных сущностей (локализация, тип для роута, алиас, тайтл)
    private function getBreadcrumbs()
    {
        $ancestors = $this->article->getAncestors();

        foreach ($ancestors as $ancestor) {

            \SiteBlade::setBreadcrumbs([
                'link'  => url('#'),
                'title' => $ancestor->title,
            ]);
        }
    }
}
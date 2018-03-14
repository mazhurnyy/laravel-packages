<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 14.11.2017
 * Time: 15:34
 */

namespace Mazhurnyy\Site\Blade;

/**
 * Class SiteBlade
 * Установка параметров страницы для шаблона
 *
 * @package App\Services
 */
class SiteBlade
{

    /**
     * @var array заголовок страницы
     */
    public $title = [
        'primary'   => '',
        'secondary' => '',
    ];
    /**
     * @var bool наличие левого сайтбара
     */
    public $sidebarLeft = false;
    /**
     * @var bool наличие правого сайтбара
     */
    public $sidebarRight = false;
    /**
     * @var bool наличие истории просмотров на странице
     */
    public $history = false;
    /**
     * @var bool наличие кнопок шары на странице
     */
    public $share = false;
    /**
     * @var array хлебные крошки
     */
    public $breadcrumbs = [];
    /**
     * @var array фильтры на странице
     */
    public $filters = [];

    public $menuSearch = false;

    public $headingAlign;

    /**
     * устанавливаем заголовок страницы
     *
     * @param string $primary
     * @param string $secondary
     */
    public function setTitle($primary, $secondary = '')
    {
        $this->title = [
            'primary'   => $primary,
            'secondary' => $secondary,
        ];
    }

    /**
     * возвращаем заголовок страницы
     *
     * @return array
     */
    public function getTitlePrimary()
    {
        return $this->title['primary'];
    }

    /**
     * возвращаем подзаголовок страницы
     *
     * @return array
     */
    public function getTitleSecondary()
    {
        return $this->title['secondary'];
    }

    /**
     * включаем левый sidebar
     */
    public function setSidebarLeft()
    {
        $this->sidebarLeft = true;
    }

    /**
     * @return bool
     */
    public function getSidebarLeft()
    {
        return $this->sidebarLeft;
    }

    /**
     * включаем правый sidebar
     */
    public function setSidebarRight()
    {
        $this->sidebarRight = true;
    }

    /**
     * @return bool
     */
    public function getSidebarRight()
    {
        return $this->sidebarRight;
    }

    /**
     * отключаем строку поиска в меню
     */
    public function unsetMenuSearch()
    {
        $this->menuSearch = false;
    }

    /**
     * @return bool
     */
    public function getMenuSearch()
    {
        return $this->menuSearch;
    }

    /**
     * отключаем историю просмотров
     */
    public function unsetHistory()
    {
        $this->history = false;
    }

    /**
     * @return bool
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * отключаем историю просмотров
     */
    public function unsetShare()
    {
        $this->share = false;
    }

    /**
     * @return bool
     */
    public function getShare()
    {
        return $this->share;
    }

    /**
     * устанавливаем фильтры
     *
     * @param array $filter
     */
    public function setFilters($filter = [])
    {
        $this->filters[] = $filter;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * устанавливаем фильтры
     *
     * @param array $breadcrumb
     */
    public function setBreadcrumbs($breadcrumb = [])
    {
        $this->breadcrumbs[] = $breadcrumb;
    }

    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }
    /**
     * выравниваем H1 влево
     */
    public function setHeadingLeft()
    {
        $this->headingAlign = 'left';
    }
    /**
     * выравниваем H1 по центру
     */
    public function setHeadingCenter()
    {
        $this->headingAlign = 'center';
    }
    /**
     * @return string
     */
    public  function getHeadingAlign()
    {
        return $this->headingAlign;
    }

}
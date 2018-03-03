<?php

namespace Mazhurnyy\Site\Meta;

/**
 * Class SiteMeta
 * Работа с Мета заголовками
 *
 * @package App\Services
 */
class SiteMeta
{

    /**
     * @var string заголовок страницы
     */
    public $metaTitle;
    /**
     * @var string Описание страницы
     */
    public $metaDescription;
    /**
     * @var string Ключевые слова
     */
    public $metaKeywords;

    /**
     * Установка дефолтного значения
     *
     * SiteMeta constructor.
     */
    public function __construct()
    {
        $this->metaTitle = __('headers.meta.title');
        $this->metaDescription = __('headers.meta.description');
        $this->metaKeywords = __('headers.meta.keywords');
    }

    /**
     * получаем заголовок
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * устанавливаем SiteMeta Title страницы
     * если надо дописать дефолтное значение, - второй параметр TRUE
     *
     * @param string $title
     * @param bool $default
     */
    public function setMetaTitle($title, $default = false)
    {
        $this->metaTitle = $default ? $title : $title . ' | ' . $this->metaTitle;
    }

    /**
     * получаем заголовок
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * устанавливаем SiteMeta description страницы
     * если надо дописать дефолтное значение, - второй параметр TRUE
     *
     * @param string $description
     * @param bool $default
     */
    public function setMetaDescription($description, $default = false)
    {
        $this->metaDescription = $default ? $description : $description . '. ' . $this->metaDescription;
    }

    /**
     * получаем ключевые слова
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * устанавливаем SiteMeta keywords страницы
     * если надо дописать дефолтное значение, - второй параметр TRUE
     *
     * @param string $keywords
     * @param bool $default
     */
    public function setMetaKeywords($keywords, $default = false)
    {
        $this->metaKeywords = $default ? $keywords : $keywords . ', ' . $this->metaKeywords;
    }

}
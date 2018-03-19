<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminColumnFilter;
use AdminDisplay;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;
use Mazhurnyy\Models\Status;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class Entities
 * Редактирование и модерация статей
 *
 * @package App\Http\Sections
 */
class Article extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Статьи';

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-check-square';
    }

    /**
     * роут секции
     *
     * @var string
     */
    protected $alias = 'article';

    /**
     * Переопределение метода содержащего заголовок редактирования записи
     *
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getEditTitle()
    {
        return 'Редактирование/создание статей';
    }

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation($priority = 100);
    }

    /**
     * Вывод вкладок на экран
     *
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setName('article')->with('status');

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');
        $display->setFilters([
            AdminDisplayFilter::related('status_id')->setModel(Status::class),
        ]);

        $display->setOrder([0, 'asc']);

        $display->setColumns([
            AdminColumn::text('name', 'Название статьи'),
            AdminColumn::text('status.title', 'Статус')->append(AdminColumn::filter('status_id')),
            AdminColumn::datetime('created_at', 'Создано')->setFormat('d.m.Y')->setWidth('100px'),
            AdminColumn::datetime('updated_at', 'Обновлено')->setFormat('d.m.Y')->setWidth('100px'),
            AdminColumn::datetime('deleted_at', 'Удалено')->setFormat('d.m.Y')->setWidth('100px'),
        ]);

        $sort = AdminDisplay::tree()->setValue('name')->setOrderField('position');

        $tabs = AdminDisplay::tabbed();
        $tabs->setElements([
            AdminDisplay::tab($display)->setIcon('<i class="fa fa-list"></i>')->setLabel('Список статей'),
            AdminDisplay::tab($sort)->setLabel('Сортировка статей')->seticon('<i class="fa fa-sort"></i>'),

        ]);

        return $tabs;

    }

    /**
     * Обновление комментария
     *
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $tabs = AdminDisplay::tabbed();

        // todo добавить редактирование только ля суперадмина
        $header = AdminFormElement::columns()->addColumn([
            AdminFormElement::text('name', 'Название статьи')->setReadOnly(true),
        ])->addColumn([
            AdminFormElement::text('alias', 'Алиас статьи')->setReadOnly(true),
        ]);

        $body = ([

            AdminFormElement::select('status_id', 'Статус статьи',
                Status::class)->setLoadOptionsQueryPreparer(function ($element, $query) {
                return $query->whereHas('statusArticle');
            })->setDisplay('title')->required(),
            AdminFormElement::ckeditor('note', 'Заметки')->setHeight(100),
        ]);

        $footer = AdminFormElement::columns()->addColumn([
            AdminFormElement::text('created_at', 'Создано')->setReadOnly(true),
        ])->addColumn([
            AdminFormElement::text('updated_at', 'Обновлено')->setReadOnly(true),
        ])->addColumn([
            AdminFormElement::text('deleted_at', 'Удалено')->setReadOnly(true),
        ]);

        $info = AdminForm::panel()->addHeader($header)->addBody($body)->addFooter($footer);

        $lang_ru = AdminForm::form()->setElements([
            AdminFormElement::text('title:ru', 'Заголовок статьи')->required(),
            AdminFormElement::text('keywords:ru', 'Ключевые слова'),
            AdminFormElement::text('description:ru', 'Описание для мета'),
            AdminFormElement::ckeditor('preview:ru', 'Анонс статьи'),
            AdminFormElement::ckeditor('text:ru', 'Текст статьи'),
        ]);

        $lang_uk = AdminForm::form()->setElements([
            AdminFormElement::text('title:uk', 'Заголовок статті')->required(),
            AdminFormElement::text('keywords:uk', 'Ключові слова'),
            AdminFormElement::text('description:uk', 'Опис для мета'),
            AdminFormElement::ckeditor('preview:uk', 'Анонс статті'),
            AdminFormElement::ckeditor('text:uk', 'Текст статті'),
        ]);

        $tabs->appendTab($info, 'Общая информация');
        $tabs->appendTab($lang_ru, 'Тексты на русском');
        $tabs->appendTab($lang_uk, 'Тексты на украинском');
 //       $tabs->appendTab($photo, 'Фотографии');

        return $tabs;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        $status_id = Status::whereAlias('draft')->first()->id;

        $form = AdminForm::form()->setElements([
            AdminFormElement::text('name', 'Название статьи')->required()->unique(),
            AdminFormElement::hidden('status_id')->setDefaultValue($status_id),
        ]);

        return $form;
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
//
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
//
    }

}

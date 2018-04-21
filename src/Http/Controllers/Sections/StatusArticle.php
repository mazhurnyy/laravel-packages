<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 07.10.2017
 * Time: 19:44
 */

namespace Mazhurnyy\Http\Sections;

use AdminColumn;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Status;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Статусы статей
 * Class StatusArticle
 *
 * @package App\Http\Sections
 */
class StatusArticle extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Статусы статей';

    /**
     * @var string
     */
    protected $alias = 'status_article';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(function () {
            $page = \AdminNavigation::getPages()->findById('status');

            $page->addPage($this->makePage(25)->setIcon('fa fa-check-square'));
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::table();

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');

        $display->setApply(function ($query) {
            $query->orderBy('order', 'asc');
        });

        $display->setColumns([
            AdminColumn::text('status.title:ru', 'Название статуса - ru'),
            AdminColumn::text('status.title:uk', 'Назва статусу - uk'),
            AdminColumn::text('status.alias', 'Алиас'),
            AdminColumn::order()->setLabel('Сортировка')->setHtmlAttribute('class', 'text-center')->setWidth('100px'),
        ])->disablePagination();

        return $display;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::form()->setElements([
            AdminFormElement::select('status_id', 'Статус статьи', Status::class)
                ->setDisplay('title')->required()->unique(),
            AdminFormElement::columns()->addColumn([
                AdminFormElement::text('created_at', 'Создано')->setReadOnly(true),
            ])->addColumn([
                AdminFormElement::text('updated_at', 'Обновлено')->setReadOnly(true),
            ])->addColumn([
                AdminFormElement::text('deleted_at', 'Удалено')->setReadOnly(true),
            ]),
        ]);

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
    }

}

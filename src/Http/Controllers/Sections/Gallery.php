<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 04.01.2018
 * Time: 17:02
 */

namespace Mazhurnyy\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminColumnFilter;
use AdminDisplay;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;
use App\Models\User;

/**
 * Корпуса
 * Class Department
 *
 * @package App\Http\Sections
 */
class Gallery extends Section implements Initializable
{
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Галереи';

    /**
     * @var string
     */
    protected $alias = 'gallery';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation($priority = 100);
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-image';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::datatables();

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');
//        $display->with('user');
        $display->setApply(
            function ($query)
                {
                $query->orderBy('name', 'asc');
                }
        );
        $display->setFilters(
            [
                AdminDisplayFilter::related('user_id')->setModel(User::class),
            ]
        );
        /*
        $display->setFilters(
   //         AdminDisplayFilter::scope('my')   // выводим только мои галереи
        );
*/
        $display->setColumns(
            [
                AdminColumnEditable::text('name', 'Название галереи'),
                AdminColumn::text('user.name', 'Пользователь')->append(AdminColumn::filter('user_id')),
                AdminColumn::datetime('created_at', 'Создана')->setFormat('d.m.Y H:i'),
                AdminColumn::datetime('updated_at', 'Обновлена'),
                AdminColumn::datetime('used_at', 'Использовалась'),
            ]
        )->disablePagination();

        return $display;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {

        $path = 'gallery/' . \Auth::user()->id . '/' . $id . '/preview/';

        $form = AdminForm::form()->setElements(
            [
                AdminFormElement::text('name', 'Название галереи')->required()->unique(),

                AdminFormElement::images('images', 'Добавить изображения')->setSaveCallback(
                    function ($file) use ($id, $path)
                        {
                        $path .= \SaveFile::uploadPhotoGallery($id, $file) . '.jpg';
                        return ['path' => $path, 'value' => $path];
                        }
                ),

                AdminFormElement::columns()->addColumn(
                    [AdminFormElement::text('created_at', 'Создана')->setReadOnly(true),]
                )->addColumn([AdminFormElement::text('updated_at', 'Обновлена')->setReadOnly(true),])->addColumn(
                    [AdminFormElement::text('deleted_at', 'Удалена')->setReadOnly(true),]
                )->addColumn([AdminFormElement::text('used_at', 'Использовалась')->setReadOnly(true),]),
            ]
        );

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        $form = AdminForm::form()->setElements(
            [
                AdminFormElement::text('title', 'Название галереи')->required(),
                //ID пользователя, добавившего галерею
                AdminFormElement::hidden('user_id')->setDefaultValue(\Auth::id()),
            ]
        );

        return $form;
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 21.04.2017
 * Time: 23:02
 */

namespace App\Services;

use App\ModelFilters\FilterSettings;

/**
 * Class Filters
 * выбор фильтров в зависимости от текущего роута
 * $filters - все доступные фильтры
 * setFilterSection - подключаем нужные фильтры к разделам сайта (заносим имя в массив)
 *
 * доступные фильтры
 * order, biography, photo, books, country, lang, lang_scr, activities, ads, content, comment,
 *
 * фильтры для разделом подключаются в конфиге (config.filters), настройки конкретного фильтра в FilterSettings
 *
 * @package App\Http\Middleware
 */
class Filters extends FilterSettings
{
    /**
     * @var array массив фильтров, доступный на страницы и выбранные значения
     */
    private $filters = [];
    /**
     * @var array выбранные значения текущей группы фильтров
     */
    private $selected = [];
    /**
     * @var string путь к секции без фильтра
     */
    public $sectionUrl = '';
    /**
     * @var string имя фильтра, для которого собираем массив фильтров
     */
    private $filtersGroup = '';
    /**
     * @var array части текущего фильтра для урала
     */
    private $currentUrl = [];
    /**
     * @var string строка фильтров
     */
    private $string;

    /**
     * Возвращаем настройки фильтров для выбранной группы
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @return string возвращаем имя текущей группы фильтров
     */
    public function getFiltersGroupName()
    {
        return $this->filtersGroup;
    }

    /**
     * @return string возвращаем урл текущей секции
     */
    public function getSectionUrl()
    {
        return $this->sectionUrl;
    }

    /**
     * возвращаем строку выбранных фильтров
     * @param array $selected
     * @return string
     */
    public function getStrSelectedFilters($selected = [])
    {
        $result = '';

        if(!empty($this->string)) {
            foreach ($this->filters AS $items) {
                $selected[] = mb_strtolower($items['name'] . ': ' . $items['selected']['name']);
            }
            $result = ' (' . implode(', ', $selected) . ')';

        }
        return $result;
    }

    /**
     *
     * @param $prefix string устанавливаем урл для текущей секции, если надо, добавляем урл переменными специфичными для секции
     */
    public function setSectionUrl($prefix = '')
    {
        $this->sectionUrl = $prefix ?? '/' . $prefix;
    }

    /**
     * Собираем доступные фильтры для текущего роута, и возвращаем в контроллер
     *
     * @param $filtersGroup string текущая группа фильтров
     * @return array|bool|\Illuminate\Support\Collection
     */
    public function setFilters($filtersGroup = '')
    {
        $this->filtersGroup = $filtersGroup;
        $this->sectionUrl = $filtersGroup;

        $this->filters = $this->setFiltersGroup();
        $this->setInputFilters();                                  //  получаем значения фильтра с URL
        foreach ($this->filters as $key => $value) {
            $this->setSelectedFilters($key);
        }
        $this->getUrlArray();
        $this->getUrlFilters();

        return $this->selected;
    }

    /**
     * формируем массив фильтров для текущей секции
     * имена фильтров для текущей группы хранятся в конфиге
     *
     * @param array $filters
     * @return array
     */
    private function setFiltersGroup($filters = [])
    {
        foreach (config('filters.' . $this->filtersGroup . '.name') as $item) {
            $called_method = 'set' . $item;
            $filters[$item] = config('filters.default');
            foreach ($this->$called_method() as $key => $value) {
                $filters[$item][$key] = $value;
            }
            $filters[$item]['alias'] = $item;
        }

        return $filters;
    }

    /**
     * получаем значения фильтра со строки
     */
    private function setInputFilters()
    {
        $this->string = request()->route('filters');
        if (!empty($this->string)) {
            if (starts_with($this->string, '_')) {
                foreach (explode('_', mb_substr($this->string, 1)) AS $filter) {
                    list($key, $items) = explode('-', $filter, 2);

                    if (strpos($items, '-') === FALSE)                              //  массив значений
                    {
                        if ($this->validationFilters($key, $items)) {
                            $this->selected[$key][] = $items;
                        }
                    } else {
                        $item = explode('-', $items);
                        foreach ($item AS $value) {
                            //                          dump($value);
                            if ($this->validationFilters($key, $value)) {
                                $this->selected[$key][] = $value;
                            }
                        }
                    }
                }
            } else                                                                       //  это не фильтр -> 404
            {
                abort(404, 'Строка фильтров не фильтр');
            }
        }
    }

    /**
     * проверка если значение не выбранно, устанавливаем по дефолту
     * @param $key
     */
    private function setSelectedFilters($key)
    {
        if (!isset($this->selected[$key])) {
            $this->selected[$key] = $this->filters[$key]['default'];
            $this->filters[$key]['selected'] = [
                'value' => $this->filters[$key]['default'],
                'name' => $this->getTitleCurrentValue($this->filters[$key]['meanings'],
                    $this->filters[$key]['default'][0]),
            ];
        } else {
            $this->filters[$key]['selected'] = [
                'value' => $this->selected[$key],
                'name' => $this->getTitleCurrentValue($this->filters[$key]['meanings'], $this->selected[$key][0]),
            ];
        }
    }

    /**
     * проверка введенных фильтров на соответствие фильтрам, прописанным для текущей секции
     * @param $key string имя фильтра
     * @param $value string выбранное значение
     * @return bool
     */
    private function validationFilters($key, $value)
    {
        if (isset($this->filters[$key]))  // проверка существования фильтра
        {
            // todo переделать проверку доступных значений
            if (isset($this->filters[$key]['meanings']['value'][$value])) // проверка существования значения фильтра
            {
                return true;
            }
        }

        return true;
        //       abort(404, 'Не корректный фильтр');;
    }

    /**
     * Преобразуем массив POST запроса фильтра в строку
     *
     * @param string $string
     * @return string
     */
    public function setFilterString($string = '')
    {
        $setFilters = request()->except([
            '_token',
            'filtersGroup',
            'text',
        ]);

        if (count($setFilters) > 0) {
            foreach ($setFilters AS $key => $items) {
                if (is_array($items)) {
                    $value = '';
                    foreach ($items as $item) {
                        $value .= '-' . $item;
                    }
                    $string .= '_' . $key . $value;
                } else {
                    $string .= '_' . $key . '-' . $items;
                }
            }
        }

        return $string;
    }

    /**
     * строим массив значения урла по текущему фильтру
     */
    private function getUrlArray()
    {
        foreach ($this->filters AS $key => $value) {
            if (!empty($this->selected[$key])) {
                $this->currentUrl[] = '_' . $key . '-' . implode('-', $this->filters[$key]['selected']['value']);
            } else {
                $this->currentUrl[] = '';
            }
        }
    }

    /**
     * формируем строку фильтров для текущего роута
     * @param int $number_filter
     * @param int $number_value
     */
    private function getUrlFilters($number_filter = 0, $number_value = 0)
    {
        $count = count($this->filters);
        foreach ($this->filters AS $k => $items) {
            $number_value = 0;
            foreach ($items['meanings'] AS $key => $item) {
                $this->filters[$k]['meanings'][$number_value]['url'] = $this->setUrlCurrent($count, $number_filter,
                    '_' . $k . '-' . $item['value']);
                $number_value++;
            }
            $number_filter++;
        }
    }

    /**
     * Собираем строку фильтров, с учетом примененного фильтра
     * @param $count int    количество фильтров в разделе
     * @param $number_filter int    порядковый номер фильтра в разделе
     * @param $str string   строка примененногоо фильтра
     * @param $string_url string   строка собранного фильтра, с учетом примененного фильтра
     * @return string
     */
    private function setUrlCurrent($count, $number_filter, $str, $string_url = '')
    {
        for ($i = 0; $i < $count; $i++) {
            if ($i == $number_filter) {
                $string_url .= $str;
            } elseif ($this->currentUrl[$i] != $str) {
                $string_url .= $this->currentUrl[$i];
            }
        }

        return $string_url;

    }

    /**
     * возвращаем название значения текущего фильтра
     * @param $items array значения текущего фильтра
     * @param $value string текущее значение фильра
     * @return string
     */
    private function getTitleCurrentValue($items, $value)
    {
        foreach ($items as $item) {
            //          dump($item['value'].'==');
            //          dump(  $value);
            if ($item['value'] == $value) {
                return $item['title'];
            }
        }

    }

}
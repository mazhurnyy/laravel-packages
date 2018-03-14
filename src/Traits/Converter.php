<?php

namespace Mazhurnyy\Traits;

/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 29.04.2017
 * Time: 22:33
 */
trait Converter
{
    /**
     * конвертируем числовое выражение месяца в строковое
     * @param $month
     * @return mixed|null
     */
    function numberToMonth($month)
    {
        $month = (int)$month;
        if (empty($month) && $month < 0 && $month > 12) {
            return null;
        } else {
            $month_str = $this->monthStr();
            return $month_str[$month];
        }
    }

    /**
     * массив месяцев в родительном падеже
     * @return array
     */
    public function monthStr()
    {
        return [
            __('converter.month.0'),
            __('converter.month.1'), __('converter.month.2'), __('converter.month.3'),
            __('converter.month.4'), __('converter.month.5'), __('converter.month.6'),
            __('converter.month.7'), __('converter.month.8'), __('converter.month.9'),
            __('converter.month.10'), __('converter.month.11'), __('converter.month.12'),

        ];
    }

    public function str2url($str)
    {
        // переводим в транслит
        $str = $this->rus2translit($str);
        // в нижний регистр
        $str = mb_strtolower($str);
        // заменям все ненужное нам на "_"
        $str = preg_replace('~[^a-z0-9_\(\)\'`\-\/]+~u', '_', $str);
        $str = str_replace('__', '_', $str);
        // удаляем начальные и конечные '_'
        $str = trim($str, "_");
        return $str;
    }

    private function rus2translit($string)
    {
        $converter = [
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'jo', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'jj', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'kh', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shh',
            'ь' => '', 'ы' => 'y', 'ъ' => '',
            'э' => 'eh', 'ю' => 'ju', 'я' => 'ja',
            'і' => 'i', 'ї' => 'ji', 'є' => 'je',
            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'Jo', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Jj', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'Kh', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Shh',
            'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
            'Э' => 'Eh', 'Ю' => 'Ju', 'Я' => 'Ja',
            'І' => 'I', 'Ї' => 'Ji', 'Є' => 'Je',
            ' ' => '_', '…' => '', '-' => '_',
            "«" => "", '»' => "", '.' => '',
            '„' => '', '”' => '', '№' => '#',
            '(' => '', ')' => '', '`' => '',
            ',' => '_', '—' => '_', '’' => '',
            '`' => '', "'" => '_', '&ndash;' => '_',
            '?' => '', '&#96' => '', '&mdash;' => '_',
            '/' => '_', '*' => '0'
        ];
        return strtr($string, $converter);
    }


}

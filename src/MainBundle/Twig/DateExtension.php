<?php


namespace MainBundle\Twig;

use DateTime;
use Twig_SimpleFilter;

class DateExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('date_russian_month', function ($date) {
                $months = array(1 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
                $date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
                $key = $date->format('n');
                return $date->format('d ' . $months[$key] . ' Y');
            }),
        );
    }
//    public function dateFilter()
//    {
////        $filter = new Twig_SimpleFilter('date_russian_month', function ($date) {
////            $months = array(1 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
////            $date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
////            $key = $date->format('n');
////            return $date->format('d ' . $months[$key] . ' Y');
////        });
//
//        return $filter;
//    }
}
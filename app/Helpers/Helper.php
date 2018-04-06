<?php

namespace App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Helper
{

    public static function number_order($current_page, $per_page, $key, $suffix = ".")
    {
        return ($per_page * ($current_page - 1) + $key + 1) . $suffix;
    }

    public static function convertGroupUser($group_id)
    {
        if ($group_id == 1) return __('messages.group_1');
        elseif ($group_id == 2) return __('messages.group_2');
        elseif ($group_id == 3) return __('messages.group_3');
    }

    public static function convertActived($actived)
    {
        if ($actived == 1) return __('messages.active_1');
        elseif ($actived == 2) return __('messages.active_2');
        elseif ($actived == 3) return __('messages.active_3');
    }

    public static function convertSex($sex)
    {
        if ($sex == 1) return __('messages.sex_1');
        elseif ($sex == 2) return __('messages.sex_2');
        else if ($sex == 3) return __('messages.sex_3');
    }

    public static function convertStatus($status)
    {
        if ($status == 0) return __('messages.status_0');
        elseif ($status == 1) return __('messages.status_1');
    }

    public static function rip_tags($string)
    {
        $string = preg_replace('/<[^>]*>/', ' ', $string);

        // ----- remove control characters -----
        $string = str_replace("\r", '', $string);    // --- replace with empty space
        $string = str_replace("\n", ' ', $string);   // --- replace with space
        $string = str_replace("\t", ' ', $string);   // --- replace with space

        // ----- remove multiple spaces -----
        $string = trim(preg_replace('/ {2,}/', ' ', $string));

        return $string;

    }

    public static function sub($description, $maxLength)
    {
        return subDescription($description, $maxLength);
    }

    public static function subDescription($description, $link, $maxLength = 300, $readmore = true)
    {
        if ($maxLength <= 0) return '';
        $descriptionText = self::rip_tags($description);
        if ($maxLength >= strlen($descriptionText)) {
            return trim($descriptionText);
        }
        $arrWordsDesciption = explode(' ', substr($descriptionText, 0, $maxLength));
        if (count($arrWordsDesciption) <= 1) {
            $list = explode(' ', $descriptionText);
            if (strlen($list[0]) > $maxLength) {
                return '';
            }
            return $list[0];
        }
        $count = count($arrWordsDesciption) - 2;
        if ($maxLength == strlen($descriptionText) || ($maxLength + 1 < strlen($descriptionText) && substr($descriptionText, $maxLength, 1) === ' ')) {
            $count = $count + 1;
        }
        $rs = '';
        for ($i = 0; $i <= $count; $i++) {
            $rs = $rs . $arrWordsDesciption[$i] . ' ';
        }
        if ($readmore) {
            $link = "<br><a href='$link'>  >> " . __('messages.read_more') . "</a>";
        } else {
            $link = " ...";
        }
        return trim($rs) . $link;
    }

    public static function formatCategories($categories, $separator = ', ')
    {
        $html = '';
        foreach ($categories as $category) {
            if (empty($html)) $html = $category->name;
            else $html .= $separator . $category->name;
        }
        return $html;
    }
}

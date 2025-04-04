<?php

use App\Models\NotificationType;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image; 

if (!function_exists('timeInHumanReading')) {
    function timeInHumanReading($date)
    { 
        Carbon::setLocale('ar');
        $formattedDate = Carbon::parse($date);
        
        // Get the current date and time
        $now = Carbon::now();
        
        // Calculate the difference
        $difference = $formattedDate->diffForHumans([
            'parts' => 3,  // Limit to the most significant time parts
            'short' => true, // Set to true if you prefer abbreviations like "1m ago"
            'join' => ', ',
            'options' => Carbon::JUST_NOW // Handle "just now" for very recent times
        ]);
        
        // Output the result
        return str_replace('منذ ','',$difference);
    }
}

if (!function_exists('calculate_diff_date_old')) {
    function calculate_diff_date_old($date) {
        date_default_timezone_set('Asia/Riyadh');
    
        $formattedTime = date('h:i a', strtotime($date)); // 12-hour format (am/pm)
        $currentDate = new DateTime();
        $givenDate = new DateTime($date);
        $difference = $givenDate->diff($currentDate);
    
        if ($difference->y > 0) {
            // More than a year ago
            return getmonth_name($givenDate->format('m')) . " " . $givenDate->format('d, Y');
        }
        if ($difference->m > 0 || $difference->d > 1) {
            // More than a month or more than a day ago
            return getmonth_name($givenDate->format('m')) . " " . $givenDate->format('d') . " at " . $formattedTime;
        }
        if ($difference->d === 1) {
            // Yesterday
            return "Yesterday at " . $formattedTime;
        }
        if ($difference->h > 0) {
            // Hours ago
            return $difference->h . " ساعة";
        }
        if ($difference->i > 1) {
            // Minutes ago
            return $difference->i . " دقيقة";
        }
    
        // Just now
        return "ثانية";
    }
} 

if (!function_exists('combinations')) {
    function combinations($arrays)
    {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }
} 

if (!function_exists('getRequest')) {
    function getRequest($key,$default = null){
        return request()->has($key) && request($key) !== null ? request($key) : $default;
	}
}

if (!function_exists('randomCreatedAt')) {
    function randomCreatedAt(){
        $faker = \Faker\Factory::create('ar_SA');
        return $faker->dateTimeBetween('-3 years', '+1 year')->format('Y-m-d').' '.$faker->time('H:i:s');
    }
}

if (!function_exists('getmonth_name')) {
    function getmonth_name($monthNum){
		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
		$monthName = $dateObj->format('F');
		return $monthName;
	}
}

if (!function_exists('get_notification_type')) {
    function get_notification_type($value, $columnName)
    {
        $notificationType = NotificationType::query();
        $notificationType = $columnName == 'id' ? $notificationType->where('id', $value) : $notificationType->where('type', $value);
        return $notificationType->first();
    }
}

if (!function_exists('calculate_diff_date')) {
    function calculate_diff_date($date) {
        $strStart = new DateTime($date);
        $strEnd = new DateTime();
        $dteDiff = $strStart->diff($strEnd);
    
        $months = monthsToSelect(); // Assuming this returns an array of month names.
    
        // Handle years and months difference.
        if ($dteDiff->y > 0) {
            return $months[(int) $strStart->format('m')] . " " . $strStart->format('Y');
        }
        if ($dteDiff->m > 0 || $dteDiff->d > 1) {
            return $months[(int) $strStart->format('m')] . " " . $strStart->format('d');
        }
    
        // Handle recent differences.
        if ($dteDiff->d == 1) {
            return "أمس";
        }
        if ($dteDiff->h > 0) {
            return $dteDiff->h . " ساعة";
        }
        if ($dteDiff->i > 0) {
            return $dteDiff->i . " دقيقة";
        }
    
        // Default to seconds.
        return "ثانية";
    }
}

if (!function_exists('yearsToSelect')) {
    function yearsToSelect(): array
    {
        $years = [];
        $last_year = date('m') >= 7 ? date('Y') : date('Y') - 1;
        for ($i = $last_year; $i >= 1950 ; $i--) {
            $years[] = $i;
        }
        return $years;
    }
}

if (!function_exists('monthsToSelect')) {
    function monthsToSelect()
    {
        return [
            1 => 'يناير',
            2 => 'فبراير',
            3 => 'مارس',
            4 => 'أبريل',
            5 => 'مايو',
            6 => 'يونيو',
            7 => 'يوليو',
            8 => 'أغسطس',
            9 => 'سبتمبر',
            10 => 'أكتوبر',
            11 => 'نوفمبر',
            12 => 'ديسمبر',
        ];
    }
} 

if (!function_exists('currentEditingLang')) {
    function currentEditingLang()
    {
        return request('lang',app()->getLocale());
    }
}  

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null,$lang = false)
    {
        $settings = Cache::remember('business_settings', 86400, function () {
            return Setting::all();
        });

        if ($lang == false) { 
            $setting = $settings->where('key', $key)->first();
        } else {
            $setting = $settings->where('key', $key)->where('lang', $lang)->first();
            $setting = !$setting ? $settings->where('key', $key)->first() : $setting;
        }  

        return $setting == null ? $default : $setting->value;
    }
} 
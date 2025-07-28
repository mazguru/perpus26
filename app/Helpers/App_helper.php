<?php

use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\IncomingRequest;

if (!function_exists('_isNaturalNumber')) {
    function _isNaturalNumber($n)
    {
        return ($n != 0 && ctype_digit((string) $n));
    }
}

if (!function_exists('_toInteger')) {
    function _toInteger($n)
    {
        return abs(intval(strval($n)));
    }
}

if (!function_exists('copyright')) {
    function copyright($year = '', $link = '', $company_name = '')
    {
        if (!_isValidYear($year)) return;
        $str = 'Copyright &copy; ';
        $str .= date('Y') > $year ? $year . ' - ' . date('Y') : $year;
        $str .= '<a href="';
        $str .= $link == '' ? base_url() : $link;
        $str .= '"> ';
        $str .= $company_name == '' ? str_replace(['http://', 'https://', 'www.'], '', rtrim(base_url(), '/')) : $company_name;
        $str .= '</a> All rights reserved.';
        return $str;
    }
}

if (!function_exists('filesize_formatted')) {
    function filesize_formatted($size)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}

if (!function_exists('create_dir')) {
    function create_dir($dir)
    {
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, true)) {
                die('Tidak dapat membuat folder : ' . $dir);
            }
        }
    }
}

if (!function_exists('extract_themes')) {
    function extract_themes()
    {
        $zip = new ZipArchive;
        $zip->open(APPPATH . '../views/themes/default.zip');
        @chmod(APPPATH . '../views/themes', 0775);
        $zip->extractTo(APPPATH . '../views/themes/');
        @chmod(APPPATH . '../views/themes/default/', 0775);
        $zip->close();
    }
}

if (!function_exists('get_options')) {
    function get_options($option_group = '', $encode = true)
    {
        $model = model('App\Models\M_options');
        $options = $model->get_options($option_group);
        return $encode ? json_encode($options, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES) : $options;
    }
}

if (!function_exists('get_option_id')) {
    function get_option_id($option_group = '', $option_name = '')
    {
        $model = model('App\Models\M_options');
        return _toInteger($model->get_option_id($option_group, $option_name));
    }
}

if (!function_exists('__session')) {
    function __session($key = null, $value = null)
    {
        $session = session();
        if ($key === null) return $session->get();
        if ($value !== null) $session->set($key, $value);
        return $session->get($key);
    }
}

if (!function_exists('encode_str')) {
    function encode_str($str)
    {
        $encrypter = Services::encrypter();
        $ret = $encrypter->encrypt($str);
        return strtr(base64_encode($ret), ['+' => '.', '=' => '-', '/' => '~']);
    }
}

if (!function_exists('decode_str')) {
    function decode_str($str)
    {
        $encrypter = Services::encrypter();
        $str = strtr($str, ['.' => '+', '-' => '=', '~' => '/']);
        return $encrypter->decrypt(base64_decode($str));
    }
}

if (!function_exists('indo_date')) {
    function indo_date($date)
    {
        if (_isValidDate($date)) {
            $parts = explode("-", $date);
            return $parts[2] . ' ' . bulan($parts[1]) . ' ' . $parts[0];
        }
        return '';
    }
}

if (!function_exists('english_date')) {
    function english_date($date)
    {
        if (_isValidDate($date)) {
            $parts = explode("-", $date);
            return $parts[2] . ', ' . month($parts[1]) . ' ' . $parts[0];
        }
        return '';
    }
}

if (!function_exists('day_name')) {
    function day_name($idx)
    {
        $arr = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu', 'Minggu'];
        return $arr[$idx];
    }
}

if (!function_exists('_isValidDate')) {
    function _isValidDate($date)
    {
        if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts)) {
            return checkdate($parts[2], $parts[3], $parts[1]);
        }
        return false;
    }
}

if (!function_exists('_isValidYear')) {
    function _isValidYear($year)
    {
        $year = _toInteger($year);
        return $year >= 1000 && $year <= 9999;
    }
}

if (!function_exists('_isValidMonth')) {
    function _isValidMonth($month)
    {
        $month = _toInteger($month);
        return $month >= 1 && $month <= 12;
    }
}

if (!function_exists('bulan')) {
    function bulan($key = '')
    {
        $data = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        return $key === '' ? $data : $data[$key];
    }
}

if (!function_exists('month')) {
    function month($key = '')
    {
        $data = [
            '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
            '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
            '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
        ];
        return $key === '' ? $data : $data[$key];
    }
}

if (!function_exists('get_ip_address')) {
    function get_ip_address()
    {
        return request()->getServer('HTTP_X_FORWARDED_FOR') ?? request()->getServer('REMOTE_ADDR');
    }
}

if (!function_exists('check_internet_connection')) {
    function check_internet_connection()
    {
        return checkdnsrr('google.com');
    }
}

if (!function_exists('array_date')) {
    function array_date($start_date, $end_date)
    {
        if (!_isValidDate($start_date) || !_isValidDate($end_date)) return [];

        $start_date = strtotime($start_date);
        $end_date = strtotime($end_date);

        if ($start_date > $end_date) return array_date(date('Y-m-d', $end_date), date('Y-m-d', $start_date));

        $dates = [];
        do {
            $dates[] = date('Y-m-d', $start_date);
            $start_date = strtotime("+1 day", $start_date);
        } while ($start_date <= $end_date);

        return $dates;
    }
}

if (!function_exists('delete_cache')) {
    function delete_cache()
    {
        helper('filesystem');
        $path = WRITEPATH . 'cache';
        $files = directory_map($path, FALSE, TRUE);
        foreach ($files as $file) {
            if ($file !== 'index.html' && $file !== '.htaccess') {
                @chmod($path . '/' . $file, 0777);
                @unlink($path . '/' . $file);
            }
        }
    }
}

if (!function_exists('alpha_dash')) {
    function alpha_dash($str)
    {
        return preg_match("/^([-a-z0-9_])+$/i", $str) ? true : false;
    }
}

if (!function_exists('slugify')) {
    function slugify($str)
    {
        $lettersNumbersSpacesHyphens = '/[^\-\s\pN\pL]+/u';
        $spacesDuplicateHypens = '/[\-\s]+/';
        $str = preg_replace($lettersNumbersSpacesHyphens, '', $str);
        $str = preg_replace($spacesDuplicateHypens, '-', $str);
        return strtolower(trim($str, '-'));
    }
}

if (!function_exists('timezone_list')) {
    function timezone_list()
    {
        $regions = [DateTimeZone::ASIA];
        $timezones = [];
        foreach ($regions as $region) {
            $timezones = array_merge($timezones, DateTimeZone::listIdentifiers($region));
        }
        $timezone_offsets = [];
        foreach ($timezones as $timezone) {
            $tz = new DateTimeZone($timezone);
            $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
        }
        asort($timezone_offsets);
        $timezone_list = [];
        foreach ($timezone_offsets as $timezone => $offset) {
            $offset_prefix = $offset < 0 ? '-' : '+';
            $offset_formatted = gmdate('H:i', abs($offset));
            $pretty_offset = "UTC${offset_prefix}${offset_formatted}";
            $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
        }
        return $timezone_list;
    }
}

if (!function_exists('__captchaActivated')) {
    function __captchaActivated()
    {
        return __session('recaptcha_status') === 'enable';
    }
}

if (!function_exists('enkripsi')) {
    function enkripsi($string)
    {
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'abcdefghijklmnopqrstuvwxyzABNCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+|}{:?><';
        $secret_iv = 'abcdefghijklmnopqrstuvwxyzABNCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+|}{:?><';

        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        return base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    }
}

if (!function_exists('dekripsi')) {
    function dekripsi($string)
    {
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'abcdefghijklmnopqrstuvwxyzABNCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+|}{:?><';
        $secret_iv = 'abcdefghijklmnopqrstuvwxyzABNCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+|}{:?><';

        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        return openssl_decrypt(base64_decode($string ?? ''), $encrypt_method, $key, 0, $iv);
    }
}

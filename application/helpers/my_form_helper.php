<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('hash_password')) {

    function hash_password($password) {
        return hash("sha256", $password);
    }

}

if (!function_exists('title_slug_name')) {

    function title_slug_name($title = "") {
        $slugtitle = str_replace(" ", "-", strtolower(trim($title)));
        return $slugtitle;
    }

}
if (!function_exists('get_random_password')) {

    /**
     * Generate a random password. 
     * 
     * get_random_password() will return a random password with length 6-8 of lowercase letters only.
     *
     * @access    public
     * @param    $chars_min the minimum length of password (optional, default 6)
     * @param    $chars_max the maximum length of password (optional, default 8)
     * @param    $use_upper_case boolean use upper case for letters, means stronger password (optional, default false)
     * @param    $include_numbers boolean include numbers, means stronger password (optional, default false)
     * @param    $include_special_chars include special characters, means stronger password (optional, default false)
     *
     * @return    string containing a random password 
     */
    function get_random_password($chars_min = 6, $chars_max = 8, $use_upper_case = false, $include_numbers = false, $include_special_chars = false) {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if ($include_numbers) {
            $selection .= "1234567890";
        }
        if ($include_special_chars) {
            $selection .= "!@04f7c318ad0360bd7b04c980f950833f11c0b1d1quot;#$%&[]{}?|";
        }

        $password = "";
        for ($i = 0; $i < $length; $i++) {
            $current_letter = $use_upper_case ? (rand(0, 1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
            $password .= $current_letter;
        }

        return $password;
    }

}
if (!function_exists('readmore')) {

    function readmore($str, $limit = 100, $flag = TRUE, $link = NULL) {
        $str = strip_tags($str);
        if (strlen(strip_tags($str)) > $limit) {
            $str = substr(strip_tags($str), 0, $limit);
        }
        if ($flag) {
            if ($limit != NULL) {
                $str .= "...<a href='" . $link . "'>Read More</a>";
            } else {
                $str .= "...Read More";
            }
        }
        return $str;
    }

}

if (!function_exists('getMenu')) {

    function getMenu() {
        $CI = & get_instance();
        $menu = $CI->load->model("menu_model", "menuModel");
        $res = $CI->menuModel->lists("name", "link", array("status" => "1"), array("index asc"));
        return $res;
    }

}
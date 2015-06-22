<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!function_exists('crete_pagination')) {

    function crete_pagination($base_url, $total_rows,$per_page,$uri_segment) {
        $CI = & get_instance();
        $CI->load->library('pagination');
        $pages = '';
        
        if ($total_rows > 0) {
            $config['base_url'] = $base_url;
            $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
            $config['display_pages'] = TRUE;
            $config['uri_segment'] = $uri_segment;
            $config['first_link'] = 'First';
            $config['num_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = '<li>';
            $config['num_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['cur_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='active'> <a href>";
            $config['cur_tag_close'] = "</a></li>";
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $per_page;
            $CI->pagination->initialize($config);
            $pages = $CI->pagination->create_links();
        }

        return $pages;
    }

}
<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        $ci->load->library('session');
 
        $site_lang = $ci->session->userdata('site_lang');
        if ($site_lang) {
            error_log("Loading Language: ".$site_lang);
            $ci->lang->load('guide',$ci->session->userdata('site_lang'));
        } else {
            $ci->lang->load('guide','english');
        }
    }
}
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Declare and Share Entry Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Matt Graham
 */
 
function save_entry($array) {
	$CI =& get_instance();
	//set cookie
	$cookie = array('name' => 'entry', 'value' => 'entered', 'expire' => time()+'5184000', 'secure' => FALSE);
	$CI->input->set_cookie($cookie);
	
	$clean_array = array(
		'ip_address' => $CI->input->ip_address(),
		'lang' => $array['lang'],
		'first_name' => $array['first_name'],
		'last_name' => $array['last_name'],
		'product_id' => $array['product_id'],
		'color_id' => $array['color_id'],
		'email' => $array['email'],
		'optin' => isset($array['optin']) ? 1 : 0
	);
	
	$CI->db->insert('ds_users', $clean_array);
	
}

function check_entry($email = NULL) {
	$CI =& get_instance();
	
	if ($email) {
		if ($CI->db->select('*')->from('ds_users')->where('email', $email)->count_all_results()) return TRUE;
	}
	
	if ($CI->input->cookie("entry")) return TRUE;
	return FALSE;
	
}

function dblang($field) {
	if (lang('short') != 'en') return $field."_".lang('short');
	return $field;
}

function stripdash($string) {
	return str_replace("-", "", $string);
}

function _compare_lightness($a, $b) {
	if ($a['lightness'] == $b['lightness']) {
        return 0;
    }
    return ($a['lightness'] > $b['lightness']) ? -1 : 1;
}

function fix_js_string($string) {
	return str_replace(array("\r","\n","<br>","<br />"), " ", strip_tags(nl2br($string)));

}

function RGB_TO_HSV ($hex)/*,$R, $G, $B)*/ {
	if (strpos($hex, "#") !== FALSE) $hex = substr($hex, 1);
	$R = hexdec(substr($hex, 0, 2));
	$G = hexdec(substr($hex, 2, 2));
	$B = hexdec(substr($hex, 4, 2));
	
	$HSL = array();

	$var_R = ($R / 255);
	$var_G = ($G / 255);
	$var_B = ($B / 255);

	$var_Min = min($var_R, $var_G, $var_B);
	$var_Max = max($var_R, $var_G, $var_B);
	$del_Max = $var_Max - $var_Min;

	$V = $var_Max;

	if ($del_Max == 0) {
		$H = 0;
		$S = 0;
	} else {
		$S = $del_Max / $var_Max;

		$del_R = ( ( ( $var_Max - $var_R ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
		$del_G = ( ( ( $var_Max - $var_G ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
		$del_B = ( ( ( $var_Max - $var_B ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;

		if		($var_R == $var_Max) $H = $del_B - $del_G;
		else if ($var_G == $var_Max) $H = ( 1 / 3 ) + $del_R - $del_B;
		else if ($var_B == $var_Max) $H = ( 2 / 3 ) + $del_G - $del_R;

		if ($H<0) $H++;
		if ($H>1) $H--;
	}

	$HSL['H'] = $H;
	$HSL['S'] = $S;
	$HSL['V'] = $V;

	return $HSL;
}
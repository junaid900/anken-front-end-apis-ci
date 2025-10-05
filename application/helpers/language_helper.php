<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */


if ( ! function_exists('get_phrase'))
{
    	function get_phrase($phrase = '') {
            $CI =& get_instance();
            $CI->load->database();
        
            $current_language = $CI->session->userdata('current_language') ?? 'english';
           
        
            // if ($current_language == '') {
            //     $current_language = $CI->db
            //         ->get_where('system_settings', ['type' => 'language'])
            //         ->row()
            //         ->description;
            //     $CI->session->set_userdata('current_language', $current_language);
            // }
        
            // Sanitize the phrase
            $phrase = trim($phrase);
        
            // Check if phrase already exists
            $query = $CI->db->get_where('language', ['phrase' => $phrase]);
            if ($query->num_rows() == 0) {
                // Insert new phrase
                $CI->db->insert('language', ['phrase' => $phrase]);
                return ucwords(str_replace('_', ' ', $phrase));
            }
        
            $row = $query->row();
            if (isset($row->$current_language) && $row->$current_language != "") {
                return $row->$current_language;
            } else {
                return ucwords(str_replace('_', ' ', $phrase));
            }
        }
        
	function set_date_for_display($date){		
		return date('d-m-Y',strtotime($date));	
	}
	
	function set_date_for_db($date){		
		return date('Y-m-d',strtotime($date));	
	}
}

// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */
if (!function_exists('get_country_by_ip')) {
    function get_country_by_ip($ip = null)
    {
        if ($ip == null) {
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        }

        // Localhost fallback for testing
        if ($ip == "127.0.0.1" || $ip == "::1") {
            $ip = "8.8.8.8"; // Google DNS (USA) for testing
        }

        $url = "http://ip-api.com/json/{$ip}?fields=status,country";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            return "unknown"; // API call failed
        }

        $data = json_decode($response, true);

        if ($data && isset($data['status']) && $data['status'] == 'success') {
            return strtolower($data['country']); // pakistan, china, united states, etc.
        }

        return "unknown";
    }
}

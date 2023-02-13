<?php
/**
 * Here will be all custom common helper function
 */

use Illuminate\Database\Eloquent\Model;

/**
 * get order job type
 * don't edit the index number
 * @return array
 */
if(!function_exists('get_order_job_types')) 
{
    function get_order_job_types() 
    {
        return [
            1 => 'Background Remove', 
            2 => 'Best Cliping Path Service', 
            3 => 'Image Masking', 
            4 => 'Retouching Services',
            5 => 'Shadow Making Service', 
            6 => 'Photo Restoration Service', 
            7 => 'E-commerce Editing Service', 
            8 => 'Color Correction',
            9 => 'Jewelery Retouch', 
            10 => 'Neck Join', 
            11 => 'Real State Photo Editing Services',
        ];
    }
}

/**
 * get query string
 * @return array
 */
if(!function_exists('get_query_strings'))
{
    function get_query_strings()
    {
        $query = [];  
        if(isset($_SERVER['QUERY_STRING'])) {
            $param_couple = explode("&", $_SERVER['QUERY_STRING']);
            foreach($param_couple as $param) {
                $arr = explode('=', $param);
                isset($query[$arr[0]]) ? 
                    $query[$arr[0]] = [...$query[$arr[0]], $arr[1]] : 
                    $query[$arr[0]] = [$arr[1]];
            }
        }
        return $query;
    }
}

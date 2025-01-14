<?php
/* This file contains fuctions being used in entire project and not specific to any module. */

namespace App\Helpers;
use Illuminate\Support\Facades\DB;

Class Utility 
{
    /* fuction "generate_random" generates randon alpha-numeric string of specified length. Default length is 10.  */
    public function generate_random($length = 10) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        $additional_characters = array('#','$');
        $final_array = array_merge($alphabets,$numbers,$additional_characters);

        $randon_alpha_num = '';

        while($length--) {
        $key = array_rand($final_array);
        $randon_alpha_num .= $final_array[$key];
        }
    return $randon_alpha_num;
    }

    
}
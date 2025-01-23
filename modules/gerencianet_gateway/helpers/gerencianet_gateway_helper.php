<?php

if (!function_exists('datetime')) {

    function datetime($value, $from = 'Y-m-d H:i:s', $to = 'd/m/Y H:i:s')
    {
        if (null === $value) {
            return null;
        }

        $datetime = DateTime::createFromFormat($from, $value);

        if (false === $datetime) {
            return null;
        }

        return $datetime->format($to);
    }
}

if (!function_exists('dt')) {

    function dt($value, $format = 'd/m/Y H:i:s')
    {
        if (null === $value) {
            return null;
        }

        $datetime = new Carbon($value);

        if (false === $datetime) {
            return null;
        }

        return $datetime->format($format);
    }
}

if (!function_exists('moeda2float')) {

    function moeda2float($value)
    {
        if (empty($value)) {
            return null;
        }

        $new = str_replace('.', '', $value);

        return str_replace(',', '.', $new);
    }
}
if (!function_exists('floatValueFromString')) {

    /**
     *
     * @param type $val
     * @return type
     * Exemplos:
     *  echo floatvalue('1.325.125,54'); // The output is 1325125.54
     *  echo floatvalue('1,325,125.54'); // The output is 1325125.54
     *  echo floatvalue('59,95');        // The output is 59.95
     *  echo floatvalue('12.000,30');    // The output is 12000.30
     *  echo floatvalue('12,000.30');    // The output is 12000.30
     */
    function floatValueFromString($val)
    {
        $val = str_replace(",", ".", $val);
        $val = preg_replace('/\.(?=.*\.)/', '', $val);
        return floatval($val);
    }
}



if (!function_exists('money')) {

    function money($value)
    {
        return number_format($value, 2, ',', '.');
    }
}


if (!function_exists('soNumeros')) {

    function soNumeros($value)
    {
        return Str::of($value)->replaceMatches('/[^A-Za-z0-9]++/', '');
    }
}


/**
 * vdebug()
 *
 * Debug Helper.
 *
 * Functions to print/dump variables to the screen with CI style formatting
 * and additional debug data.
 *
 * Inspired by the works of Joost van Veen[1] and Kevin Wood-Friend[2].
 * [1] http://github.com/joostvanveen/
 * [2] http://github.com/kwoodfriend/
 *
 * @author Yahya ERTURAN <root@yahyaerturan.com>
 * @version 1.1
 * @license https://github.com/yahyaerturan/codeigniter-developers-debug-helper/blob/master/LICENSE MIT License
 */
/**
 * dd()
 *
 * @param mixed $data
 * @param bool $die FALSE
 * @param bool $add_var_dump FALSE
 * @param bool $add_last_query TRUE
 * @return void
 */
if (!function_exists('dd')) {

    function dd($die)
    {
        $numargs = func_num_args();
        $arg_list = func_get_args();

        for ($i = 0; $i < $numargs; $i++) {
            if ($i > 0) {
                $value = $arg_list[$i];

                $CI = &get_instance();
                $CI->load->library('unit_test');

                $bt = debug_backtrace();

                $src = file($bt[0]["file"]);

                $line = $src[$bt[0]['line'] - 1];

                preg_match('#' . __FUNCTION__ . '\((.+)\)#', $line, $match);

                $max = strlen($match[1]);

                $varname = null;

                $arr_values = explode(',', $match[1]);

                if (is_object($value)) {
                    $message = '<span class="vayes-debug-badge vayes-debug-badge-object">OBJECT</span>';
                } elseif (is_array($value)) {
                    $message = '<span class="vayes-debug-badge vayes-debug-badge-array">ARRAY</span>';
                } elseif (is_string($value)) {
                    $message = '<span class="vayes-debug-badge vayes-debug-badge-string">STRING</span>';
                } elseif (is_int($value)) {
                    $message = '<span class="vayes-debug-badge vayes-debug-badge-integer">INTEGER</span>';
                } elseif (is_true($value)) {
                    $message = '<span class="vayes-debug-badge vayes-debug-badge-true">TRUE [BOOLEAN]</span>';
                } elseif (is_false($value)) {
                    $message = '<span class="vayes-debug-badge vayes-debug-badge-false">FALSE [BOOLEAN]</span>';
                } elseif (is_null($value)) {
                    $message = '<span class="vayes-debug-badge vayes-debug-badge-null">NULL</span>';
                } elseif (is_float($value)) {
                    $message = '<span class="vayes-debug-badge vayes-debug-badge-float">FLOAT</span>';
                } else {
                    $message = 'N/A';
                }

                $output = '<div style="clear:both;"></div>';
                $output .= '<meta charset="UTF-8" />';
                $output .= '<style>body{margin:0}::selection{background-color:#E13300!important;color:#fff}::moz-selection{background-color:#E13300!important;color:#fff}::webkit-selection{background-color:#E13300!important;color:#fff}div.debugbody{background-color:#fff;margin:0px;font:9px/12px normal;font-family:Arial,Helvetica,sans-serif;color:#4F5155;min-width:500px;padding:10px;margin-bottom:0px;}a.debughref{color:#039;background-color:transparent;font-weight:400}h1.debugheader{color:#444;background-color:transparent;border-bottom:1px solid #D0D0D0;font-size:12px;line-height:14px;font-weight:700;margin:0 0 14px;padding:14px 15px 10px;font-family:\'Ubuntu Mono\',Consolas}code.debugcode{font-family:\'Ubuntu Mono\',Consolas,Monaco,Courier New,Courier,monospace;font-size:12px;background-color:#f9f9f9;border:1px solid #D0D0D0;color:#002166;display:block;margin:10px 0;padding:5px 10px 15px}code.debugcode.debug-last-query{display:none}pre.debugpre{display:block;padding:0;margin:0;color:#002166;font:12px/14px normal;font-family:\'Ubuntu Mono\',Consolas,Monaco,Courier New,Courier,monospace;background:0;border:0}div.debugcontent{margin:0 15px}p.debugp{margin:0;padding:0}.debugitalic{font-style:italic}.debutextR{text-align:right;margin-bottom:0;margin-top:0}.debugbold{font-weight:700}p.debugfooter{text-align:right;font-size:11px;border-top:1px solid #D0D0D0;line-height:32px;padding:0 10px;margin:20px 0 0}div.debugcontainer{margin:0px;border:1px solid #D0D0D0;-webkit-box-shadow:0 0 8px #D0D0D0}code.debug p{padding:0;margin:0;width:100%;text-align:right;font-weight:700;text-transform:uppercase;border-bottom:1px dotted #CCC;clear:right}code.debug span{float:left;font-style:italic;color:#CCC}.vayes-debug-badge{background:#285AA5;border:1px solid rgba(0,0,0,0);border-radius:4px;color:#FFF;padding:2px 4px}.vayes-debug-badge-object{background:#A53C89}.vayes-debug-badge-array{background:#037B5A}.vayes-debug-badge-string{background:#037B5A}.vayes-debug-badge-integer{background:#552EF3}.vayes-debug-badge-true{background:#126F0B}.vayes-debug-badge-false{background:#DE0303}.vayes-debug-badge-null{background:#383838}.vayes-debug-badge-float{background:#9E4E09}p.debugp.debugbold.debutextR.lq-trigger:hover + code{display:block}</style>';

                $output .= '<div class="debugbody"><div class="debugcontainer">';
                $output .= '<h1 class="debugheader">' . $arr_values[$i] . '</h1>';
                $output .= '<div class="debugcontent">';
                $output .= '<code class="debugcode"><p class="debugp debugbold debutextR">:: print_r</p><pre class="debugpre">' . $message;
                ob_start();
                print_r($value);
                $output .= "\n\n" . trim(ob_get_clean());
                $output .= '</pre></code>';

                if ($CI->db->last_query()) {
                    $output .= '<code class="debugcode debug-last-query"><p class="debugp debugbold debutextR">:: $CI->db->last_query()</p>';
                    $output .= $CI->db->last_query();
                    $output .= '</code>';
                }


                $output .= '</div><p class="debugfooter">Vayes Debug Helper © Yahya A. Erturan (melhoria por Taffarel Xavier)</p></div></div>';
                $output .= '<div style="clear:both;"></div>';

                if (PHP_SAPI == 'cli') {
                    echo $varname . ' = ' . PHP_EOL . $output . PHP_EOL . PHP_EOL;
                    return;
                }

                echo $output;
            }
        }

        if ($die) {
            exit;
        }
    }
}


// ------------------------------------------------------------------------

/**
 * v_echo()
 *
 * @param mixed $var
 * @param string $custom_style
 * @return void
 */
if (!function_exists('v_echo')) {

    function v_echo($var, $bgcolor = '#3377CC', $custom_style = '')
    {
        $style = 'font-family:\'Ubuntu Mono\';font-size:11pt;background:' . $bgcolor . ';color:#FFF;border-radius:5px;padding:3px 6px;min-width:100px; max-width: 600px;word-wrap: break-word;';
        if ($custom_style) {
            $style = $custom_style;
        }
        if ((is_array($var)) or (is_object($var))) {
            echo '<pre style="' . $style . 'font-size:10pt;line-height:11pt;">' . json_encode($var, JSON_PRETTY_PRINT) . '</pre>';
        } else {
            echo '<pre style="' . $style . '">' . $var . '</pre>';
        }
    }
}

// ------------------------------------------------------------------------
// ------------------------------------------------------------------------
// ------------------------------------------------------------------------

function calcularMulta($x)
{
    return $x * 100;
}

function calcularJuros($x)
{
    if ($x < 10) {
        return (int) 1000 * $x;
    }
    return 1000;
}

if (!function_exists("efi_get_media_path_project")) {

    /**
     *
     * @return string
     */
    function efi_get_media_path_project()
    {
        $ci = &get_instance();
        return FCPATH . $ci->app->get_media_folder();
    }
}

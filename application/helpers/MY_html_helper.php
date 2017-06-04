<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('dump'))
{
	function dump($data = '')
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}

if ( ! function_exists('script_tag'))
{
  function script_tag($href = '', $type = 'text/javascript', $index_page = FALSE)
  {
    $CI =& get_instance();
    $link = '<script ';

    if (is_array($href))
    {
      foreach ($href as $k => $v)
      {
        if ($k === 'src' && ! preg_match('#^([a-z]+:)?//#i', $v))
        {
          if ($index_page === TRUE)
          {
            $link .= 'src="'.$CI->config->site_url($v).'" ';
          }
          else
          {
            $link .= 'src="'.$CI->config->slash_item('base_url').$v.'" ';
          }
        }
        else
        {
          $link .= $k.'="'.$v.'" ';
        }
      }
    }
    else
    {
      if (preg_match('#^([a-z]+:)?//#i', $href))
      {
        $link .= 'src="'.$href.'" ';
      }
      elseif ($index_page === TRUE)
      {
        $link .= 'src="'.$CI->config->site_url($href).'" ';
      }
      else
      {
        $link .= 'src="'.$CI->config->slash_item('base_url').$href.'" ';
      }

      $link .= 'type="'.$type.'" ';
    }

    return $link." charset='UTF-8'></script>\n";
  }
}

if ( ! function_exists('hr'))
{
	function hr($count = 1)
	{
		return str_repeat('<hr />', $count);
	}
}

if ( ! function_exists('p'))
{
	function p($data = '', $attributes = '')
	{
		return '<p'._stringify_attributes($attributes).'>'.$data.'</p>';
	}
}

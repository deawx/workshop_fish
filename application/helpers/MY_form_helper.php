<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('form_number'))
{
	function form_number($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'type' => 'number',
			'name' => is_array($data) ? '' : $data,
			'value' => $value
		);
		return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
	}
}

if ( ! function_exists('form_email'))
{
	function form_email($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'type' => 'email',
			'name' => is_array($data) ? '' : $data,
			'value' => $value
		);
		return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
	}
}

if ( ! function_exists('form_url'))
{
	function form_url($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'type' => 'url',
			'name' => is_array($data) ? '' : $data,
			'value' => $value
		);
		return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
	}
}

if ( ! function_exists('form_anchor_edit'))
{
	function form_anchor_edit($uri = '')
	{
		$title = (string) 'แก้ไข';
		$site_url = is_array($uri)
			? site_url($uri)
			: (preg_match('#^(\w+:)?//#i', $uri) ? $uri : site_url($uri));
		$attributes = array(
			'type' => 'button',
			'class' => 'btn btn-info'
		);
		$attributes = _stringify_attributes($attributes);
		return '<a href="'.$site_url.'"'.$attributes.'>'.$title.'</a>';
	}
}

if ( ! function_exists('form_anchor_delete'))
{
	function form_anchor_delete($uri = '')
	{
		$title = (string) 'ลบ';
		$site_url = is_array($uri)
			? site_url($uri)
			: (preg_match('#^(\w+:)?//#i', $uri) ? $uri : site_url($uri));
		$attributes = array(
			'type' => 'button',
			'class' => 'btn btn-warning',
			'onclick' => "return confirm('ยืนยันการลบข้อมูลนี้ ?');"
		);
		$attributes = _stringify_attributes($attributes);
		return '<a href="'.$site_url.'"'.$attributes.'>'.$title.'</a>';
	}
}

if ( ! function_exists('dropdown_title'))
{
  function dropdown_title()
  {
    $title = array(
      'นาย.' => 'นาย.',
      'นาง.' => 'นาง.',
      'นางสาว.' => 'นางสาว.'
    );
    return $title;
  }
}

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Pagination Config
 *
 * Just applying codeigniter's standard pagination config with twitter
 * bootstrap stylings
 *
 * @license		http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @author		Mike Funk
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 * @email		mike@mikefunk.com
 *
 * @file		pagination.php
 * @version		1.3.1
 * @date		03/12/2012
 *
 * Copyright (c) 2011
 */

// --------------------------------------------------------------------------

$config['base_url'] = '';
$config['per_page'] = 15;
$config['num_links'] = 5;
$config['page_query_string']  = TRUE;
$config['use_page_numbers']   = FALSE;
$config['display_pages'] 	  = TRUE;
$config['reuse_query_string'] = FALSE;
$config['query_string_segment'] = 'p';

$config['full_tag_open'] = '<ul class="pagination">';
$config['full_tag_close'] = '</ul>';

$config['first_link'] = '&laquo; แรกสุด';
$config['first_tag_open'] = '<li class="first page">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'ท้ายสุด &raquo;';
$config['last_tag_open'] = '<li class="last page">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = 'ถัดไป &rarr;';
$config['next_tag_open'] = '<li class="next page">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '&larr; ก่อนหน้า';
$config['prev_tag_open'] = '<li class="prev page">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="active"><a href="">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page">';
$config['num_tag_close'] = '</li>';

$config['anchor_class'] = 'follow_link';

// --------------------------------------------------------------------------

/* End of file pagination.php */
/* Location: ./bookymark/application/config/pagination.php */

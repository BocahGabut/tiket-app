<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Main';
$route[$this->uri->segment(1)] = 'Main';
$route['post'] = 'Post';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

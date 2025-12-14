<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['logout'] = 'login/logout';  

 

$route['change-password'] = 'login/change_password';
$route['dash'] = 'dashboard'; 
$route['get-data'] = 'general/get_data';
$route['update-data'] = 'general/update_data';
$route['insert-data'] = 'general/insert_data';
$route['delete-record'] = 'general/delete_record';
$route['get-content'] = 'general/get_content';   
 
$route['user-list'] = 'master/user_list';
$route['user-list/(:num)'] = 'master/user_list/$1';
 
$route['project-list'] = 'master/project_list';
$route['project-list/(:num)'] = 'master/project_list/$1';

$route['client-list'] = 'master/client_list';
$route['client-list/(:num)'] = 'master/client_list/$1';


$route['create-employee'] = 'master/add_employee'; 
$route['edit-employee/(:num)'] = 'master/edit_employee/$1'; 

$route['emp-category-list'] = 'master/emp_category_list';
$route['emp-category-list/(:num)'] = 'master/emp_category_list/$1';

$route['emp-type-list'] = 'master/emp_type_list';
$route['emp-type-list/(:num)'] = 'master/emp_type_list/$1';

$route['blood-group-list'] = 'master/blood_group_list';
$route['blood-group-list/(:num)'] = 'master/blood_group_list/$1';

 $route['task-list'] = 'master/task_list';
$route['task-list/(:num)'] = 'master/task_list/$1';


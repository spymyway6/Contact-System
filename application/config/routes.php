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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth routes
$route['login']                   = 'auth/login';
$route['login-user']              = 'auth/login_user_ajax';
$route['register-user']           = 'auth/register_user_ajax';
$route['register']                = 'auth/register';
$route['logout']                  = 'auth/user_logout';
$route['update-profile-settings'] = 'auth/update_profile_settings';

// Contact/Dashboard/User Routes
$route['dashboard']              = 'user/dashboard';
$route['add-new-contact']        = 'user/add_new_contact';
$route['fetch-all-contacts']     = 'user/fetch_all_contacts';
$route['search-fetch-contacts']  = 'user/fetch_all_contacts';
$route['edit-contact/(:num)']    = 'user/fetch_contact/$1';
$route['delete-contact/(:num)']  = 'user/delete_contact/$1';


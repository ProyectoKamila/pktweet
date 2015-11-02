<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "controller";
$route['process'] = "controller/process";
$route['controller/search'] = "controller/search";
$route['directmessage'] = "controller/directmessage";
$route['profile/(:num)'] = "controller/actualizar/$1";
$route['noseguidores/(:num)'] = "controller/noseguidores/$1";
$route['fans/(:num)'] = "controller/fans/$1";
$route['elimdirect'] = "controller/elimdirect/";
$route['nofollow'] = "controller/nofollow/";
$route['nofollowall'] = "controller/nofollowall/";
$route['followuser'] = "controller/followuser/";
$route['followuserall'] = "controller/followuserall/";
$route['sucess'] = "controller/sucess/";
$route['sucess/PayPal_IPN'] = "controller/PayPal_IPN";
$route['followusersearch'] = "controller/followusersearch/";
$route['followusersearchall'] = "controller/followusersearchall/";
//$route['controller'] = "controller/index";
//$route['empresa/(:any)'] = "publico/empresa/$1";
//$route['user/(:any)'] = "controller/index/$1";
//$route['home'] = "controller/index";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */

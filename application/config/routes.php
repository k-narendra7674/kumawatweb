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

$route['login'] = 'admin/login/index';
$route['logout'] = 'admin/login/logout';
$route['register'] = 'admin/login/register';
$route['authenticate'] = 'admin/login/authenticate';

/*=================================================*/ 
/*              For Dash Board                     */ 
/*=================================================*/ 

$route['Admin-Dashboard'] = 'admin/admin/index';
$route['profile'] = 'admin/dashboard/profile';

// for Mobile Controller

$route['mobile'] = 'Mobile/index';
$route['addMobile'] = 'Mobile/addMobile';
$route['fetchMobile'] = 'Mobile/fetchMobile';
$route['delMobile'] = 'Mobile/delMobile';
$route['editMobile'] = 'Mobile/editMobile';
$route['updateMobile'] = 'Mobile/updateMobile';


// for About Controller

$route['about'] = 'About/index';
$route['addAbout'] = 'About/addAbout';
$route['fetchAbout'] = 'About/fetchAbout';
$route['delAbout'] = 'About/delAbout';
$route['editAbout'] = 'About/editAbout';
$route['updateAbout'] = 'About/updateAbout';

// for service Controller

$route['service'] = 'Service/index';
$route['addService'] = 'Service/addService';
$route['fetchService'] = 'Service/fetchService';
$route['delService'] = 'Service/delService';
$route['editService'] = 'Service/editService';
$route['updateService'] = 'Service/updateService';

// for Team Controller

$route['team'] = 'Team/index';
$route['addTeam'] = 'Team/addTeam';
$route['fetchTeam'] = 'Team/fetchTeam';
$route['delTeam'] = 'Team/delTeam';
$route['editTeam'] = 'Team/editTeam';
$route['updateTeam'] = 'Team/updateTeam';

// for Portfolio/App Controller
$route['all_product'] = 'portfolio/All_Product/index';
$route['fetchProduct'] = 'portfolio/All_Product/fetchProduct';
$route['addProduct'] = 'portfolio/All_Product/addProduct';


// for Portfolio/App Controller

$route['app'] = 'portfolio/App/index';
$route['addApp'] = 'portfolio/App/addApp';
$route['fetchApp'] = 'portfolio/App/fetchApp';
$route['delApp'] = 'portfolio/App/delApp';
$route['editApp'] = 'portfolio/App/editApp';
$route['updateApp'] = 'portfolio/App/updateApp';

// for Portfolio/Card Controller

$route['card'] = 'portfolio/Card/index';
$route['addCard'] = 'portfolio/Card/addCard';
$route['fetchCard'] = 'portfolio/Card/fetchCard';
$route['delCard'] = 'portfolio/Card/delCard';
$route['editCard'] = 'portfolio/Card/editCard';
$route['updateCard'] = 'portfolio/Card/updateCard';

// for Portfolio/Web Controller

$route['web'] = 'portfolio/Web/index';
$route['addWeb'] = 'portfolio/Web/addWeb';
$route['fetchWeb'] = 'portfolio/Web/fetchWeb';
$route['delWeb'] = 'portfolio/Web/delWeb';
$route['editWeb'] = 'portfolio/Web/editWeb';
$route['updateWeb'] = 'portfolio/Web/updateWeb';

// for contact us controller
$route['contactUs'] = 'pages/Contact_Us/index';
$route['addMessage'] = 'pages/Contact_Us/addMessage';
$route['fetchInfo'] = 'pages/Contact_Us/fetchInfo';


// For Pages/Home Page Controller

$route['home'] = 'pages/Home/index';
$route['showMobile'] = 'pages/Home/showMobile';

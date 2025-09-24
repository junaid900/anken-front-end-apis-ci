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

$route['default_controller'] = 'welcome';

$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;



// $route['about-us/who-we-are'] = 'about/who_we_are';

// $route['about-us/positive-impact'] = 'about/positive_impact';

// $route['about-us/anken-milestones'] = 'about/milestones';

// $route['about-us/our-shanghai'] = 'about/our_shanghai';

// $route['about-us/services'] = 'about/services';

// $route['about-us/cultivate-with-care'] = 'about/cultivate_with_care';

// $route['about-us/build-more-with-less'] = 'about/build_more';

// $route['about-us/brand-stories'] = 'about/places_made_of_people';


// $route['about-us/(:any)'] = 'about/index/$1';

// $route['our-portfolio/(:any)'] = 'portfolio/index/$1';
// $route['(:any)'] = 'portfolio/index/$1';
$route['language'] = 'home/change_language';

$route['company'] = 'company';
$route['event'] = 'event';
$route['contact'] = 'contact';


// $route['(:any)'] = 'slug_router/index/$1';

// $route['(.+)'] = 'slug_router/index/$1';

// 1) API ko direct allow karo
$route['api/(.+)'] = 'api/$1';

// 2) Agar nested function bhi call karna hai
// $route['api/(.+)'] = 'api/$1/$2';

// 3) Last me catch-all slug routing
$route['(.+)'] = 'slug_router/index/$1';




$route['november23'] = 'welcome/index';

$route['november24'] = 'welcome/rsvp_2024_11_24';




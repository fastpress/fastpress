<?php
/**
 * ## This file contains your app's "LOCAL" setting. 
 * copy/paste another different setting for production  
 *
 * ## All these configs can be accessed using 
 * $app['name']['key'] anywhere
 *
 * ## To change/override any of these, use 
 * $app->set('page:title', 'hello');  
 *
 * ## It's possible to add any arbitrary config here, such as; 
 *   whether to use/load an asset or not. ex: 
 *   $app['include'] = ['jQuery' => FALSE] 
 *   // see fastpress/troque for more.
 */

const __HOST__ = 'http://fastpress.fastpress'; 


// default page metadata
$app['page'] = [
   'title'        => 'Your page title!',
   'keywords'     => 'site, keywords, here ..',
   'description'  => 'site description', 
   'image'        => __HOST__ . '/images/thumbnail.png'
];


// database details 
$app['database'] = [
   'driver'     => 'mysql',
   'host'       => 'localhost',
   'database'   => '',
   'username'   => '',
   'password'   => '',
   'charset'    => 'utf8',
   'collation'  => 'utf8_unicode_ci',
   'prefix'     => '',
];


// folders and directories 
$app['path'] = [
   'app'    => __DIR__ . '/app/',
   'views'  => __DIR__ . '/views/',
   'layout' => __DIR__ . '/views/layout/',
];


// path to your assets 
$app['assets'] = [
   'dir'  => __HOST__ . '/assets', 
   'js'   => __HOST__ . '/assets/js',
   'css'  => __HOST__ . '/assets/css',
   'img'  => __HOST__ . '/assets/img',
];


// session security configs
$app['app.session'] = [
   'strict' => TRUE,
   'cookie_path'   => '/',
   'cache_expire'  => 180,
   'cookie_secure' => FALSE,
   'cache_limiter' => NULL,
   'hash_function' => NULL,
   'cookie_domain' => '', 
   'referer_check' => '', 
   'gc_maxlifetime'  => 1080,
   'cookie_lifetime' => 0, 
   'cookie_httponly' => TRUE
];


// your layouts block 
$app['block'] = [
   'header'   => true,
   'content'  => true,
   'sidebar'  => true, 
   'footer'   => true, 
];


// misc directives 
$app['use'] = [
   'output_buffering' => false, 
   'template_inheritance' => false, 
   'adsense' => false, 
   'facebook_api' => false, 
   'soundmanager' => false, 
];


// cache #@TODO 
$app['cache'] = [
   'path'     => __DIR__ .'/app/cache/',
   'seconds'  => 180, 
   'ignore'   => '',
];


error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
ini_set('log_errors', 0);


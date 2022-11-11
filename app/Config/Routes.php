<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/reg', 'Auth::register');
$routes->get('/dasbor', "App::dashboard", ['filter' => 'exceptAgen']);
$routes->get('/dasbor/agen', "App::listAgen", ['filter' => 'exceptPIC']);
$routes->get('/dasbor/agen/tambah', "App::addAgen", ['filter' => 'exceptPIC']);
$routes->get('/dasbor/agen/delete', "App::deleteAgen", ['filter' => 'exceptPIC']);
$routes->get('/dasbor/agen/update/(:num)', "App::updateAgen/$1", ['filter' => 'exceptPIC']);
$routes->get('/dasbor/user', "App::listUser", ['filter' => 'adminPicOnly']);
$routes->get('/dasbor/user/enable/(:num)', "App::authorize/$1", ['filter' => 'adminPicOnly']);
$routes->get('/dasbor/user/disable/(:num)', "App::authorize/$1", ['filter' => 'adminPicOnly']);
$routes->get('/dasbor/user/update/(:num)', "App::updateUser/$1", ['filter' => 'adminOnly']);
$routes->get('/dasbor/user/tambah', "App::addUser", ['filter' => 'adminOnly']);
$routes->get('/dasbor/user/delete/(:num)', "App::deleteUser/$1", ['filter' => 'adminOnly']);
$routes->get('/dasbor/link', "App::listLink", ['filter' => 'exceptAgen']);
$routes->get('/dasbor/file', "App::listFile", ['filter' => 'exceptAgen']);
$routes->get('/dasbor/faq', "App::faq", ['filter' => 'exceptAgen']);
$routes->get('/dasbor/user/ubah', "App::ubahPass", ['filter' => 'exceptAgen']);
$routes->get('/dasbor/file/upload', "App::upload", ['filter' => 'exceptAgen']);
$routes->get('/dasbor/file/delete/(:any)', "App::deleteFile/$1", ['filter' => 'exceptAgen']);
$routes->get('/dasbor/file/update/(:num)', "App::updateFile/$1", ['filter' => 'exceptAgen']);
$routes->get('/dasbor/link/tambah', "App::addLink", ['filter' => 'exceptMarketing']);
$routes->get('/dasbor/log', "App::log", ['filter' => 'exceptMarketing']);
$routes->get('/dasbor/link/delete/(:num)', "App::deleteLink/$1", ['filter' => 'exceptMarketing']);
$routes->get('/dasbor/link/update/(:num)', "App::updateLink/$1", ['filter' => 'exceptMarketing']);
$routes->get('/link', "App::link", ['filter' => 'authGuard']);
$routes->get('/link/redir', "App::linkRedirect", ['filter' => 'authGuard']);
$routes->post('/doRegister', "Auth::doRegister");
$routes->post('/doAddLink', "App::doAddLink");
$routes->post('/doAddAgen', "App::doAddAgen");
$routes->post('/doLogin', "Auth::doLogin");
$routes->post('/doAddUser', "App::doAddUser");
$routes->post('/doUpdateLink', "App::doUpdateLink");
$routes->post('/doUpdateFile', "App::doUpdateFile");
$routes->post('/doUpdateUser', "App::doUpdateUser");
$routes->post('/doUpdateAgen', "App::doUpdateAgen");
$routes->post('/doChgPass', 'App::doChgPass');
$routes->post('/doUpload', "App::doUpload");
$routes->post('/addDriveFolder', "App::addFolderDrive");
$routes->post('/updateDrive', "App::updateDrive");
$routes->post('/doDelete', "App::doUpload");
$routes->get('/welcome', 'App::welcome', ['filter' => 'exceptAgen']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

<?php

namespace Config;

use App\Controllers\Auth;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

//$routes->get('/', 'Home::index');

$routes->get('/','Auth::Login');
$routes->post('Login','Auth::plogin');
$routes->get('logout','Auth::logout',['filter' => 'auth']);


//routes admin
$routes->get('Admin', 'Admin::index', ['filter' => 'auth']);
$routes->get('Data-Pegawai','Admin::read',['filter' =>'auth']);
$routes->get('Tambah-data-pegawai','Admin::tambahuser',['filter' =>'auth']);
$routes->post('Tambah-pegawai','Admin::add',['filter'=>'auth']);
$routes->get('Tambah-jabatan','Admin::tjbtn',['filter' =>'auth']);
$routes->post('Tambah-jbt','Admin::savejbtn',['filter' =>'auth']);
$routes->post('editdata', 'Admin::edit', ['filter' => 'auth']);
$routes->post('updatedata/(:num)', 'Admin::update/$1', ['filter' => 'auth']);
$routes->post('deletedata/(:num)', 'Admin::delete/$1',['filter' => 'auth']);
$routes->post('admin/fetchPegawaiData', 'Admin::fetchPegawaiData',['filter' => 'auth']);


$routes->get('Laporan-Pegawai','Admin::vlistuser',['filter' => 'auth']);
$routes->get('Data-kurja/(:num)','Admin::vkurja/$1',['filter' => 'auth']);
$routes->post('laporan/hapuskinerja/(:num)', 'Admin::hapuskinerja/$1',['filter' => 'auth']);
$routes->get('editkinerja/(:num)', 'Admin::editkinerja/$1',['filter' => 'auth']);
$routes->post('updatestatus/(:num)', 'Admin::updatestatus/$1',['filter' => 'auth']);
$routes->get('subkinerja/(:num)', 'Admin::subkinerja/$1',['filter' => 'auth']);
$routes->get('editsub/(:num)', 'Admin::editsub/$1',['filter' => 'auth']);
$routes->post('updatesub/(:num)', 'Admin::updatesub/$1',['filter' => 'auth']);

//routes pegawai
$routes->get('Pegawai', 'Pegawai::index', ['filter' => 'auth']);
$routes->post('kurja/kurja', 'Pegawai::kurja', ['filter' => 'auth']);
$routes->get('History','Pegawai::history',['filter'=>'auth']);
$routes->get('Kurja', 'Pegawai::read', ['filter' => 'auth']);
$routes->get('Add-Kurja', 'Pegawai::addkurja', ['filter' => 'auth']);
$routes->post('Savekurja', 'Pegawai::savekurja', ['filter' => 'auth']);
$routes->get('Tambahsub','Subkinerja::subkinerja',['filter'=>'auth']);
$routes->get('Subkinerja','Subkinerja::index',['filter'=>'auth']);
$routes->post('Savesub','Subkinerja::tambahsub',['filter'=>'auth']);



if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

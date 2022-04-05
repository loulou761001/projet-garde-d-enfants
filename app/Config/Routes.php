<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/inscription', 'Inscription::redirect');
$routes->get('/inscription/parent', 'Inscription::index');
$routes->get('/profil/photo/(:num)', 'Inscription::photo/$1');
$routes->post('/inscription/parent', 'Inscription::handlePost');
$routes->post('/profil/photo/(:num)', 'Inscription::handlePhoto/$1');
$routes->get('/inscription/nourrice', 'Inscription::indexNourrice');
$routes->post('/inscription/nourrice', 'Inscription::handlePostNourrice');
$routes->get('/errors', 'errors::index');
$routes->get('/inscription/utilisateur', 'InscriptionUtilisateur::index');
$routes->get('/vieprive', 'vieprive::index');
$routes->get('conditions', 'conditions::index');
$routes->post('/connexion', 'Connexion::loginVerif');
$routes->get('/connexion', 'Connexion::index');
$routes->get('/deconnexion', 'Connexion::deco');
$routes->post('/uploadEmailParent', 'Inscription::uploadEmailParent');
$routes->get('/profil', 'Profil::index');
$routes->get('/profil/modifier', 'Profil::modifProfil');
$routes->post('/profil/modifier', 'Profil::modifiedProfil');
$routes->post('/profil', 'Profil::ajoutEnfant');
$routes->get('/motdepasse', 'Profil::motDePasse');
$routes->post('/motdepasse', 'Profil::motDePassePost');
$routes->get('/motdepasse/modifier', 'Profil::motDePasseModif');
$routes->post('/motdepasse/modifier', 'Profil::motDePasseModifPost');
$routes->get('/motdepasse/profil/modifier', 'Profil::motDePasseModifProfil');
$routes->post('/motdepasse/profil/modifier', 'Profil::motDePasseModifProfilPost');
$routes->get('/profil/supprimer/(:num)', 'Profil::supprEnfant/$1');
$routes->post('/uploadEmail', 'Inscription::uploadEmail');

$routes->get('/gestionDispo', 'Dispo::index');
$routes->get('/gestionDispo/supprimer/(:num)', 'Dispo::deleteDispo/$1');
$routes->get('/gestionDispo/ajout', 'Dispo::ajout');
$routes->post('/gestionDispo/ajout', 'Dispo::HandlePost');

$routes->get('/voirDispos', 'Dispo::disposParents');
$routes->get('/mesDispos', 'Dispo::mesDisposParents');
$routes->get('/voirDispos', 'Dispo::disposParents');
$routes->get('/dispoDetails', 'Dispo::dispoDetails');
$routes->post('/dispoDetails', 'Dispo::postChoix');
$routes->get('/dispoErreur', 'Dispo::noDispo');



$routes->get('/paiement', 'Paiement::index');


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

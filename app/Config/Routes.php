<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// nom de domaine : http://amset.com

// Amset

service('auth')->routes($routes);

// page d'accueil : http://amset.com/
// $routes->get('/', 'Amset::page', ['as' => 'connexion']);  // redirection vers accueil (connexion en dure)
//$routes->post('connexion-(:num)', 'Connexion::connect/$1');

// page d'accueil : http://amset.com/accueil/
$routes->get('/', 'Amset::main', ['as' => 'accueil']);

// --------------------------------------------------------

// Profils

// liste : http://amset.com/accueil/liste-profils
$routes->get('liste-profils', 'Profil::liste', ['as' => 'profils_liste']);

// ajout : http://amset.com/accueil/liste-profils/ajout-profils
$routes->get('ajout-profil', 'Profil::ajout', ['as' => 'profils_ajout']);
$routes->post('ajout-profil', 'Profil::create', ['as' => 'profils_create']);

// modif : http://amset.com/accueil/liste-profils/modif-profils
$routes->get('modif-profil-(:num)', 'Profil::modif/$1', ['as' => 'profils_modif']);
$routes->post('modif-profil', 'Profil::update', ['as' => 'profils_update']);

// delet : http://amset.com/accueil/liste-profils/suppr-profils
$routes->post('suppr-profil', 'Profil::delete', ['as' => 'profils_delete']);

// --------------------------------------------------------

// Salarie

// liste : http://amset.com/accueil/liste-salarie
$routes->get('liste-salaries', 'Salarie::liste', ['as' => 'salarie_liste']);

// ajout : http://amset.com/accueil/liste-salarie/ajout-salarie
$routes->get('ajout-salarie', 'Salarie::ajout', ['as' => 'salarie_ajout']);
$routes->post('ajout-salarie', 'Salarie::create', ['as' => 'salarie_create']);

// modif : http://amset.com/accueil/liste-salarie/modif-salarie
$routes->get('modif-salarie-(:num)', 'Salarie::modif/$1', ['as' => 'salarie_modif']);
$routes->post('modif-salarie', 'Salarie::update', ['as' => 'salarie_update']);

// delete : http://amset.com/accueil/liste-salarie/suppr-salarie
$routes->post('suppr-salarie', 'Salarie::delete', ['as' => 'salarie_delete']);

$routes->post('ajout-profil-salarie', 'Salarie::ajoutProfil', ['as' => 'ajout_profil_salarie']);
$routes->post('suppr-profil-salarie', 'Salarie::supprProfil', ['as' => 'suppr_profil_salarie']);


// --------------------------------------------------------

// Mission

// liste : http://amset.com/accueil/liste-mission
$routes->get('liste-missions', 'Mission::liste', ['as' => 'mission_liste']);

// ajout : http://amset.com/accueil/liste-mission/ajout-mission
$routes->get('ajout-mission', 'Mission::ajout', ['as' => 'mission_ajout']);
$routes->post('ajout-mission', 'Mission::create', ['as' => 'mission_create']);

// modif : http://amset.com/accueil/liste-mission/modif-mission
$routes->get('modif-mission-(:num)', 'Mission::modif/$1', ['as' => 'mission_modif']);
$routes->post('modif-mission', 'Mission::update', ['as' => 'mission_update']);
/////Ajout nouveau profil dans mission
$routes->post('modif-mission-ajout-profil', 'Mission::updateAddProfil', ['as' => 'mission_update_ajout_profil']);
/////Suppression  profil dans mission
$routes->post('modif-mission-supp-profil', 'Mission::updateDeleteProfil', ['as' => 'mission_update_supp_profil']);


// delet : http://amset.com/accueil/liste-mission/suppr-mission
$routes->post('suppr-mission', 'Mission::delete', ['as' => 'mission_delete']);

// affect: http://amset.com/accueil/liste-mission/affect-mission
$routes->get('affect-mission-(:num)', 'Mission::PageAttributionDesSalarie/$1', ['as' => 'mission_attribution']);
$routes->post('affect-mission', 'Mission::affect', ['as' => 'mission_affect']);


// --------------------------------------------------------

// client

// liste : http://amset.com/accueil/liste-client
$routes->get('liste-clients', 'Client::liste', ['as' => 'client_liste']);

// ajout : http://amset.com/accueil/liste-client/ajout-client
$routes->get('ajout-client', 'Client::ajout', ['as' => 'client_ajout']);
$routes->post('ajout-client', 'Client::create', ['as' => 'client_create']);


// modif : http://amset.com/accueil/liste-client/modif-client
$routes->get('modif-client-(:num)', 'Client::modif/$1', ['as' => 'client_modif']);
$routes->post('modif-client', 'Client::update', ['as' => 'client_update']);

// delete : http://amset.com/accueil/liste-client/suppr-client
$routes->post('suppr-client', 'Client::delete', ['as' => 'client_delete']);
// $routes->get('suppr-client-(:num)', 'Client::delete/$1', ['as' => 'client_delete']);

// image : http://amset.local/upload/logo.png

// --------------------------------------------------------
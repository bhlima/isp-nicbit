<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth\LoginController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
#$routes->get('/', 'Auth\LoginController::login');

$routes->add('/', 'Auth\AccountController::dashboard');
$routes->add('/users', 'Auth\AccountController::dashboard');


/**
 * --------------------------------------------------------------------
 * Custom Routing 
 * --------------------------------------------------------------------
 */
$routes->group('', ['namespace' => 'App\Controllers'], function($routes) {
	// Registration
	$routes->get('register', 'Auth\RegistrationController::register', ['as' => 'register']);
    $routes->post('register', 'Auth\RegistrationController::attemptRegister');

	// Activation
	$routes->get('activate-account', 'Auth\RegistrationController::activateAccount', ['as' => 'activate-account']);

	// Login-out
	$routes->get('login', 'Auth\LoginController::login', ['as' => 'login']);
	$routes->post('login', 'Auth\LoginController::attemptLogin');
    $routes->get('logout', 'Auth\LoginController::logout');

	// Forgotten password
	$routes->get('forgot-password', 'Auth\PasswordController::forgotPassword', ['as' => 'forgot-password']);
    $routes->post('forgot-password', 'Auth\PasswordController::attemptForgotPassword');
	
    // Reset password
    $routes->get('reset-password', 'Auth\PasswordController::resetPassword', ['as' => 'reset-password']);
    $routes->post('reset-password', 'Auth\PasswordController::attemptResetPassword');

    // Account settings
    $routes->get('dashboard', 'Auth\AccountController::dashboard', ['as' => 'dashboard']);
    $routes->post('account', 'Auth\AccountController::updateAccount');
    $routes->post('change-email', 'Auth\AccountController::changeEmail'); // not used
    $routes->get('confirm-email', 'Auth\AccountController::confirmNewEmail'); // not used
    $routes->post('change-password', 'Auth\AccountController::changePassword'); // new
    $routes->post('delete-account', 'Auth\AccountController::deleteAccount'); // new

    // Profile
    $routes->get('profile', 'Auth\AccountController::profile', ['as' => 'profile']); // new 
    $routes->post('update-profile', 'Auth\AccountController::updateProfile'); // new

    // Routers
    $routes->get('router', 'Auth\RouterController::router'); // new
    $routes->get('router/enable/(:num)', 'Auth\RouterController::enable'); // new
    $routes->get('router/disable/(:num)', 'Auth\RouterController::disable'); // new

    $routes->get('router/edit/(:num)', 'Auth\RouterController::edit'); // new
    $routes->post('router/update', 'Auth\RouterController::update'); // new
    $routes->get('router/delete/(:num)', 'Auth\RouterController::delete'); // new
    $routes->post('router/create-router', 'Auth\RouterController::createRouter');


    // Account groups reply
    $routes->get('groups', 'Auth\GroupsController::groups', ['as' => 'groups']);
    $routes->post('groups/delete/(:num)', 'Auth\GroupsController::delete');
    $routes->get('groups/editgroups/(:num)', 'Auth\GroupsController::editgroups');
    $routes->post('groups/dele/(:num)', 'Auth\GroupsController::delete');
    $routes->post('groups/update/(:num)', 'Auth\GroupsController::delete');


    // Account groups check
    $routes->get('groupsc', 'Auth\GroupscController::groupsc', ['as' => 'groupsc']);
    $routes->post('groupsc/delete/(:num)', 'Auth\GroupscController::delete');
    $routes->get('groupsc/editgroups/(:num)', 'Auth\GroupscController::edit');
    $routes->post('groupsc/dele/(:num)', 'Auth\GroupscController::delete');
    $routes->post('groupsc/update/(:num)', 'Auth\GroupscController::update');

    // Dictionary
    $routes->get('/dic', 'Auth\DictionaryController::dictionary', ['as' => 'dic']);
    $routes->post('/dicatt', 'Auth\DictionaryController::attributes');

    // Maps
    $routes->get('/map', 'Auth\MapController::map', ['as' => 'map']);

    // Plans
    $routes->get('/plans', 'Auth\PlansController::plans', ['as' => 'plans']);
    $routes->get('/plans/create', 'Auth\PlansController::create');
    $routes->post('/plans/c', 'Auth\PlansController::createplan');
    $routes->get('/plans/edit/(:num)', 'Auth\PlansController::edit');
    $routes->post('/plans/update', 'Auth\PlansController::update');






    // Contracts
    $routes->get('/contracts', 'Auth\ContractsController::contracts', ['as' => 'contracts']);
    $routes->get('/contracts/create', 'Auth\ContractsController::contracts', ['as' => 'create']);


    //nicbit
    $routes->get('nicbit', 'Auth\NicbitController::about'); // new
    $routes->get('git', 'Auth\NicbitController::git'); // new
    $routes->get('licenca', 'Auth\NicbitController::licenca'); // new
    $routes->get('update', 'Auth\NicbitController::atualiza'); // new
    $routes->get('inslicenca', 'Auth\NicbitController::key'); // new


    // Email models
    $routes->get('emodels', 'Auth\EmodelsController::emodels'); // new
    $routes->get('emodels/edit/(:num)', 'Auth\EmodelsController::edit'); // new
    $routes->post('emodels/createc', 'Auth\EmodelsController::createemodel'); // new
    $routes->get('emodels/create', 'Auth\EmodelsController::create'); // new
    $routes->get('emodels/delete/(:num)', 'Auth\EmodelsController::delete'); // new
    $routes->post('emodels/update', 'Auth\EmodelsController::update'); // new

    // Gteways
    $routes->get('gateways', 'Auth\GatewaysController::gateways'); // new
    $routes->get('gateways/enable/(:num)', 'Auth\GatewaysController::enable'); // new
    $routes->get('gateways/disable/(:num)', 'Auth\GatewaysController::disable'); // new
    $routes->get('gateways/edit/(:num)', 'Auth\GatewaysController::edit'); // new
    $routes->post('gateways/update-user', 'Auth\GatewaysController::update'); // new
    $routes->get('gateways/delete/(:num)', 'Auth\GatewaysController::delete'); // new
    $routes->post('gateways/create-gateway', 'Auth\GatewaysController::createGateway');

    // Users
    $routes->get('users', 'Auth\UsersController::users', ['as' => 'users']); // new
    $routes->get('users/enable/(:num)', 'Auth\UsersController::enable'); // new
    $routes->get('users/edit/(:num)', 'Auth\UsersController::edit'); // new
    $routes->post('users/update-user', 'Auth\UsersController::update'); // new
    $routes->get('users/delete/(:num)', 'Auth\UsersController::delete'); // new
    $routes->post('users/create-user', 'Auth\UsersController::createUser');
    $routes->get('logs', 'Auth\UsersController::userLogs', ['as' => 'userlogs']); // new

    // Clients
    $routes->get('clients', 'Auth\ClientsController::clients'); // new
    $routes->get('clients/edit/(:any)', 'Auth\ClientsController::edit'); // new
    $routes->post('clients/update', 'Auth\ClientsController::update'); // new
    $routes->post('clients/upinfo', 'Auth\ClientsController::updateinfo'); // new


    // Invoices
    $routes->get('invoices', 'Auth\InvoicesController::invoices'); // new
    $routes->post('invoices/update', 'Auth\InvoicesController::invoicesUpdate'); // new





    $routes->get('clients/delete/(:num)', 'Auth\ClientsController::delete'); // new
    $routes->post('clients/create', 'Auth\ClientsController::create');
    $routes->get('clients/perfil/(:any)', 'Auth\ClientsController::clientperfil');

    //Ajax teste bet
    $routes->get('clients/ajax', 'Auth\ClientsController::ajaxRequest');
    $routes->get('clients/handle-myajax/(:any)', 'Auth\ClientsController::handleajaxrequest');




    // Settings
    $routes->get('settings', 'Auth\SettingsController::settings', ['as' => 'settings']); // new
    $routes->post('settings-update-system', 'Auth\SettingsController::updateSystem'); // new
    $routes->post('settings-update-email', 'Auth\SettingsController::updateEmail'); // new
});

/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

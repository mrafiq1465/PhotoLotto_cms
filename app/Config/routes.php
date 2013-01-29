<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/_home.ctp)...
 */
    Router::parseExtensions('rss');
    Router::connect('/events/rss/:id', array('controller' => 'events', 'action' => 'view', 'ext' => 'rss' ),
        array('pass' => array('id'), 'id' => '[a-zA-Z-0-9-]*') );

	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */

    Router::connect('/users/login/', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/eventlist/*', array('controller' => 'events', 'action' => 'eventlist'));
    Router::connect('/events', array('controller' => 'events', 'action' => 'index'));
    Router::connect('/events/add', array('controller' => 'events', 'action' => 'add'));
    Router::connect('/events/edit/:id', array('controller' => 'events', 'action' => 'edit'),array('pass' => array('id')));
    Router::connect('/events/report/:id', array('controller' => 'events', 'action' => 'report'),array('pass' => array('id')));
    Router::connect('/eventaction/*', array('controller' => 'events', 'action' => 'event_action'));

    Router::connect('/*', array('controller' => 'events', 'action' => 'event_custom'), array('pass' => array('*')));

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';

<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $helpers = array(
        'Session',
        'Html'      => array('className' => 'TwitterBootstrap.BootstrapHtml'),
        'Form'      => array('className' => 'TwitterBootstrap.BootstrapForm'),
        'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator')
    );
    
    // If current user is not logged in, prompt for login
    function requireLogin() {
        if (!$this->Session->check('User')) {
            // clear session var for where we were before going to login form
            $this->Session->del('goto');

            // set flash message and redirect
            $this->Session->setFlash('You need to be logged in to access this area', FALSE, FALSE, 'login');
            $this->redirect('/users/login/',301);
            exit();
        }
    }

    // If current user is not admin, prompt for login
    function requireAdmin() {
        // if the admin session hasn't been set
        if ($this->Session->read('User.username')!='admin') {
            // set flash message and redirect
            $this->Session->setFlash('You need to be an administrator to access this area');
            $this->redirect('/users/login/');
            exit();
        }
    }

    // Returns logged in status of current user as true/false
    function isLoggedIn() {
        // if the current user is logged in
        return $this->Session->check('User');
    }

    // Returns true if logged in user is admin, false if not
    function isAdmin() {
        // if the logged in user is the admin
        return ($this->Session->read('User.name')=='admin') ? TRUE : FALSE ;
    }

    // called before every single action
    function beforeFilter() {
        // if admin pages are being requested
        if(isset($this->params['admin'])) {
            // require the admin to be logged in
            $this->requireAdmin();
        }
    }

    function calculate_distance(){


        App::import('Vendor', 'geography');
        $Geography = new Geography();


        return $Geography->mToKm($Geography->getDistance(-30, 150, -31, 160));

    }

}

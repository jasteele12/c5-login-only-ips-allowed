<?php /* controllers/login.php - override to only allow certain IPs to login */
defined('C5_EXECUTE') or die('Access Denied.');
/**
concrete5 Login only IPs Allowed override (concrete5 5.6+)
	Overrides the concrete5 concrete/controllers/login.php to only allow certain IP(s) to access the login page
Usage
	Copy login.php to controllers/login.php NOT concrete/controllers/login.php
	Uncomment and Edit the define for LOGIN_ONLY_IPS - or move it to config/site.php
	If the remote IP is not in the list, they will receive an Access Denied message instead of the login form.
Notes
	Make sure the Overrides Cache is turned off until you get it working
	See the comments for additional/optional customization.
Contact
	John Steele - Steelesoft Consulting
	http://steelesoftconsulting.com/	http://steelesoft.net/concrete5
	https://www.oncrete5.org/profile/-/view/13433/
**/

    // you could put one of these in config/site.php instead (only one define is allowed of course)
// define('LOGIN_ONLY_IPS', '192.168.1.2,192.168.1.3');  // IPs allowed to login, comma separated list
// define('LOGIN_ONLY_IPS', '75.170.15.217');            // IP allowed to login, single example

if (defined('LOGIN_ONLY_IPS')) {
    $ip = Loader::helper('validation/ip');
    $remote = $ip->getRequestIP();	// $remote = $_SERVER['REMOTE_ADDR'];
        // die('Current IP: '. $remote);  // uncomment to make sure the override is working, showing IP Address
    $login_ips = explode(',', LOGIN_ONLY_IPS);
        // die('<pre>'. print_r($login_ips, 1). '</pre>');
    $can_login = false;
        // check if they are allowed to login
    foreach($login_ips as $login) {
        if ($remote == $login) {
            $can_login = true;
        }
    }
    if (!$can_login) {
/*          // optionally log, bad idea if your site is being attacked
        $log = new Log('login_attempt', true);
        $log->write('Login attempted from '. $remote);
        $log->close();
*/
/*          // this might also add to the exception log
        throw new Exception(t('IP Address not Allowed'));
*/
        die('<h2>Access Denied</h2>');
    }
}

class LoginController extends Concrete5_Controller_Login { }

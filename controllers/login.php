<?php /* controllers/login.php - override to only allow certain IPs to login */
defined('C5_EXECUTE') or die('Access Denied.');

    // you could put this in config/site.php instead
// define('LOGIN_ONLY_IPS', '192.168.1.2,192.168.1.3');     // IPs allowed to login, comma separated list
// define('LOGIN_ONLY_IPS', '75.170.15.217'); // IPs allowed to login, comma separated list

if (defined('LOGIN_ONLY_IPS')) {
    $ip = Loader::helper('validation/ip');
    $remote = $ip->getRequestIP();          // $remote = $_SERVER['REMOTE_ADDR'];
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
/*          // optionally log
        $log = new Log('login_attempt', true);
        $log->write('Logn attempted from '. $remote);
        $log->close();
*/
/*          // this may also add to the exception log
        throw new Exception(t('IP Address not Allowed'));
*/
        die('<h2>Access Denied</h2>');
    }
}

class LoginController extends Concrete5_Controller_Login { }


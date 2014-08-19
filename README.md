c5-login-only-ips-allowed
=========================
  Overrides the concrete5 concrete5/controllers/login.php to only allow certain IP(s) to access the login page

Usage
-----
  Copy login.php to controllers/login.php *NOT* concrete/controllers/login.php
  Uncomment and Edit the define for LOGIN_ONLY_IPS (or move it to config/site.php
  If the remote IP is not in the list, they will receive an Access Denied message instead of the login form.

Notes
-----
  Make sure the Overrides Cache is turned off until you get it working
  See the comments for additional/optional customization.

Contact
-------
  John Steele   Steelesoft Consulting
  http://steelesoftconsulting.com/  http://steelesoft.net/concrete5
  https://www.concrete5.org/profile/-/view/13433/

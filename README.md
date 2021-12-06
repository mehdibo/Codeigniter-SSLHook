> :warning:  I no longer maintaing this project, if you have access to the server add these headers and redirections early on before the request even reaches the application 

Codeigniter-SSLHook
============================

This hook will automatically redirect to the HTTPS version of your website and set the appropriate headers.


Installation
-----------------
Make sure your `base_url` starts with `https`

Copy `/application/config/hooks.php`  into your `application`'s folder.
If you have other hooks copy the content of `/application/config/hooks.php` to your `hooks.php` file.

Enable hooks by modifying your `/application/config/config.php`, set `enable_hooks` to `TRUE`:
```php
/*
|--------------------------------------------------------------------------
| Enable/Disable System Hooks
|--------------------------------------------------------------------------
|
| If you would like to use the 'hooks' feature you must enable it by
| setting this variable to TRUE (boolean).  See the user guide for details.
|
*/
$config['enable_hooks'] = TRUE;
```

How does it work?
-----------------
The hook will:
- Redirect to the HTTPS version if accessed from a non-secure connection.
- Make cookies only accessible via HTTPS (no JavaScript)
- Set the following headers:
  -  `Strict-Transport-Security: max-age=2629800`
  -  `X-Content-Type-Options: nosniff`
  -  `Referrer-Policy: strict-origin`
  -  `X-Frame-Options: DENY`
  -  `X-XSS-Protection: 1; mode=block`

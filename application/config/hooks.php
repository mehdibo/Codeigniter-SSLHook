<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Security improvments when using SSL
$hook['post_controller'][] = function()
{
	// Check if the base url starts with HTTPS
	if(substr(base_url(), 0, 5) !== 'https'){
		return;
	}

	// If we are not using HTTPS or in a cli
	if(!is_https() || is_cli()){
		// Redirect to the HTTPS version
		redirect(base_url(uri_string()));
	}

	// Get CI instance
	$CI =& get_instance();

	// Enable cookie_secure to use it for session cookie
	$CI->config->set_item('cookie_secure', TRUE);
	// Force future requests to be over HTTPS (max-age is set to 1 month
	$CI->output->set_header("Strict-Transport-Security: max-age=2629800");
	// Disable MIME type sniffing
	$CI->output->set_header("X-Content-Type-Options: nosniff");
	// Only allow referrers to be sent withing the website
	$CI->output->set_header("Referrer-Policy: strict-origin");
	// Frames are not allowed
	$CI->output->set_header("X-Frame-Options: DENY");
	// Enable XSS protection in browser
	$CI->output->set_header("X-XSS-Protection: 1; mode=block");
};

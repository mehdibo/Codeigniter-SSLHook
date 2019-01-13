<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Security improvments when using SSL
$hook['post_controller'][] = function()
{
	// Check if the base url starts with HTTPS
	if(substr(base_url(), 0, 5) !== 'https'){
		return;
	}

	// If we are not using HTTPS and not in CLI
	if(!is_https() && !is_cli()){
		// Redirect to the HTTPS version
		redirect(base_url(uri_string()));
	}

	// Get CI instance
	$CI =& get_instance();

	// Only allow HTTPS cookies (no JS)
	$CI->config->set_item('cookie_secure', TRUE);
	$CI->config->set_item('cookie_httponly', TRUE);
	
	// Set headers
	$CI->output->set_header("Strict-Transport-Security: max-age=2629800")// Force future requests to be over HTTPS (max-age is set to 1 month
			   ->set_header("X-Content-Type-Options: nosniff") // Disable MIME type sniffing
			   ->set_header("Referrer-Policy: strict-origin") // Only allow referrers to be sent withing the website
			   ->set_header("X-Frame-Options: DENY") // Frames are not allowed
			   ->set_header("X-XSS-Protection: 1; mode=block"); // Enable XSS protection in browser
};

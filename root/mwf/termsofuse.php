<?php

// Terms of Service

 

$terms_url = 'http://www.policy.ucsb.edu/terms_of_use/content.html';

$terms_output = '<div>Error while retrieving the Terms of Use</div>';
$http_status_code = NULL;


	// Make the request
		$curlhandle = curl_init();
		curl_setopt($curlhandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlhandle, CURLOPT_PROXYPORT, 3128);
		curl_setopt($curlhandle, CURLOPT_PROXY, "10.3.100.201");
		curl_setopt($curlhandle, CURLOPT_URL, $terms_url);
		$contents = curl_exec($curlhandle);
		$curl_error = curl_errno($curlhandle);
		$curl_info = curl_getinfo($curlhandle);
		
		$http_status_code = $curl_info['http_code'];
		
		curl_close($curlhandle);


	// If successful, output the HTML

	if($http_status_code == 200)
		{

		$terms_output = $contents;
	
	}


// Return URL is set to the main MWF UCSB site, by default
$return_url = 'http://mwf.library.ucsb.edu/';
if(isset($_SERVER['HTTP_REFERER']))
{
	$return_url = $_SERVER['HTTP_REFERER'];
}

require_once(dirname(dirname(__FILE__)).'/assets/lib/decorator.class.php');
require_once(dirname(dirname(__FILE__)).'/assets/config.php');

echo HTML_Decorator::html_start()->render();

echo Site_Decorator::head()->set_title('UCSB Terms Of Use')->render();

echo HTML_Decorator::body_start()->render();

echo Site_Decorator::header()
        ->set_title('UCSB Terms Of Use')
        ->render();
?>
<div class="content-full content-padded">
<?php echo $terms_output; ?>
</div>
<?

// Footer
echo Site_Decorator::button_full()
                ->set_padded()
                ->add_option(Config::get('global', 'back_to_home_text'), $return_url )
                ->render();

echo Site_Decorator::default_footer()->render();

echo HTML_Decorator::body_end()->render();

echo HTML_Decorator::html_end()->render();

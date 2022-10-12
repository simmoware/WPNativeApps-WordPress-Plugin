<?php

/**
 * Fired during plugin activation
 *
 * @link       https://wpnativeapps.com/
 * @since      1.0.0
 *
 * @package    Wp_Native_Apps
 * @subpackage Wp_Native_Apps/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Native_Apps
 * @subpackage Wp_Native_Apps/includes
 * @author     WPNativeApps <wpnativeapps@hustledigital.com.au>
 */
class Wp_Native_Apps_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$url = 'https://api.staging.wpnativeapps.com/v1/account';
		$args = array(
									'method'=>'POST',
									'headers'=>array(
										'wpnativeappsrequestkey'=> 'sO4nl&W5sVTpBOQ#Wo07bJGMdJTZ&isi$HTe#j3x'
									),
									'body'=>array('domain' => str_replace(array("http://","https://"), array(""), get_site_url())),
								);

		$request = wp_remote_post($url,$args);
		$body = wp_remote_retrieve_body($request);
		$response = (array)json_decode($body);


		if($response['success']){
			$appId = $response['appId'];
			$secret = $response['secret'];
			$siteURL = get_site_url();

			$config = [
				"appId"=> $appId,
				"appSecret"=> $secret,
				"siteURL"=> $siteURL,
				"name"=> "",
				"headerToHide"=> "",
				"footerToHide"=> "",
				"otherHide"=> [],
				"splash"=> [
					"backgroundColor"=> "",
					"backgroundImage"=> ""
				],
				"topBarNav"=> [
					"styles"=> [
						"backgroundColor"=> "",
						"statusBarTextColor"=> "",
						"bannerLogo"=> "",
						"topBarTextColor"=> "",
						"topBarIconColor"=> ""
					]
				],
				"bottomBarNav"=> [
					"styles"=> [
						"backgroundColor"=> "",
						"defaultIconColor"=> "",
						"activeIconColor"=> ""
					],
					"pages"=> [[
						"url"=> $siteURL,
						"icon"=> "",
						"name"=> "Home",
						"isExternal"=> false,
						"topNav"=> [
							"designType"=> "",
							"useLogo"=> true,
							"logo"=> "",
							"label"=> "",
							"hamburger"=> [
								"backgroundColor"=> "",
								"menuIcon"=> ""
							]
						]
					]]
				],
				"prompts"=> [
					"promptLocationService"=> true,
					"promptItems"=> [
						"pushNotification"=> [
							"styles"=> [
								"backgroundColor"=> "",
								"textColor"=> "",
								"icon"=> "",
								"title"=> "",
								"description"=> "",
								"acceptButtonText"=> "",
								"acceptButtonColor"=> ""
							]
						],
						"trackingService"=> [
							"styles"=> [
								"backgroundColor"=> "",
								"textColor"=> "",
								"icon"=> "",
								"title"=> "",
								"description"=> "",
								"acceptButtonText"=> "",
								"acceptButtonColor"=> ""
							]
						]
					]
				],
				"authenticationSettings"=> [
					"accountRequired"=> false,
					"authenticationPage"=> ""
				]
			];

			file_put_contents(str_replace("/includes", "/admin", dirname(__FILE__)) . '/config.json', json_encode($config));
			delete_option( 'WPNativeAppsConfigMessage');
		}else{
			// Add option to notify of error.
			update_option( 'WPNativeAppsConfigMessage', "There was error activationg the plugin: ".$response['message'], '', 'yes' );
		}


	}
}

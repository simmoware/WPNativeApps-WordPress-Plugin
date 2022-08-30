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
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.staging.wpnativeapps.com/v1/account',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => array('domain' => str_replace("https://", "", get_site_url())),
		CURLOPT_HTTPHEADER => array(
			'WPNativeAppsRequestKey: sO4nl&W5sVTpBOQ#Wo07bJGMdJTZ&isi$HTe#j3x'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$response = (array) json_decode($response);
		

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

		}

	}

}

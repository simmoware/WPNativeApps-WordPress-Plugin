<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wpnativeapps.com/
 * @since      1.0.0
 *
 * @package    Wp_Native_Apps
 * @subpackage Wp_Native_Apps/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Native_Apps
 * @subpackage Wp_Native_Apps/admin
 * @author     WPNativeApps <wpnativeapps@hustledigital.com.au>
 */
class Wp_Native_Apps_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Wordpress Native Apps Settings fetched from Database.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wpnativeapps    The current version of this plugin.
	 */
	private $wpnativeapps;

	/**
	 * Default Configuration File Fetched From Storage/ Or later fetched from s3bucket.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wpnativeapps    The current version of this plugin.
	 */
	private $wpNativeAppSettings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->admin_notices = null;
		$this->wpnativeAppSettings = $this->wpna_get_settings();

	}

	public function wpna_addAdminNotice($notice){
		$admin_notices = $this->admin_notices;
		$admin_notices[] = $notice;
		$this->admin_notices = $admin_notices;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Native_Apps_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Native_Apps_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 $wp_scripts = wp_scripts();
		 wp_enqueue_style('plugin_name-admin-ui-css',
		                 'http://ajax.googleapis.com/ajax/libs/jqueryui/' . $wp_scripts->registered['jquery-ui-core']->ver . '/themes/smoothness/jquery-ui.css',
		                 false,
		                 $this->version,
		                 false);

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-native-apps-admin.css', array(), date("YmdHis")/*$this->version*/, 'all' );

		wp_enqueue_style( $this->plugin_name.'_introduction_css', plugin_dir_url( __FILE__ ) . 'css/introduction.css', array(), date("YmdHis")/*$this->version*/, 'all' );
		wp_enqueue_style( $this->plugin_name.'_general_css', plugin_dir_url( __FILE__ ) . 'css/general.css', array(), date("YmdHis")/*$this->version*/, 'all' );
		wp_enqueue_style( $this->plugin_name.'_publish_css', plugin_dir_url( __FILE__ ) . 'css/publish.css', array(), date("YmdHis")/*$this->version*/, 'all' );
		wp_enqueue_style( $this->plugin_name.'_account_css', plugin_dir_url( __FILE__ ) . 'css/account.css', array(), date("YmdHis")/*$this->version*/, 'all' );
		wp_enqueue_style( $this->plugin_name.'_bottomNav_css', plugin_dir_url( __FILE__ ) . 'css/bottomNav.css', array(), date("YmdHis")/*$this->version*/, 'all' );
		wp_enqueue_style( $this->plugin_name.'_topNav_css', plugin_dir_url( __FILE__ ) . 'css/topNav.css', array(), date("YmdHis")/*$this->version*/, 'all' );
		wp_enqueue_style( $this->plugin_name.'_prompts_css', plugin_dir_url( __FILE__ ) . 'css/prompts.css', array(), date("YmdHis")/*$this->version*/, 'all' );
		wp_enqueue_style( $this->plugin_name.'_pushnotifications_css', plugin_dir_url( __FILE__ ) . 'css/pushNotifications.css', array(), date("YmdHis")/*$this->version*/, 'all' );
		wp_enqueue_style( $this->plugin_name.'_authentication_css', plugin_dir_url( __FILE__ ) . 'css/authentication.css', array(), date("YmdHis")/*$this->version*/, 'all' );
		wp_enqueue_style( $this->plugin_name.'_analytics_css', plugin_dir_url( __FILE__ ) . 'css/analytics.css', array(), date("YmdHis")/*$this->version*/, 'all' );
		wp_enqueue_style( $this->plugin_name.'_iframe_css', plugin_dir_url( __FILE__ ) . 'css/iframe.css', array(), date("YmdHis")/*$this->version*/, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Native_Apps_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Native_Apps_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		 wp_enqueue_media();
		 // if ( ! did_action( 'wp_enqueue_media' ) ) {
			//  wp_enqueue_media();
		 // }
		 if (get_current_screen()->id == 'wpnativeapps-settings') {
	    // wp_enqueue_style('thickbox');
			wp_enqueue_script('jquery-ui-core');// enqueue jQuery UI Core
    	wp_enqueue_script('jquery-ui-tabs');// enqueue jQuery UI Tabs
	    // wp_enqueue_script('plugin-install');
	  }
		// wp_enqueue_script('jquery-ui-core');// enqueue jQuery UI Core
    // wp_enqueue_script('jquery-ui-tabs');// enqueue jQuery UI Tabs
		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_script( 'wp-color-picker-alpha', plugin_dir_url( __FILE__ ) . 'js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), date("YmdHis"), false );
		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-native-apps-admin.js', array( 'jquery', 'wp-color-picker' ), date("YmdHis"), false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-native-apps-admin.js', array('jquery', 'jquery-ui-core' , 'jquery-ui-tabs'), date("YmdHis"), false );
		wp_enqueue_script( $this->plugin_name."_topNav", plugin_dir_url( __FILE__ ) . 'js/topnav.js', array('jquery'), date("YmdHis"), false );
		wp_enqueue_script( $this->plugin_name."_analytics", plugin_dir_url( __FILE__ ) . 'js/analytics.js', array('jquery'), date("YmdHis"), false );
		wp_enqueue_script( $this->plugin_name."_pushNotifications", plugin_dir_url( __FILE__ ) . 'js/pushNotifications.js', array('jquery'), date("YmdHis"), false );

		wp_enqueue_script( $this->plugin_name."_previewJs", plugin_dir_url( __FILE__ ) . 'js/iframePreview.js', array('jquery'), date("YmdHis"), false );
		wp_localize_script( $this->plugin_name, 'WPNativeApps',
		        array(
		            'pluginURL' => plugin_dir_url( __FILE__ ),
		            'homeURL' => get_home_url(),
		        )
		    );

		wp_enqueue_script( 'wpnaImageUpload', plugin_dir_url( __FILE__ ) . 'js/wpnaImageUpload.js', array( 'jquery', $this->plugin_name ), date("YmdHis"), false );

	}

	/**
	 * Register the Function to handle the saving of notification groups.
	 *
	 * @since    1.0.0
	 */

	public function handle_add_notification_group(){
		if( isset( $_POST['addSubscriptionGroup_nonce'] ) && wp_verify_nonce( $_POST['addSubscriptionGroup_nonce'], 'wpna_addSubscriptionGroup_nonce') ) {
			// var_dump($_POST);die;
			$notice = array(
						'type'=>'success',
						'icon'=>plugin_dir_url( __FILE__ ).'images/WPNativeApps-Icon.png',
						'title'=>'Settings Saved',
						'message'=>'Success'
					);

			$this->wpna_addAdminNotice($notice);
			wp_safe_redirect( admin_url('admin.php?page=wpnativeapps-push-notification') );
			exit;

		}else {
			echo 'Nonce failed';die;
				wp_die( __( 'Invalid nonce specified', $this->plugin_name ), __( 'Error', $this->plugin_name ), array(
							'response' 	=> 403,
							'back_link' => 'admin.php?page=wpnativeapps-push-notification?tab=subscriptionGroup',
					) );
			}
	}
	/**
	 * Register the Function to handle the saving of notification groups.
	 *
	 * @since    1.0.0
	 */

	public function handle_send_push_notification(){
		if( isset( $_POST['add_push_notification_nonce'] ) && wp_verify_nonce( $_POST['add_push_notification_nonce'], 'add_push_notification_submit_nonce') ) {
			// var_dump($_POST);die;
			$notice = array(
						'type'=>'success',
						'icon'=>plugin_dir_url( __FILE__ ).'images/WPNativeApps-Icon.png',
						'title'=>'Settings Saved',
						'message'=>'Success'
					);

			$this->wpna_addAdminNotice($notice);
			wp_safe_redirect( admin_url('admin.php?page=wpnativeapps-push-notification?tab=send') );
			exit;

		}else {
			echo 'Nonce failed';die;
				wp_die( __( 'Invalid nonce specified', $this->plugin_name ), __( 'Error', $this->plugin_name ), array(
							'response' 	=> 403,
							'back_link' => 'admin.php?page=wpnativeapps-push-notification',
					) );
			}
	}
	/**
	 * Register the Function to handle the settings form submission to store app settings.
	 *
	 * @since    1.0.0
	 */

	public function handle_settings_save(){
		if( isset( $_POST['wpna_save_settings_nonce'] ) && wp_verify_nonce( $_POST['wpna_save_settings_nonce'], 'wpna_save_settings_form_nonce') ) {

			// echo '<pre>';
			// var_dump($_POST);die;
			$name = 				isset($_POST['wpna_app_name']) ? sanitize_text_field($_POST['wpna_app_name']) : '';
			$headerToHide = isset($_POST['headerToHide']) ? sanitize_text_field($_POST['headerToHide']) : '';
			$footerToHide = isset($_POST['footerToHide']) ? sanitize_text_field($_POST['footerToHide']) : '';
			$otherHide = 		isset($_POST['otherHide']) ? $_POST['otherHide'] : null;


			$splash_background_color = isset($_POST['splash_backgroundColor']) ? sanitize_text_field($_POST['splash_backgroundColor']) : '';
			$splash_backgroundImage_image_url = isset($_POST['splash_backgroundImage_image_url']) ? sanitize_url($_POST['splash_backgroundImage_image_url']) : '';
			$splash = array(
											'backgroundColor'=>$splash_background_color,
											'backgroundImage'=>$splash_backgroundImage_image_url,
										);

			$topBarNav = array(
											'styles'=> array(
															"backgroundColor"=>	isset($_POST['topBarNav_backgroundColor']) ? sanitize_text_field($_POST['topBarNav_backgroundColor']) : '',
															"statusBarTextColor"=> 	isset($_POST['topbar_statusbar_textColour']) ? sanitize_text_field($_POST['topbar_statusbar_textColour']) : '',
															"bannerLogo"=> 	isset($_POST['topBarNav_styles_bannerLogo_image_url']) ? sanitize_url($_POST['topBarNav_styles_bannerLogo_image_url']) : '',
															"topBarTextColor"=> 	isset($_POST['topbar_textColour']) ? sanitize_text_field($_POST['topbar_textColour']) : '',
															"topBarIconColor"=>	isset($_POST['topbar_iconColor']) ? sanitize_text_field($_POST['topbar_iconColor']) : '',
														)
											);

			// $bottombarNavPages = null;
			$bottomBarNav = array(
				"styles"=>array(
					"backgroundColor"=> isset($_POST['bottombarNavStyle_backgroundColor']) ? sanitize_text_field($_POST['bottombarNavStyle_backgroundColor']) : '',
				 "defaultIconColor"=> isset($_POST['bottombarNavStyle_defaultIconColor']) ? sanitize_text_field($_POST['bottombarNavStyle_defaultIconColor']) : '',
				 "activeIconColor"=> isset($_POST['bottombarNavStyle_activeIconColor']) ? sanitize_text_field($_POST['bottombarNavStyle_activeIconColor']) : '',
			 ),
				"pages"=> array(),
			);

			$bottomBarNavPages = $_POST['bottomBarItemText'];
				if(!empty($bottomBarNavPages)){
					$pagecount = 1;
					foreach($bottomBarNavPages as $page){
						$pageType = $_POST['bottomBarItemType_'.$pagecount];
						if($pageType == "page"){
							$pageUrl = isset($_POST['bottomBarItemUrlInternal_'.$pagecount]) ? sanitize_url($_POST['bottomBarItemUrlInternal_'.$pagecount]) : '';
							if(!empty($pageUrl))
								$pageUrl = get_permalink($this->getIDfromGUID($pageUrl));
							$isExternal = false;
						}else{
							$pageUrl = isset($_POST['bottomBarItemUrlExternal_'.$pagecount]) ? sanitize_url($_POST['bottomBarItemUrlExternal_'.$pagecount]) : '';
							$isExternal = true;
						}
						$pageIcon = isset($_POST['bottomBarNavLogo_'.$pagecount.'_image_url']) ? sanitize_url($_POST['bottomBarNavLogo_'.$pagecount.'_image_url']) : '';

						$designType  = isset($_POST['topNav_'.$pagecount.'_structure']) ? sanitize_text_field($_POST['topNav_'.$pagecount.'_structure']) : '';
						$topNav = null;
						switch($designType){
							case 'logoOnly':{
								$topNav = array(
				              "designType"=> "logoOnly",
											"useLogo" => $_POST['topNav_'.$pagecount.'_logoOnly_type'] == 'logo'? true : false,
				              "logo"=> isset($_POST['topNav_'.$pagecount.'_logo_image_url']) ? sanitize_url($_POST['topNav_'.$pagecount.'_logo_image_url']) : '',
				              "label"=> isset($_POST['topNav_'.$pagecount.'_text']) ? sanitize_text_field($_POST['topNav_'.$pagecount.'_text']) : '',
				              "alignment"=> isset($_POST['topNav_'.$pagecount.'_logoOnly_align']) ? sanitize_text_field($_POST['topNav_'.$pagecount.'_logoOnly_align']) : '',
								);
								break;
							}
							case 'logoLeftBurgerRight':{

								$HBItemSources = $_POST['topNav_'.$pagecount.'_logoLeftBurgerRight_hamburgerNavItemSource'];
								// var_dump($navSources);die;
								$navInternalUrls = $_POST['topNav_'.$pagecount.'_logoLeftBurgerRight_hamburgerNavItem_internalURL'];
								// var_dump($navInternalUrls);
								$navExternalUrls = $_POST['topNav_'.$pagecount.'_logoLeftBurgerRight_hamburgerNavItem_externalURL'];
								// var_dump($navExternalUrls);die;
								$hamburgerMenuItems = array();

								if(!empty($HBItemSources)){
									$buttonCount = 1;
									foreach ($HBItemSources as $key=>$value){
										$navIcon = isset($_POST['topNav_'.$pagecount.'_logoLeftBurgerRight_hamburgerNavItemIcon_'.$buttonCount.'_image_url']) ? $_POST['topNav_'.$pagecount.'_logoLeftBurgerRight_hamburgerNavItemIcon_'.$buttonCount.'_image_url'] : '';
										$hamburgerMenuItems[] = array(
											"isExternal"=> $value == 'external' ? true : false,
											"icon"=> $navIcon,
											"url"=> $value == 'page' ? ( isset($navInternalUrls[$key]) ? get_permalink($this->getIDfromGUID($navInternalUrls[$key])) : '') : ( isset($navExternalUrls[$key]) ? $navExternalUrls[$key] : ''),
										);
										$buttonCount++;
									}
								}


								$topNav = array(
				            "designType"=> "logoLeftBurgerRight",
										"useLogo" => $_POST['topNav_'.$pagecount.'_logoLeftBurgerRight_type'] == 'logo'? true : false,
										"logo"=> isset($_POST['topNav_'.$pagecount.'_logo_image_url']) ? sanitize_url($_POST['topNav_'.$pagecount.'_logo_image_url']) : '',
										"label"=> isset($_POST['topNav_'.$pagecount.'_text']) ? sanitize_text_field($_POST['topNav_'.$pagecount.'_text']) : '',
				            "hamburger"=> [
				              "backgroundColor"=> isset($_POST['topNav_'.$pagecount.'_logoLeftBurgerRight_HamburgerMenuBgColor']) ? sanitize_text_field($_POST['topNav_'.$pagecount.'_logoLeftBurgerRight_HamburgerMenuBgColor']) : '',
				              "menuIcon"=> isset($_POST['topNav_'.$pagecount.'_logoLeftBurgerRight_HamburgerMenuIcon_image_url']) ? sanitize_url($_POST['topNav_'.$pagecount.'_logoLeftBurgerRight_HamburgerMenuIcon_image_url']) : '',
											"fontColor"=> isset($_POST['topNav_'.$pagecount.'_logoLeftBurgerRight_HamburgerMenuFontColor']) ? sanitize_text_field($_POST['topNav_'.$pagecount.'_logoLeftBurgerRight_HamburgerMenuFontColor']) : '',
											"hamburgerMenuItems"=> $hamburgerMenuItems
				            ]
								);
								// var_dump($topNav);die;
								break;
							}
							case 'logoLeftNavRight':{

								$navSources = $_POST['topNav_'.$pagecount.'_logoLeftNavRight_Source'];
								$navInternalUrls = $_POST['topNav_'.$pagecount.'_logoLeftNavRight_internalURL'];
								$navExternalUrls = $_POST['topNav_'.$pagecount.'_logoLeftNavRight_externalURL'];


								$buttons = array();
								if(!empty($navSources)){
									$buttonCount = 1;
									foreach ($navSources as $key=>$value){
										$navIcon = isset($_POST['topNav_'.$pagecount.'_logoLeftNavRight_iconImage_'.$buttonCount.'_image_url']) ? $_POST['topNav_'.$pagecount.'_logoLeftNavRight_iconImage_'.$buttonCount.'_image_url'] : '';

										$buttons[] = array(
											"isExternal"=> $value == 'external' ? true : false,
											"icon"=> $navIcon,
											"url"=> $value == 'page' ? ( isset($navInternalUrls[$key]) ? get_permalink($this->getIDfromGUID($navInternalUrls[$key])) : '') : ( isset($navExternalUrls[$key]) ? $navExternalUrls[$key] : ''),
										);
										$buttonCount++;
									}
								}

								$topNav = array(
				            "designType"=> "logoLeftNavRight",
										"useLogo" => $_POST['topNav_'.$pagecount.'_logoLeftNavRight_type'] == 'logo'? true : false,
										"logo"=> isset($_POST['topNav_'.$pagecount.'_logo_image_url']) ? sanitize_url($_POST['topNav_'.$pagecount.'_logo_image_url']) : '',
										"label"=> isset($_POST['topNav_'.$pagecount.'_text']) ? sanitize_text_field($_POST['topNav_'.$pagecount.'_text']) : '',
										"buttons"=> $buttons
								);
								break;
							}

							case 'logoMidNavBoth':{


								$navSources = $_POST['topNav_'.$pagecount.'_logoMidNavBoth_Source'];
								$navInternalUrls = $_POST['topNav_'.$pagecount.'_logoMidNavBoth_internalURL'];
								$navExternalUrls = $_POST['topNav_'.$pagecount.'_logoMidNavBoth_externalURL'];
								// $navIcons = $_POST['topNav_'.$pagecount.'_logoMidNavBoth_iconImage_image_url'];

								// topNav_4_logoMidNavBoth_iconImage_image_url



								$leftButtons = array();
								$rightButtons = array();

								if(!empty($navSources)){
									$buttonCount = 1;
									foreach ($navSources as $key=>$value){
										$temp = array(
											"isExternal"=> $value == 'external' ? true : false,
											"icon"=> isset($_POST['topNav_'.$pagecount.'_logoMidNavBoth_iconImage_'.$buttonCount.'_image_url'])? $_POST['topNav_'.$pagecount.'_logoMidNavBoth_iconImage_'.$buttonCount.'_image_url']: '',
											"url"=> $value == 'page' ? ( isset($navInternalUrls[$key]) ? get_permalink($this->getIDfromGUID($navInternalUrls[$key])) : '') : ( isset($navExternalUrls[$key]) ? $navExternalUrls[$key] : ''),
										);
										if($buttonCount == 1){
											$leftButtons[] = $temp;
										}else{
											$rightButtons[] = $temp;
										}
										$buttonCount++;
									}
								}
								$topNav = array(
										"designType"=> "logoMidNavBoth",
										"useLogo" => $_POST['topNav_'.$pagecount.'_logoMidNavBoth_type'] == 'logo'? true : false,
										"logo"=> isset($_POST['topNav_'.$pagecount.'_logo_image_url']) ? sanitize_url($_POST['topNav_'.$pagecount.'_logo_image_url']) : '',
										"label"=> isset($_POST['topNav_'.$pagecount.'_text']) ? sanitize_text_field($_POST['topNav_'.$pagecount.'_text']) : '',
										"leftButtons"=> $leftButtons,
										"rightButtons"=> $rightButtons
								);
								break;
							}
						}
						$bottomBarNav["pages"][] = array(
																					"url"=> $pageUrl,
																					"icon" => $pageIcon,
																					"name" => $page,
																					"isExternal" => $isExternal,
																					"topNav" => $topNav
																				);
						$pagecount++;
					}
				}


			$prompts = array(
										"promptLocationService"=>$_POST["promptLocationOn"] == 'true' ? true : false,
										"promptItems"=>array(
														"pushNotification"=>array(
															"styles"=> array(
																"backgroundColor"=> isset($_POST['promptPushNoti_backgroundColor']) ? sanitize_text_field($_POST['promptPushNoti_backgroundColor'] ) : '',
																"textColor"=>isset($_POST['promptPushNoti_textColor']) ? sanitize_text_field($_POST['promptPushNoti_textColor'] ) : '',
																"icon"=> isset($_POST['promptPushNoti_icon_image_url']) ? sanitize_url($_POST['promptPushNoti_icon_image_url'] ) : '',
																"title"=>isset($_POST['promptPushNoti_titleText']) ? sanitize_text_field($_POST['promptPushNoti_titleText'] ) : '',
																"description"=>isset($_POST['promptPushNoti_descText']) ? sanitize_text_field($_POST['promptPushNoti_descText'] ) : '',
																"acceptButtonText"=>isset($_POST['promptPushNoti_acceptButtonText']) ? sanitize_text_field($_POST['promptPushNoti_acceptButtonText'] ) : '',
																"acceptButtonColor"=>isset($_POST['promptPushNoti_acceptButtonColor']) ? sanitize_text_field($_POST['promptPushNoti_acceptButtonColor'] ) : '',
															)
														),
														"trackingService"=>array(
															"styles"=> array(
																"backgroundColor"=> isset($_POST['promptTracking_backgroundColor']) ? sanitize_text_field($_POST['promptTracking_backgroundColor'] ) : '',
																"textColor"=> isset($_POST['promptTracking_textColor']) ? sanitize_text_field($_POST['promptTracking_textColor'] ) : '',
																"icon"=> isset($_POST['promptTracking_icon_image_url']) ? sanitize_url($_POST['promptTracking_icon_image_url'] ) : '',
																"title"=>isset($_POST['promptTracking_titleText']) ? sanitize_text_field($_POST['promptTracking_titleText'] ) : '',
																"description"=>isset($_POST['promptTracking_descText']) ? sanitize_text_field($_POST['promptTracking_descText'] ) : '',
																"acceptButtonText"=>isset($_POST['promptTracking_acceptButtonText']) ? sanitize_text_field($_POST['promptTracking_acceptButtonText'] ) : '',
																"acceptButtonColor"=>isset($_POST['promptTracking_acceptButtonColor']) ? sanitize_text_field($_POST['promptTracking_acceptButtonColor'] ) : '',
															)
														)
													)
												);


												$authentication = array(
													"accountRequired"=> $_POST['accountRequired'] == 'yes'? true : false,
											    "authenticationPage"=>isset($_POST['authenticationPage']) ? get_permalink($this->getIDfromGUID(sanitize_url($_POST['authenticationPage']))) : ''
												);

						// echo dirname(__FILE__) . '/config.json';die;
						// echo json_encode($configSaved);die;
						// Reading the config and storing the Licence Keys
						$existingConfig = json_decode(file_get_contents(dirname(__FILE__) . '/config.json'), true);
						$appId = isset($existingConfig['appId']) ? $existingConfig['appId'] : '';
						$appSecret = isset($existingConfig['appSecret']) ? $existingConfig['appSecret'] : '';
						$siteURL = get_site_url();


						$configSaved = array(
									"appId"=> $appId,
									"appSecret"=> $appSecret,
									"siteURL"=> $siteURL,
									"name"=> $name,
									"headerToHide"=> $headerToHide,
									"footerToHide"=> $footerToHide,
									"otherHide"=> $otherHide,
									"splash"=> $splash,
									"topBarNav"=>$topBarNav,
									"bottomBarNav"=>$bottomBarNav,
									"prompts"=>$prompts,
									"authenticationSettings"=>$authentication
							);

						file_put_contents(dirname(__FILE__) . '/config.json', json_encode($configSaved));


					// add the admin notice
					$notice = array(
								'type'=>'success',
								'icon'=>plugin_dir_url( __FILE__ ).'images/WPNativeApps-Icon.png',
								'title'=>'Settings Saved',
								'message'=>'Your settings have been saved, click the preview button to view your preview'
							);
					$this->wpna_addAdminNotice($notice);
					wp_safe_redirect( admin_url('admin.php?page=wpnativeapps-settings') );
					exit;
				}
				else {
					wp_die( __( 'Invalid nonce specified', $this->plugin_name ), __( 'Error', $this->plugin_name ), array(
								'response' 	=> 403,
								'back_link' => 'admin.php?page=' . $this->plugin_name,
						) );
				}

	}

	/**
	 * Register the Function to add custom post type for pushnotification.
	 *
	 * @since    1.0.0
	 */
	function add_pushnotification_postType(){
		register_post_type( 'pushnotification',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Push Notifications' ),
                'singular_name' => __( 'Push Notification' )
            ),
            'public' => false,
            'has_archive' => true,
            'rewrite' => array('slug' => 'pushnotification'),
            'show_in_rest' => true,
						'supports'=>array('custom-fields')

        )
    );
	}
	/**
	 * Register the Function to add custom post type for pushnotification group.
	 *
	 * @since    1.0.0
	 */
	function add_pushnotification_group_postType(){
		register_post_type( 'pushnotification-group',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Push Notification Groups' ),
                'singular_name' => __( 'Push Notification Group' )
            ),
            'public' => false,
            'has_archive' => true,
            'rewrite' => array('slug' => 'pushnotification-group'),
            'show_in_rest' => true,
						'supports'=>array('custom-fields')

        )
    );
	}
	/**
	 * Register the Function to add Admin Pages for the admin area.
	 *
	 * @since    1.0.0
	 */

	public function add_admin_menu_pages() {
		add_menu_page(
		  'WP Native Apps',
		  'WP Native Apps',
		  'manage_options',
		  'wpnativeapps',
		  array($this, 'wpnativeapps_dashboard'),
		  'dashicons-dashboard',
		  30
		);

		add_submenu_page(
					'wpnativeapps',
					'Introduction',
					'Introduction',
					'manage_options',
					'wpnativeapps',
					array($this, 'wpnativeapps_dashboard')
				);
		add_submenu_page(
					'wpnativeapps',
					'WPNativeApps',
					'Settings',
					'manage_options',
					'wpnativeapps-settings',
					array($this, 'wpnativeapps_settings')
				);
		add_submenu_page(
					'wpnativeapps',
					'WPNativeApps',
					'Account',
					'manage_options',
					'wpnativeapps-account',
					array($this, 'wpnativeapps_account')
				);
		add_submenu_page(
					'wpnativeapps',
					'WPNativeApps',
					'Publish',
					'manage_options',
					'wpnativeapps-publish',
					array($this, 'wpnativeapps_publish')
				);
		add_submenu_page(
					'wpnativeapps',
					'WPNativeApps',
					'Push Notifications',
					'manage_options',
					'wpnativeapps-push-notification',
					array($this, 'wpnativeapps_push_notifications')
				);
		add_submenu_page(
					'wpnativeapps',
					'WPNativeApps',
					'Analytics',
					'manage_options',
					'wpnativeapps-analytics',
					array($this, 'wpnativeapps_analytics')
				);
	}

	public function wpnativeapps_dashboard(){
		include_once dirname(__FILE__) . '/partials/wp-native-apps-introduction.php';
	}
	public function wpnativeapps_account(){
		include_once dirname(__FILE__) . '/partials/account.php';
	}
	public function wpnativeapps_publish(){
		include_once dirname(__FILE__) . '/partials/publish.php';
	}

public function wpnativeapps_push_notifications(){
	include_once dirname(__FILE__) . '/partials/push-notifications.php';
}

public function wpnativeapps_analytics(){
	include_once dirname(__FILE__) . '/partials/analytics.php';
}

	public function wpnativeapps_settings(){
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		global $wpnativeapps;
		$wpnativeapps = $this->wpnativeapps;

		$setupNotices = array(
			array(
						'type'=>'info is-dismissable',
						'icon'=> plugin_dir_url( __FILE__ ).'images/WPNativeApps-Icon.png',
						'title'=>'Introduction to WPNativeApps',
						'message'=>'WPNativeApps will help you convert your website into beautiful app. All of the functionality provided must be confirgure craefully in order to acheeve the vest restutl.'
						),
						array(
									'type'=>'error',
									'icon'=>plugin_dir_url( __FILE__ ).'images/WPNativeApps-Icon.png',
									'title'=>'Configure Settings to see app preview',
									'message'=>''
									),
		);
		foreach($setupNotices as $notice){
			$this->wpna_addAdminNotice($notice);
		}

		include_once dirname(__FILE__) . '/partials/wp-native-apps-settings.php';
	}

	public function admin_notices(){
	  $admin_notices = $this->admin_notices;
		if(!empty($admin_notices)){
			foreach ($admin_notices as $notice){
				$type = $notice['type'];
				$class = 'notice notice-'.$type;
				$iconHtml = empty($notice['icon']) ? '': '<img class="wpnaNoticeIcon" src="'.$notice["icon"].'" />' ;
				$title = empty($notice['title']) ? '' : '<h1>'.$notice["title"].'</h1>';
				$message = __( $notice['message'], 'wpna' );

				printf('
				<div class="notice notice-%1$s is-dismissible">
				    <div class="pluginIcon">
					    '.$iconHtml.'
					</div>
					<div class="bannerContent">
					    '.$title.'
					    <p>%2$s</p>
					</div>
				</div>', esc_attr( $class ), esc_html( $message ));


			}
		}
	}



public function wpna_get_settings(){
	$pluginConfiguration = json_decode(file_get_contents(dirname(__FILE__) . '/config.json'), true);
	foreach ($pluginConfiguration as $ia) {
		if (!is_array($ia)) {
			$ia = json_decode($ia, true);
		}
	}

	if(empty($pluginConfiguration)){
		$pluginConfiguration = array(
		    "name"=> "Test App",
		    "headerToHide"=> "#header",
		    "footerToHide"=> "#footer",
		    "otherHide"=> array("#elemeent1","#element2"),
		    "splash"=> [
		      "backgroundColor"=> "rgb(67,50,193,1)",
		      "backgroundImage"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		    ],
		    "topBarNav"=>[
		      "styles"=> [
		        "backgroundColor"=> "rgb(67,50,193,1)",
		        "statusBarTextColor"=> "#000",
		        "bannerLogo"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		        "topBarTextColor"=> "#fff",
		        "topBarIconColor"=> "rgb(67,50,193,1)"
		      ],
		    ],
		    "bottomBarNav"=>[
		      "styles"=> [
		        "backgroundColor"=> "#ececec",
		        "defaultIconColor"=> "green",
		        "activeIconColor"=> "blue",
		      ],
		      "pages"=> [
		        [
		          "id"=> 1,
		          "url"=> "https://wpnativeapps.com/?page_id=599",
		          "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		          "name"=> "FAQ Page should be selected",
		          "isExternal"=> false,
		          "topNav"=>[
		              "designType"=> "logoOnly",
									"useLogo" => true,
		              "logo"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		              "label"=> "TopNav Label shoulfor Page d",
		              "alignment"=> "middle",
		          ]
		        ],
		        [
		          "id"=> 2,
		          "url"=> "https://wpnativeapps.com.au/bottom2",
		          "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		          "name"=> "Page Number 2",
		          "isExternal"=> true,
		          "topNav"=>[
		            "designType"=> "logoLeftBurgerRight",
								"useLogo" => false,
		            "logo"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
								"label"=> "TopNav Label for Page 2",
		            "hamburger"=> [
		              "backgroundColor"=> "rgb(67,50,193,1)",
		              "menuIcon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		            ]
		          ]
		        ],
		        [
		          "id"=> 3,
		          "url"=> "https://wpnativeapps.com.au/bottom3",
		          "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		          "name"=> "Page Number 3",
		          "isExternal"=> true,
		          "topNav"=>[
		            "designType"=> "logoLeftNavRight",
								"useLogo" => false,
		            "logo"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
								"label"=> "TopNav Label for Page 3",
								"buttons"=> [
		              [
		                "isExternal"=>true,
		                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		                "url"=> "https://wpnativeapps.com/link",
		              ],
		              // [
		              //   "isExternal"=>false,
		              //   "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		              //   "url"=> "https://wpnativeapps.com/?page_id=554",
		              // ],
		              [
		                "isExternal"=>false,
		                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		                "url"=> "https://wpnativeapps.com/?page_id=885",
		              ],
		            ]
		          ]
		        ],
		        [
		          "id"=> 4,
		          "url"=> "https://wpnativeapps.com.au/bottom4",
		          "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		          "name"=> "Page Number 4",
		          "isExternal"=> true,
		          "topNav"=>[
		            "designType"=> "logoMidNavBoth",
								"useLogo" => true,
		            "logo"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
								"label"=> "TopNav Label for Page 3",
		            "leftButtons"=> [
		              [
		                "isExternal"=>true,
		                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		                "url"=> "https://wpnativeapps.com/leftbutton",
		              ],
		            ],
		            "rightButtons"=> [
		              [
		                "isExternal"=>false,
		                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		                "url"=> "https://wpnativeapps.com/rightbutton1",
		              ],
		              [
		                "isExternal"=>false,
		                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		                "url"=> "https://wpnativeapps.com/rightbutton2",
		              ],
		              [
		                "isExternal"=>false,
		                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		                "url"=> "https://wpnativeapps.com/?page_id=31",
		              ],
		            ]
		          ]
		        ],
		      ],
		    ],
		    "prompts"=>[
		      "promptLocationService"=>true,
		      "promptItems"=>[
		      "pushNotification"=>[
		        "styles"=> [
		          "backgroundColor"=> "rgb(67,50,193,1)",
		          "textColor"=> "#000",
		          "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		          "title"=>"Prompt Title Text",
		          "description"=>"Prompt Description",
		          "acceptButtonText"=>"Accept",
		          "acceptButtonColor"=>"rgb(67,50,193,1)",
		        ]
		      ],
		      "trackingService"=>[
		        "styles"=> [
		          "backgroundColor"=> "rgb(67,50,193,1)",
		          "textColor"=> "#000",
		          "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
		          "title"=>"Prompt Title Text",
		          "description"=>"Prompt Description",
		          "acceptButtonText"=>"Accept",
		          "acceptButtonColor"=>"rgb(67,50,193,1)",
		        ]
		      ]
		    ]
		  ],
		  "authenticationSettings"=>[
		    "accountRequired"=>true,
		    "authenticationPage"=>"https://wpnativeapps.com/?page_id=554"
		  ]
		);
	}

	return $pluginConfiguration;

}

public function  wpna_image_uploadField($args){
		ob_start();
		$default = array(
													'inputName'=>'wpnaImage'.rand(),
													'imageUrl'=>'',
													'uploadText'=>'Upload Image',
													'changeText'=>'Change Image',
												);
	 $args = wp_parse_args( $args, $default );
		extract($args);

		ob_start();
		?>
		<div class="wpnaImageUploadSection <?php echo $inputName?>_section">
			<div class="wpnaImageUploadPreview  <?php echo $inputName;?>_preview" style="background-image: url('<?php echo $imageUrl;?>');"></div>
			<a href="javascript:void(0)" class="wpna-remove  <?php echo $inputName;?>_remove button">Change Image</a>
			<a style="display:none;" href="#" class="button wpna-upload <?php echo $inputName;?>_upload">Upload image</a>
			<input type="hidden" name="<?php echo $inputName;?>_image_id"  class="wpna_img_id" value="">
			<input type="hidden" name="<?php echo $inputName;?>_image_url"  class="wpna_img_url" value="<?php echo  $imageUrl  ?>">
		</div>
		<?php
		return ob_get_clean();
}

function getIDfromGUID( $guid ){
    global $wpdb;
    return $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid=%s", $guid ) );
}

function getIDfromURL( $url ){
		return url_to_postid($url);

}


}

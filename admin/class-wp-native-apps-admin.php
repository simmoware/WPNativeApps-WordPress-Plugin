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
		$this->wpnativeapps = $this->wpna_get_settings();

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
		wp_localize_script( $this->plugin_name, 'WPNativeApps',
		        array(
		            'pluginURL' => plugin_dir_url( __FILE__ ),
		            'homeURL' => get_home_url(),
		        )
		    );

		wp_enqueue_script( 'wpnaImageUpload', plugin_dir_url( __FILE__ ) . 'js/wpnaImageUpload.js', array( 'jquery', $this->plugin_name ), date("YmdHis"), false );

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
	}

	public function wpnativeapps_dashboard(){
		include_once dirname(__FILE__) . '/partials/wp-native-apps-introduction.php';
	}

	public function wpnativeapps_settings(){
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		global $wpnativeapps;
		$wpnativeapps = $this->wpnativeapps;

		$setupNotices = array(
			array(
						'type'=>'success is-dismissable',
						'icon'=> plugin_dir_url( __FILE__ ).'images/WPNativeApps-Icon.png',
						'title'=>'Introduction to WPNativeApps',
						'message'=>'WPNativeApps will help you convert your website into beautiful app. All of the functionality provided must be confirgure craefully in order to acheeve the vest restutl.'
						),
						array(
									'type'=>'warning',
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
					'.$iconHtml.'
					'.$title.'
					<p>%2$s</p>
				</div>', esc_attr( $class ), esc_html( $message ));



				// printf( '<div class="%1$s"><p>%2$s%3$s%4$s</p></div>', esc_attr( $class ), $iconHtml, $title, esc_html( $message ) );


				// $class = $notice['type'];
	    	// $message = __( $notice['message'], 'wpna' );
				//
				// printf( '<div class="notice notice-%1$s flex-row %1$s">%2$s<div class="wpnaNoticeText">%3$s</div></div>', esc_attr( $class ),$iconHtml, esc_html( $message ) );


			}
		}
	}

public function wpna_get_settings(){

	// Fetch settings from database and return.
$ret = array(
	'account'=>array('appName'=>'Test App'),
	'hideelements'=>array(
												'type'=>'header','selector'=>'#header',
												'type'=>'footer','selector'=>'#wp_footer',
												'type'=>'other', 'selector'=>'#other',
												'type'=>'other', 'selector'=>'.other-class',
												'type'=>'other', 'selector'=>'.another-class'
											),
	'topbarnav'=>array('navigationStructure'=>'1',
											'backgroundColor'=>'#ececec',
											'statusBarTextColor'=>'#fff',
											'bannerLogo'=>'https://wpnativeapps.com/cdn-cgi/image/metadata=none/wp-content/uploads/2022/05/wpn-white-logo-wordmark.png',
											'navigationbarTextColor'=>'#000',
											'defaultIconColor'=>'#fff',
											'activeIconColor'=>'#000'
										),
	'bottombarnav'=>array(
													'backgroundColor'=>'#fff',
													'defaultIconColor'=>'#000',
													'activeIconColor'=>'#fff'

	)
);
	return $ret;

}

public function  wpna_image_uploadField($args){
		ob_start();
		$default = array(
													'inputName'=>'wpnaImage'.rand(),
													'imageUrl'=>plugin_dir_url( __FILE__ ).'images/no-image.png',
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
			<input type="hidden" name="<?php echo $inputName;?>_image_url"  class="wpna_img_url" value="<?php echo absint( $imageUrl ) ?>">
		</div>
		<?php
		return ob_get_clean();
}

}

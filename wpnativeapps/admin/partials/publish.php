<?php
/* GET STATUS OF THE ACCOUNT */

//TODO: this varialbe should be set in wpnativeapps-settings to be passed here
$config = $this->wpnativeAppSettings;

$appId = $config['appId'];
$appSecret = $config['appSecret'];
$url = 'https://api.staging.wpnativeapps.com/v1/subscription/initialcheck';
$header = array(
  'WPNativeAppsRequestKey: sO4nl&W5sVTpBOQ#Wo07bJGMdJTZ&isi$HTe#j3x',
  "WPNativeAppsId:$appId",
  "WPNativeAppsSecret: $appSecret"
);
$response = wp_remote_get( $url, array('headers'=> $header) );
$status = $response['status'];

if($status == false):
?>
<div id="wpNativeAppsPublish">
    <div id="publish">
      <div class="flex-column">
          <img class='wpna-logo' src="<?php echo esc_url(plugin_dir_url(__DIR__));?>/images/publish/WPNativeApps-Logo-Landscape.png" />
          <img class='processing-graphic' src="<?php echo esc_url(plugin_dir_url(__DIR__));?>/images/publish/market-launch-bro.jpg" />
          <h2><?php _e('Ready to publish your app to the Google &amp; Apple App Store?', 'wpnativeapps');?></h2>
          <p>
            <?php _e('It costs $399USD to have us publish your app. The setup includes time with our design and development team to make sure that your app has a great user experience and is perfectly configured to meet the app store requirements.','wpnativeapps');?>
          </p>
          <div class='price-parent'>
              <h1 align=center>$399<span class='currency'>USD</span></h1>
              <a
                id="wpPayNow"
                href='#'
                class='publish-pay'
                data-wpnativeappsid="<?php esc_attr_e($appId); ?>"
                data-wpnativeappssecret="<?php esc_attr_e($appSecret); ?>"
                data-returnurl="<?php echo esc_url($_SERVER['HTTP_HOST']) . esc_url($_SERVER['REQUEST_URI']); ?>"
              >
                Pay Now
              </a>
          </div>
      </div>
    </div>
</div>
<?php else: ?>
<div id="wpNativeAppsPublish">
  <div id="processing">
    <div class="flex-column">
      <img class='wpna-logo' src="<?php echo esc_url(plugin_dir_url(__DIR__));?>/images/publish/WPNativeApps-Logo-Landscape.png" />
      <img class='processing-graphic' src="<?php echo esc_url(plugin_dir_url(__DIR__));?>/images/publish/Task-bro.jpg" />
      <h2><?php _e('We\'re working on getting your app onto the app stores', 'wpnativeapps');?></h2>
      <p>
        <?php _e('We’ll be in touch via email as we make progress. If you have any questions in the meantime please contact us at <a href="mailto:support@wpnativeapps.com">support@wpnativeapps.com</a>','wpnativeapps');?>
      </p>
    </div>
  </div>
</div>
<?php endif; ?>

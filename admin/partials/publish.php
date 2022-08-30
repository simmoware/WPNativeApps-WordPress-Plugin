<?php
/* GET STATUS OF THE ACCOUNT */

//TODO: this varialbe should be set in wp-native-apps-settings to be passed here
$config = $this->wpnativeAppSettings;

$appId = $config['appId'];
$appSecret = $config['appSecret'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.staging.wpnativeapps.com/v1/subscription/initialcheck',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'WPNativeAppsRequestKey: sO4nl&W5sVTpBOQ#Wo07bJGMdJTZ&isi$HTe#j3x',
    "WPNativeAppsId:$appId",
    "WPNativeAppsSecret: $appSecret"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$response = (array) json_decode($response);

$status = $response['status'];

if($status == false):
?>
<div id="wpNativeAppsPublish">
    <div id="publish">
      <div class="flex-column">
          <img class='wpna-logo' src="<?php echo plugin_dir_url(__DIR__);?>/images/publish/WPNativeApps-Logo-Landscape.png" />
          <img class='processing-graphic' src="<?php echo plugin_dir_url(__DIR__);?>/images/publish/market-launch-bro.jpg" />
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
                data-wpnativeappsid="<?php echo $appId; ?>"
                data-wpnativeappssecret="<?php echo $appSecret; ?>"
                data-returnurl="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"
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
      <img class='wpna-logo' src="<?php echo plugin_dir_url(__DIR__);?>/images/publish/WPNativeApps-Logo-Landscape.png" />
      <img class='processing-graphic' src="<?php echo plugin_dir_url(__DIR__);?>/images/publish/Task-bro.jpg" />
      <h2><?php _e('We\'re working on getting your app onto the app stores', 'wpnativeapps');?></h2>
      <p>
        <?php _e('We’ll be in touch via email as we make progress. If you have any questions in the meantime please contact us at <a href="mailto:support@wpnativeapps.com">support@wpnativeapps.com</a>','wpnativeapps');?>
      </p>
    </div>
  </div>
</div>
<?php endif; ?>

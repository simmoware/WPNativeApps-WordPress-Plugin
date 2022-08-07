<?php
/**
 * Renders the settings page for the plugin.
 */

$default_tab = null;
$tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
?>
<div class="flex-row">
  <div class="flexitem wpna_settings_page_left w60p ">
    <h1 class="wp-heading-inline"><span class="wpna-icon"></span><?php echo get_admin_page_title(); ?></h1>
    <?php $this->admin_notices(); ?>
    <div class="wpna_tabs_wrap">
    <nav class="nav-tab-wrapper">
      <a href="javascript:void(0)" targetTab="#general" class="tabcontrol nav-tab <?php if($tab===null || $tab==='general'):?>nav-tab-active<?php endif; ?>">General</a>
      <a href="javascript:void(0)" targetTab="#navigation" class="tabcontrol nav-tab <?php if($tab==='navigation'):?>nav-tab-active<?php endif; ?>">Bottom Nav</a>
      <a href="javascript:void(0)" targetTab="#store-listing" class="tabcontrol nav-tab <?php if($tab==='store-listing'):?>nav-tab-active<?php endif; ?>">Top Nav</a>
      <a href="javascript:void(0)" targetTab="#push-notifications" class="tabcontrol nav-tab <?php if($tab==='push-notifications'):?>nav-tab-active<?php endif; ?>">Prompts</a>
    </nav>

    <div class="tab-content-wrap flex-row">
      <form id="wpnaSettingsForm" method="post" action="<?php echo esc_html(admin_url('admin-post.php'));?>">
        <div id="general" class="tab-content">
          <?php include_once dirname(__FILE__) . '/general.php';?>
        </div>
        <div id="navigation" class="tab-content" style="display:none;">
          <?php include_once dirname(__FILE__) . '/bottomnav.php';?>
        </div>
        <div id="store-listing" class="tab-content" style="display:none;">
          <?php include_once dirname(__FILE__) . '/topnav.php';?>
        </div>
        <div id="push-notifications" class="tab-content" style="display:none;">
          <?php include_once dirname(__FILE__) . '/prompts.php';?>
        </div>

        <p><?php  submit_button('Save','primary','wpna-save-general',false);wp_nonce_field('wpna-save','wpna-save-general');?></p>



      </form>





    </div>
  </div>
  <!-- <div class="sticky w40p">
    <h2>Preview you App</h2>
    <div id="app_preview">
      <div>
        This is the preview
      </div>
    </div>
  </div> -->

  </div>
  <div class="wpna_settings_page_right sticky">
    <h2>Preview you App</h2>
    <div id="app_preview">
      <div>
        This is the preview
      </div>
    </div>
  </div>



  </div>

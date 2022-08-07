<div class="flex-column">


    <section class="general_appName flex-row">
      <!-- <div class="section_heading">

      </div> -->
      <!-- <div class="textcontent">

      </div> -->
        <div class="flex-column w50p">
          <label class="inputLabel">App Name</label>
          <input type="text" name="wpna_app_name" id="wpna_app_name" required />
        </div>

        <!-- <div class="empty">

        </div> -->



      <!-- <div class="header_selector itemSelectorWrap">

        <div class="general_app_col1">


        </div>
      </div> -->

    </section>

  <section class="general_hideElements flex-row jc-se">
    <div class="flex-column w50p">
      <div class="section_heading">
        Hide web elements to make your website more app friendly
      </div>
      <div class="textcontent">
        We'll need to remove your website's header and footers.
        Our inspector tool below will open a popover that will allow you to select them on your website.
      </div>
      <div class="flex-row">
        <div class="flex-column">
          <label class="inputLabel">Header Selector</label>
          <input type="text" name="wpna_hide_header" id="wpna_hide_header" required />
        </div>
        <div class="flex-column">
          <div class="choose_button_with_icon" onclick="buildHeaderiFrame();"><a href="javascript:void(0);" class="" data-title="Select Element to Hide">Choose Header</a><span class="arrow_north"></span></div>
        </div>
      </div>


      <div class="flex-row">
        <div class="flex-column">
          <label class="inputLabel">Footer Selector</label>
          <input type="text" name="wpna_hide_footer" id="wpna_hide_footer" required />
        </div>
        <div class="flex-column">
          <div class="choose_button_with_icon" onclick="buildFooteriFrame();"><a href="javascript:void(0);" class="" data-title="Select Element to Hide">Choose Footer</a><span class="arrow_north"></span></div>
        </div>
      </div>




      <div class="flex-row">
        <div class="flex-column">
          <label class="inputLabel">Footer Selector</label>
          <input type="text" name="wpna_hide_footer" id="wpna_hide_footer" required />
        </div>
        <div class="flex-column">
          <div class="choose_button_with_icon" onclick="buildElementiFrame();"><a href="javascript:void(0);" class="" data-title="Select Element to Hide">Choose Element</a><span class="arrow_north"></span></div>
        </div>
      </div>

      <a href="javascript:void(0)" onclick="add_element_to_hide()">Add another element to hide</a>



    </div>
    <div class="video-preview">
      <video width="320" height="240" controls>
        <source src="<?php echo plugin_dir_url(__DIR__).'/videos/wpna-preview.mp4';?>" type="video/mp4">
        <source src="<?php echo plugin_dir_url(__DIR__).'/videos/wpna-preview.ogg';?>" type="video/ogg">
        <!-- <source src="movie.ogg" type="video/ogg"> -->
        Your browser does not support the video tag.
      </video>
    </div>
  </section>


  <!-- <div class="flex-item">

    <div class="header_selector itemSelectorWrap">

      <div class="general_hide_header_col1">
        <label class="inputLabel">Header Selector</label>
        <input type="text" name="wpna_hide_header" id="wpna_hide_header" required />
      </div>
      <div class="general_hide_selector_col2">
        <div class="choose_button_with_icon" onclick="buildHeaderiFrame();"><a href="javascript:void(0);" class="" data-title="Select Element to Hide">Choose Header</a><span class="arrow_north"></span></div>
      </div>
    </div>
  </div> -->

  <!-- <div class="flex-item">

    <div class="header_selector itemSelectorWrap">

      <div class="general_hide_header_col1">
        <label class="inputLabel">Footer Selector</label>
        <input type="text" name="wpna_hide_footer" id="wpna_hide_footer" required />
      </div>
      <div class="general_hide_selector_col2">
        <div class="choose_button_with_icon" onclick="buildFooteriFrame();"><a href="javascript:void(0);" class="" data-title="Select Element to Hide">Choose Footer</a><span class="arrow_north"></span></div>
      </div>
    </div>
  </div> -->
<!--
  <div class="flex-item">

    <div class="header_selector itemSelectorWrap">
      <div class="general_hide_header_col1">
        <label class="inputLabel">Is there anything else you want to hide?</label>
        <input type="text" name="wpna_hide_other" id="wpna_hide_other" />
      </div>
      <div class="general_hide_selector_col2">
        <div class="choose_button_with_icon" onclick="buildElementiFrame();"><a href="javascript:void(0);" class="" data-title="Select Element to Hide">Choose Element</a><span class="arrow_north"></span></div>
      </div>
    </div>
    <a href="javascript:void(0)" onclick="add_element_to_hide()">Add another element to hide</a>

  </div> -->

<section class="flex-row jc-se">
  <div class="splashScreenSection w50p">
    <div class="section_heading">
      Splash Screen
    </div>
    <div class="textcontent">
    When someone opens your app there are 1-3 seconds before the app is ready to display. In this time we'll show what 's called a "splash" screen. A splash screen should be a very simple branded screen with ans image and your logo.
    </div>
    <div class="itemSelectorWrap splash_screen_backgroundColor flex-column aifs">
        <label class="inputLabel">Splash background colour</label>
        <input type="text" class="color-picker" name="splash_screen_backgroundColor" id="splash_screen_backgroundColor" required />
    </div>
    <div class="itemSelectorWrap splash_screen_backgroundImage">
      <label class="inputLabel">Splash screen background image</label>
      <div class="textcontent">

          If you choose to have a background image it will cover the whole screen. It will be center positioned. Please ensure that the background image doesn’t clash with your logo.
          Suggested Format:

        <ul>
          <li>
            Dimensions of 9:16 ratio. E.g. 900px WIDTH x 1600px HEIGHT
          </li>
          <li>
            JPG with file size < 100KB
          </li>
        </ul>
      </div>
      <label class="inputLabel">Choose a background image</label>
      <input type="file" name="splash_screen_backgroundImage" id="splash_screen_backgroundImage" accept="image/png, image/jpeg">
    </div>
    <div class="itemSelectorWrap splash_screen_backgroundLogo">
      <label class="inputLabel">Splash screen logo</label>
      <div class="textcontent">
        Your logo will be center positioned. Please ensure that your logo is visible on your chosen background. Suggested format:
        <ul>
          <li>
            PNG with transapanrent background.
          </li>
        </ul>
      </div>

        <label class="inputLabel">Choose a Logo </label>
        <?php

        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_src( $custom_logo_id , 'thumbnail' );
        // return $image[0];
                      $args = array(
                              'inputName'=>'splash_screen_backgroundLogo',
                              'imageUrl'=>$image[0],
                              'uploadText'=>'Upload Logo',
                              'changeText'=>'Change Logo'
                            );


        echo $this->wpna_image_uploadField($args);
        ?>
        <!-- <input type="file" name="splash_screen_backgroundLogo" id="splash_screen_backgroundLogo" accept="image/png, image/jpeg"> -->
    </div>
  </div>
  <div class="splashScreenSection flex-column">
    <img src="<?php echo plugin_dir_url(__DIR__).'/images/general/splash-thumbnail.png';?>" />
    <span class="button previewSplash">Preview Splash Screen</span>
  </div>



</section>


<section class="flex-row jc-se">
  <div class="flex-item general_topbar_navigation_section flex-column">
    <div class="section_heading">
      Top Bar Navigation
    </div>
    <div class="itemSelectorWrap topbar_backgroundColorSection">

      <!-- <div class="input_section"> -->
      <label class="inputLabel">Background Colour</label>
        <input type="text" class="color-picker" name="topbar_navigation_backgroundColor" id="topbar_navigation_backgroundColor" required />
      <!-- </div> -->
    </div>
    <div class="itemSelectorWrap topbar_statusbar_textColor">

      <!-- <div class="input_section"> -->
      <label class="inputLabel">Status bar text colour</label>
      <div class="textcontent">
        This is the bar on your phone that shows battery, the time and other options. We suggest choosing the colour that best contrasts with your top banner background colour.
      </div>
        <div>
          <input type="radio" class="" name="topbar_statusbar_textColour" value="black" required /><label class="inputLabel">Black</label>
        </div>
        <div>
          <input type="radio" class="" name="topbar_statusbar_textColour" value="white"  /><label class="inputLabel">White</label>
        </div>
      <!-- </div> -->
    </div>

    <div class="itemSelectorWrap topbar_bannerLogo">

      <!-- <div class="input_section"> -->
      <label class="inputLabel">Banner Logo</label>
      <div class="textcontent">
        Suggested Formats:
        <ul>
          <li>Dimensions of 4:1 ratio. E.g. 400px WIDTH x 100px HEIGHT</li>
          <li>PNG with a transparent background</li>
        </ul>
      </div>
        <div class="bannerLogoUploadWrap">
          <?php
          $args = array(
                  'inputName'=>'wpna_bannerLogo',
                  'imageUrl'=>$image[0],
                  'uploadText'=>'Upload Banner Image',
                  'changeText'=>'Change Banner Image'
                );

            echo $this->wpna_image_uploadField($args);
          ?>
        </div>
    </div>

    <div class="itemSelectorWrap topbar_textColor">

      <!-- <div class="input_section"> -->
      <label class="inputLabel">Tob bar text colour</label>
      <div class="textcontent">
        What colour should text be when it’s in the top navigation bar? We suggest choosing the colour that best contrasts with your top banner background colour.
      </div>
        <div>
          <input type="radio" class="" name="topbar_textColour" value="black" required /><label class="inputLabel">Black</label>
        </div>
        <div>
          <input type="radio" class="" name="topbar_textColour" value="white"  /><label class="inputLabel">White</label>
        </div>
      <!-- </div> -->
    </div>

    <div class="itemSelectorWrap topbar_iconColour">

      <!-- <div class="input_section"> -->
      <label class="inputLabel">Top Bar Icon Colour</label>
        <input type="text" class="color-picker" name="topbar_iconColor" id="topbar_iconColor" required />
      <!-- </div> -->
    </div>
  </div>



  </section>


  <section class="flex-row">

    <div class="flex-item general_bottomBar_section">
      <div class="section_heading">
        Bottom Bar Navigation
      </div>
      <div class="itemSelectorWrap bottomBar_backgroundColorSection">

        <!-- <div class="input_section"> -->
        <label class="inputLabel">Bottom Banner Background Color</label>
        <input type="text" class="color-picker" name="bottomBar_bottomBanner_backgroundColor" id="bottomBar_bottomBanner_backgroundColor" required />
        <!-- </div> -->

        <label class="inputLabel">Default Icon Color</label>
        <input type="text" class="color-picker" name="bottomBar_defaultIconColor" id="bottomBar_defaultIconColor" required />


        <label class="inputLabel">Active Icon Color</label>
        <input type="text" class="color-picker" name="bottomBar_activeIconColor" id="bottomBar_activeIconColor" required />


      </div>
    </div>

  </section>


  </div>

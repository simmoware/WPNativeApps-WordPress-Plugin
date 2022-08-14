<div class="flex-column">


    <section class="general_appName flex-row jc-fs">
      <!-- <div class="section_heading">

      </div> -->
      <!-- <div class="textcontent">

      </div> -->
        <div class="flex-column w50p">
          <h3 class=" ">App Name</h3>
          <input type="text" name="wpna_app_name" id="wpna_app_name" required />
        </div>

        <!-- <div class="empty">

        </div> -->



      <!-- <div class="header_selector deletedClass">

        <div class="general_app_col1">


        </div>
      </div> -->

    </section>

  <section class="general_hideElements flex-row jc-sb">
    <div class="flex-column w50p">
      <h2 class=" ">
        Hide web elements to make your website more app friendly
      </h2>
      <div class="textcontent">
        We'll need to remove your website's header and footers.
        Our inspector tool below will open a popover that will allow you to select them on your website.
      </div>
      <div class="flex-row jc-sb ai-fe">
        <div class="flex-column">
          <h3 class=" ">Header Selector</h3>
          <input type="text" name="wpna_hide_header" id="wpna_hide_header" required />
        </div>
        <div class="flex-column">
          <div class="choose_button_with_icon" onclick="buildHeaderiFrame();"><a href="javascript:void(0);" class="" data-title="Select Element to Hide">Choose your header</a><span class="arrow_north"></span></div>
        </div>
      </div>


      <div class="flex-row jc-sb ai-fe">
        <div class="flex-column">
          <h3 class=" ">Footer Selector</h3>
          <input type="text" name="wpna_hide_footer" id="wpna_hide_footer" required />
        </div>
        <div class="flex-column">
          <div class="choose_button_with_icon" onclick="buildFooteriFrame();"><a href="javascript:void(0);" class="" data-title="Select Element to Hide">Choose you footer</a><span class="arrow_north"></span></div>
        </div>
      </div>




      <div class="flex-row jc-sb ai-fe">
        <div class="flex-column">
          <h3 class=" ">Is there anything else you want to hide?</h3>
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

    <div class="header_selector deletedClass">

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

    <div class="header_selector deletedClass">

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

    <div class="header_selector deletedClass">
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

<section class="flex-row jc-sb">
  <div class="splashScreenSection w50p">
    <h1 class=" ">
      Splash Screen
    </h1>
    <div class="textcontent">
    When someone opens your app there are 1-3 seconds before the app is ready to display. In this time we'll show what 's called a "splash" screen. A splash screen should be a very simple branded screen with ans image and your logo.
    </div>
    <div class="deletedClass splash_screen_backgroundColor flex-column aifs">
        <h3 class=" ">Splash background colour</h3>
        <input type="text" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" class="color-picker" name="splash_screen_backgroundColor" id="splash_screen_backgroundColor" required />
    </div>
    <div class="deletedClass splash_screen_backgroundImage">
      <h3 class=" ">Splash screen background image</h3>
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
      <?php
        $args = array(
              'inputName'=>'splash_screen_backgroundImage',
              'imageUrl'=>'',
              'uploadText'=>'Upload Background Image',
              'changeText'=>'Change Background Image'
            );


      echo $this->wpna_image_uploadField($args);
      ?>
      <!-- <input type="file" name="splash_screen_backgroundImage" id="splash_screen_backgroundImage" accept="image/png, image/jpeg"> -->
    </div>
    <div class="deletedClass splash_screen_backgroundLogo">
      <h3 class=" ">Splash screen logo</h3>
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


<section class="flex-row jc-fs ai-fs">
  <div class="flex-item general_topbar_navigation_section flex-column">
    <h1 class=" ">
      Top Bar Navigation
    </h1>
    <div class="deletedClass flex-row jc-sb">

      <div class="input_section flex-column">
        <h3 class=" ">Background Colour</h3>
        <input type="text" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" class="color-picker" name="topbar_navigation_backgroundColor" id="topbar_navigation_backgroundColor" required />
      </div>



    </div>
    <div class="deletedClass topbar_statusbar_textColor flex-row jc-sb">

      <div class="input_section flex-column jc-se width150">
      <h3 class=" ">Status bar text colour</h3>
      <div class="textcontent">
        This is the bar on your phone that shows battery, the time and other options. We suggest choosing the colour that best contrasts with your top banner background colour.
      </div>
      <div class="flex-row jc-sb ai-fs width250">
        <fieldset>
          <input type="radio" class="" name="topbar_statusbar_textColour" value="black" required /><label class="inputLabel">Black</label>
        </fieldset>
        <fieldset>
          <input type="radio" class="" name="topbar_statusbar_textColour" value="white"  /><label class="inputLabel">White</label>
        </fieldset>
      </div>
      </div>

      <div class="topbarnav-previewsection flex-column jc-se">
        <div class="previewImages" style="background-image: url('<?php echo plugin_dir_url(__DIR__);?>/images/general/status-bar-thumbnail.jpg');"></div>
      </div>

    </div>

    <div class="topbar_bannerLogo flex-column ai-fs jc-sb">

      <!-- <div class="input_section"> -->
      <h3 class=" ">Banner Logo</h3>
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

    <div class="deletedClass topbar_statusbar_textColor flex-row jc-sb">

      <div class="input_section flex-column jc-se width150">
      <h3 class=" ">Tob bar text colour</h3>
      <div class="textcontent">
        What colour should text be when it’s in the top navigation bar? We suggest choosing the colour that best contrasts with your top banner background colour.
      </div>
      <div class="flex-row jc-sb ai-fs width250">
        <fieldset>
          <input type="radio" class="" name="topbar_textColour" value="black" required /><label class="inputLabel">Black</label>
        </fieldset>
        <fieldset>
          <input type="radio" class="" name="topbar_textColour" value="white"  /><label class="inputLabel">White</label>
        </fieldset>
      </div>
      </div>

      <div class="topbarnav-previewsection flex-column jc-se">
        <div class="previewImages" style="background-image: url('<?php echo plugin_dir_url(__DIR__);?>/images/general/top-bar-thumbnail.jpg');"></div>
      </div>

    </div>






    <div class="flex-column topbar_iconColour">

      <!-- <div class="input_section"> -->
      <h3 class=" ">Top Bar Icon Colour</h3>
        <input type="text" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" class="color-picker" name="topbar_iconColor" id="topbar_iconColor" required />
      <!-- </div> -->
    </div>
  </div>

    <?php /*
    <div class="topbarnav-previewsection flex-column jc-se">
    <div class="previewImages" style="background-image: url('<?php echo plugin_dir_url(__DIR__);?>/images/general/status-bar-thumbnail.jpg');"></div>
    <div class="previewImages" style="background-image: url('<?php echo plugin_dir_url(__DIR__);?>/images/general/top-bar-thumbnail.jpg');"></div>
      <!-- <img src="<?php echo plugin_dir_url(__DIR__).'/images/general/status-bar-thumbnail.jpg';?>" />
      <img src="<?php echo plugin_dir_url(__DIR__).'/images/general/top-bar-thumbnail.jpg';?>" /> -->
    </div>
    */ ?>


  </section>


  <section class="flex-row jc-sb">

    <div class="flex-column general_bottomBar_section">
      <h1 class=" ">
        Bottom Bar Navigation
      </h1>
      <div class="flex-column bottomBar_backgroundColorSection">

        <!-- <div class="input_section"> -->
        <h3 class=" ">Bottom Banner Background Color</h3>
        <input type="text" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" class="color-picker" name="bottomBar_bottomBanner_backgroundColor" id="bottomBar_bottomBanner_backgroundColor" required />
        <!-- </div> -->

        <h3 class=" ">Default Icon Color</h3>
        <input type="text" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" class="color-picker" name="bottomBar_defaultIconColor" id="bottomBar_defaultIconColor" required />


        <h3 class=" ">Active Icon Color</h3>
        <input type="text" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" class="color-picker" name="bottomBar_activeIconColor" id="bottomBar_activeIconColor" required />


      </div>
    </div>

  </section>


  </div>

<?php
$defaultLogo = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $defaultLogo , 'thumbnail' );
$defaultLogoURL = $image[0];
?>
<div class="flex-column">
    <section class="general_appName flex-row jc-fs">
        <div class="flex-column w60p">
          <h4 class=" ">App Name</h4>
          <input
                type="text"
                name="wpna_app_name"
                value="<?php echo isset($config['name']) ? sanitize_text_field($config['name']) :''; ?>"
                id="wpna_app_name"
                required
                />
        </div>
    </section>
    <section class="general_hideElements flex-row jc-sb">
        <div class="flex-column w60p">
            <h2 class=" ">
                Hide web elements to make your website more app friendly
            </h2>
            <p class="textcontent">
                We'll need to remove your website's header and footers.
                Our inspector tool below will open a popover that will allow you to select them on your website.
            </p>
            <h4 class=" ">Header Selector</h4>
            <div class="flex-row jc-sb ai-fe selectorInputs">
                <div class="flex-row">
                    <input
                        type="text"
                        name="headerToHide"
                        value="<?php echo isset($config['headerToHide']) ? sanitize_text_field($config['headerToHide']) :''; ?>"
                        id="headerToHide"
                        required
                    />
                    <div class="choose_button_with_icon" onclick="buildHeaderiFrame();">
                        <a
                            href="javascript:void(0);"
                            class=""
                            data-title="Select Element to Hide">
                                Choose your header
                        </a>
                    <span class="arrow_north"></span>
                  </div>
                </div>
            </div>
            <h4 class=" ">Footer Selector</h4>
            <div class="flex-row jc-sb ai-fe selectorInputs">
                <div class="flex-row">
                    <input
                        type="text"
                        name="footerToHide"
                        id="footerToHide"
                        value="<?php echo isset($config['footerToHide']) ? sanitize_text_field($config['footerToHide']) :''; ?>"
                        required
                    />
                    <div class="choose_button_with_icon" onclick="buildFooteriFrame();">
                        <a
                            href="javascript:void(0);"
                            class=""
                            data-title="Select Element to Hide">
                                Choose you footer
                        </a>
                        <span class="arrow_north"></span>
                    </div>
                  </div>
                </div>

      <?php
      $otherHide = isset($config['otherHide']) ? $config['otherHide'] :[];
      // print_r($otherHide);die;
      // $otherHide = 1;
      $otherToHideHtml = '';

      $otherToHideHtmlDefault = <<<EOT
        <h4>Is there anything else you want to hide?</h4>
        <div class="flex-row jc-sb ai-fe selectorInputs">
          <div class="flex-row">
            <input
                  type="text"
                  name="otherHide[]"
                  class="otherHideElement"
                  value=""
                  required
            />
            <div class="flex-column">
                <div class="choose_button_with_icon" onclick="buildElementiFrame({{counter}});">
                    <a
                        href="javascript:void(0);"
                        class=""
                        data-title="Select Element to Hide"
                    >
                        Choose Element
                    </a>
                    <span class="arrow_north"></span>
                </div>
            </div>
        </div>
      EOT;
        if(!empty($otherHide)){
            foreach ($otherHide as $key => $value) {
                $count = intval($key+1);
                $otherToHideHtml .= <<<EOT
                <h4>Is there anything else you want to hide?</h4>
                <div class="flex-row jc-sb ai-fe selectorInputs">
                    <div class="flex-row">
                        <input
                            type="text"
                            name="otherHide[]"
                            class="otherHideElement"
                            value="{$value}"
                            required
                        />
                        <div class="choose_button_with_icon" onclick="buildElementiFrame({$count});">
                            <a
                                href="javascript:void(0);"
                                class=""
                                data-title="Select Element to Hide"
                            >
                                Choose Element
                            </a>
                            <span class="arrow_north"></span>
                        </div>
                    </div>
                </div>
                EOT;
            }
        echo $otherToHideHtml;
      }else{
        echo $otherToHideHtmlDefault;
      }
      ?>
      <a class="addAnotherHideEl" href="javascript:void(0)" onclick="add_element_to_hide(this)">Add another element to hide</a>
    </div>
    <div class="flex-column video-preview">
      <video width="100%" height="auto" controls>
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
    <a href="javascript:void(0)" onclick="add_element_to_hide(this)">Add another element to hide</a>

  </div> -->

<section class="flex-row jc-sb">
  <?php $splash = $config['splash'];?>
  <div class="splashScreenSection w60p">
    <h1 class=" ">
      Splash Screen
    </h1>
    <p class="textcontent">
    When someone opens your app there are 1-3 seconds before the app is ready to display. In this time we'll show what 's called a "splash" screen. A splash screen should be a very simple branded screen with ans image and your logo.
    </p>
    <div class="deletedClass splash_screen_backgroundColor flex-column aifs">
        <h4 class=" ">Splash background colour</h4>
        <input
            type="text"
            data-alpha-enabled="true"
            data-default-color="rgba(0,0,0,1)"
            class="color-picker"
            name="splash_backgroundColor"
            id="splash_backgroundColor"
            value="<?php echo isset($config['splash']['backgroundColor']) ? sanitize_text_field($config['splash']['backgroundColor']) :''; ?>"
            required
            />
    </div>
    <div class="deletedClass splash_screen_backgroundImage">
      <h4 class=" ">Splash screen background image</h4>
      <p class="textcontent">
<?php printf('  If you choose to have a background image it will cover the whole screen. It will be center positioned. Please ensure that the background image doesn’t clash with your logo.
  Suggested Format:','wpnativeapps');?>


            <ul>
              <li>
                <?php printf('Dimensions of 9:16 ratio. E.g. 900px WIDTH x 1600px HEIGHT', 'wpnativeapps');?>
              </li>
              <li>
                <?php printf('JPG with file size < 100KB', 'wpnativeapps');?>
              </li>
            </ul>
        </p>
        <div class="flex-row iconPickerSectionVertical">
            <p>Choose a background image</p>
            <?php
                $args = array(
                  'inputName'=>'splash_backgroundImage',
                  'imageUrl'=>isset($config['splash']['backgroundImage']) ? sanitize_text_field($config['splash']['backgroundImage']) : '',
                  'uploadText'=>'Upload Background Image',
                  'changeText'=>'Change Background Image'
                );

                echo $this->wpna_image_uploadField($args);
            ?>
        </div>
    </div>

    <!-- <div class="deletedClass splash_screen_backgroundLogo">
      <h4 class=" ">Splash screen logo</h4>
      <p class="textcontent">
        Your logo will be center positioned. Please ensure that your logo is visible on your chosen background. Suggested format:
        <ul>
          <li>
            PNG with transapanrent background.
          </li>
        </ul>
      </p>

        <label class="inputLabel">Choose a Logo </label>
        <?php
        // return $image[0];
                      $args = array(
                              'inputName'=>'splash_screen_backgroundLogo',
                              'imageUrl'=>$defaultLogoURL,
                              'uploadText'=>'Upload Logo',
                              'changeText'=>'Change Logo'
                            );


        echo $this->wpna_image_uploadField($args);
        ?>
    </div>
    -->

  </div>
  <div class="splashScreenSection flex-column w40p">
    <img src="<?php echo plugin_dir_url(__DIR__).'/images/general/splash-thumbnail.png';?>" class="promptScreenPreview" />
    <span class="button previewSplash ">Preview Splash Screen</span>
  </div>
</section>


<section class="topBarNavSection flex-row jc-fs ai-fs">
  <div class="flex-item general_topbar_navigation_section flex-column">
    <h1 class=" ">
      Top Bar Navigation
    </h1>
    <div class="deletedClass flex-row jc-sb">

      <div class="input_section flex-column">
        <h4 class=" ">Background Colour</h4>
        <input
              type="text"
              data-alpha-enabled="true"
              data-default-color="rgba(0,0,0,0.85)"
              class="color-picker"
              name="topBarNav_backgroundColor"
              id="topbar_navigation_backgroundColor"
              value="<?php echo isset($config['topBarNav']['styles']['backgroundColor']) ? sanitize_text_field($config['topBarNav']['styles']['backgroundColor']) : '';?>"
              required
            />
      </div>



    </div>
    <div class="deletedClass topbar_statusbar_textColor flex-row jc-sb">

    <div class="input_section flex-column jc-se w60p">
        <h4 class=" ">Status bar text colour</h4>
        <p class="textcontent">
            This is the bar on your phone that shows battery, the time and other options. We suggest choosing the colour that best contrasts with your top banner background colour.
        </p>
        <div class="flex-row radioInputs">
            <?php $statusBarTextColor = isset($config['topBarNav']['styles']['statusBarTextColor']) ? sanitize_text_field($config['topBarNav']['styles']['statusBarTextColor']) : '#000'; ?>
            <fieldset>
                <input type="radio" class="" name="topbar_statusbar_textColour" id="topbar_statusbar_textColourBlack" value="#000" <?php echo $statusBarTextColor == "#000" ? "checked" :"" ;?>  required />
                <label for="topbar_statusbar_textColourBlack" class="inputLabel">Black</label>
                <input type="radio" class="" name="topbar_statusbar_textColour" id="topbar_statusbar_textColourWhite" value="#fff" <?php echo $statusBarTextColor == "#fff" ? "checked" :"";?>   />
                <label for="topbar_statusbar_textColourWhite" class="inputLabel">White</label>
            </fieldset>
        </div>
    </div>
    <div class="topbarnav-previewsection flex-column jc-se w40p">
        <div class="previewImages" style="background-image: url('<?php echo plugin_dir_url(__DIR__);?>/images/general/status-bar-thumbnail.jpg');"></div>
    </div>
</div>

    <div class="topbar_bannerLogo flex-column ai-fs">
      <h4 class=" ">Banner Logo</h4>
      <p class="textcontent">
        Suggested Formats:
        <ul>
          <li>Dimensions of 4:1 ratio. E.g. 400px WIDTH x 100px HEIGHT</li>
          <li>PNG with a transparent background</li>
        </ul>
      </p>
      <div class="flex-row iconPickerSection reversePicker">
            <?php
                $args = array(
                  'inputName'=>'topBarNav_styles_bannerLogo',
                  'imageUrl'=>isset($config['topBarNav']['styles']['bannerLogo']) ? sanitize_text_field($config['topBarNav']['styles']['bannerLogo'])  : $defaultLogoURL,
                  'uploadText'=>'Upload Banner Image',
                  'changeText'=>'Change Banner Image'
                );

                echo $this->wpna_image_uploadField($args);
            ?>
        </div>
    </div>

    <div class="deletedClass topbar_statusbar_textColor flex-row jc-sb">

    <div class="input_section flex-column jc-se w60p">
        <h4 class=" ">Tob bar text colour</h4>
        <p class="textcontent">
            What colour should text be when it’s in the top navigation bar? We suggest choosing the colour that best contrasts with your top banner background colour.
        </p>
        <div class="flex-row radioInputs">
            <?php
                $topBarTextColor = isset($config['topBarNav']['styles']['topBarTextColor']) ? sanitize_text_field($config['topBarNav']['styles']['topBarTextColor']) : "#fff";
            ?>
            <fieldset>
                <input type="radio" class="" name="topbar_textColour" id="topbar_textColourBlack" value="#000" <?php echo $topBarTextColor == "#000" ? "checked" :"" ;?> required />
                <label for="topbar_textColourBlack" class="inputLabel">Black</label>
                <input type="radio" class="" name="topbar_textColour" id="topbar_textColourWhite" value="#fff" <?php echo $topBarTextColor == "#fff" ? "checked" :"" ;?>  />
                <label for="topbar_textColourWhite" class="inputLabel">White</label>
            </fieldset>
        </div>
      </div>

      <div class="topbarnav-previewsection flex-column jc-se w40p">
        <div class="previewImages" style="background-image: url('<?php echo plugin_dir_url(__DIR__);?>/images/general/top-bar-thumbnail.jpg');"></div>
      </div>
    </div>






    <div class="flex-column topbar_iconColour">

      <!-- <div class="input_section"> -->
      <h4 class=" ">Top Bar Icon Colour</h4>
        <input
        type="text" data-alpha-enabled="true"
        data-default-color="rgba(0,0,0,0.85)"
        class="color-picker" name="topbar_iconColor"
        id="topbar_iconColor"
        value="<?php echo isset($config['topBarNav']['styles']['topBarIconColor'])  ? sanitize_text_field($config['topBarNav']['styles']['topBarIconColor'])  : ''?>";
        required />
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


  <section class="bottomBarNavSection flex-row jc-sb">
    <?php
    $bottombarNavStyle = $config['bottomBarNav']['styles'];
    ?>

    <div class="flex-column general_bottomBar_section">
      <h1 class=" ">
        Bottom Bar Navigation
      </h1>
      <div class="flex-column bottomBar_backgroundColorSection">

        <!-- <div class="input_section"> -->
        <h4 class=" ">Bottom Banner Background Color</h4>
        <input
              type="text"
              data-alpha-enabled="true"
              data-default-color="rgba(0,0,0,0.85)"
              class="color-picker"
              name="bottombarNavStyle_backgroundColor"
              id="bottombarNavStyle_backgroundColor"
              value="<?php echo isset($bottombarNavStyle['backgroundColor']) ? sanitize_text_field($bottombarNavStyle['backgroundColor']) : '';?>"
              required
               />
        <!-- </div> -->

        <h4 class=" ">Default Icon Color</h4>
        <input
              type="text"
              data-alpha-enabled="true"
              data-default-color="rgba(0,0,0,0.85)"
              class="color-picker"
              name="bottombarNavStyle_defaultIconColor"
              id="bottombarNavStyle_defaultIconColor"
              value="<?php echo isset($bottombarNavStyle['defaultIconColor']) ? sanitize_text_field($bottombarNavStyle['defaultIconColor']) : '';?>"
              required
               />


        <h4 class=" ">Active Icon Color</h4>
        <input
              type="text"
              data-alpha-enabled="true"
              data-default-color="rgba(0,0,0,0.85)"
              class="color-picker"
              name="bottombarNavStyle_activeIconColor"
              id="bottombarNavStyle_activeIconColor"
              value="<?php echo isset($bottombarNavStyle['activeIconColor']) ? sanitize_text_field($bottombarNavStyle['activeIconColor']) : '';?>"
              required
               />


      </div>
    </div>

  </section>


  </div>

<section class="flex=row mb10">
  <div class="flex-item flex-column topNavsection">
    <div class="section_heading">
      <h2>Select a top navigation for each of your bottom navigation Pages</h2>
    </div>
    <div id="topNavTabs">
      <?php
      $bottomNavPages = $config['bottomBarNav']['pages'];
      if(!empty($bottomNavPages)){
        echo '<ul id="topNavTabsControl">';
        $liCount = 1;
        foreach($bottomNavPages as $ulItem){
          echo '<li><a href="#topNavPage_'.$liCount.'"><span class="topNavPageIcon"></span>'.$ulItem["name"].'</li></a>';
          $liCount++;
        }
        echo '</ul>';

        $topNavTabCount = 1;
        foreach ($bottomNavPages as $bottomNavPage){
          $navPage = $bottomNavPage['topNav'];
          $designType = sanitize_text_field($navPage['designType']);
          $topNav_logo = $navPage['logo'];
          $topNav_label = sanitize_text_field($navPage['label']);
          $useLogo = $navPage['useLogo'];


          $logoAlignment = null;
          $hamburger = null;
          $hamburger_backgroundColor = null;
          $hamburger_menuIcon = null;
          $buttonsData = array(
                          array(
                          "isExternal"=>true,
                          "icon"=>'',
                          "url"=>''
                        )
                      );
          $leftButtons = array(
                          array(
                          "isExternal"=>true,
                          "icon"=>'',
                          "url"=>''
                        )
                      );
          $rightButtons = array(
                          array(
                          "isExternal"=>true,
                          "icon"=>'',
                          "url"=>''
                        )
                      );

          switch($designType){
            case 'logoOnly':{
              $logoAlignment = sanitize_text_field($navPage['alignment']);
              break;
            }
            case 'logoLeftBurgerRight':{
              $hamburger = $navPage['hamburger'];
              $hamburger_backgroundColor = $hamburger['backgroundColor'];
              $hamburger_menuIcon = $hamburger['menuIcon'];
              break;
            }
            case 'logoLeftNavRight':{
              $buttonsSettings = $navPage['buttons'];
              if(!empty($buttonsSettings)){
                $buttonsData = array();
                foreach($buttonsSettings as $buttonItem){
                  $buttonsData[] = array(
                                  "isExternal"=>$buttonItem['isExternal'],
                                  "icon"=>$buttonItem['icon'],
                                  "url"=>$buttonItem['url']
                                  );
                  }
                }

              break;
            }
            case 'logoMidNavBoth':{
              // $leftButtons = $navPage['leftButtons'];
              $leftButtonsSettings = $navPage['leftButtons'];
              if(!empty($leftButtonsSettings)){
                $leftButtons = array();
                foreach($leftButtonsSettings as $buttonItem){
                  $leftButtons[] = array(
                                  "isExternal"=>$buttonItem['isExternal'],
                                  "icon"=>$buttonItem['icon'],
                                  "url"=>$buttonItem['url']
                                  );
                  }
                }

              // $rightButtons = $navPage['rightButtons'];
              $rightButtonsSettings = $navPage['rightButtons'];
              if(!empty($rightButtonsSettings)){
                $rightButtons = array();
                foreach($rightButtonsSettings as $buttonItem){
                  $rightButtons[] = array(
                                  "isExternal"=>$buttonItem['isExternal'],
                                  "icon"=>$buttonItem['icon'],
                                  "url"=>$buttonItem['url']
                                  );
                  }
                }

              break;
            }
          }





          ?>
          <div id="topNavPage_<?php echo $topNavTabCount;?>" data-pageCount="<?php echo $topNavTabCount;?>" class="topNavPageSettings flex-column">
              <label>How would you like your top bar navigation to be structured?</label>
              <div class="topNavOptionsParent">
                <div class="flex-column topNavLogoAndText">
                  <h3>Select Logo</h3>
                  <?php
                  $args = array(
                          'inputName'=>'topNav_'.$topNavTabCount.'_logo',
                          'imageUrl'=>$topNav_logo,
                          'uploadText'=>'Upload Icon',
                          'changeText'=>'Change Icon'
                        );
                echo $this->wpna_image_uploadField($args); ?>
                <h3>Top bar text</h3>
                <p>By default we’ll load in the page title. You can edit the text to be anything you would like within 10 characters.</p>
                <input type="text" name="topNav_<?php echo $topNavTabCount;?>_text" value="<?php echo $topNav_label;?>" />
                </div>

                <section data-structure='1' class="topNav_optionParent navStructureRow flex-column jc-sb ai-fe">
                  <div class='settingSelect'>
                    <label><input type="radio" name="topNav_<?php echo $topNavTabCount;?>_structure" <?php echo ($designType =='logoOnly') ? 'checked' : ''; ?> value="logoOnly" /> Logo/Text aligned left,middle or right</label>
                  </div>
                  <div class="settingParent <?php echo $designType == 'logoOnly' ? '':'hide'?>">
                    <label class='question'>Logo or Text?</label>
                    <div class='settingOption'>
                      <div data-id="1" class="optionParent">
                        <div class="optionRadio">
                          <label>
                            <input type="radio" class="conditional" <?php echo $useLogo ? 'checked' :''; ?> name="topNav_<?php echo $topNavTabCount;?>_structure_1_type" value="logo"> Logo
                          </label>
                        </div>
                        <div class="conditionalSettings hide">
                        </div>
                      </div>

                      <div data-id="2" class <?php echo ($useLogo) ? '' : 'checked';?>="optionParent">
                        <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_<?php echo $topNavTabCount;?>_structure_1_type" value="text"> Text</label></div>
                        <div class="conditionalSettings hide">
                        </div>
                      </div>
                    </div>
                    <h3>Select the Logo Alignment</h3>
                    <div class="alignmentOptions flex-row">
                      <label><input type="radio" class="" <?php echo $logoAlignment =="left" ? "checked" : "";?> name="topNav_<?php echo $topNavTabCount;?>_structure_1_align" value="left" /> Left</label>
                      <label><input type="radio" class="" <?php echo $logoAlignment =="middle" ? "checked" : "";?> name="topNav_<?php echo $topNavTabCount;?>_structure_1_align" value="middle" /> Middle</label>
                      <label><input type="radio" class="" <?php echo $logoAlignment =="right" ? "checked" : "";?> name="topNav_<?php echo $topNavTabCount;?>_structure_1_align" value="right" /> Right</label>
                    </div>
                  </div>
                </section>
                <section  data-structure='2'  class="topNav_optionParent navStructureRow flex-column jc-sb ai-fe">
                  <div class='settingSelect'>
                    <label><input type="radio" name="topNav_<?php echo $topNavTabCount;?>_structure" <?php echo ($designType =='logoLeftBurgerRight') ? 'checked' : 'logoLeftBurgerRight'; ?> value="logoLeftBurgerRight" /> Logo/Text on the left and hamburger menu icon on the right</label>
                  </div>
                  <div class="settingParent <?php echo $designType == 'logoLeftBurgerRight' ? '':'hide'?>">
                    <div class='settingOption'>
                      <div data-id="1" class="optionParent">
                        <div class="optionRadio"><label><input type="radio" class="conditional" <?php echo $useLogo ? 'checked' :''; ?>name="topNav_<?php echo $topNavTabCount;?>_structure_2_type" value="logo"> Logo </label></div>
                        <div class="conditionalSettings hide">
                        </div>
                      </div>
                      <div data-id="2" class="optionParent">
                        <div class="optionRadio"><label><input type="radio" <?php echo ($useLogo) ? '' : 'checked';?> class="conditional" name="topNav_<?php echo $topNavTabCount;?>_structure_2_type" value="text"> Text</label></div>
                        <div class="conditionalSettings hide">
                        </div>
                      </div>
                      <div data-id='3' class='optionParent flex-column'>
                        <label>Hamburger Menu background color</label>
                        <input
                              type="text"
                              value="<?php echo isset($hamburger_backgroundColor) ? $hamburger_backgroundColor :"rgba(0,0,0,0.85)"  ;?>"
                              data-alpha-enabled="true"
                              data-default-color="rgba(0,0,0,0.85)"
                              class="color-picker"
                              name="topNav_<?php echo $topNavTabCount;?>_structure_2_HamburgerMenuBgColor"
                              required
                               />
                        <label class="inputLabel">Hamburger Menu Icon</label>
                        <?php
                          $args = array(
                                'inputName'=>'topNav_'.$topNavTabCount.'_structure_2_HamburgerMenuIcon',
                                'imageUrl'=>$hamburger_menuIcon,
                                'uploadText'=>'Select Icon',
                                'changeText'=>'Change Icon'
                              );
                        echo $this->wpna_image_uploadField($args);
                        ?>
                      </div>
                    </div>
                  </div>
                </section>
                <section  data-structure='3'  class="topNav_optionParent navStructureRow flex-column jc-sb ai-fe">
                  <div class='settingSelect'>
                    <label><input type="radio" name="topNav_<?php echo $topNavTabCount;?>_structure" <?php echo ($designType =='logoLeftNavRight') ? 'checked' : 'logoLeftNavRight'; ?> value="logoLeftNavRight" /> Logo/Text on the left and navigation icons on the right      </label>
                  </div>
                  <div class="settingParent <?php echo $designType == 'logoLeftNavRight' ? '':'hide'?>">
                    <h3>Logo or text in top bar</h3>
                    <p>Would you like your logo or text displayed in the top bar?</p>
                    <div class='settingOption'>
                      <div data-id="1" class="optionParent">
                        <div class="optionRadio"><label><input type="radio" class="conditional" <?php echo $useLogo ? 'checked' :''; ?>name="topNav_<?php echo $topNavTabCount;?>_structure_3_type" value="logo"> Logo </label></div>
                        <div class="conditionalSettings hide">
                        </div>
                      </div>
                      <div data-id="2" class="optionParent">
                        <div class="optionRadio"><label><input type="radio" <?php echo ($useLogo) ? '' : 'checked';?> class="conditional" name="topNav_<?php echo $topNavTabCount;?>_structure_3_type" value="text"> Text</label></div>
                        <div class="conditionalSettings hide">
                        </div>
                      </div>
                    </div>
                    <?php
                        $buttonItemCount = 1;
                        foreach($buttonsData as $buttonSettings){
                          ?>
                          <div class="flex-column topNavPageIconItem">
                            <div class="flex-row bottomBarItemWrapTop">
                              <div class="bottomBarItemType">
                                <select onchange="handleTopNavLinkTypeChange(this)"  required class="bottomBarItemType" name="topNav_<?php echo $topNavTabCount;?>_structure_3_Source_<?php echo $buttonItemCount;?>">
                                  <option value="page" <?php echo $buttonSettings['isExternal'] ? '' : 'selected';?>>Page</option>
                                  <option value="external" <?php echo $buttonSettings['isExternal'] ? 'selected' : '';?>>External</option>
                                </select>
                              </div>
                              <div class="bottomBarItemUrl flex-column">
                                <?php
                                $ddClass = $buttonSettings['isExternal'] ? 'hide' : '';
                                wp_dropdown_pages(
                                                              [
                                                                'name'=>'topNav_'.$topNavTabCount.'_structure_3_internalURL_'.$buttonItemCount,
                                                                'id'=>'topNav_'.$topNavTabCount.'_structure_3_internalURL_'.$buttonItemCount,
                                                                'class'=>$ddClass.' topNavItemUrlInternal',
                                                                'echo'=>'1',
                                                                'value_field'=>'guid',
                                                                'selected'=>$this->getIDfromGUID($buttonSettings['url'])
                                                              ]
                                                            );?>
                                <input
                                      type="text"
                                      class="topNavItemUrlExternal <?php echo $buttonSettings['isExternal'] ? '' : 'hide' ?>"
                                      name="topNav_<?php echo $topNavTabCount;?>_structure_3_externalURL_<?php echo $buttonItemCount;?>"
                                      placeholder="Enter External URL"
                                      value="<?php echo sanitize_text_field($buttonSettings['url']);?>"
                                      />
                              </div>
                            </div>
                            <div class="flex-row flex-start bottomBarItemWrapBottom">
                              <?php
                              $args = array(
                                      'inputName'=>'topNav_'.$topNavTabCount.'_structure_3_iconImage_'.$buttonItemCount,
                                      'imageUrl'=>$buttonSettings['icon'],
                                      'uploadText'=>'Upload Icon',
                                      'changeText'=>'Change Icon'
                                    );
                            echo $this->wpna_image_uploadField($args); ?>
                            </div>
                          </div>
                          <?php
                          $buttonItemCount++;
                        }
                      ?>


                  <div class="addNewNavigationIcon <?php echo ($buttonItemCount > 3) ? 'hide' : ''; ?>">
                    <a href="javascript:void(0)" onclick="addTopNavNavigationIcon(this)">Add another navigation icon</a>
                  </div>
                  </div>
                </section>

                <section  data-structure='4'  class="topNav_optionParent navStructureRow flex-column jc-sb ai-fe">
                  <div class='settingSelect'>
                    <label><input type="radio" name="topNav_<?php echo $topNavTabCount;?>_structure" <?php echo ($designType =='logoMidNavBoth') ? 'checked' : 'logoMidNavBoth'; ?> value="logoMidNavBoth" /> Logo/Text middle and navigation icons on both left and right  </label>
                  </div>
                  <div class="settingParent <?php echo $designType == 'logoMidNavBoth' ? '':'hide'?>">
                    <h3>Logo or text in top bar?</h3>
                    <p>Would you like your logo or text displayed in the top bar?</p>
                    <div class='settingOption'>
                      <div data-id="1" class="optionParent">
                        <div class="optionRadio"><label><input type="radio" class="conditional" <?php echo $useLogo ? 'checked' :''; ?>  name="topNav_<?php echo $topNavTabCount;?>_structure_4_type" value="logo"> Logo </label></div>
                        <div class="conditionalSettings hide">
                        </div>
                      </div>
                      <div data-id="2" class="optionParent">
                        <div class="optionRadio"><label><input type="radio" class="conditional" <?php echo ($useLogo) ? '' : 'checked';?> name="topNav_<?php echo $topNavTabCount;?>_structure_4_type" value="text"> Text</label></div>
                        <div class="conditionalSettings hide">
                        </div>
                      </div>
                    </div>


                    <?php
                      $navigationItems = array_merge($leftButtons,$rightButtons);
                      $buttonItemCount = 1;
                      foreach ($navigationItems as $buttonSettings) {

                        ?>

                        <div class="flex-column topNavPageIconItem">
                          <div class="flex-row bottomBarItemWrapTop">
                            <div class="bottomBarItemType">
                              <select onchange="handleTopNavLinkTypeChange(this)"  required class="bottomBarItemType" name="topNav_<?php echo $topNavTabCount;?>_structure_4_Source_<?php echo $buttonItemCount;?>">
                                <option value="page" <?php echo $buttonSettings['isExternal'] ? '' : 'selected';?>>Page</option>
                                <option value="external" <?php echo $buttonSettings['isExternal'] ? 'selected' : '';?>>External</option>
                              </select>
                            </div>
                            <div class="bottomBarItemUrl flex-column">
                              <?php
                              $ddClass = $buttonSettings['isExternal'] ? 'hide' : '';
                              wp_dropdown_pages(
                                                            [
                                                              'name'=>'topNav_'.$topNavTabCount.'_structure_4_internalURL_'.$buttonItemCount,
                                                              'id'=>'topNav_'.$topNavTabCount.'_structure_4_internalURL_'.$buttonItemCount,
                                                              'class'=>$ddClass.' topNavItemUrlInternal',
                                                              'echo'=>'1',
                                                              'value_field'=>'guid',
                                                              'selected'=>$this->getIDfromGUID($buttonSettings['url'])
                                                            ]
                                                          );?>
                              <input
                                    type="text"
                                    class="topNavItemUrlExternal <?php echo $buttonSettings['isExternal'] ? '' : 'hide' ?>"
                                    name="topNav_<?php echo $topNavTabCount;?>_structure_4_externalURL_1"
                                    placeholder="Enter External URL"
                                    value="<?php echo sanitize_text_field($buttonSettings['url']);?>"
                                    />
                            </div>
                          </div>
                          <div class="flex-row flex-start bottomBarItemWrapBottom">
                            <?php
                            $args = array(
                                    'inputName'=>'topNav_'.$topNavTabCount.'_structure_4_iconImage',
                                    'imageUrl'=>'',
                                    'uploadText'=>'Upload Icon',
                                    'changeText'=>'Change Icon'
                                  );
                          echo $this->wpna_image_uploadField($args); ?>
                          </div>
                        </div>


                        <?php
                        $buttonItemCount++;
                      }


                    ?>




                  <div class="addNewNavigationIcon <?php echo ($buttonItemCount > 3) ? 'hide' : ''; ?>">
                    <a href="javascript:void(0)" onclick="addTopNavNavigationIcon(this)">Add another navigation icon</a>
                  </div>
                  </div>
                </section>

              </div>
          </div>
          <?php
          $topNavTabCount++;

}



      }

      ?>



    </div>
  </div>
</section>
















<style>
.flex-column{

}
.bottomBarItemWrapBottom .wpnaImageUploadPreview, .hamburgerItemWrapBottom .wpnaImageUploadPreview{
  height: 36px;
  width: 36px;
  max-height: 36px;
  max-width: 36px;
  margin-right:15px;
}
.bottomBarItemWrapBottom .wpnaImageUploadSection , .hamburgerItemWrapBottom .wpnaImageUploadSection {
  display: flex;
  flex-direction: row;
    align-items: center;
    padding: 10px;
}
.bottomBarItemWrapBottom .wpnaImageUploadSection .button, .hamburgerItemWrapBottom .wpnaImageUploadSection .button{
    padding: 3px 15px;
    color: #CB1818;
    border-color: #CB1818;
}
.hide{
  height: 0;
  width: 0;
  visibility: hidden;
}
.mb10{
  margin-bottom: 10px;

}
.mt10{
  margin-top: 10px;
}
</style>

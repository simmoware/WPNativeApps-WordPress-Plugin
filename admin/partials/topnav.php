<!-- 'logoOnly', 'logoLeftHamburgerRight', 'logoLeftNavigationRight', 'logoMiddleNavigationBothSides -->
<div class="toNavIndividualPageSetup hide" id="topNavIndividualPageSetupGeneric">
    <label>How would you like your top bar navigation to be structured?</label>
    <div class="topNavOptionsParent">
      <div class="flex-column topNavLogoAndText">
        <h3>Select Logo</h3>
        <?php
        $args = array(
                'inputName'=>'topNav_{{bottomBarPageCount}}_logo',
                'imageUrl'=>'',
                'uploadText'=>'Upload Icon',
                'changeText'=>'Change Icon'
              );
      echo $this->wpna_image_uploadField($args); ?>
      <h3>Top bar text</h3>
      <p>By default we’ll load in the page title. You can edit the text to be anything you would like within 10 characters.</p>
      <input type="text" name="topNav_{{bottomBarPageCount}}_text" value="" />
      </div>
      <section id='topNav_option_{{bottomBarPageCount}}_one' data-structure='1' class="topNav_optionParent navStructureRow flex-column jc-sb ai-fe">
        <div class='settingSelect'>
          <label><input type="radio" name="topNav_{{bottomBarPageCount}}_structure" value="1" /> Logo/Text aligned left,middle or right</label>
        </div>
        <div class='settingParent hide'>
          <label class='question'>Logo or Text?</label>
          <div class='settingOption'>
            <div data-id="1" class="optionParent">
              <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_{{bottomBarPageCount}}_structure_1_type" value="logo"> Logo </label></div>
              <div class="conditionalSettings hide">
              </div>
            </div>

            <div data-id="2" class="optionParent">
              <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_{{bottomBarPageCount}}_structure_1_type" value="text"> Text</label></div>
              <div class="conditionalSettings hide">
              </div>
            </div>
          </div>
          <h3>Select the Logo Alignment</h3>
          <div class="alignmentOptions flex-row">
            <label><input type="radio" class="" name="topNav_{{bottomBarPageCount}}_structure_1_align" value="left" /> Left</label>
            <label><input type="radio" class="" name="topNav_{{bottomBarPageCount}}_structure_1_align" value="middle" /> Middle</label>
            <label><input type="radio" class="" name="topNav_{{bottomBarPageCount}}_structure_1_align" value="right" /> Right</label>
          </div>
        </div>
      </section>
      <section id='topNav_option_{{bottomBarPageCount}}_two' data-structure='2'  class="topNav_optionParent navStructureRow flex-column jc-sb ai-fe">
        <div class='settingSelect'>
          <label><input type="radio" name="topNav_{{bottomBarPageCount}}_structure" value="2" /> Logo/Text on the left and hamburger menu icon on the right</label>
        </div>
        <div class='settingParent hide'>
          <div class='settingOption'>
            <div data-id="1" class="optionParent">
              <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_{{bottomBarPageCount}}_structure_2_type" value="logo"> Logo </label></div>
              <div class="conditionalSettings hide">
              </div>
            </div>
            <div data-id="2" class="optionParent">
              <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_{{bottomBarPageCount}}_structure_2_type" value="text"> Text</label></div>
              <div class="conditionalSettings hide">
              </div>
            </div>
            <div data-id='3' class='optionParent flex-column'>
              <label>Hamburger Menu background color</label>
              <input type="text" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" class="color-picker" name="topNav_{{bottomBarPageCount}}_structure_2_HamburgerMenuBgColor" required />
              <label class="inputLabel">Hamburger Menu Icon</label>
              <?php
                $args = array(
                      'inputName'=>'topNav_{{bottomBarPageCount}}_structure_2_HamburgerMenuIcon',
                      'imageUrl'=>'',
                      'uploadText'=>'Select Icon',
                      'changeText'=>'Change Icon'
                    );
              echo $this->wpna_image_uploadField($args);
              ?>
            </div>
          </div>
        </div>
      </section>
      <section id='topNav_option_{{bottomBarPageCount}}_three' data-structure='3'  class="topNav_optionParent navStructureRow flex-column jc-sb ai-fe">
        <div class='settingSelect'>
          <label><input type="radio" name="topNav_{{bottomBarPageCount}}_structure" value="3" /> Logo/Text on the left and navigation icons on the right      </label>
        </div>
        <div class='settingParent hide'>
          <h3>Logo or text in top bar</h3>
          <p>Would you like your logo or text displayed in the top bar?</p>
          <div class='settingOption'>
            <div data-id="1" class="optionParent">
              <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_{{bottomBarPageCount}}_structure_3_type" value="logo"> Logo </label></div>
              <div class="conditionalSettings hide">
              </div>
            </div>
            <div data-id="2" class="optionParent">
              <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_{{bottomBarPageCount}}_structure_3_type" value="text"> Text</label></div>
              <div class="conditionalSettings hide">
              </div>
            </div>
          </div>

    <div class="flex-column topNavPageIconItem">
      <div class="flex-row bottomBarItemWrapTop">
        <div class="bottomBarItemType">
          <select onchange="handleTopNavLinkTypeChange(this)"  required class="bottomBarItemType" name="topNav_{{bottomBarPageCount}}_structure_3_Source_1">
            <!-- <option disabled selected>Select a Link Type</option> -->
            <option value="page">Page</option>
            <option value="external">External</option>
            <option value="share">Share</option>
          </select>
        </div>
        <div class="bottomBarItemUrl flex-column">
          <?php wp_dropdown_pages(
                                        [
                                          'name'=>'topNav_{{bottomBarPageCount}}_structure_3_internalURL_1',
                                          'id'=>'topNav_{{bottomBarPageCount}}_structure_3_internalURL_1',
                                          'class'=>'topNavItemUrlInternal',
                                          'echo'=>'1',
                                          'value_field'=>'guid'
                                        ]
                                      );?>
          <input type="text" class="topNavItemUrlExternal" name="topNav_{{bottomBarPageCount}}_structure_3_externalURL_1" placeholder="Enter External URL" style="display:none;" />
        </div>
      </div>
      <div class="flex-row flex-start bottomBarItemWrapBottom">
        <?php
        $args = array(
                'inputName'=>'topNav_{{bottomBarPageCount}}_structure_3_iconImage',
                'imageUrl'=>'',
                'uploadText'=>'Upload Icon',
                'changeText'=>'Change Icon'
              );
      echo $this->wpna_image_uploadField($args); ?>
      </div>
    </div>
    <div class="addNewNavigationIcon">
      <a href="javascript:void(0)" onclick="addTopNavNavigationIcon(this)">Add another navigation icon</a>
    </div>
        </div>
      </section>
      <section id='topNav_option_{{bottomBarPageCount}}_four' data-structure='4'  class="topNav_optionParent navStructureRow flex-column jc-sb ai-fe">
        <div class='settingSelect'>
          <label><input type="radio" name="topNav_{{bottomBarPageCount}}_structure" value="4" /> Logo/Text middle and navigation icons on both left and right  </label>
        </div>
        <div class='settingParent hide'>
          <h3>Logo or text in top bar?</h3>
          <p>Would you like your logo or text displayed in the top bar?</p>
          <div class='settingOption'>
            <div data-id="1" class="optionParent">
              <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_{{bottomBarPageCount}}_structure_4_type" value="logo"> Logo </label></div>
              <div class="conditionalSettings hide">
              </div>
            </div>
            <div data-id="2" class="optionParent">
              <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_{{bottomBarPageCount}}_structure_4_type" value="text"> Text</label></div>
              <div class="conditionalSettings hide">
              </div>
            </div>
          </div>


        <div class="flex-column topNavPageIconItem">
          <div class="flex-row bottomBarItemWrapTop">
            <div class="bottomBarItemType">
              <select onchange="handleTopNavLinkTypeChange(this)"  required class="bottomBarItemType" name="topNav_{{bottomBarPageCount}}_structure_4_Source_1">
                <!-- <option disabled selected>Select a Link Type</option> -->
                <option value="page">Page</option>
                <option value="external">External</option>
                <option value="share">Share</option>
              </select>
            </div>
            <div class="bottomBarItemUrl flex-column">
              <?php wp_dropdown_pages(
                                            [
                                              'name'=>'topNav_{{bottomBarPageCount}}_structure_4_internalURL_1',
                                              'id'=>'topNav_{{bottomBarPageCount}}_structure_4_internalURL_1',
                                              'class'=>'topNavItemUrlInternal',
                                              'echo'=>'1',
                                              'value_field'=>'guid'
                                            ]
                                          );?>
              <input type="text" class="topNavItemUrlExternal" name="topNav_{{bottomBarPageCount}}_structure_4_externalURL_1" placeholder="Enter External URL" style="display:none;" />
            </div>
          </div>
          <div class="flex-row flex-start bottomBarItemWrapBottom">
            <?php
            $args = array(
                    'inputName'=>'topNav_{{bottomBarPageCount}}_structure_4_iconImage',
                    'imageUrl'=>'',
                    'uploadText'=>'Upload Icon',
                    'changeText'=>'Change Icon'
                  );
          echo $this->wpna_image_uploadField($args); ?>
          </div>

        </div>
        <div class="addNewNavigationIcon">
          <a href="javascript:void(0)" onclick="addTopNavNavigationIcon(this)">Add another navigation icon</a>
        </div>
        </div>
      </section>
    </div>
</div>



  <div class="hide flex-column  topNavPageIconItem"  id="topNavNaviagionIconGeneric">
    <div class="flex-row bottomBarItemWrapTop">
      <div class="bottomBarItemType">
        <select onchange="handleTopNavLinkTypeChange(this)"  required class="bottomBarItemType" name="topNav_{{bottomBarPageCount}}_structure_{{structureCount}}_Source_{{iconCount}}">
          <!-- <option disabled selected>Select a Link Type</option> -->
          <option value="page">Page</option>
          <option value="external">External</option>
          <option value="share">Share</option>
        </select>
      </div>
      <div class="bottomBarItemUrl flex-column">
        <?php wp_dropdown_pages(
                                      [
                                        'name'=>'topNav_{{bottomBarPageCount}}_structure_{{structureCount}}_internalURL_{{iconCount}}',
                                        'id'=>'topNav_{{bottomBarPageCount}}_structure_{{structureCount}}_internalURL_{{iconCount}}',
                                        'class'=>'topNavItemUrlInternal',
                                        'echo'=>'1',
                                        'value_field'=>'guid'
                                      ]
                                    );?>
        <input type="text" class="topNavItemUrlExternal" name="topNav_{{bottomBarPageCount}}_structure_{{structureCount}}_externalURL_{{iconCount}}" placeholder="Enter External URL" style="display:none;" />
      </div>
    </div>
    <div class="flex-row flex-start bottomBarItemWrapBottom">
      <?php
      $args = array(
              'inputName'=>'topNav_{{bottomBarPageCount}}_structure_{{structureCount}}_iconImage_{{iconCount}}',
              'imageUrl'=>'',
              'uploadText'=>'Upload Icon',
              'changeText'=>'Change Icon'
            );
    echo $this->wpna_image_uploadField($args); ?>
    </div>
  </div>






<section class="flex=row mb10">
  <div class="flex-item flex-column topNavsection">
    <div class="section_heading">
      <h2>Select a top navigation for each of your bottom navigation Pages</h2>
    </div>
    <div id="topNavTabs">
      <ul id="topNavTabsControl">
        <li><a href="#topNavPage_1"><span class="topNavPageIcon"></span>Page 1</li></a>
      </ul>

      <div id="topNavPage_1" data-pageCount="1" class="topNavPageSettings flex-column">

          <label>How would you like your top bar navigation to be structured?</label>
          <div class="topNavOptionsParent">
            <div class="flex-column topNavLogoAndText">
              <h3>Select Logo</h3>
              <?php
              $args = array(
                      'inputName'=>'topNav_1_logo',
                      'imageUrl'=>'',
                      'uploadText'=>'Upload Icon',
                      'changeText'=>'Change Icon'
                    );
            echo $this->wpna_image_uploadField($args); ?>
            <h3>Top bar text</h3>
            <p>By default we’ll load in the page title. You can edit the text to be anything you would like within 10 characters.</p>
            <input type="text" name="topNav_1_text" value="" />
            </div>
            <section data-structure='1' class="topNav_optionParent navStructureRow flex-column jc-sb ai-fe">
              <div class='settingSelect'>
                <label><input type="radio" name="topNav_1_structure" value="1" /> Logo/Text aligned left,middle or right</label>
              </div>
              <div class='settingParent hide'>
                <label class='question'>Logo or Text?</label>
                <div class='settingOption'>
                  <div data-id="1" class="optionParent">
                    <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_1_structure_1_type" value="logo"> Logo </label></div>
                    <div class="conditionalSettings hide">
                    </div>
                  </div>

                  <div data-id="2" class="optionParent">
                    <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_1_structure_1_type" value="text"> Text</label></div>
                    <div class="conditionalSettings hide">
                    </div>
                  </div>
                </div>
                <h3>Select the Logo Alignment</h3>
                <div class="alignmentOptions flex-row">
                  <label><input type="radio" class="" name="topNav_1_structure_1_align" value="left" /> Left</label>
                  <label><input type="radio" class="" name="topNav_1_structure_1_align" value="middle" /> Middle</label>
                  <label><input type="radio" class="" name="topNav_1_structure_1_align" value="right" /> Right</label>
                </div>
              </div>
            </section>
            <section  data-structure='2'  class="topNav_optionParent navStructureRow flex-column jc-sb ai-fe">
              <div class='settingSelect'>
                <label><input type="radio" name="topNav_1_structure" value="2" /> Logo/Text on the left and hamburger menu icon on the right</label>
              </div>
              <div class='settingParent hide'>
                <div class='settingOption'>
                  <div data-id="1" class="optionParent">
                    <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_1_structure_2_type" value="logo"> Logo </label></div>
                    <div class="conditionalSettings hide">
                    </div>
                  </div>
                  <div data-id="2" class="optionParent">
                    <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_1_structure_2_type" value="text"> Text</label></div>
                    <div class="conditionalSettings hide">
                    </div>
                  </div>
                  <div data-id='3' class='optionParent flex-column'>
                    <label>Hamburger Menu background color</label>
                    <input type="text" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" class="color-picker" name="topNav_1_structure_2_HamburgerMenuBgColor" required />
                    <label class="inputLabel">Hamburger Menu Icon</label>
                    <?php
                      $args = array(
                            'inputName'=>'topNav_1_structure_2_HamburgerMenuIcon',
                            'imageUrl'=>'',
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
                <label><input type="radio" name="topNav_1_structure" value="3" /> Logo/Text on the left and navigation icons on the right      </label>
              </div>
              <div class='settingParent hide'>
                <h3>Logo or text in top bar</h3>
                <p>Would you like your logo or text displayed in the top bar?</p>
                <div class='settingOption'>
                  <div data-id="1" class="optionParent">
                    <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_1_structure_3_type" value="logo"> Logo </label></div>
                    <div class="conditionalSettings hide">
                    </div>
                  </div>
                  <div data-id="2" class="optionParent">
                    <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_1_structure_3_type" value="text"> Text</label></div>
                    <div class="conditionalSettings hide">
                    </div>
                  </div>
                </div>

          <div class="flex-column topNavPageIconItem">
            <div class="flex-row bottomBarItemWrapTop">
              <div class="bottomBarItemType">
                <select onchange="handleTopNavLinkTypeChange(this)"  required class="bottomBarItemType" name="topNav_1_structure_3_Source_1">
                  <!-- <option disabled selected>Select a Link Type</option> -->
                  <option value="page">Page</option>
                  <option value="external">External</option>
                  <option value="share">Share</option>
                </select>
              </div>
              <div class="bottomBarItemUrl flex-column">
                <?php wp_dropdown_pages(
                                              [
                                                'name'=>'topNav_1_structure_3_internalURL_1',
                                                'id'=>'topNav_1_structure_3_internalURL_1',
                                                'class'=>'topNavItemUrlInternal',
                                                'echo'=>'1',
                                                'value_field'=>'guid'
                                              ]
                                            );?>
                <input type="text" class="topNavItemUrlExternal" name="topNav_1_structure_3_externalURL_1" placeholder="Enter External URL" style="display:none;" />
              </div>
            </div>
            <div class="flex-row flex-start bottomBarItemWrapBottom">
              <?php
              $args = array(
                      'inputName'=>'topNav_1_structure_3_iconImage',
                      'imageUrl'=>'',
                      'uploadText'=>'Upload Icon',
                      'changeText'=>'Change Icon'
                    );
            echo $this->wpna_image_uploadField($args); ?>
            </div>
          </div>
          <div class="addNewNavigationIcon">
            <a href="javascript:void(0)" onclick="addTopNavNavigationIcon(this)">Add another navigation icon</a>
          </div>
              </div>
            </section>
            <section  data-structure='4'  class="topNav_optionParent navStructureRow flex-column jc-sb ai-fe">
              <div class='settingSelect'>
                <label><input type="radio" name="topNav_1_structure" value="4" /> Logo/Text middle and navigation icons on both left and right  </label>
              </div>
              <div class='settingParent hide'>
                <h3>Logo or text in top bar?</h3>
                <p>Would you like your logo or text displayed in the top bar?</p>
                <div class='settingOption'>
                  <div data-id="1" class="optionParent">
                    <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_1_structure_4_type" value="logo"> Logo </label></div>
                    <div class="conditionalSettings hide">
                    </div>
                  </div>
                  <div data-id="2" class="optionParent">
                    <div class="optionRadio"><label><input type="radio" class="conditional" name="topNav_1_structure_4_type" value="text"> Text</label></div>
                    <div class="conditionalSettings hide">
                    </div>
                  </div>
                </div>


              <div class="flex-column topNavPageIconItem">
                <div class="flex-row bottomBarItemWrapTop">
                  <div class="bottomBarItemType">
                    <select onchange="handleTopNavLinkTypeChange(this)"  required class="bottomBarItemType" name="topNav_1_structure_4_Source_1">
                      <!-- <option disabled selected>Select a Link Type</option> -->
                      <option value="page">Page</option>
                      <option value="external">External</option>
                      <option value="share">Share</option>
                    </select>
                  </div>
                  <div class="bottomBarItemUrl flex-column">
                    <?php wp_dropdown_pages(
                                                  [
                                                    'name'=>'topNav_1_structure_4_internalURL_1',
                                                    'id'=>'topNav_1_structure_4_internalURL_1',
                                                    'class'=>'topNavItemUrlInternal',
                                                    'echo'=>'1',
                                                    'value_field'=>'guid'
                                                  ]
                                                );?>
                    <input type="text" class="topNavItemUrlExternal" name="topNav_1_structure_4_externalURL_1" placeholder="Enter External URL" style="display:none;" />
                  </div>
                </div>
                <div class="flex-row flex-start bottomBarItemWrapBottom">
                  <?php
                  $args = array(
                          'inputName'=>'topNav_1_structure_4_iconImage',
                          'imageUrl'=>'',
                          'uploadText'=>'Upload Icon',
                          'changeText'=>'Change Icon'
                        );
                echo $this->wpna_image_uploadField($args); ?>
                </div>

              </div>
              <div class="addNewNavigationIcon">
                <a href="javascript:void(0)" onclick="addTopNavNavigationIcon(this)">Add another navigation icon</a>
              </div>
              </div>
            </section>
          </div>
      </div>
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
  display: none;
}
.mb10{
  margin-bottom: 10px;

}
.mt10{
  margin-top: 10px;
}
</style>

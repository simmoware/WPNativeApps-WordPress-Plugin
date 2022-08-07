
<!-- <div class="flex-column hide" id="navigationBottomBarItemGeneric">
  <div class="flex-row bottomBarItemWrapTop">
    <div class="bottomBarItemType">
      <select onchange="handleBottomBarLinkTypeChange(this)" required class="bottomBarItemType" name="bottomBarItemType_1">
        <option disabled selected>Select a Link Type</option>
        <option value="page">Page</option>
        <option value="external">External</option>
      </select>
    </div>
    <div class="bottomBarItemUrl flex-column">
      <?php wp_dropdown_pages(
                                    [
                                      'name'=>'bottomBarItemUrlInternal_{{iconcount}}',
                                      'id'=>'bottomBarItemUrlInternal_{{iconcount}}',
                                      'class'=>'bottomBarItemUrlInternal',
                                      'echo'=>'1',
                                      'value_field'=>'guid'
                                    ]
                                  );?>
      <input type="text" class="bottomBarItemUrlExternal" name="bottomBarItemUrlExternal_{{iconcount}}" placeholder="Enter External URL" style="display:none;" />
    </div>
    <div class="bottomBarItemText">
      <input type="text" class="bottomBarItemText" name="bottomBarItemText_{{iconcount}}" value="" placeholder="Enter Label"/>
    </div>
  </div>
  <div class="flex-row flex-start bottomBarItemWrapBottom">
    <?php
    $args = array(
            'inputName'=>'bottomBarItemIcon_{{iconcount}}',
            'imageUrl'=>$image[0],
            'uploadText'=>'Upload Icon',
            'changeText'=>'Change Icon'
          );
    echo $this->wpna_image_uploadField($args); ?>
  </div>
</div> -->

<!-- <div class="flex-column hide" id="navigationHamburgerItemGeneric">
  <div class="flex-row hamburgerItemWrapTop">
    <div class="hamburgerItemType">
      <select onchange="handleHamburgerLinkTypeChange(this)" required class="hamburgerItemType" name="hamburgerItemType_1">
        <option disabled selected>Select a Link Type</option>
        <option value="page">Page</option>
        <option value="external">External</option>
      </select>
    </div>
    <div class="hamburgerItemUrl flex-column">
      <?php wp_dropdown_pages(
                                    [
                                      'name'=>'hamburgerItemUrlInternal_{{iconcount}}',
                                      'id'=>'hamburgerItemUrlInternal_{{iconcount}}',
                                      'class'=>'hamburgerItemUrlInternal',
                                      'echo'=>'1',
                                      'value_field'=>'guid'
                                    ]
                                  );?>
      <input type="text" class="hamburgerItemUrlExternal" name="hamburgerItemUrlExternal_{{iconcount}}" placeholder="Enter External URL" style="display:none;" />
    </div>
    <div class="hamburgerItemText">
      <input type="text" class="hamburgerItemText" name="hamburgerItemText_{{iconcount}}" value="" placeholder="Enter Label"/>
    </div>
  </div>
  <div class="flex-row flex-start hamburgerItemWrapBottom">
    <?php
    $args = array(
            'inputName'=>'hamburgerItemIcon_{{iconcount}}',
            'imageUrl'=>$image[0],
            'uploadText'=>'Upload Icon',
            'changeText'=>'Change Icon'
          );
    echo $this->wpna_image_uploadField('hamburgerItemIcon_{{iconcount}}'); ?>
  </div>
</div> -->




  <section class="flex=row mb10">
    <div class="flex-item flex-column topNavsection">
      <div class="section_heading">
        Select a top navigation for each of your bottom navigation Pages
      </div>
      <div id="topNavTabOptions" class="flex-row jc-se">
        add html for tab to select
      </div>
      <div id="topNavTabContent flex-column">
        add html for each tab content ( partials ma cha each tab dynamic)
      </div>

    </div>
    <div class="addNewNavigationIcon">
      <a id="addBottomNavigationIcon" href="javascript:void(0)">Add another navigation icon</a>
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

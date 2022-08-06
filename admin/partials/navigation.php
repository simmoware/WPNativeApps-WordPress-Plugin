<div class="flex-column">

  <div class="flex-item flex-column navigation_bottomBar_section">
    <div class="section_heading">
      Bottom Bar
    </div>
    <div class="flex-column navigationBottomBarItem">
      <div class="flex-row bottomBarItemWrapTop">
        <div class="bottomBarItemType">
          <select required class="bottomBarItemType" name="bottomBarItemType_1">
            <option disabled selected>

            <Select a Link Type>
            <option value="page">Page</option>
            <option value="external">External</option>
          </select>
        </div>
        <div class="bottomBarItemUrl flex-column">
          <?php wp_dropdown_pages(
                                        [
                                          'name'=>'bottomBarItemUrlInternal_1',
                                          'id'=>'bottomBarItemUrlInternal_1',
                                          'class'=>'bottomBarItemUrlInternal',
                                          'echo'=>'1',
                                          'value_field'=>'guid'
                                        ]
                                      );?>
          <input type="text" class="bottomBarItemUrlExternal" name="bottomBarItemUrlExternal_1" placeholder="Enter External URL" style="display:none;" />
        </div>
        <div class="bottomBarItemText">
          <input type="text" class="bottomBarItemText" name="bottomBarItemText_1" value="" placeholder="Enter Label"/>
        </div>
      </div>
      <div class="flex-row flex-start bottomBarItemWrapBottom">
        <?php echo $this->wpna_image_uploadField('bottomBarItemIcon_1'); ?>

      </div>

    </div>
    <div class="flex-column navigationBottomBarItem">
      <div class="flex-row bottomBarItemWrapTop">
        <div class="bottomBarItemType">
          <select required class="bottomBarItemType" name="bottomBarItemType_2">
            <option disabled selected>Select a Link Type</option>
            <option value="page">Page</option>
            <option value="external">External</option>
          </select>
        </div>
        <div class="bottomBarItemUrl flex-column">
          <?php wp_dropdown_pages(
                                        [
                                          'name'=>'bottomBarItemUrlInternal_2',
                                          'id'=>'bottomBarItemUrlInternal_2',
                                          'class'=>'bottomBarItemUrlInternal',
                                          'echo'=>'1',
                                          'value_field'=>'guid'
                                        ]
                                      );?>

          <input type="text" class="bottomBarItemUrlExternal" name="bottomBarItemUrlExternal_1" placeholder="Enter External URL" style="display:none;" />
        </div>
        <div class="bottomBarItemText">
          <input type="text" class="bottomBarItemText" name="bottomBarItemText_1" value="" placeholder="Enter Label"/>
        </div>
      </div>
      <div class="flex-row flex-start bottomBarItemWrapBottom">
        <?php echo $this->wpna_image_uploadField('bottomBarItemIcon_1'); ?>

      </div>

    </div>
    <div class="flex-column navigationBottomBarItem">
      <div class="flex-row bottomBarItemWrapTop">
        <div class="bottomBarItemType">
          <select required class="bottomBarItemType" name="bottomBarItemType_3">
            <option disabled selected>

            <Select a Link Type>
            <option value="page">Page</option>
            <option value="external">External</option>
          </select>
        </div>
        <div class="bottomBarItemUrl flex-column">
          <?php wp_dropdown_pages(
                                        [
                                          'name'=>'bottomBarItemUrlInternal_3',
                                          'id'=>'bottomBarItemUrlInternal_3',
                                          'class'=>'bottomBarItemUrlInternal',
                                          'echo'=>'1',
                                          'value_field'=>'guid'
                                        ]
                                      );?>

          <input type="text" class="bottomBarItemUrlExternal" name="bottomBarItemUrlExternal_1" placeholder="Enter External URL" style="display:none;" />
        </div>
        <div class="bottomBarItemText">
          <input type="text" class="bottomBarItemText" name="bottomBarItemText_1" value="" placeholder="Enter Label"/>
        </div>
      </div>
      <div class="flex-row flex-start bottomBarItemWrapBottom">
        <?php echo $this->wpna_image_uploadField('bottomBarItemIcon_1'); ?>

      </div>

    </div>

  </div>
  <div class="addNewNavigationIcon">
    <a href="javascript:addNavigationIcon()">Add another navigation icon</a>
  </div>









</div>



<style>
.flex-column{

}
.bottomBarItemWrapBottom .wpnaImageUploadPreview{
  height: 36px;
  width: 36px;
  max-height: 36px;
  max-width: 36px;
  margin-right:15px;
}
.bottomBarItemWrapBottom .wpnaImageUploadSection {
  display: flex;
  flex-direction: row;
    align-items: center;
    padding: 10px;
}
.bottomBarItemWrapBottom .wpnaImageUploadSection .button{
    padding: 3px 15px;
    color: #CB1818;
    border-color: #CB1818;
}
</style>

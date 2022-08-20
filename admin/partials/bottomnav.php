
<div class="flex-column hide" id="navigationBottomBarItemGeneric">
  <div class="flex-row bottomBarItemWrapTop">
    <div class="bottomBarItemType">
      <select onchange="handleBottomBarLinkTypeChange(this)" required class="bottomBarItemType" name="bottomBarItemType_1">
        <!-- <option disabled selected>Select a Link Type</option> -->
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
      <input type="text" class="bottomBarItemUrlExternal hide" name="bottomBarItemUrlExternal_{{iconcount}}" placeholder="Enter External URL" />
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
</div>




<?php
$bottomBarNavs =  $config['bottomBarNav']['pages'];
?>
<div class="flex-column">
  <section class="flex=row mb10">
    <div class="flex-item flex-column navigation_bottomBar_section">
      <h1 class=" ">
        Bottom Nav
      </h1>
      <div class="flex-column navigationBottomBarItems">



      <?php
      $bottomNavHtml = '';
      $count = 1;
      // ob_start();
      if(!empty($bottomBarNavs)){
        foreach($bottomBarNavs as $bottomNav){
          $isExternal = $bottomNav['isExternal'];
          $url = $bottomNav['url'];
          $icon = $bottomNav['icon'];
          $name = $bottomNav['name'];
          $selectedPage = ($isExternal) ? 0 : $this->getIDfromGUID($url);
          $pageDDHTML = $this->wpna_image_uploadField("bottomBarItemIcon_".$count);
          ?>

            <div class="flex-column navigationBottomBarItem">
              <div class="flex-row bottomBarItemWrapTop">
                <div class="bottomBarItemType">
                  <select onchange="handleBottomBarLinkTypeChange(this)"  required class="bottomBarItemType" name="bottomBarItemType_<?php echo $count;?>">
                    <option value="page">Page</option>
                    <option value="external">External</option>
                  </select>
                </div>
                <div class="bottomBarItemUrl flex-column">
                  <?php wp_dropdown_pages(
                                                [
                                                  'name'=>'bottomBarItemUrlInternal_'.$count,
                                                  'id'=>'bottomBarItemUrlInternal_'.$count,
                                                  'class'=>'bottomBarItemUrlInternal',
                                                  'echo'=>'1',
                                                  'value_field'=>'guid',
                                                  'selected' => $selectedPage
                                                ]
                                              );?>
                  <input type="text" class="bottomBarItemUrlExternal hide" value="<?php echo $url;?>" name="bottomBarItemUrlExternal_<?php echo $count;?>" placeholder="Enter External URL" />
                </div>
                <div class="bottomBarItemText">
                  <input type="text" class="bottomBarItemText" name="bottomBarItemText_<?php echo $count;?>" value="<?php echo $name;?>" placeholder="Enter Label"/>
                </div>
              </div>
              <div class="flex-row flex-start bottomBarItemWrapBottom">
                <?php echo $pageDDHTML; ?>
              </div>
              <?php
              if( $count == count($bottomBarNavs) && $count > 3 ){
                echo '<span id="removeBottomBarNavigationIcon" class="button" onclick="removeBottomBarNavigationIcon(this);">Remove</span>';
              }
              ?>
            </div>
          <?php
          $count++;
        }
      }else{
          $count = 1;
          $isExternal = false;
          $url = '';
          $icon = '';
          $name = '';
          $selectedPage = 0;
          $pageDDHTML = $this->wpna_image_uploadField("bottomBarItemIcon_".$count);
          ?>

            <div class="flex-column navigationBottomBarItem">
              <div class="flex-row bottomBarItemWrapTop">
                <div class="bottomBarItemType">
                  <select onchange="handleBottomBarLinkTypeChange(this)"  required class="bottomBarItemType" name="bottomBarItemType_<?php echo $count;?>">
                    <option value="page">Page</option>
                    <option value="external">External</option>
                  </select>
                </div>
                <div class="bottomBarItemUrl flex-column">
                  <?php wp_dropdown_pages(
                                                [
                                                  'name'=>'bottomBarItemUrlInternal_'.$count,
                                                  'id'=>'bottomBarItemUrlInternal_'.$count,
                                                  'class'=>'bottomBarItemUrlInternal',
                                                  'echo'=>'1',
                                                  'value_field'=>'guid',
                                                  'selected' => $selectedPage
                                                ]
                                              );?>
                  <input type="text" class="bottomBarItemUrlExternal hide" value="<?php echo $url;?>" name="bottomBarItemUrlExternal_<?php echo $count;?>" placeholder="Enter External URL"  />
                </div>
                <div class="bottomBarItemText">
                  <input type="text" class="bottomBarItemText" name="bottomBarItemText_<?php echo $count;?>" value="<?php echo $name;?>" placeholder="Enter Label"/>
                </div>
              </div>
              <div class="flex-row flex-start bottomBarItemWrapBottom">
                <?php echo $pageDDHTML; ?>
              </div>
            </div>
          <?php
        }
      ?>
    </div>
    </div>
    <div class="addNewNavigationIcon">
      <a id="addBottomNavigationIcon" href="javascript:void(0)" onclick="addBottomBarNavigationIcon(this)">Add another navigation icon</a>
    </div>
  </section>



</div>



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

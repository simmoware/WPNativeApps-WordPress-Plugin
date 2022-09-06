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
          $icon = isset($bottomNav['icon']) ? $bottomNav['icon'] : '';
          $name = $bottomNav['name'];
          $selectedPage = ($isExternal) ? 0 : $this->getIDfromURL($url);
          $args = array(
            'inputName'=>'bottomBarNavLogo_'.$count,
            'imageUrl'=>$icon,
            'uploadText'=>'Upload Background Image',
            'changeText'=>'Change Background Image'
          );

          $pageDDHTML = $this->wpna_image_uploadField($args);
          ?>

            <div class="flex-column navigationBottomBarItem">
              <div class="flex-row bottomBarItemWrapTop">
                <div class="bottomBarItemType">
                  <select onchange="handleBottomBarLinkTypeChange(this)"  required class="bottomBarItemType" name="bottomBarItemType_<?php echo $count;?>">
                    <option value="page" <?php echo ($isExternal) ? '': 'selected';?>>Page</option>
                    <option value="external" <?php echo ($isExternal) ? 'selected': '';?>>External</option>
                  </select>
                </div>
                <div class="bottomBarItemUrl flex-column">
                  <?php
                  $ddClass = ($isExternal)? 'hide ' : '';
                  wp_dropdown_pages(
                                                [
                                                  'name'=>'bottomBarItemUrlInternal_'.$count,
                                                  'id'=>'bottomBarItemUrlInternal_'.$count,
                                                  'class'=>$ddClass.'bottomBarItemUrlInternal',
                                                  'echo'=>'1',
                                                  'value_field'=>'guid',
                                                  'selected' => $selectedPage
                                                ]
                                              );?>
                  <input type="text" class="bottomBarItemUrlExternal <?php echo ($isExternal)? '' : 'hide';?>" value="<?php echo $url;?>" name="bottomBarItemUrlExternal_<?php echo $count;?>" placeholder="Enter External URL" />
                </div>
                <div class="bottomBarItemText">
                  <input type="text" data-itemcount = "<?php echo $count;?>" class="bottomBarItemText item_<?php echo $count;?>" name="bottomBarItemText[]" value="<?php echo $name;?>" placeholder="Enter Label" onchange="updateTopNavTabName(this)"/>
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
                  <input type="text" class="bottomBarItemText" name="bottomBarItemText[]" value="<?php echo $name;?>" placeholder="Enter Label"/>
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
    <div class="addNewNavigationIcon <?php echo ($count > 4) ? "hide" : "";?>">
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

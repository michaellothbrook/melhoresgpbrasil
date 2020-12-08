<?php
$path =  plugin_dir_url(__FILE__);
?>
<div class="uimrow"> <a href="admin.php?page=pm_woocommerce_settings">
  <div class="pm_setting_image"> <img src="<?php echo $path;?>images/woocommerce.png" class="options" alt="options"> </div>
  <div class="pm-setting-heading"> <span class="pm-setting-icon-title">
    <?php _e( 'WooCommerce','profilegrid-woocommerce' ); ?>
    </span> <span class="pm-setting-description">
    <?php _e( 'Define WooCommerce integration parameters.', 'profilegrid-woocommerce' ); ?>
    </span> </div>
  </a> </div>
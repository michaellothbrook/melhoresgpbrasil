<?php
$path =  plugin_dir_url(__FILE__);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$pmrequest = new PM_request();
$deactivate_extensions = $pmrequest->pg_check_premium_extension();
        
?>

<?php if(!empty($deactivate_extensions)):?>
<div class="uimrow"> <a id="pm-premium-popup">
  <div class="pm_setting_image"> <img src="<?php echo $path;?>images/pg-promo-icon.png" class="options" alt="options"> </div>
  <div class="pm-setting-heading"> <span class="pm-setting-icon-title">
    <?php _e( 'More','profilegrid-user-profiles-groups-and-communities' ); ?>
    </span> <span class="pm-setting-description">
    <?php _e( 'Unlock more settings', 'profilegrid-user-profiles-groups-and-communities' ); ?>
    </span> </div>
  </a> </div>


<div class="pm-popup" id="pg-promo-popup">
    <div class="pg-promo-popup">
    <div class="pm-popup-header">
        <div class="pm-popup-title">
            <?php _e('Extend Power of ProfileGrid','profilegrid-user-profiles-groups-and-communities'); ?>
        </div>
        <img class="pm-popup-close" src="<?php echo $path; ?>images/close-pm.png">
    </div>
        
        
        <div class="pg-promo-wrap">
             <div class="pg-promo-subsection pg-promo-subsect-tabs">
                <ul class="pg-promo-section-icons">
                    <div class="pg-promo-section-title"><?php _e('Premium Extensions', 'profilegrid-user-profiles-groups-and-communities'); ?></div>
                    <?php if(in_array('Profilegrid_Userid_Slug_Changer',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/userid_slug.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Group_photos',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/group-photos.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Display_Name',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/display_name.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Group_Fields',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/group-custom-fields.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Bbpress',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/bbpress.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Geolocation',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/geolocation.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Front_End_Groups',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/frontend-group.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Mailchimp',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/pg-mailchimp.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Woocommerce',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/pg-woocommerce.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Social_Connect',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/social-connect.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_User_Content',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/profile-tabs-icon.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Mycred',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/pg-mycred-integration.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    
                    <?php if(in_array('Profilegrid_User_Photos_Extension',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/user_photos.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    
                    <?php if(in_array('Profilegrid_Menu_Restriction',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/menu_restrictions.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
               
                    
                </ul> 

                <div class="pg-promo-content-wrap">
                    <?php if(in_array('Profilegrid_Userid_Slug_Changer',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Define how your user profile URL's will appear to site visitors and search engines. Take control of your user profile permalinks and add dynamic slugs.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Group_photos',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Allow your users to create and share Photo Albums within their Groups. There's also an option for public photos. Users can enlarge and comment on different photos.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Display_Name',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Now take complete control of your users' display names. Mix and match patterns and add predefined suffixes and prefixes. There's a both global and per group option allowing display names in different groups stand out!", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Group_Fields',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Create and add custom fields to groups too! Now your user groups can have more detailed information and personality just like your user profile pages.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Bbpress',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Integrate ProfileGrid user profile properties and sign up system with the ever popular bbPress community forums plugin.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Geolocation',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Generate maps showing locations of all users or specific groups using simple shortcodes. Get location data from registration form.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Front_End_Groups',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Allow registered users to create new Groups on front end. These Groups behave and work just like regular ProfileGrid groups.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Mailchimp',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Assign ProfileGrid users to MailChimp lists with custom field mapping and options for users to manage subscriptions.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Woocommerce',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Combine the power of ProfileGrid's user groups with WooCommerce cart to provide your users ultimate shopping experience.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Social_Connect',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Allow your users to sign up and login using their favourite social network accounts. Social accounts can be managed from Profile settings.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_User_Content',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Add personalized tabs in user profiles to suit your business or industry. Add user authored content from any custom post type or shortcode (or add specific content) with different privacy levels. Open doors to endless possibilities - Integrate user profiles with other plugins supporting custom post or shortcode format.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Mycred',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Integrate popular points system for WordPress with ProfileGrid to reward your users. Display ranks and badges on user profile pages, give incentive for activities on site or penalize based on pre-set rules.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_User_Photos_Extension',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Allow users to upload and manage personal photos on their user profiles.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Menu_Restriction',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Use in-built ProfileGrid hierarchy to hide or show menu items on your site! You can mark specific menu items to be visible or hidden only to certain group(s). Create specific menu items for Group Managers of selected or all groups. Combine it with ProfileGrid's core content restriction system to build extremely powerful membership sites.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    
                   </div>


            </div>
            
            <div class="pg-promo-subsection pg-promo-subsect-tabs">
                <ul class="pg-promo-section-icons">
                    <div class="pg-promo-section-title"></div>
                       <?php if(in_array('Profilegrid_Woocommerce_Wishlist',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/pg-wishlist-woocommerce.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Instagram_Integration',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/pg-instagram.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Group_Wall',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/pg-groupwall.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Menu_Integration',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/pg-logout-icon.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Advanced_Woocommerce',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/pg-woo-advanced-icon.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_EventPrime_Integration',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/pg-ep-integration.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Admin_Power',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/frontend-group-manager.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Group_Multi_Admins',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/multi-admins.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Profile_Labels',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/pg-user-labels.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Stripe_Payment',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/stripe-logo.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_User_Profile_Status',$deactivate_extensions)):?>
                      <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/profile_status.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Demo_Content',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/demo-content.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Woocommerce_Product_Integration',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/woocommerce-product-intregration.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Hero_Banner',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/hero-banner.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Woocommerce_Subscription_Integration',$deactivate_extensions)):?>
                    <li class="pg-promo-icon"> <img src="<?php echo $path; ?>images/pg-wooCommerce-subscription.png"> <span class="pg-promo-nub"></span> </li>
                    <?php endif;?>
                </ul>
                   <div class="pg-promo-content-wrap">
                  <?php if(in_array('Profilegrid_Woocommerce_Wishlist',$deactivate_extensions)):?>
                   <div class="pg-promo-content"> <?php _e("Add WooCommerce products to your Wishlist and manage it completely from your ProfileGrid User Profile.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Instagram_Integration',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Show Instagram tab on User Profile page with user’s Instagram photos displayed in the tab.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Group_Wall',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("A brand new ProfileGrid extension that adds social activity to your User Groups. Now users can create new posts, comment on other users' posts and browse Group timeline. Group wall is accessible from Group page as a new tab.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Menu_Integration',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Now you can add contextual login menu item to your website menu(s) with few simple clicks. The menu item changes based on user login state. Additionally, you have option to add User Profile, User Groups and Password Recovery items too.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Advanced_Woocommerce',$deactivate_extensions)):?>
                   <div class="pg-promo-content"> <?php _e("Enhance the power of ProfileGrid's integration with WooCommerce by adding in integrations with WooCommerce extensions.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_EventPrime_Integration',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Create ProfileGrid Group Events by Integrating ProfileGrid User Groups with EventPrime Events.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Admin_Power',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Offer more power and control to your Group Managers. They can edit Groups, approve membership requests, moderate blogs, manage users, etc. from a dedicated frontend Group management area.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Group_Multi_Admins',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Don't stay limited to just one Manager per Group. Unlock the ability to have more than one Managers for your ProfileGrid User Groups now. With all of them sharing the same level of control.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Profile_Labels',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Allow user to add Profile Labels to their User Profiles as an additional way to convey their interests and/or designation.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Stripe_Payment',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e('Start accepting credit cards on your site for Group memberships and registrations by integrating popular Stripe payment gateway.', 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_User_Profile_Status',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Allow users to upload statuses to their user profiles. Users can view statuses on their own profiles and other users' profiles.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Demo_Content',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("This dynamic extension enables admin to import demo content. The admin can also import these groups with multiple fields, sections and users. Moreover, the admins get an option to choose number of demo groups they want to import.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Woocommerce_Product_Integration',$deactivate_extensions)):?>
                     <div class="pg-promo-content"> <?php _e("This ravishing extension allows you to integrate WooCommerce products with ProfileGrid Groups. You can assign groups to your users based on the type of products they buy or the amount of purchase they make on WooCommerce.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Hero_Banner',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("With the dynamic Hero Banner feature showcase your group profiles as a striking hero image on your WordPress website. You can add multiple rows and columns of your choice.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                    <?php if(in_array('Profilegrid_Woocommerce_Subscription_Integration',$deactivate_extensions)):?>
                    <div class="pg-promo-content"> <?php _e("Integrate WooCommerce product subscriptions with ProfileGrid Groups. Assign/Unassign the groups to the users based on WooCommerce subscription.", 'profilegrid-user-profiles-groups-and-communities'); ?> </div>
                    <?php endif;?>
                   </div>
                
                
            </div>
        </div>
        
        <div class="pg-promo-popup-footer"><a href="admin.php?page=pm_extensions" target="_blank">More Information</a></div>
    </div>
</div>


<script>

(function($){ 
    
    $(document).ready(function(){
       $(".pg-promo-subsect-tabs").each(function(){
            var $this = $(this);
            $this.find("li").each(function(curr_index){
                $(this).hover(function(){
                    $this.find(".pg-promo-content").hide().eq(curr_index).show();
                    $this.find(".pg-promo-nub").hide().eq(curr_index).show();
                });
            });
            
            $this.find(".pg-promo-content").hide().eq(0).show();
            $this.find(".pg-promo-nub").hide().eq(0).show();
        });        
        
    });   
    
})(jQuery);


</script>
<?php endif; ?>

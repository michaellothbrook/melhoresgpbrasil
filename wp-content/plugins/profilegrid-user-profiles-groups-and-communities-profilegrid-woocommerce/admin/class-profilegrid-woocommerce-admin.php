<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Profilegrid_Woocommerce
 * @subpackage Profilegrid_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Profilegrid_Woocommerce
 * @subpackage Profilegrid_Woocommerce/admin
 * @author     Your Name <email@example.com>
 */
class Profilegrid_Woocommerce_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $profilegrid_woocommerce    The ID of this plugin.
	 */
	private $profilegrid_woocommerce;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $profilegrid_woocommerce       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $profilegrid_woocommerce, $version ) {

		$this->profilegrid_woocommerce = $profilegrid_woocommerce;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Profilegrid_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Profilegrid_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
            if (class_exists('Profile_Magic') ) {
                wp_enqueue_style( $this->profilegrid_woocommerce, plugin_dir_url( __FILE__ ) . 'css/profilegrid-woocommerce-admin.css', array(), $this->version, 'all' );
            }
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Profilegrid_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Profilegrid_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
            if (class_exists('Profile_Magic') ) {
                wp_enqueue_script( $this->profilegrid_woocommerce, plugin_dir_url( __FILE__ ) . 'js/profilegrid-woocommerce-admin.js', array( 'jquery' ), $this->version, false );
            }
	}
        
        public function profilegrid_woocommerce_admin_menu()
	{
                add_submenu_page("",__("Woocommerce Settings","profilegrid-woocommerce"),__("Woocommerce Settings","profilegrid-woocommerce"),"manage_options","pm_woocommerce_settings",array( $this, 'pm_woocommerce_settings' ));
        }
	
        public function pm_woocommerce_settings()
        {
            include 'partials/profilegrid-woocommerce-admin-display.php';
        }
        
        public function profilegrid_woocommerce_add_option_setting_page()
        {
            include 'partials/profilegrid-woocommerce-setting-option.php';
        }
        
        public function profile_magic_woocommerce_notice_fun()
        {
            if (!class_exists('Profile_Magic') ) {
                    
                $this->Woocommerce_installation();
                    //wp_die( "ProfileGrid Stripe won't work as unable to locate ProfileGrid plugin files." );
            }
            
            if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) 
            {
                $this->Woocommerce_installation2();
            }
        }
        
        public function Woocommerce_installation()
        {
            $plugin_slug= 'profilegrid-user-profiles-groups-and-communities';
            $installUrl = admin_url('update.php?action=install-plugin&plugin=' . $plugin_slug);
            $installUrl = wp_nonce_url($installUrl, 'install-plugin_' . $plugin_slug);
            ?>
            <div class="notice notice-success is-dismissible">
                <p><?php echo sprintf(__( "Profilegrid Woocommerce work with ProfileGrid Plugin. You can install it  from <a href='%s'>Here</a>.", 'profilegrid-woocommerce'),$installUrl ); ?></p>
            </div>
            <?php
            deactivate_plugins('profilegrid-user-profiles-groups-and-communities-profilegrid-woocommerce/profilegrid-woocommerce.php'); 
        }
        
        public function Woocommerce_installation2()
        {
            $plugin_slug= 'woocommerce';
            $installUrl = admin_url('update.php?action=install-plugin&plugin=' . $plugin_slug);
            $installUrl = wp_nonce_url($installUrl, 'install-plugin_' . $plugin_slug);
            ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e( "Since you have deactivated WooCommerce, the ProfileGrid WooCommerce Extension has been automatically deactivated. You will have to manually turn it on when you activate WooCommerce.", 'profilegrid-woocommerce' ); ?></p>
            </div>
            <?php
            deactivate_plugins('profilegrid-user-profiles-groups-and-communities-profilegrid-woocommerce/profilegrid-woocommerce.php');
        }
      
        
        public function activate_sitewide_plugins($blog_id)
        {
            // Switch to new website
            $dbhandler = new PM_DBhandler;
            $activator = new Profile_Magic_Activator;
            switch_to_blog( $blog_id );
            // Activate
            foreach( array_keys( get_site_option( 'active_sitewide_plugins' ) ) as $plugin ) {
                do_action( 'activate_'  . $plugin, false );
                do_action( 'activate'   . '_plugin', $plugin, false );
                $activator->activate();
                
            }
            // Restore current website 
            restore_current_blog();
        }
        
        public function profile_magic_woocommerce_group_option($id,$group_options)
        {
            $dbhandler = new PM_DBhandler;
            if($dbhandler->get_global_option_value('pm_enable_woocommerce','0')==1):
             include 'partials/profilegrid-woocommerce-group-option.php';
            endif;
        }
        
        public function pm_woocommerce_tabs_filters($pm_profile_tabs_status)
        {
            $dbhandler = new PM_DBhandler;
            $status = $dbhandler->get_global_option_value('pm_enable_woocommerce','0');
            $check_ids = array();
            foreach($pm_profile_tabs_status as $oldtab)
            {
                $check_ids[] =$oldtab['id'];
            }
            if(!in_array('pg-woocommerce_purchases',$check_ids))
            {
                $pm_profile_tabs_status['pg-woocommerce_purchases'] = array('id'=>'pg-woocommerce_purchases','title'=>__('Purchases','profilegrid-woocommerce'),'status'=>$status,'class'=>'');
            }
            if(!in_array('pg-woocommerce_cart',$check_ids))
            {
                $pm_profile_tabs_status['pg-woocommerce_cart'] = array('id'=>'pg-woocommerce_cart','title'=>__('Cart','profilegrid-woocommerce'),'status'=>$status,'class'=>'');
            }
            
            if(!in_array('pg-woocommerce_reviews',$check_ids))
            {
                $pm_profile_tabs_status['pg-woocommerce_reviews'] = array('id'=>'pg-woocommerce_reviews','title'=>__('Product Reviews','profilegrid-woocommerce'),'status'=>$status,'class'=>'');
            }
           
            
            return $pm_profile_tabs_status;
           
        }
        
        

}

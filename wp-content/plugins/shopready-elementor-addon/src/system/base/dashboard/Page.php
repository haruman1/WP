<?php 
namespace Shop_Ready\system\base\dashboard;

Class Page {
  

  
    public function register(){
     
         add_action( 'admin_enqueue_scripts' , [ $this,'add_admin_scripts'] );
         add_action( 'admin_menu' , [ $this,'dashboard_menu_page'] );
         add_action( 'network_admin_menu' , [ $this,'dashboard_menu_page'] );
   
    }

    public function add_admin_scripts($handle){
      
      
        if( $handle == 'toplevel_page_'.SHOP_READY_SETTING_PATH ) {
          
            wp_enqueue_style( 'shop-ready-admin-base' );
            wp_enqueue_style( 'shop-ready-admin-grid' );
            wp_enqueue_style( 'bvselect' );
            wp_enqueue_script( 'bvselect' );
  
        }
    }
   
    public function dashboard_content(){
       
        require_once( __DIR__ . '/views/dashboard.php' );
    }

    function dashboard_menu_page() {
        
        if(!current_user_can( 'edit_users' )){
          return;
        }

        add_menu_page( 
            esc_html__( 'Shop Ready' , 'shopready-elementor-addon' ),
            esc_html__( 'Shop Ready' , 'shopready-elementor-addon' ),
            'manage_options',
            SHOP_READY_SETTING_PATH,
            [$this,'dashboard_content'],
            SHOP_READY_PUBLIC_ROOT_IMG . 'logo.svg',
            4
        );

        $installed_plugins = array_keys( get_plugins() );
        
        if ( in_array('shop-ready-pro/shop-ready-pro.php',$installed_plugins) ) {
            return; 
        } 

        if ( in_array('shop-ready-pro-bundle/shop-ready-pro-bundle.php',$installed_plugins) ) {
            return; 
        } 

        add_submenu_page(
            SHOP_READY_SETTING_PATH,
            esc_html__( 'Go Pro', 'shopready-elementor-addon' ),
            esc_html__( 'Go Pro 🔥', 'shopready-elementor-addon' ),
            'manage_options',
            SHOP_READY_DEMO_URL,
            '',
            100
        );

        
    
    }

   

}


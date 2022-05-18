<?php 
/**
 * @package  Mega menu
 */
namespace Element_Ready\Modules\Menu_Builder\Base;
use Element_Ready\Base\BaseController;

class Enqueue extends BaseController
{
	public function register() {
		// admin
		add_action( 'admin_enqueue_scripts', array( $this, 'backend' ) );
		add_action( 'elementor/frontend/after_register_styles', array( $this, 'frontend' ) );
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'elementor_frontend' ) );
       
   	}

    public function frontend(){
  
        wp_register_style( 'er-round-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-round-menu.css', false ,ELEMENT_READY_VERSION);
        wp_register_style( 'er-offcanvas-min-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-offcanvas-menu.css', false, ELEMENT_READY_VERSION);
        wp_register_style( 'er-offcanvas-slide-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-offcanvas-slide.css', false , ELEMENT_READY_VERSION);
        wp_register_style( 'er-standard-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-standard-menu.css', false , ELEMENT_READY_VERSION);
        wp_register_style( 'er-standard-round', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-standard-round.css', false , ELEMENT_READY_VERSION);
        wp_register_style( 'er-standard-5-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-standard-5-menu.css', false, ELEMENT_READY_VERSION);
        wp_register_style( 'er-standard-offcanvas', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-standard-offcanvas.css', false, ELEMENT_READY_VERSION);
        wp_register_style( 'er-mobile-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-mobile-menu.css', false , ELEMENT_READY_VERSION);
        wp_register_style( 'er-menu-off-canvas', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-menu-off-canvas.css', false , ELEMENT_READY_VERSION);
    
    } 
    
    public function elementor_frontend(){

        wp_register_script( 'element-ready-menu-frontend-script', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/js/frontend.js',['jquery'],ELEMENT_READY_VERSION);
        wp_register_script( 'element-ready-vartical-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/js/vartical.js', array('jquery'),ELEMENT_READY_VERSION );
        wp_register_script( 'er-round-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/js/er-round-menu.js', array('jquery'),ELEMENT_READY_VERSION );
     
    }
    
  
	
	function backend( $handle ) {
        // enqueue all our scripts
        if( 'nav-menus.php' != $handle ){
            return;
        }

        if ( ! did_action( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }
 	   
        wp_enqueue_style( 'element-ready-mega-menu-backend', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/backend.css', false , time());
        wp_enqueue_script( 'element-ready-mega-menu-backend-script', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/js/backend.js', array('jquery','underscore'), time() );
      
        $mege_menu_obj = array(
            'ajax_url'        => admin_url( 'admin-ajax.php' ),
            'nonce'           => wp_create_nonce( 'element_ready_mega_menu_metabox_nonce' ),
            'menu_id'         => sanitize_text_field(isset($_REQUEST['menu'])?$_REQUEST['menu']:null),
            'mega_menu_title' => esc_html__('Mega Menu','element-ready')
        );

        wp_localize_script( 'element-ready-mega-menu-backend-script', 'mege_menu_obj', $mege_menu_obj );
    }

    
    
  
}
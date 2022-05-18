<?php
namespace Shop_Ready\extension\templates\hooks\cart;
use Shop_Ready\base\Page_Layout as Page_Layout;
use Shop_Ready\base\View;
/*
* WooCommerece Checkout Template
* woocommerce->settings->advanced->page setup  
*/

Class Layout extends Page_Layout{

    public $name = null;
    public function register(){
     
    add_action( 'wp_enqueue_scripts', [$this,'remove_default_stylesheet'], 20 );
   
   }

   public function remove_default_stylesheet(){
   
        if( !is_cart() ){
            return;
        }

        if( $this->is_tpl_active('cart') && $this->preset_tpl('cart') ){
        return ;  
        }
    
        wp_dequeue_style( 'shop-ready-public-base' );
        wp_deregister_style( 'shop-ready-public-base' );

   }


}

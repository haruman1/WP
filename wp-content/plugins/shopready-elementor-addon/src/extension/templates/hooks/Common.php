<?php

namespace Shop_Ready\extension\templates\hooks;

use Illuminate\Config\Repository as Shop_Ready_Repository;

/*
* WooCommerece Shop Common 
* Templates 
*/

Class Common{


    public function register(){
     
      add_filter('body_class', [$this, 'set_body_class'] );
      add_filter('shop_ready_sr_templates_config', [$this, 'templates_config'],10 );
     
      // Product Details Page
     
    }
  


    /**
    * | set_body_class |
    * @author     <quomodosoft.com>
    * @since      File available since Release 1.0
    * @param  [string]  $classes
    * @return array | []
    */
    public function set_body_class($classes){
        
        return array_merge( $classes, array( 'shopready-elementor-addon' ) );
    }
    
    public function templates_config($templates){

      $availables = [
          'single','shop','order_received','my_account_login_register'
      ];
     
      $old = $templates->all();
     
      foreach( $old as $key => $item ){
       
        if( in_array( $key , $availables ) ) {
           $old[$key]['is_pro'] = false;    
        }else{
           $old[$key]['is_pro'] = true;    
        } 
       
      }
     
      $return_template = new Shop_Ready_Repository($old);
      return $return_template;  
    }


}

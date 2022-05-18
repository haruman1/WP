<?php

namespace Shop_Ready\extension\elewidgets\deps\product;

/** 
* @since 1.0 
* WooCommerce Product Tabs Data
* Cart Product qty Update
* use in Widget folder checkout
* @author quomodosoft.com 
*/

class Tabs {
  
  public $key = 'wready_product_tab_data_keys'; 
  
  public function register(){
    
    add_filter('woocommerce_product_tabs',[$this,'store_tabs_key'],99);
  }

  public function store_tabs_key($tabs){
 
    $items = [];
   
    foreach($tabs as $key => $val){
        $items[$key] = sanitize_text_field($val['title']);
    } 
    
    if(!empty($items)){
        update_option( $this->key ,$items );
    }
    
    return $tabs;
  }

}
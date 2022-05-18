<?php
namespace Shop_Ready\extension\elefinder\category;

/**
* WooCommerece Dashboard Finder From Elementor Editor
* @see https://developers.elementor.com/elementor-finder/
* @since 1.0  
*/

Class Dashboard{

    public function register(){
        
        add_action('elementor/finder/categories/init',[ $this,'add_links' ],12);
        
    }

    public function add_links($categories_manager){
        
        $categories_manager->add_category( 'wp-settings', new WR_Settings_Finder_Category() );
        
    }
 

}

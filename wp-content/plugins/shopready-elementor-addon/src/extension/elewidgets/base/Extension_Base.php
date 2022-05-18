<?php

namespace Shop_Ready\extension\elewidgets\base;

use Shop_Ready\base\elementor\Boot as Shop_Ready_Boot;
use Shop_Ready\base\elementor\query\Controls\Product_Taxonomy;
use Shop_Ready\base\elementor\query\Controls\Sort_Controls;
use Shop_Ready\base\elementor\query\Controls\Generel_Controls;
use Shop_Ready\base\elementor\query\Controls\Date_Filter_Controls;
use Shop_Ready\base\elementor\query\Controls\Data_Exclude_Controls;
use Shop_Ready\base\elementor\query\Controls\Slider_Controls;
use Shop_Ready\extension\elewidgets\document\Login_Redirect;
use Shop_Ready\extension\elewidgets\deps\checkout\Order_Review;
use Shop_Ready\extension\elewidgets\deps\checkout\Mini_Cart;

use Shop_Ready\extension\elewidgets\deps\product\Variable_Product as Variable_Product;
use Shop_Ready\extension\elewidgets\deps\product\Ajax_Service as Product_AJAX;
use Shop_Ready\extension\elewidgets\deps\product\Tabs as Product_Tabs;
use Shop_Ready\extension\elewidgets\deps\product\Slider as Product_Slider;
use Shop_Ready\extension\elewidgets\deps\product\Comming_Soon;
use Shop_Ready\extension\elewidgets\deps\product\Product_Vendor;
use Shop_Ready\extension\elewidgets\deps\filter\Grid as Product_Filter;

use Shop_Ready\extension\elewidgets\base\Widgets_Settings as Widgets_Settings;

/**
* @since 1.0
* Elementor Extension Boot Base
*/
Abstract Class Extension_Base extends Shop_Ready_Boot{
   

    /****************************
	 * 	INIT WIDGETS
	 ****************************/
	public function init_widgets() {
		$this->_widgets();
	}

	public static function get_query(){

		return [
			Product_Taxonomy::class,
			Sort_Controls::class,
			Generel_Controls::class,
			Date_Filter_Controls::class,
			Data_Exclude_Controls::class,
			Slider_Controls::class,
			
		];
	}

	public static function get_base(){

		return [
			Widgets_Settings::class,	
		];
	}

	public static function get_defs(){

		return [
			
			Order_Review::class,
			Mini_Cart::class,
			Product_AJAX::class,
			Product_Tabs::class,
			Variable_Product::class,
			Product_Slider::class,
			Comming_Soon::class,
			Product_Vendor::class,
			Product_Filter::class,
			
		];
	}

	/** 
	* Elementor Editor Page | Site Document Settings
	* https://developers.elementor.com/elementor-document-settings/
	* @return array class
	*/
	public static function document(){
        
		$settings = [];
        
		// register site setting panel
		if( class_exists( '\Shop_Ready\extension\elewidgets\document\Settings_Tabs' ) ){

			$settings[] = '\Shop_Ready\extension\elewidgets\document\Settings_Tabs';
		}
        
		// login register widgets  
		if( class_exists( '\Shop_Ready\extension\elewidgets\document\Login_Redirect' ) ){
			
			$settings[] = '\Shop_Ready\extension\elewidgets\document\Login_Redirect';
		}
		
		// Payment Module
		if( class_exists( '\Shop_Ready\extension\elewidgets\document\Payment_Hooks' ) ){
			
			$settings[] = '\Shop_Ready\extension\elewidgets\document\Payment_Hooks';
		}
		
		// Checkout Module
		if( class_exists( '\Shop_Ready\extension\elewidgets\document\Checkout_Hook' ) ){
			
			$settings[] = '\Shop_Ready\extension\elewidgets\document\Checkout_Hook';
		}
		
		// post type meta settings
		if( class_exists( '\Shop_Ready\extension\elewidgets\document\Page_Settings' ) ){
			
			$settings[] = '\Shop_Ready\extension\elewidgets\document\Page_Settings';
		}
		
		return $settings;
	}

    
   /****************************
	 * 	Register Widgets
	 ****************************/
	public function _widgets(){

     	/*
		** Autoload Widget class
		** 
		*/
	    
        $modules  = shop_ready_widgets_class_dir_list( SHOP_READY_DIR_PATH.'src/extension/elewidgets/widgets' );
	   
		 if( is_array( $modules ) ){
			
		// 	// Register Widgets
			foreach($modules as $module=> $item){
				
				if( is_array( $item )){
                  
                   foreach($item as $widget_file){
                   
                     $cls = '\Shop_Ready\extension\elewidgets\widgets\\'.$module.'\\'.$widget_file;
					
                   	 if( class_exists( $cls ) && get_parent_class($cls) == 'Shop_Ready\extension\elewidgets\Widget_Base' ):
					 	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $cls() );
                     endif;
                       
                   }
                }
				
				
				
			}
		}
        
	  
	}

    /****************************
	 * 	Register Widgets Modules
	 ****************************/
	public function widget_modules(){

		include( dirname(__FILE__) . '/inc/dashboard/controls/active.php' );
	    $widgets_dir     = shop_ready_widgets_class_dir_list();
	    	   
	    $widgets_modules = shop_ready_components_permission($widgets_dir);
		
		foreach($widgets_modules as $path => $value){

			$widget_path = SHOP_READY_DIR_PATH."/inc/Widgets/".$path;
			$widgets     = shop_ready_widgets_class_dir_list($widget_path);
		   
			if( is_array($widgets) ){

				// Register Widgets
				foreach($widgets as $widget_cls){
				   
					if(in_array($widget_cls,$return_active) ){
						$cls = '\Shop_Ready\extension\elewidgets\widgets'.'\\'.$path.'\\'.$widget_cls;
					   
						if(class_exists($cls)):
							\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $cls() );
						endif;

					}elseif(did_action('element_ready_pro_init')){
						
						$pro_cls = '\Shop_Ready\extension\elewidgets\widgets'.'\\'.$path.'\\'.$widget_cls;
						
						if(class_exists($pro_cls)):
							\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $pro_cls() );
						endif;	
						
					}
				
				}

			}
		}
		
	}


    /*******************************
	 * 	ADD CUSTOM CATEGORY
	 *******************************/
	public function add_elementor_category()
	{

		
		$category_list = shop_ready_elementor_meta_config()->all();
		$categories    = $category_list['categories'];
          
		if( is_array( $categories ) ) {
			
			foreach( $categories as $slug => $item ){
				
				\Elementor\Plugin::instance()->elements_manager->add_category( $slug , array(
					'title' => $item['name'],
					'icon'  => isset($item['name']) ? $item['name']: 'fa fa-shopping-cart',
				), 1 );
	
			} 

		}
		
	}
    

 
}
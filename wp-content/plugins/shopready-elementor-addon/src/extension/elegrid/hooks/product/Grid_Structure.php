<?php
namespace Shop_Ready\extension\elegrid\hooks\product;
use Shop_Ready\helpers\classes\Elementor_Helper as WReady_Helper;
/**
* WooCommerece Archive Default Grid Style
* Preset One
* @since 1.0  
*/

Class Grid_Structure{

    public $meta_key = 'wready_swatch_color';
    public $style    = 'classic';
    public function register(){

        $grid_style = get_option('wooready_products_archive_shop_grid_style','wc');
       
        if($grid_style != $this->style){
          return;  
        }
       
        remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 ); 
        remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 ); 
        add_action( 'woocommerce_before_shop_loop_item', [$this,'woocommerce_template_loop_product_wrapper_open'], 10 ); 
        
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 ); 
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 ); 
        add_action( 'woocommerce_after_shop_loop_item', [$this,'woocommerce_template_loop_product_tag_close'], 5 ); 
        add_action( 'woocommerce_after_shop_loop_item', [$this,'loop_add_to_cart'], 5 ); 
        
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 ); 
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 ); 
        add_action( 'woocommerce_before_shop_loop_item_title', [$this,'thumnnail'], 10 ); 

        remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 ); 
        add_action( 'woocommerce_shop_loop_item_title', [$this,'loop_product_title'], 10); 
        
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 ); 
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); 
        add_action( 'woocommerce_after_shop_loop_item_title', [$this,'loop_price'], 10); 
        add_action( 'woocommerce_after_shop_loop_item_title', [$this,'variation_color_price'], 11); 
        add_action( 'woocommerce_after_shop_loop_item_title', [$this,'loop_rating'], 5); 
        
    }
 
	function loop_add_to_cart( $args = array() ) {

		global $product;

		if ( $product ) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'button',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button ajax_add_to_cart ' : '',
							$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'rel'              => 'nofollow',
				),
			);

			$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

			if ( isset( $args['attributes']['aria-label'] ) ) {
				$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
			}
            echo sprintf('<div class="wready-product-loop-cart-btn-wrapper display:flex flex-direction:column justify-content:left align-items:left">');
			    wc_get_template( 'loop/add-to-cart.php', $args );
            echo '</div>';
		}
	}

    function loop_price() {
        
        echo sprintf('<div class="wready-product-loop-price-wrapper">');
		    wc_get_template( 'loop/price.php' );
        echo '</div>';

     
	}
    
    function variation_color_price() {
        global $product;
        if(!$product->is_type('variable')){
           return;
        }
         $attributes           = $product->get_variation_attributes();
         $selected_attributes  = $product->get_default_attributes();
         
        foreach ( $attributes as $attribute_name => $options ){

            $attributes_id_arr      = wp_list_pluck( wc_get_attribute_taxonomies(), 'attribute_id', 'attribute_name' ) ;
            $remove_suffix          = preg_replace('/^pa_/', '', $attribute_name);
            $woo_ready_color_id     = isset( $attributes_id_arr[ $remove_suffix ] ) ? $attributes_id_arr[ $remove_suffix ] : null;
            $attribute_wrea         = get_option('woo_ready_product_attributes') ? get_option('woo_ready_product_attributes') : array();
            $woo_ready_display_type = sanitize_text_field(isset($_POST['woo_ready_display_type']) ? $_POST['woo_ready_display_type'] : (isset($attribute_wrea[$woo_ready_color_id]) ? $attribute_wrea[$woo_ready_color_id] : ''));
            $name                   = 'attribute_'.sanitize_title($attribute_name);

            if($woo_ready_display_type == 'variation_color'){
                echo wp_kses_post(sprintf('<a href="%s" class="wready-product-loop-color-wrapper display:flex gap:10 align-items:center %s">', esc_url(get_permalink($product->get_id())) , esc_attr($product->get_type())));
                if(!empty($options)) {

                    if($product && taxonomy_exists($attribute_name)) {
              
                      $terms = wc_get_product_terms($product->get_id(), $attribute_name, array(
                        'fields' => 'all',
                      ));
                      
                      foreach($terms as $term) {
                      
                         $cls = $woo_ready_display_type=='variation_color'?' border-radius:100%':'';
                         $color = "background-color:".get_term_meta($term->term_id, $attribute_name  . '_' . $this->meta_key . '_color',true);
                       
                         if(in_array($term->slug, $options)) {
                           
                           $id = $name.'-'.$term->slug;
                           if($woo_ready_display_type=='variation_color'){
                            echo wp_kses_post('<label class="'.esc_attr($cls).'" style="'.wp_kses_post($color).'" for="'.sanitize_key($id).'">'.'</label>');
                           }else{
                            echo wp_kses_post('<label class="'.esc_attr($cls).'" for="'.sanitize_key($id).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $term->name,$woo_ready_display_type)).'</label>');
                           }
                           
                         }
              
                      }// end forach

                    } 
              
                  }
                echo '</a>';
            }
        }

	}

    function loop_rating() {
        echo sprintf('<div class="wready-product-loop-rating-wrapper">');
		    wc_get_template( 'loop/rating.php' );
        echo '</div>';
	}

    function loop_product_title() {
        global $product;
        $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
        
        echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'wready-loop-product__title' ) ) . '">';
            echo '<a href="' . esc_url( $link ) . '" class="wready-product-loop-title-link">';  
                echo get_the_title(); 
            echo '</a>';
        echo '</h2>'; 
	}

     /**
     * wrapper_open    
     * @return void
     */
    public function woocommerce_template_loop_product_wrapper_open( ){}
    
     /**
      * Wrapper Close
      * 
      */
    public function woocommerce_template_loop_product_tag_close(){ }
    
    public function thumnnail(){
        global $product;
        if ( $product ) {
        echo sprintf('<div class="wready-thumbnail-wrapper position:relative">');
            $this->loop_sale_flash();
            $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
            echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
                echo woocommerce_get_product_thumbnail();
            echo '</a>';
            echo "<ul class='position-absolute-center wready-product-loop-extra left:50 display:flex gap:10'>";
                do_action('shop_ready_loop_product_thumb_inner');
            echo '</ul>';
        echo '</div>';
        }
    }
    function loop_sale_flash() {

        if(!shop_ready_sysytem_module_options_is_active('product_badge')){
            return;
        }
        global $product;
        if($product->is_on_sale()){
            wc_get_template( 'loop/sale-flash.php' );
        }
		
	}
 

}

<?php

namespace Shop_Ready\extension\elewidgets\deps\product;
use Shop_Ready\helpers\classes\Elementor_Helper as WReady_Helper;
/** 
* @since 1.0 
* WooCommerce Product related 
* 
* @author quomodosoft.com 
*/

class Ajax_Service {
     
    public function register(){
    
      add_filter( 'woocommerce_add_to_cart_fragments', [$this,'woocommerce_header_add_to_cart_fragment'] );
      add_filter( 'woocommerce_add_to_cart_fragments', [$this,'add_to_cart_fragment_link'] );
      add_filter( 'woocommerce_add_to_cart_fragments', [$this,'cart_total_update'] );

    }
    
    function add_to_cart_fragment_link($fragments){
      
      global $woocommerce;
      $count_icon = esc_html( WReady_Helper::get_global_setting('woo_ready_widget_cart_count_icon') );
      $cart_label = esc_html( WReady_Helper::get_global_setting('woo_ready_widget_cart_label') );
      $singular   = esc_html( WReady_Helper::get_global_setting('woo_ready_widget_cart_count_singular'));
      $plural     = esc_html( WReady_Helper::get_global_setting('woo_ready_widget_cart_count_plural') );
      $before_text = esc_html( WReady_Helper::get_global_setting('woo_ready_widget_cart_number_before_text') );
      ob_start();
    
      ?>
          <a class="woo-ready-user-interface woo-ready-cart-fr" href="<?php echo wc_get_cart_url(); ?>">
                <?php echo shop_ready_render_icons( $count_icon,'wready-cart-count' ); ?>
                <?php if($before_text == 'yes'): ?>
                    <?php if(isset(WC()->cart)){ ?>
                        <span class="wready-cart-count-before cart-count-sr-modifire"> <?php echo WC()->cart->get_cart_contents_count()>1?sprintf('%s %s',esc_html(WC()->cart->get_cart_contents_count()),esc_html($plural)):sprintf('%s %s',WC()->cart->get_cart_contents_count(),$singular); ?> </span>
                    <?php } ?>
                <?php endif; ?>
                <?php if($cart_label !=''): ?>
                  <div class="display:inline-block wready-cart-count-text shop-ready-cart-count-text-modifire"> <?php echo esc_html($cart_label); ?> </div> 
                <?php endif; ?>
                <?php if($before_text != 'yes'): ?>
                        <?php if(isset(WC()->cart)){ ?>
                            <span class="wready-cart-count-before cart-count-sr-modifire"> <?php echo WC()->cart->get_cart_contents_count()>1?sprintf('%s %s',WC()->cart->get_cart_contents_count(),$plural):sprintf('%s %s',WC()->cart->get_cart_contents_count(),$singular); ?> </span>
                        <?php } ?>
                <?php endif; ?>
          </a>
      <?php
      $fragments['a.woo-ready-cart-fr'] = ob_get_clean();
      ob_start();

      ?>
       <div class="wr-tax-amount"> <?php wc_cart_totals_taxes_total_html(); ?> </div>
      <?php
      $fragments['div.wr-tax-amount'] = ob_get_clean();
      return $fragments;
    
    }

    public function cart_total_update($fragments){
      ob_start();
      ?>
       <div class="wr-checkout-cart-total-bill"> <?php wc_cart_totals_order_total_html(); ?> </div>
      <?php
      $fragments['div.wr-checkout-cart-total-bill'] = ob_get_clean();
      return $fragments;
    }

    function woocommerce_header_add_to_cart_fragment( $fragments ) {
      global $woocommerce;

      $count_icon = wp_kses_post(WReady_Helper::get_global_setting('woo_ready_widget_cart_count_icon'));
      $cart_label = esc_html(WReady_Helper::get_global_setting('woo_ready_widget_cart_label'));
      $singular   = esc_html(WReady_Helper::get_global_setting('woo_ready_widget_cart_count_singular'));
      $plural     = esc_html(WReady_Helper::get_global_setting('woo_ready_widget_cart_count_plural'));
      $before_text = esc_html(WReady_Helper::get_global_setting('woo_ready_widget_cart_number_before_text'));
      ob_start();
    
      ?>
        <div class="woo-ready-user-interface woo-ready-cart-popup">
              <?php echo shop_ready_render_icons( $count_icon,'wready-cart-count' ); ?>
              <?php if($before_text == 'yes'): ?>
                      <?php if(isset(WC()->cart)){ ?>
                          <span class="wready-cart-count-before cart-count-sr-modifire"> <?php echo wp_kses_post(WC()->cart->get_cart_contents_count()>1?sprintf('%s %s',WC()->cart->get_cart_contents_count(),$plural):sprintf('%s %s',WC()->cart->get_cart_contents_count(),$singular)); ?> </span>
                      <?php } ?>
              <?php endif; ?>
              <?php if($cart_label !=''): ?>
                <div class="display:inline-block wready-cart-count-text shop-ready-cart-count-text-modifire"> <?php echo esc_html($cart_label); ?> </div> 
              <?php endif; ?>
              <?php if($before_text != 'yes'): ?>
                      <?php if(isset(WC()->cart)){ ?>
                          <span class="wready-cart-count-after cart-count-sr-modifire"> <?php echo wp_kses_post(WC()->cart->get_cart_contents_count()>1?sprintf('%s %s',WC()->cart->get_cart_contents_count(),$plural):sprintf('%s %s',WC()->cart->get_cart_contents_count(),$singular)); ?> </span>
                      <?php } ?>
              <?php endif; ?>
            
          </div>
      <?php
      $fragments['div.woo-ready-cart-popup'] = ob_get_clean();

      ob_start();
      ?>

      <div class="wr-tax-amount"> <?php wc_cart_totals_taxes_total_html(); ?> </div>

      <?php
      $fragments['div.wr-tax-amount'] = ob_get_clean();
      return $fragments;
    }

    /**
     * sanitize text input
     * @param string
     **/  
    public function senitize($input){

       $ids = [];
       $old_ids = json_decode($input);

       foreach($old_ids as $id){
        $ids[] = sanitize_text_field($id); 
       }

       return $ids;
       
    }
   
    public function get_products($ids){
      
      $return_list      = [];
      $add_to_cart_text = WReady_Helper::get_global_setting('woo_ready_product_wishlist_add_to_cart_text','add to cart');

      foreach($ids as $key => $id){
        
        $cart_id       = '';
        $product       = wc_get_product( $id );
      
        if($product->is_type('simple')){
          $cart_id = sprintf('<a href="?add-to-cart=%s" data-quantity="1" class="button %s add_to_cart_button ajax_add_to_cart woo-ready-wishlist-cart-btn" data-product_id="%s">%s</a>',esc_attr($product->get_id()),esc_attr($product->get_type()),esc_attr($product->get_id()),esc_html($add_to_cart_text));   
        }else{
          $cart_id = sprintf('<a href="%s" class="button %s woo-ready-wishlist-cart-btn " data-product_id="%s">%s</a>',esc_url(get_permalink( $product->get_id() )), esc_attr($product->get_type()), esc_attr($product->get_id()), esc_html($add_to_cart_text));   
        }
       
        $return_list[] = [
          'id'           => $id,
          'title'        => sprintf('<a href="%s" class="%s woo-ready-wishlist-pro-title" >%s</a>', esc_url(get_permalink( $product->get_id() )), esc_attr($product->get_type()), esc_html($product->get_name())),
          'featured'     => $product->get_featured()?esc_html__('Featured','shopready-elementor-addon'):'',
          'sdesc'        => $product->get_short_description(),
          'link'         => esc_url(get_permalink( $product->get_id() )),
          'price'        => $product->get_price_html(),
          'stock'        => $product->get_stock_quantity(),
          'stock_status' => $product->get_stock_status(),
          'sku'          => $product->get_sku(),
          'dweight'      => $product->get_weight(),
          'dlength'      => $product->get_length(),
          'dwidth'       => $product->get_width(),
          'dheight'      => $product->get_height(),
          'dimensions'   => $product->get_dimensions(false),
          'image'        => sprintf('<img class="%s woo-ready-wishlist-image sr-wish-table" src="%s" />', esc_attr($product->get_type()), shop_ready_resize(get_the_post_thumbnail_url($product->get_id()),100,100)),
          'review'       => $product->get_average_rating(),
          'cart'         => $cart_id
        ];

        if($key == 2){
          break;
        }

      }

      return $return_list;
    } 
    
}
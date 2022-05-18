<?php

namespace Shop_Ready\extension\elewidgets\deps\product;
use Shop_Ready\base\Module;
/** 
* 
* WooCommerce Product Variable
* Add Color field To Attr option
* @since 1.0 
* @author quomodosoft.com 
*/

class Variable_Product {
     
  use Module;
	public static $ext_name = 'color_swatch';
  public $taxonomy = null;
  public $meta_key = 'wready_swatch_color';

  public function register(){

    if(self::sr_module_live()){

      add_action( 'created_term' , array( $this, '_field_save' ), 10, 3 );
      add_action( 'edit_term' , array( $this, '_field_save' ), 10, 3 );
      add_action( 'admin_init' , array( $this, 'on_admin_init' ) );
      add_action( 'woocommerce_attribute_updated' , array( $this , 'on_woocommerce_attribute_updated' ), 10, 2);
      add_filter( 'woocommerce_dropdown_variation_attribute_options_html', [ $this , 'variation_radio_buttons' ], 20, 2);
      add_action( 'woocommerce_before_edit_attribute_fields' , [ $this , 'edit_attribute_fields' ], 20, 0);
      add_filter( 'woocommerce_variation_option_name', [ $this , 'woocommerce_variation_option_name' ], 20, 2);

    }
  }

  public function woocommerce_variation_option_name($name,$color_active){

    if( $color_active == 'variation_color' ){
        return '';
    }   

    return $name;
  }

  public function on_woocommerce_attribute_updated($attribute_id,$attribute){
        
        $product_attribute = get_option('woo_ready_product_attributes') ? get_option('woo_ready_product_attributes') : array();
        //sanitize
        $product_attribute[$attribute_id]     = stripslashes( sanitize_text_field($_POST['woo_ready_display_type']) );
        update_option('woo_ready_product_attributes', wc_clean($product_attribute));
        return;
  }

  function edit_attribute_fields() {
    
    $attribute_id           = absint( sanitize_text_field($_GET['edit']) );
    $attribute_wrea         = get_option('woo_ready_product_attributes') ? get_option('woo_ready_product_attributes') : array();
    $woo_ready_display_type = sanitize_text_field(isset($_POST['woo_ready_display_type']) ? $_POST['woo_ready_display_type'] : (isset($attribute_wrea[$attribute_id]) ? $attribute_wrea[$attribute_id] : ''));

    ?>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="display"><?php echo esc_html__('Display Type', 'shopready-elementor-addon'); ?></label>
        </th>
        <td>
            <select  name="woo_ready_display_type">
                <option value="select"><?php echo esc_html__('Select','shopready-elementor-addon') ?></option>
                <option <?php echo esc_attr($woo_ready_display_type=='variation_color'?'selected':''); ?> value="variation_color"><?php echo esc_html__('Variation Color','shopready-elementor-addon'); ?></option>
                <option <?php echo esc_attr($woo_ready_display_type=='variation_radio'?'selected':''); ?> value="variation_radio"><?php echo esc_html__('Variation Radio','shopready-elementor-addon'); ?></option>
            </select>
        </td>
    </tr>
    <?php
}

  function variation_radio_buttons($html, $args) {
   
    $woo_ready_display_type = isset($args['wready_select'])?$args['wready_select']:'';
    if(!in_array($woo_ready_display_type,['variation_color','variation_radio'])){
      return $html;       
    }
   
    $args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), array(
      'options'          => false,
      'attribute'        => false,
      'product'          => false,
      'selected'         => false,
      'name'             => '',
      'id'               => '',
      'class'            => '',
      'show_option_none' => esc_html__('Choose an option', 'shopready-elementor-addon'),
    ));
  
    if(false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {

      $selected_key     = 'attribute_'.sanitize_title($args['attribute']);
      $args['selected'] = sanitize_text_field( isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']) );
    
    }
   
    $options               = $args['options'];
    $product               = $args['product'];
    $attribute             = $args['attribute'];
    $name                  = $args['name'] ? $args['name'] : 'attribute_'.sanitize_title($attribute);
  
    $id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
    $class                 = $args['class'];
    $show_option_none      = (bool)$args['show_option_none'];
    $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'shopready-elementor-addon');
    
    if(empty($options) && !empty($product) && !empty($attribute)) {
      $attributes = $product->get_variation_attributes();
      $options    = $attributes[$attribute];
    }
   
    $radios = '<div class="variation-radios woo-ready-radio-button hide-select display:flex gap:10 align-items:center">';
  
    if(!empty($options)) {

      if($product && taxonomy_exists($attribute)) {

        $terms = wc_get_product_terms($product->get_id(), $attribute, array(
          'fields' => 'all',
        ));
      
        foreach($terms as $term) {
        
          $cls = $woo_ready_display_type=='variation_color'?'  border-radius:100%':'';
          $color = "background-color:".get_term_meta($term->term_id, $attribute  . '_' . $this->meta_key . '_color',true);
          if(in_array($term->slug, $options, true)) {
            $id = $name.'-'.$term->slug;
            if($woo_ready_display_type=='variation_color'){
              $radios .= '<div class="wready-attr-wrapper"> <input type="radio" id="'.esc_attr($id).'" name="'.esc_attr($name).'" value="'.esc_attr($term->slug).'" '.checked(sanitize_title($args['selected']), $term->slug, false).'><label class="'.$cls.'" style="'.$color.'" for="'.esc_attr($id).'">'.'</label></div> ';
            }else{
              $radios .= '<div class="wready-attr-wrapper"> <input type="radio" id="'.esc_attr($id).'" name="'.esc_attr($name).'" value="'.esc_attr($term->slug).'" '.checked(sanitize_title($args['selected']), $term->slug, false).'><label class="'.$cls.'" for="'.esc_attr($id).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $term->name,$woo_ready_display_type)).'</label></div> ';
            }
            
          }

        }
      } else {
        foreach($options as $option) {
          $cls = $woo_ready_display_type=='variation_color'?' border-radius:100%':'';
          $color = '#e1e1e1';  
          $id = $name.'-'.$option;
          $checked    = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'], sanitize_title($option), false) : checked($args['selected'], $option, false);
          if($woo_ready_display_type=='variation_color'){
            $radios    .= '<div class="wready-attr-wrapper"><input type="radio" id="'.esc_attr($id).'" name="'.esc_attr($name).'" value="'.esc_attr($option).'" id="'.sanitize_title($option).'" '.$checked.'>
            <label class="'.$cls.'" style="background-color:"'.$color.'" for="'.esc_attr($id).'">'.'</label> </div>';
          }else{
            $radios    .= '<div class="wready-attr-wrapper"><input type="radio" id="'.esc_attr($id).'" name="'.esc_attr($name).'" value="'.esc_attr($option).'" id="'.sanitize_title($option).'" '.$checked.'>
            <label class="'.$cls.'" style="background-color:"'.$color.'" for="'.esc_attr($id).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $option,$woo_ready_display_type)).'</label> </div>';
          }
         
        }
      }

    }
  
    $radios .= '</div>';
      
    return $html.$radios;
  }

  public function _field_save( $term_id, $tt_id, $taxonomy ) {
  
    if ( isset( $_POST[ 'product_attribute_meta' ] ) ) {
        // sanitize in  array_map method
      
        $metas = array_map( 'sanitize_text_field', $_POST[ 'product_attribute_meta' ] );
        if ( isset( $metas[ $this->meta_key ] ) ) {

          $data = $metas[ $this->meta_key ];
          $color =  isset( $data[ 'color' ] ) ? $data[ 'color' ] : '';
          update_term_meta( $term_id , $taxonomy . '_' . $this->meta_key . '_color' , sanitize_text_field($color) );
         
        }
    }
  } 

  

  public function on_admin_init(){
    
    if( !isset($_REQUEST['post_type'] )){
      return; 
    }

    if( $_REQUEST['post_type']!='product' ){
        return;
    }

    if (isset($_REQUEST['taxonomy'])){
        $this->taxonomy = sanitize_text_field( $_REQUEST[ 'taxonomy' ] );
    }

    $attribute_taxonomies = wc_get_attribute_taxonomies();

 
    if ( $attribute_taxonomies ) {
         foreach ( $attribute_taxonomies as $tax ) {
   
            add_action( 'pa_' . $tax->attribute_name . '_add_form_fields', array($this, 'add_attribute_color_field') );
            add_action( 'pa_' . $tax->attribute_name . '_edit_form_fields', array($this, 'color_sw_field'), 10, 2 );

            add_filter( 'manage_edit-pa_' . $tax->attribute_name . '_columns', array($this, 'product_attribute_color_columns') );
            add_filter( 'manage_pa_' . $tax->attribute_name . '_custom_column', array($this, 'product_attribute_column_val'), 10, 3 );
         }
    }
        
  }

  public function product_attribute_color_columns( $columns ) {

         if(isset($columns['cb'])){
            $new_columns = array();
            $new_columns['cb'] = $columns['cb'];
            $new_columns[$this->meta_key] = __( 'Color', 'shopready-elementor-addon' );
            unset( $columns['cb'] );
            $columns = array_merge( $new_columns, $columns );
         }
      
        return $columns;
  }
  /**
   * Attribute Column
   * @since 1.0
   */
  public function product_attribute_column_val( $columns, $column, $term_id ) {
   
        if ( $column == $this->meta_key ) :
            $value =  get_term_meta($term_id, $this->taxonomy . '_' . $this->meta_key . '_color',true);
            $columns .= "<input disabled type='color' value='$value' />";
        endif;
        return $columns;
  }
  /**
   * Show In Create field
   * @since 1.0
   */
  public function add_attribute_color_field(){
    
     ?>
     
        <div class="form-field">
              <label for="product_attribute_swatchtype_<?php echo esc_attr($this->meta_key); ?>"><?php echo esc_html__('Color','shopready-elementor-addon'); ?></label>
              <input type="color" name="product_attribute_meta[<?php echo esc_attr($this->meta_key); ?>][color]" id="product_attribute_swatchtype_<?php echo esc_attr($this->meta_key); ?>" value="">
        </div>

     <?php
  } 
  /**
   * Edit Color Field
   * @since 1.0
   */
  public function color_sw_field( $term, $taxonomy ){

      $value = get_term_meta($term->term_id, $term->taxonomy . '_' . $this->meta_key . '_color',true);
     
     ?>
        <table class="form-table"> 
          <tr class="form-field ">
              <th> <label for="product_attribute_swatchtype_<?php echo esc_attr($this->meta_key); ?>"><?php echo esc_html__('Color','shopready-elementor-addon'); ?></label> </th>
          <td> <input type="color" name="product_attribute_meta[<?php echo esc_attr($this->meta_key); ?>][color]" id="product_attribute_swatchtype_<?php echo esc_attr($this->meta_key); ?>" value="<?php echo esc_attr($value); ?>"> </td>
          </tr>
        </table>

     <?php
  }

}
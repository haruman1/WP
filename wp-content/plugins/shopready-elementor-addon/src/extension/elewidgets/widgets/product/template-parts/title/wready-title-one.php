<?php 

/**
 * Product Title Default layouts
 * @since 1.0
 * @author quomodosoft.com
 * shop_ready_is_elementor_mode()
 */
       
		
        $tag  = $settings['title_tag'];
        $id = get_the_id();
        
        if(shop_ready_is_elementor_mode()){

            if($settings['wready_product_id'] !=''){
                $id = $settings['wready_product_id'];
            }
            
        }
		global $product;
        $product_instance = is_null($product)? wc_get_product($id): $product;
		
		if(!is_object($product)){
			return;
	    }
		/*Icon Animation*/
		if ( $settings['icon_hover_animation'] ) {
			$icon_animation = 'elementor-animation-' . $settings['icon_hover_animation'];
		}else{
			$icon_animation = '';
		}

		/*Icon Condition*/
		if ( 'yes' == $settings['show_icon'] ) {
			if ( 'font_icon' == $settings['icon_type'] && !empty( $settings['font_icon'] ) ) {
				$icon = '<div class="area__icon '. esc_attr( $icon_animation ) .'">'.shop_ready_render_icons( $settings['font_icon'] ).'</div>';
			}elseif( 'image_icon' == $settings['icon_type'] && !empty( $settings['image_icon'] ) ){
				$icon_array = $settings['image_icon'];
				$icon_link  = wp_get_attachment_image_url( $icon_array['id'], 'thumbnail' );
				$icon       = '<div class="area__icon '. esc_attr( $icon_animation ) .'"><img src="'. esc_url( $icon_link ) .'" alt="" /></div>';
			}
		}else{
			$icon = '';
		}

		/*Title Background Text*/
		if ( !empty($settings['title_bg_text']) ) {
			$title_bg_text = '<div class="title__bg__text">'.esc_html( $settings['title_bg_text'] ).'</div>';
		}else{
			$title_bg_text = '';
		}


		/*Title Tag*/
		if ( !empty( $settings['title_tag'] ) ) {
			$title_tag = $settings['title_tag'];
		}else{
			$title_tag = 'h3';
		}

		/*Title*/
		if ($product_instance && method_exists( $product_instance,'get_name' ) ) {
			$title = '<'.$title_tag.' class="area__title">'. $product_instance->get_name().'</'.$title_tag.'>';
		}else{
			$title = '';
		}

		/*Subtitle*/
		if ( !empty( $settings['subtitle'] ) ) {
			$subtitle = '<div class="area__subtitle">'.esc_html( $settings['subtitle'] ).'</div>';
		}else{
			$subtitle = '';
		}

		/*Description*/
		if ( $settings['description'] == 'yes' && $product_instance && method_exists( $product_instance,'get_short_description' ) ) {
			$description = '<div class="area__description">'.wpautop( wp_trim_words( $product_instance->get_short_description(), $settings['description_limit'], '' )  ).'</div>';
		}else{
			$description = '';
		}
		
		/*Title Condition*/
		if ( 'before_title' == $settings['subtitle_position'] ) {
			$title_subtitle = $subtitle . $title;
		}elseif( 'after_title' == $settings['subtitle_position'] ){
			$title_subtitle = $title . $subtitle;
		}elseif( empty($settings['subtitle']) ){
			$title_subtitle = $title . $subtitle;
		}

		echo '<div class="area__content">'; ?>
			<?php if ( 'yes' == $settings['show_bg_icon'] ) :  ?>
				<?php if ( 'font_icon' == $settings['bg_icon_type'] && !empty($settings['bg_font_or_svg']) ) : ?>
					<div class="title__bg__icon"><?php echo shop_ready_render_icons( $settings['bg_font_or_svg'] ); ?></div>
				<?php elseif ( 'image_icon' == $settings['bg_icon_type'] && !empty($settings['bg_image_icon']) ) : ?>
					<?php
						$icon_array = $settings['bg_image_icon'];
						$icon_link  = wp_get_attachment_image_url( $icon_array['id'], 'thumbnail' );
						echo wp_kses_post('<div class="title__bg__icon"><img src="'. esc_url( $icon_link ) .'" alt="" /></div>'); 
					?>
				<?php endif; ?>
			<?php endif;
			echo wp_kses_post(''.( isset( $title_bg_text ) ? $title_bg_text : '' ).'
				'.( isset( $icon ) ? $icon : '' ).'
				'.( isset( $title_subtitle ) ? $title_subtitle : '' ).'
				'.( isset( $description ) ? $description : '' ).'
				'.( isset( $button ) ? $button : '' ).'');
		echo '</div>';
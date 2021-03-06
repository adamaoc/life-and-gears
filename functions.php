<?php

// Add RSS links to <head> section
// automatic_feed_links();

if (function_exists( 'add_theme_support' )) { 
    add_theme_support('automatic-feed-links');
	add_theme_support( 'post-thumbnails' ); 
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function ampnetmedia_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// limit excerpt //

function limit_words($string, $word_limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $word_limit));
}        

// featured images size ---
add_image_size( 'category-thumb', 400, 9999 ); //400 pixels wide (and unlimited height)


// registering menus
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'our-friends' => __( 'Our Friends' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

add_filter('show_admin_bar', '__return_false');


remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'gallery_shortcode_custom');

function gallery_shortcode_custom($attr) {
	global $post, $wp_locale;

	static $instance = 0;
	$instance++;
	
	        if ( ! empty( $attr['ids'] ) ) {
	                // 'ids' is explicitly ordered, unless you specify otherwise.
	                if ( empty( $attr['orderby'] ) )
	                        $attr['orderby'] = 'post__in';
	                $attr['include'] = $attr['ids'];
	        }
	
	        // Allow plugins/themes to override the default gallery template.
	        // $output = apply_filters('post_gallery', '', $attr);
	        // if ( $output != '' )
	        //         return $output;
	
	        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	        if ( isset( $attr['orderby'] ) ) {
	                $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
	                if ( !$attr['orderby'] )
	                        unset( $attr['orderby'] );
	        }
	
	        extract(shortcode_atts(array(
	                'order'      => 'ASC',
	                'orderby'    => 'menu_order ID',
	                'id'         => $post->ID,
	                'itemtag'    => 'dl',
	                'icontag'    => 'dt',
	                'captiontag' => 'dd',
	                'columns'    => 5,
	                'size'       => 'thumbnail',
	                'include'    => '',
	                'exclude'    => ''
	        ), $attr));
	
	        $id = intval($id);
	        if ( 'RAND' == $order )
	                $orderby = 'none';
	
	        if ( !empty($include) ) {
	                $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
	                $attachments = array();
	                foreach ( $_attachments as $key => $val ) {
	                        $attachments[$val->ID] = $_attachments[$key];
	                }
	        } elseif ( !empty($exclude) ) {
	                $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	        } else {
	                $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	        }
	
	        if ( empty($attachments) )
	                return '';
	
	        if ( is_feed() ) {
	                $output = "\n";
	                foreach ( $attachments as $att_id => $attachment )
	                        $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
	                return $output;
	        }
	
	        $itemtag = tag_escape($itemtag);
	        $captiontag = tag_escape($captiontag);
	        $icontag = tag_escape($icontag);
	        $valid_tags = wp_kses_allowed_html( 'post' );
	        if ( ! isset( $valid_tags[ $itemtag ] ) )
	                $itemtag = 'dl';
	        if ( ! isset( $valid_tags[ $captiontag ] ) )
	                $captiontag = 'dd';
	        if ( ! isset( $valid_tags[ $icontag ] ) )
	                $icontag = 'dt';
	
	        $columns = intval($columns);
	        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	        $float = is_rtl() ? 'right' : 'left';
	
	        $selector = "gallery-{$instance}";
	
	        $gallery_style = $gallery_div = '';
	        if ( apply_filters( 'use_default_gallery_style', true ) )
	                /*$gallery_style = "
	                <style type='text/css'>
	                        #{$selector} {
	                                margin: auto;
	                        }
	                        #{$selector} .gallery-item {
	                                float: {$float};
	                                margin-top: 10px;
	                                text-align: center;
	                                width: {$itemwidth}%;
	                        }
	                        #{$selector} img {
	                                border: 2px solid #cfcfcf;
	                        }
	                        #{$selector} .gallery-caption {
	                                margin-left: 0;
	                        }
	                </style>
	                <!-- see gallery_shortcode() in wp-includes/media.php -->";*/
	        $size_class = sanitize_html_class( $size );
	        $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'><h2>Photo Gallery</h2>";
	        $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
	
	        $i = 0;
	        foreach ( $attachments as $id => $attachment ) {
	                $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
	
	                $output .= "<{$itemtag} class='gallery-item'>";
	                $output .= "
	                        <{$icontag} class='gallery-icon'>
	                                $link
	                        </{$icontag}>";
	                if ( $captiontag && trim($attachment->post_excerpt) ) {
	                        $output .= "
	                                <{$captiontag} class='wp-caption-text gallery-caption'>
	                                " . wptexturize($attachment->post_excerpt) . "
	                                </{$captiontag}>";
	                }
	                $output .= "</{$itemtag}>";
	                if ( $columns > 0 && ++$i % $columns == 0 )
	                        $output .= '<br style="clear: both" />';
	        }
	
	        $output .= "
	                        <br style='clear: both;' />
	                </div>\n";
	
	        return $output;
}


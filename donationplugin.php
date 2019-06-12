<?php
/**
 * Plugin Name: Donation Plugin
 * Description: to make donation using woocommerce. Shortcode:donation_buttons.
 * Version: 1.0
 * Author: Sahil Gulati
 * Author URI: http://www.facebook.com/sahilgulati007
 */
function sg_checkout_add_on() {
    $product_ids = array( 14877, 14879, 15493 );
    $in_cart = false;
    foreach( WC()->cart->get_cart() as $cart_item ) {
        $product_in_cart = $cart_item['product_id'];
        if ( in_array( $product_in_cart, $product_ids ) ) {
            $in_cart = true;
            break;
        }
    }
    if ( ! $in_cart ) {
        ob_start();
        echo '<h4>Make a Donation?</h4>';
        echo '<p><a class="button" style="margin-right: 1em; width: auto" href="?add-to-cart=48"> €5 </a><a class="button" style="margin-right: 1em; width: auto" href="?add-to-cart=52"> €20 </a><a class="button" style="width: auto" href="?add-to-cart=53"> €50 </a></p>';
        return ob_get_clean();

    }
}
add_action( 'woocommerce_review_order_before_submit', 'sg_checkout_add_on', 9999 );
add_shortcode( 'donation_buttons' , 'sg_checkout_add_on' );
function sg_redirect_checkout_add_cart( $url ) {
    $url = get_permalink( get_option( 'woocommerce_checkout_page_id' ) );
    return $url;
}

add_filter( 'woocommerce_add_to_cart_redirect', 'sg_redirect_checkout_add_cart' );
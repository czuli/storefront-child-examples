<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

// add_filter( 'woocommerce_catalog_orderby', 'wpdesk_woocommerce_catalog_orderby', 20 );
/**
 * Task 1 - Remove product sorting
 *
 */
function wpdesk_woocommerce_catalog_orderby( $orderby ) {
	unset($orderby['date']);        // Data
	unset($orderby['price']);       // Cena rosnąco
	unset($orderby['price-desc']);  // Cena malejąco
	unset($orderby['rating']);      // Ocena

	return $orderby;
}


/**
 * Task 2 - Change number of displayed products
 *
 */
// add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20 );


/**
 * Task 3 - Remove related products on single product page
 *
 */
// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


// add_action( 'woocommerce_after_single_product_summary', 'wpdesk_bestsellers', 20 );
/**
 * Task 4 - Replace related products with bestsellers
 *
 */
function wpdesk_bestsellers() {
    echo '<h3>Bestsellers</h3>';

    echo do_shortcode( '[best_selling_products per_page="3" columns="3"]' );
}


/**
 * Task 5 - Change order of elements on the product page
 *
 */
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );         // Title
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );       // Rating
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );        // Price
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );      // Short description
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );  // Add to cart
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );         // SKU, Categories, Tags

// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 30 );           // Title
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 25 );          // Rating
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );           // Price
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 15 );         // Short description
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 10 );     // Add to cart
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );             // SKU, Categories, Tags


// add_action( 'woocommerce_thankyou', 'wpdesk_next_steps' );
// add_action( 'woocommerce_email_order_details', 'wpdesk_next_steps' );
/**
 * Task 6 - Add next steps to thank you page and emails
 *
 */
function wpdesk_next_steps() {
?>
    <h2>Next steps (hook)</h2>

    <ul>
        <li><a href="<?php echo get_permalink( get_page_by_path( 'blog' ) ); ?>">Read our blog</a></li>
        <li><a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">Return to shop</a></li>
    </ul>
<?php
}

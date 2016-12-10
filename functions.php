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

//add_filter( 'woocommerce_catalog_orderby', 'wpdesk_woocommerce_catalog_orderby', 20 );
/**
 * Zadanie 1 - Usunięcie opcji sortowania
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
 * Zadanie 2 - Zmiana wyświetlanej liczby produktów w sklepie na 6
 *
 */
//add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20 );


/**
 * Zadanie 3 - Usunięcie pokrewnych produktów na stronie produktu
 *
 */
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


//add_action( 'woocommerce_after_single_product_summary', 'wpdesk_bestsellers', 20 );
/**
 * Zadanie 4 - Dodanie bestsellerów w miejsce pokrewnych produktów
 *
 */
function wpdesk_bestsellers() {
    echo '<h3>Nasze Bestsellery</h3>';

    echo do_shortcode( '[best_selling_products per_page="3" columns="3"]' );
}


/**
 * Zadanie 5 - Zmiana kolejności elementów na stronie produktu
 *
 */
/*remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );         // Nazwa
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );       // Ocena
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );        // Cena
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );      // Krótki opis
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );  // Dodaj do koszyka
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );         // SKU, Kategorie, Tagi

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 30 );           // Nazwa
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 25 );          // Ocena
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );           // Cena
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 15 );         // Krótki opis
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 10 );     // Dodaj do koszyka
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );             // SKU, Kategorie, Tagi */


//add_action( 'woocommerce_thankyou', 'wpdesk_next_steps' );
//add_action( 'woocommerce_email_order_details', 'wpdesk_next_steps' );
/**
 * Zadanie 6 - Dodanie kolejnych kroków do strony podziękowania i maili
 *
 */
function wpdesk_next_steps() {
?>
    <h2>Co dalej?</h2>

    <ul>
        <li><a href="<?php echo get_permalink( get_page_by_path( 'blog' ) ); ?>">Poczytaj nasz blog</a></li>
        <li><a href="<?php echo get_permalink( get_page_by_path( 'sklep' ) ); ?>">Przejdź do sklepu</a></li>
    </ul>
<?php
}

<?php
/**
 * Plugin Name: Exalting
 * Plugin URI: https://exalting.de
 * Description: Exalting Adaptions
 * Version: 1.0.7
 * Author: Your Name
 * Author URI: https://exalting.de
 */

function jw_moneyBackText(): string {
		return '<p><span style="font-weight:bold;">Zufriedenheitsgarantie:</span> Testen Sie als Neukunde Arthrofill ohne Risiko. Wenn Sie unzufrieden sind, 
schicken Sie uns das geöffnete Glas innerhalb von 30 Tagen zurück für eine <u><a target="_blank" href="/widerrufsbelehrung/">volle&nbsp;Rückerstattung.</a></u> </p>';
}


//Anderer Add To Cart Text
function woocommerce_custom_single_add_to_cart_text() {
	return __('Jetzt probieren - risikofrei', 'woocommerce');
}
add_action('woocommerce_single_product_summary', 'custom_text', 35);



//Text unter Add To Cart
function custom_text(): void {
	echo jw_moneyBackText();
}
add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text');

//include css file
function exalting_plugin_styles(): void {
	wp_enqueue_style('exalting_plugin_styles', plugins_url('/css/style.css', __FILE__), [], time());


}
add_action('wp_enqueue_scripts', 'exalting_plugin_styles');


//Überschrift über Zahlungzmethoden
function paymentHeading(): void {
	echo '<h3 id="payment_heading">Zahlungsmethode auswählen</h3>';
}
add_action('woocommerce_review_order_before_payment', 'paymentHeading');


//Übersetzungen
function snippetpress_change_text($translation, $text, $domain) {
	if($domain == 'woocommerce') { // Replace woocommerce with the text domain of your plugin
		if($text == 'Billing details') { // Replace cart with the word you want to change
			$translation = 'Rechnungsadresse'; // Replace basket with your new word
		}
		if($text == 'Place Order') { // Replace cart with the word you want to change
			$translation = 'Rechnungsadresse'; // Replace basket with your new word
		}
	}
	return $translation;
}
add_filter('gettext', 'snippetpress_change_text', 1000, 3);


//Remove Order Notes Field
function theme_wc_setup(): void {
	remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
	add_action('woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20);
}
add_filter('woocommerce_enable_order_notes_field', '__return_false');
add_action('after_setup_theme', 'theme_wc_setup');


// Text unter Place Order
function bbloomer_privacy_message_below_checkout_button() {
	echo jw_moneyBackText();
}
add_action( 'woocommerce_review_order_after_submit', 'bbloomer_privacy_message_below_checkout_button' );



<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/nikzz1866/Book-Plugins
 * @since      1.0.0
 *
 * @package    Book_Library_Search
 * @subpackage Book_Library_Search/Shortcode
 */

/**
 * The Shortode-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the Shortode-facing stylesheet and JavaScript.
 *
 * @package    Book_Library_Search
 * @subpackage Book_Library_Search/shortcode
 * @author     Nikhil <nikhiljain180794@gmail.com>
 */
class Book_Library_Search_Shortcode {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	//custom filter books shortcode

	public function books_custom_shortcode() {

		$html .= '<form role="search" id="filter" method="post" class="search-form" action="'.site_url() .'/wp-admin/admin-ajax.php">
				<div class="book_name wrap-input100">
					<input type="text" class="book-name" placeholder="Book Name" value="" name="b-name">
				</div>
				<div class="author_name wrap-input100">
					<input type="text" class="author" placeholder="Author" value="" name="author">
				</div>';

		if( $terms = get_terms( array(
				    'taxonomy' => 'publisher', // to make it simple I use default categories
				    'orderby' => 'name'
				) ) ) : 
					// if categories exist, display the dropdown
				$html .='<div class="publisher_name wrap-input100"><select class="publisher" name="publisher"><option value="">Select Publisher</option>';
					foreach ( $terms as $term ) :
						
						$html .= '<option value="' . $term->name . '">' . $term->name . '</option>'; // ID of the category as an option value
					endforeach;
				$html .= '</select></div>';
		endif;
		$html .='<div class="rating_cl wrap-input100"><select name="rating" class="rating">
					 <option value="">Rating</option>
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					  <option value="5">5</option>
					</select>
					</div>
  				<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
  				<div id="slider-range"></div>
				<input type="submit" id="btn-search" class="btn-submit" value="Search">

			</form>';
			$html .='<div id="ajx_respo">
				<img id="loader" src="'.plugin_dir_url( __FILE__ ).'img/loader.gif" style="display:none;width: 19%;margin: 0 auto">
			<div id="response">
					
			</div></div>';
			return $html;
	}

}

<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/nikzz1866/Book-Plugins
 * @since      1.0.0
 *
 * @package    Book_Library_Search
 * @subpackage Book_Library_Search/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Book_Library_Search
 * @subpackage Book_Library_Search/public
 * @author     Nikhil <nikhiljain180794@gmail.com>
 */
class Book_Library_Search_Register_Book {

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

	public function book_custom_post_type() {
		// Register Custom Post Type
	$labels = array(
		'name'                  => _x( 'Books', 'Post Type General Name', 'book_search' ),
		'singular_name'         => _x( 'Books', 'Post Type Singular Name', 'book_search' ),
		'menu_name'             => __( 'Books', 'book_search' ),
		'name_admin_bar'        => __( 'Books', 'book_search' ),
		'archives'              => __( 'Item Archives', 'book_search' ),
		'attributes'            => __( 'Item Attributes', 'book_search' ),
		'parent_item_colon'     => __( 'Parent Item:', 'book_search' ),
		'all_items'             => __( 'All Books', 'book_search' ),
		'add_new_item'          => __( 'Add New Books', 'book_search' ),
		'add_new'               => __( 'Add New Books', 'book_search' ),
		'new_item'              => __( 'New Books', 'book_search' ),
		'edit_item'             => __( 'Edit Book', 'book_search' ),
		'update_item'           => __( 'Update books', 'book_search' ),
		'view_item'             => __( 'View books', 'book_search' ),
		'view_items'            => __( 'View books', 'book_search' ),
		'search_items'          => __( 'Search books', 'book_search' ),
		'not_found'             => __( 'Not found', 'book_search' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'book_search' ),
		'featured_image'        => __( 'Featured Image', 'book_search' ),
		'set_featured_image'    => __( 'Set featured image', 'book_search' ),
		'remove_featured_image' => __( 'Remove featured image', 'book_search' ),
		'use_featured_image'    => __( 'Use as featured image', 'book_search' ),
		'insert_into_item'      => __( 'Insert into Books', 'book_search' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Books', 'book_search' ),
		'items_list'            => __( 'Books list', 'book_search' ),
		'items_list_navigation' => __( 'Books list navigation', 'book_search' ),
		'filter_items_list'     => __( 'Filter Books list', 'book_search' ),
	);
	$args = array(
		'label'                 => __( 'Books', 'book_search' ),
		'description'           => __( 'Books', 'book_search' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields' ),
		'taxonomies'            => array( 'author', 'publisher' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'query_var'             => 'books',
		'capability_type'       => 'page',
	);
	register_post_type( 'book', $args );
	}

	// Register Author Custom Taxonomy
	public function author_taxonomy() {

	$labels = array(
		'name'                       => _x( 'author', 'Taxonomy General Name', 'author_tax' ),
		'singular_name'              => _x( 'author', 'Taxonomy Singular Name', 'author_tax' ),
		'menu_name'                  => __( 'Author', 'author_tax' ),
		'all_items'                  => __( 'All Author', 'author_tax' ),
		'parent_item'                => __( 'Parent Author', 'author_tax' ),
		'parent_item_colon'          => __( 'Parent Author', 'author_tax' ),
		'new_item_name'              => __( 'New Author Name', 'author_tax' ),
		'add_new_item'               => __( 'Add New Author', 'author_tax' ),
		'edit_item'                  => __( 'Edit Author', 'author_tax' ),
		'update_item'                => __( 'Update Author', 'author_tax' ),
		'view_item'                  => __( 'View Author', 'author_tax' ),
		'separate_items_with_commas' => __( 'Separate Author with commas', 'author_tax' ),
		'add_or_remove_items'        => __( 'Add or remove Author', 'author_tax' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'author_tax' ),
		'popular_items'              => __( 'Popular Author', 'author_tax' ),
		'search_items'               => __( 'Search Author', 'author_tax' ),
		'not_found'                  => __( 'Not Found', 'author_tax' ),
		'no_terms'                   => __( 'No Author', 'author_tax' ),
		'items_list'                 => __( 'Author list', 'author_tax' ),
		'items_list_navigation'      => __( 'Author list navigation', 'author_tax' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'author', array( 'book' ), $args );
}

	// Register  publisher_taxonomy Custom Taxonomy
	public	function publisher_taxonomy() {

		$labels = array(
			'name'                       => _x( 'publisher', 'Taxonomy General Name', 'publisher_tax' ),
			'singular_name'              => _x( 'publisher', 'Taxonomy Singular Name', 'publisher_tax' ),
			'menu_name'                  => __( 'publisher', 'publisher_tax' ),
			'all_items'                  => __( 'All publisher', 'publisher_tax' ),
			'parent_item'                => __( 'Parent publisher', 'publisher_tax' ),
			'parent_item_colon'          => __( 'Parent publisher', 'publisher_tax' ),
			'new_item_name'              => __( 'New publisherName', 'publisher_tax' ),
			'add_new_item'               => __( 'Add New publisher', 'publisher_tax' ),
			'edit_item'                  => __( 'Edit publisher', 'publisher_tax' ),
			'update_item'                => __( 'Update publisher', 'publisher_tax' ),
			'view_item'                  => __( 'View publisher', 'publisher_tax' ),
			'separate_items_with_commas' => __( 'Separate publisherwith commas', 'publisher_tax' ),
			'add_or_remove_items'        => __( 'Add or remove publisher', 'publisher_tax' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'publisher_tax' ),
			'popular_items'              => __( 'Popular publisher', 'publisher_tax' ),
			'search_items'               => __( 'Search publisher', 'publisher_tax' ),
			'not_found'                  => __( 'Not Found', 'publisher_tax' ),
			'no_terms'                   => __( 'No Author', 'publisher_tax' ),
			'items_list'                 => __( 'publisherlist', 'publisher_tax' ),
			'items_list_navigation'      => __( 'publisherlist navigation', 'publisher_tax' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'publisher', array( 'book' ), $args );
	}

}

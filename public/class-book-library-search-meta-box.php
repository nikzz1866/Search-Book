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
class Book_Library_Search_Meta_Box {

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

	/* Create one or more meta boxes to be displayed on the post editor screen. */
	function smashing_add_post_meta_boxes() {

	  add_meta_box(
	    'smashing-post-class',      // Unique ID
	    'Post Class',    // Title
	    'smashing_post_class_meta_box',   // Callback function
	    'book	',         // Admin page (or post type)
	    'normal',        // Context
	     'default'         // Priority
	  );
	}

	/* Display the post meta box. */
function smashing_post_class_meta_box( $post ) { 

 


}

}


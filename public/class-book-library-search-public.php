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
class Book_Library_Search_Public {

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

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Book_Library_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Book_Library_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/book-library-search-public.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'jquery-ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'font-awsome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), $this->version, 'all' );

		wp_localize_script( 'my_ajax_filter_search', 'ajax_url', admin_url('admin-ajax.php') );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Book_Library_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Book_Library_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/book-library-search-public.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( 'jquery-ui', plugin_dir_url( __FILE__ ) . 'js/jquery-ui.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( 'jquery-star', plugin_dir_url( __FILE__ ) . 'js/simple-rating.js', array( 'jquery' ), $this->version, false );

	}	

	function misha_filter_function(){

	/**
	==================================================================================
								Meta query Start

		***  We have 2 meta fileds that is price and rating 
	==================================================================================
	*/	
		$meta_query = array();

	    if(($_POST['min_price'] != 0 ) && ($_POST['max_price'] != 0) )  {
	        //$year = sanitize_text_field( $_POST['year'] );
	        $meta_query[] = array(
				'key' => 'price',
				'value' => array($_POST['min_price'],$_POST['max_price']),
				'type' => 'numeric',
				'compare' => 'BETWEEN'
			);
	    } else if(($_POST['rating'] != "") && ($_POST['min_price'] == 0) && ($_POST['max_price'] == 0)) {
	        //$rating = sanitize_text_field(  );
	        $meta_query[] = array(
	            'key' => 'rating',
	            'value' => $_POST['rating'],
	            'compare' => '='
	        );
	    }else if(($_POST['min_price'] != 0) && ($_POST['max_price'] != 0) && ($_POST['rating'] != 0)){
	    	
	    	$meta_query = array('relation' => 'AND', );

	    	$meta_query[] = array(
	            'key' => 'price',
				'value' => array($_POST['min_price'],$_POST['max_price']),
				'type' => 'numeric',
				'compare' => 'BETWEEN'
	        );
	    	$meta_query[] = array(
	            'key' => 'rating',
	            'value' => $_POST['rating'],
	            'compare' => '='
	        );
	    	
	    }
	    /**
		==================================================================================
									Meta query end
										
			***  We have 2 meta fileds that is price and rating 
		==================================================================================
		*/
 	
 	/* --------------------- Tax Query -----------------------------------------------------
	** Tax query filter data based on tax value 
	** we have 2 taxonomy author and publisher so it filtered as per request data
 	*/

		$tax_query = array();
	    if(($_POST['publisher'] != "") && ($_POST['author'] == "")) {
	       // $genre = sanitize_text_field( $_POST['publisher'] );
	        $tax_query[] = array(
	            'taxonomy' => 'publisher',
	            'field' => 'slug',
	            'terms' => $_POST['publisher']
	        );
	    }else if(($_POST['author'] != "") && ($_POST['publisher'] == "")){
	    	$tax_query[] = array(
	            'taxonomy' => 'author',
	            'field' => 'slug',
	            'terms' => $_POST['author']
	        );
	    }else if(($_POST['author'] != "") && ($_POST['publisher'] != "") ){
		 $args['tax_query'] = array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'author',
				'terms' => $_POST['author'],
				'field' => 'slug',
			),
			array(
				'taxonomy' => 'publisher',
				'terms' => $_POST['publisher'],
				'field' => 'slug',
			),
		);
	    }

 	/* ---------------------End Tax Query -----------------------------------------------------
	** */



		if( ($_POST['bookname'] != "") && ($_POST['publisher'] == "")  && ($_POST['author'] == "")   ) {
			$args = array(
	        'post_type' => 'book',
	        'posts_per_page' => -1,
	        // 'meta_query' => $meta_query,
	        // 'tax_query' => $tax_query,
	        's' => $_POST['bookname']  
	    );
		} else if( ($_POST['publisher'] != "") && ($_POST['bookname'] == "") && ($_POST['author'] == "") ){
			$args = array(
	        'post_type' => 'book',
	        'posts_per_page' => -1,
	        // 'meta_query' => $meta_query,
	        'tax_query' => $tax_query,
	        //'s' => $_POST['bookname']  
	    );
		}else if ( ($_POST['publisher'] != "") && ($_POST['bookname'] != "") ) {
			$args = array(
	        'post_type' => 'book',
	        'posts_per_page' => -1,
	        //'meta_query' => $meta_query,
	        'tax_query' => $tax_query,
	        's' => $_POST['bookname']  
	    );
		}else if ( ($_POST['publisher'] == "") && ($_POST['bookname'] != "") && ($_POST['author'] != "") ) {
			$args = array(
	        'post_type' => 'book',
	        'posts_per_page' => -1,
	        //'meta_query' => $meta_query,
	        'tax_query' => $tax_query,
	        's' => $_POST['bookname']  
	    );
		}else if(($_POST['author'] != "") && ($_POST['publisher'] == "") && ($_POST['bookname'] == "") ){
			$args = array(
	        'post_type' => 'book',
	        'posts_per_page' => -1,
	        //'meta_query' => $meta_query,
	        'tax_query' => $tax_query,
	        //'s' => $_POST['bookname']  
	    );	
		}else if(($_POST['min_price'] != "") && ($_POST['min_price'] != "")  && ($_POST['publisher'] == "") && ($_POST['bookname'] == "") && ($_POST['rating'] == "")){
			$args = array(
	        'post_type' => 'book',
	        'posts_per_page' => 6,
	        'meta_query' => $meta_query,
	        //'tax_query' => $tax_query,
	        //'s' => $_POST['bookname']  
	    );	
		}else if(($_POST['min_price'] != '') && ($_POST['max_price'] != '') && ($_POST['rating'] != "") && ($_POST['publisher'] == "") && ($_POST['bookname'] == "") ){
			$args = array(
	        'post_type' => 'book',
	        'posts_per_page' => 6,
	        'meta_query' => $meta_query,
	        //'tax_query' => $tax_query,
	        //'s' => $_POST['bookname']  
	    );	
		}else if(($_POST['min_price'] != '') && ($_POST['max_price'] != '') && ($_POST['rating'] != "") && ($_POST['publisher'] != "") && ($_POST['bookname'] != "") ){
			$args = array(
	        'post_type' => 'book',
	        'posts_per_page' => 6,
	        'meta_query' => $meta_query,
	        'tax_query' => $tax_query,
	        's' => $_POST['bookname']  
	    );	
		}
	
		$search_query = new WP_Query( $args );
	   // print_r($search_query);
		// for taxonomies / categories
		if ( $search_query->have_posts() ) {
 
        $result = array();
 
        while ( $search_query->have_posts() ) {
            $search_query->the_post();  	
   			$publisher_term = wp_get_post_terms(get_the_ID(), 'publisher', array("fields" => "names"));
   			$author = wp_get_post_terms(get_the_ID(), 'author', array("fields" => "names"));
            $result[] = array(
                "id" => get_the_ID(),
                "title" => get_the_title(),
                "price" => get_field('price'),
                "permalink" => get_permalink(),
                "author" => $author,
                "publisher" => $publisher_term,
                "rating" => get_field('rating'),     
                "poster" => wp_get_attachment_url(get_post_thumbnail_id($post->ID),'full')
            );
        }
        wp_reset_query();
 		//print_r($result);
        echo json_encode($result);
 
    } else {
        // no posts found
    }
    wp_die();
}

}

<?php
namespace themexpo\rkslide;

if ( ! defined('ABSPATH')) exit;  // if direct access 

/**
 * custom post class handlar 
 */
class txCustompost 
{
	
/**
 * register post type 
 */	

public function tx_responsive_slider_register() {
	
	$labels = array(
	'name'                 => __( 'Responsive Slider', 'tx-responsive-slider' ),
	'singular_name'        => __( 'Responsive Slider', 'tx-responsive-slider' ),
	'all_items'            => __( 'All Responsive Slider', 'tx-responsive-slider' ),
	'add_new'              => __( 'Add New Responsive Slider', 'tx-responsive-slider' ),
	'add_new_item'         => __( 'Add New Responsive Slider', 'tx-responsive-slider' ),
	'edit_item'            => __( 'Edit Responsive Slider', 'tx-responsive-slider' ),
	'new_item'             => __( 'New Responsive Slider', 'tx-responsive-slider' ),
	'view_item'            => __( 'View Responsive Slider', 'tx-responsive-slider' ),
	'search_items'         => __( 'Search Responsive Slider', 'tx-responsive-slider' ),
	'not_found'            => __( 'No Responsive Slider found', 'tx-responsive-slider' ),
	'not_found_in_trash'   => __( 'No Responsive Slider found in Trash', 'tx-responsive-slider' ), 
	'parent_item_colon'    => ''		
	);
	
	$args = array(
	'labels'               => $labels,
	'public'               => true,
	'publicly_queryable'   => true,
	'_builtin'             => false,
	'show_ui'              => true, 
	'query_var'            => true,
	'rewrite'              => array( "slug" => "txresponsiveslider" ),
	'capability_type'      => 'post',
	'hierarchical'         => false,
	'menu_position'        => 15,
	'supports'             => array( 'title','thumbnail', 'page-attributes' ),
	'taxonomies'           => array(),
	'has_archive'          => true,
	'show_in_nav_menus'    => false,
	'menu_icon'            => 'dashicons-media-document',
	);
	
	register_post_type( 'txresponsiveslider', $args );	
 }
   
	/**
	* register metabox post type 
	*/	  

    public function tx_responsive_slider_metaboxes() {	

    remove_meta_box( 'postimagediv', 'tx-responsive-slider', 'side' );
	remove_meta_box( 'pageparentdiv', 'tx-responsive-slider', 'side' );
	remove_meta_box( 'hybrid-core-post-template', 'tx-responsive-slider', 'side' );
	remove_meta_box( 'theme-layouts-post-meta-box', 'tx-responsive-slider', 'side' );
	remove_meta_box( 'post-stylesheets', 'tx-responsive-slider', 'side' );  

 add_meta_box('postimagediv', __('Responsive Image', 'responsive-slider' ), 'post_thumbnail_meta_box', 'Responsive Slider', 'side', 'low');

 add_meta_box('pageparentdiv', __('Order By ', 'responsive-slider' ), 'page_attributes_meta_box', 'Responsive Slider', 'side', 'low');
  } 



    /**
	* custom columns post type 
	*
	*/
  public function tx_responsive_slider_extra_columns( $columns ) {

    /**
	* customize columns name
	*
	*/	
   
	$columns = array(
		'cb'       => '<input type="checkbox" />',		
		'title'    => __( 'Title', 'tx-responsive-slider' ),
		'image'    => __( 'Slide Image', 'tx-responsive-slider' ),
		'order'    => __( 'Order', 'tx-responsive-slider' ),
		'date'     => __( 'Date', 'tx-responsive-slider' )				
	);

	return $columns;
}
    /**
	* extra columon add
	*
	*/	

 public function tx_responsive_slider_distribute_columns( $column ) {

	global $post;
	
	/* Get the post edit link for the post. */
	$edit_link = get_edit_post_link( $post->ID );

	/* Add column 'Image'. */
	if ( $column == 'image' )		
	echo get_the_post_thumbnail( $post->ID, array( 60, 60 ), array( 'title' => trim( strip_tags(  $post->post_title ) ) ) );
	
	/* Add column 'Order'. */	
	if ( $column == 'order' )		
	echo $post->menu_order;		
}

/**
 * Order the slides by the 'order' attribute in the 'all_items' column view.
 *
 * @since 0.1.2
 */

public function tx_responsive_slider_column_order($wp_query) {
	
	if( is_admin() ) {
		
		$post_type = $wp_query->query['post_type'];
		
		if( $post_type == 'txresponsiveslider' ) {
			$wp_query->set( 'orderby', 'menu_order' );
			$wp_query->set( 'order', 'ASC' );
		}
	}	
 }






} /*end the class*/

?>
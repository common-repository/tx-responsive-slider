<?php
namespace themexpo\rkslide;

 if ( ! defined('ABSPATH')) exit;  // if direct access 
 /**
  * dashboard class handel 
  */

 class AdminDashboardMain 
 {
 	
 	function __construct()
 	{        
	  /*custom post object create*/ 
    $custompost = new txCustompost();
    
    /*resgister custom post*/ 

    add_action( 'init', [ $custompost, 'tx_responsive_slider_register' ] ); 
    
    /*resgister meta box*/ 
    add_action('do_meta_boxes', [ $custompost, 'tx_responsive_slider_metaboxes' ]);
    
    /*resgister custom colmun*/
    add_filter( 'manage_edit-txresponsiveslider_columns',[ $custompost, 'tx_responsive_slider_extra_columns']);
   
    /* Add slide-specific columns to the 'all_items' view. */
  	add_action( 'manage_posts_custom_column', [ $custompost,'tx_responsive_slider_distribute_columns'] );
  	
  	/* Order the slides by the 'order' attribute in the 'all_items' column view. */
  	add_filter( 'pre_get_posts', [ $custompost,'tx_responsive_slider_column_order'] ); 
      
    /*Menu object create*/
     $adminmenu = new txmainMenu();  

    /*setting menu registar*/
    add_action( 'admin_menu', [ $adminmenu, 'tx_responsive_slider_setting_menu' ] ); 

  }

 }
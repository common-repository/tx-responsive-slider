<?php
namespace themexpo\rkslide;

if ( ! defined('ABSPATH')) exit;  // if direct access 

/**
 *  frontend class
 */
class FrontendResponsive  
{
	
	function __construct()
	{   

    /* Enqueue style & js hook register.*/
  add_action( 'wp_enqueue_scripts', [$this, 'tx_slider_responsive_script']);

    /* Register shortcodes the Hook */
	add_action( 'init', [$this,'tx_slider_responsive_shortcode']);

	/* custom js regsiter in footer */ 
	add_action('wp_footer',[$this,'tx_slider_responsive_customjs']);

    /* setting regsiter in footer */ 
	add_action('wp_footer',[$this,'tx_slider_responsive_slider_setting']);  

	}


    /**    
    *  Enqueue style & Js.
    */ 

    public function tx_slider_responsive_script()
    {
    	
	  wp_enqueue_style( 'responsive_slider_stylesheet',  plugins_url( 'assets/css/style.css', __FILE__ ), false, 0.1, 'all' );
    
    /*wp_enqueue_style( 'responsive_slider_awesome_font', plugins_url( 'assets/css/awesomefont.min.css', __FILE__ ), false, 0.2, 'all');*/

   wp_enqueue_style( 'responsive_slider_awesome_font', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css', false, 0.2, 'all');

    wp_enqueue_script( 'Jquery', plugins_url( 'assets/js/jquery-3.4.1.min.js', __FILE__ ), array( 'jquery' ), 0.1, false );
    }



    /* forntend show this scrtpt */

	public function tx_responsive_slider_custompost() {   

   /* $rkslide = array('orderby' => 'menu_order', 'order' => 'DESC');  */ 
       
   $mypost = array('post_type' => 'txresponsiveslider',  'orderby' => 'menu_order'); 
    $loop = new \WP_Query( $mypost );    

	echo "<div class='slider-wrapper' id='slider'>

	   <ul class='slider-img'>";
	   
	 while ( $loop->have_posts() ) : $loop->the_post();          
?>
	  <li> <?php 
     the_post_thumbnail('post-thumbnail', ['class' => 'slider_image_sizes', 'title' => '']);
	 ?></li>

<?php
	 endwhile;   
     wp_reset_query();
     
     echo"</ul> 
	   </div>"; 
	}
 

   /* shortcode generate */

	 public function tx_slider_responsive_shortcode()
	 {
	   add_shortcode( 'tx_responsive_slider', [$this, 'tx_responsive_slider_custompost']);
	 }
   

  /* custom js code */

   public function tx_slider_responsive_customjs()
    {
   ?> 	
    	<script type="text/javascript">
        // Determine the total amount of images in the carousel.
      let sliderCount = $("#slider").find(".slider-img li img").length;
      // Load images into the carousel
      let sliderImg = $("#slider").find(".slider-img");
      // Define the navigation arrows and pagination bullets.
      let sliderArrow = `<ul class="slider-arrow"><li class="arrow-left" role="button"><i class="fas fa-chevron-left"></i></li><li class="arrow-right" role="button"><i class="fas fa-chevron-right"></i></li></ul>`;
      let sliderDotLi = "";
      for (let i = 0; i < sliderCount; i++) {
        sliderDotLi += `<li><i class="fas fa-circle"></i></li>`;
      }
      let sliderDot = `<ul class="slider-dot">${sliderDotLi}</ul>`;
      $("#slider").append(sliderArrow + sliderDot);

      let activeDefaultCount = $(".slider-dot li.active").length;
      if (activeDefaultCount != 1) {
        $(".slider-dot li")
          .removeClass()
          .eq(0)
          .addClass("active");
      }
      let sliderIndex = $(".slider-dot li.active").index();
      sliderImg.css("left", -sliderIndex * 100 + "%");

      // switch between images
      function sliderPos() {
        sliderImg.css("left", -sliderIndex * 100 + "%");
        $(".slider-dot li")
          .removeClass()
          .eq(sliderIndex)
          .addClass("active");
      }

      $(".arrow-right").click(function() {
        sliderIndex >= sliderCount - 1 ? (sliderIndex = 0) : sliderIndex++;
        sliderPos();
      });

      $(".arrow-left").click(function() {
        sliderIndex <= 0 ? (sliderIndex = sliderCount - 1) : sliderIndex--;
        sliderPos();
      });

      $(".slider-dot li").click(function() {
        sliderIndex = $(this).index();
        sliderPos();
      });

      let goSlider = setInterval(() => {
        $(".arrow-right").click();
      }, <?php $options = get_option( 'tx_setting_option_name', array() ); echo $options['animation_duration'];?>);

      $("#slider").on({
        mouseenter: () => {
          clearInterval(goSlider);
        },
        mouseleave: () => {
          goSlider = setInterval(() => {
            $(".arrow-right").click();
          }, <?php $options = get_option( 'tx_setting_option_name', array() ); echo $options['animation_duration'];?>);
        }
      });

</script>

<?php
    } 
 
  
 /* custom style code */

 public function tx_slider_responsive_slider_setting()
 {
   $options = get_option( 'tx_setting_option_name', array() ); 
   ?>
 <style type="text/css">
  
   ul.slider-arrow{	
  display: <?php echo $options['slider_arrow_active'];?>!important; ?>
  } 
  .slider-dot{
   display: <?php echo $options['slider_dot'];?>!important;	?>
  }
  .slider_image_sizes{
   width: <?php echo $options['width'];?>px!important;?>
  }
  .slider-wrapper{
   height:<?php echo $options['height'];?>px!important;?>
  }


   </style>
 <?php  
 }


} /*end the class*/ 


?>


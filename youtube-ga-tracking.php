<?php
/*
Plugin Name: Youtube Video Tracking with Google Analytics
Plugin URI: http://www.runestenstroem.dk/2016/08/03/monitorering-af-din-youtube-marketing/ ‎
Description: This plugin adds a shortcode for inserting youtube videos. When using this shortcode the video events will be tracked in Google Analytics.
THIS PLUGIN REQUIRES YOU TO HAVE A GOOGLE ANALYTICS UA TRACKING CODE ON YOUR SITE!!! 
Version: 1.0
Author: Rune Stenstrøm
Author URI: http://www.runestenstroem.dk
*/

class NB_YtGa {
    public function __construct()
    {
    	add_shortcode('youtube-video', array($this,'nb_youtube_ga_tracking_shortcode'));
    }

	//Youtube carousel shortcode
	function nb_youtube_ga_tracking_shortcode($atts, $content = null){   
	  wp_register_script( 'youtube-ga-tracking', plugins_url( 'youtube-ga-tracking.js', __FILE__ ), array( 'jquery' ), NULL, true );
	  wp_enqueue_script( 'youtube-ga-tracking' );
	  wp_register_style( 'youtube-ga-tracking', plugins_url('youtube-ga-tracking.css', __FILE__ ), NULL, 'all' );
	  wp_enqueue_style( 'youtube-ga-tracking' );
	  ob_start();
	  ?>
	    <div class="video-container">
	        <div class="youtube-video" id='<?php echo $atts['id'] ?>'></div>
	    </div>
	  <?php       
	  $output = ob_get_contents();
	  ob_end_clean();
	  return $output;
	}           
}
$nb_ytga = new NB_YtGa();
?>
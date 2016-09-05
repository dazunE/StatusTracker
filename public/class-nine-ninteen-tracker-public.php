<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://919press.com
 * @since      1.0.0
 *
 * @package    Nine_Ninteen_Tracker
 * @subpackage Nine_Ninteen_Tracker/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nine_Ninteen_Tracker
 * @subpackage Nine_Ninteen_Tracker/public
 * @author     Dasun Edirisinghe <dazunj4me@gmail.com>
 */
class Nine_Ninteen_Tracker_Public {

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
		 * defined in Nine_Ninteen_Tracker_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nine_Ninteen_Tracker_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nine-ninteen-tracker-public.css', array(), $this->version, 'all' );

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
		 * defined in Nine_Ninteen_Tracker_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nine_Ninteen_Tracker_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nine-ninteen-tracker-public.js', array( 'jquery' ), $this->version, true);

	}

	public function nnpress_single_page_templates( $single_template ){

		global $post;

	     if ($post->post_type == 'nn_tracker') {

	          $single_template = plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/nn_tracker-single.php';
	     }
	     return $single_template;
	}


	public function nnpress_get_tracking_data(){

		$post_id = (int)$_POST['postId'];

		$tracking_data = get_post($post_id);

		
		if ($tracking_data->post_type == 'nn_tracker'){
			$item_image = get_the_post_thumbnail($tracking_data->ID , array( 150, 150));
			$html = '<h4>' . esc_html__( 'Hooray we found your package', 'nnpress' ) . ' for tracking ID :'.esc_html__( 'TRA', 'nnpress' ).$tracking_data->ID.'</h4>';
			$html .= '<div class="package-deatils">';
			$html .= '<div class="post-thumbnail"><a href="'.$tracking_data->guid.'">'.$item_image.'</a></div>';
			$html .= '<div class="package-data">';
			$html .= '<h4>'.$tracking_data->post_title.'</h4>';

			$status =  $tracking_data->post_status;

			switch ($status) {
				case 'dispatched':
					$html .= '<p class="'.$status.'"><span><i class="flaticon-dispathced"></i></span>'.esc_html__( 'Items has dispatched', 'nnpress' ).'</p>';
					break;
				case 'notfound':
					$html .= '<p class="'.$status.'"><span><i class="flaticon-notfound"></i></span>'.esc_html__( 'Items gone missing', 'nnpress' ).'</p>';
					break;
				case 'intransist':
					$html .= '<p class="'.$status.'"><span><i class="flaticon-intransist"></i></span>'.esc_html__( 'Items in transist', 'nnpress' ).'</p>';
					break;
				case 'localpost':
					$html .= '<p class="'.$status.'"><span><i class="flaticon-localpost"></i></span>'.esc_html__( 'Items in local post', 'nnpress' ).'</p>';
					break;
				case 'recived':
					$html .= '<p class="'.$status.'"><span><i class="flaticon-recived"></i></span>'.esc_html__( 'Items recived', 'nnpress' ).'</p>';
					break;
				default:
					$html .= '<p class="'.$status.'"><span><i class=""></i></span>'.esc_html__( 'Items still processing', 'nnpress' ).'</p>';
					break;
			}
			$html .= '<p>'.get_post_meta( $post->ID, 'nnpress_item_decription', true).'</p>';
			$html .= '</div>';
			$html .= '<a href="'.$tracking_data->guid.'"><button>'.esc_html__( 'Package Details', 'nnpress' ).'</button><a/>';

		} else{

			$html = '<h3>' . esc_html__( 'It seems you have entered the wrong Tracking ID', 'nnpress' ) . '</h3>';
		}

		echo json_encode($html);

		exit;
	}

}

function nnpress_tracking_items_shortcode(){

?>
<div  class="tracking-from">
	<label>
		<span class="screen-reader-text">Search for:</span>
		<input type="text" id="tracking-input" placeholder="Enter the tracking id" autocomplete="off">
	</label>
	<label>
		<button id="track-now">Track now</button>
	</label>
	<div class="clear-fix"></div>

	<div class="loader-wrapper" style="display:none;">
		<svg version="1.1" id="L2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		  viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
		<circle fill="none" stroke="#2e2256" stroke-width="4" stroke-miterlimit="10" cx="50" cy="50" r="48"/>
		<line fill="none" stroke-linecap="round" stroke="#2e2256" stroke-width="4" stroke-miterlimit="10" x1="50" y1="50" x2="85" y2="50.5">
		  <animateTransform 
		       attributeName="transform" 
		       dur="2s"
		       type="rotate"
		       from="0 50 50"
		       to="360 50 50"
		       repeatCount="indefinite" />
		</line>
		<line fill="none" stroke-linecap="round" stroke="#2e2256" stroke-width="4" stroke-miterlimit="10" x1="50" y1="50" x2="49.5" y2="74">
		  <animateTransform 
		       attributeName="transform" 
		       dur="15s"
		       type="rotate"
		       from="0 50 50"
		       to="360 50 50"
		       repeatCount="indefinite" />
		</line>
		</svg>
	 </div>
	 <div class="results-data"></div>

</div>
<?php
}

add_shortcode('tracking_items' , 'nnpress_tracking_items_shortcode' );


function nnpress_tracking_status($post_id){


	$post_data = get_post($post_id);

	$status = $post_data->post_status;

	switch ($status) {
		case 'dispatched':
			$html = '<span><i class="flaticon-dispathced"></i>'.esc_html__( 'Status : Dispathed', 'nnpress' ).'</span>';
			break;
		case 'notfound':
			$html = '<span><i class="flaticon-notfound"></i>'.esc_html__( 'Status : Not Found :(', 'nnpress' ).'</span>';
			break;
		case 'intransist':
			$html = '<span><i class="flaticon-intransist"></i>'.esc_html__( 'Status : In transist', 'nnpress' ).'</span>';
			break;
		case 'localpost':
			$html = '<span><i class="flaticon-localpost"></i>'.esc_html__( 'Status : Local Post', 'nnpress' ).'</span>';
			break;
		case 'recived':
			$html = '<span><i class="flaticon-recived"></i>'.esc_html__( 'Status : Recived', 'nnpress' ).'</span>';
			break;
		default:
			$html = '<span><i class=""></i>'.esc_html__( 'Status : Processing', 'nnpress' ).'</span>';
			break;
	}

	echo $html;
}
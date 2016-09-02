<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://919press.com
 * @since      1.0.0
 *
 * @package    Nine_Ninteen_Tracker
 * @subpackage Nine_Ninteen_Tracker/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nine_Ninteen_Tracker
 * @subpackage Nine_Ninteen_Tracker/admin
 * @author     Dasun Edirisinghe <dazunj4me@gmail.com>
 */
class Nine_Ninteen_Tracker_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nine-ninteen-tracker-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nine-ninteen-tracker-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function nnpress_tracker_post_type() {

		$labels = array(
			'name'                  => _x( 'Tracking Items', 'Post Type General Name', 'nnpress' ),
			'singular_name'         => _x( 'Tracking Item', 'Post Type Singular Name', 'nnpress' ),
			'menu_name'             => __( 'Tracking Item', 'nnpress' ),
			'name_admin_bar'        => __( 'Tracking Item', 'nnpress' ),
			'archives'              => __( 'Item Archives', 'nnpress' ),
			'parent_item_colon'     => __( 'Parent Item:', 'nnpress' ),
			'all_items'             => __( 'All Items', 'nnpress' ),
			'add_new_item'          => __( 'Add New Item', 'nnpress' ),
			'add_new'               => __( 'Add New', 'nnpress' ),
			'new_item'              => __( 'New Item', 'nnpress' ),
			'edit_item'             => __( 'Edit Item', 'nnpress' ),
			'update_item'           => __( 'Update Item', 'nnpress' ),
			'view_item'             => __( 'View Item', 'nnpress' ),
			'search_items'          => __( 'Search Item', 'nnpress' ),
			'not_found'             => __( 'Not found', 'nnpress' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'nnpress' ),
			'featured_image'        => __( 'Featured Image', 'nnpress' ),
			'set_featured_image'    => __( 'Set featured image', 'nnpress' ),
			'remove_featured_image' => __( 'Remove featured image', 'nnpress' ),
			'use_featured_image'    => __( 'Use as featured image', 'nnpress' ),
			'insert_into_item'      => __( 'Insert into item', 'nnpress' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'nnpress' ),
			'items_list'            => __( 'Items list', 'nnpress' ),
			'items_list_navigation' => __( 'Items list navigation', 'nnpress' ),
			'filter_items_list'     => __( 'Filter items list', 'nnpress' ),
		);

		$rewrite = array(
			'slug'                  => 'tracking-item',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);

		$args = array(
			'label'                 => __( 'Tracking Item', 'nnpress' ),
			'description'           => __( 'This is content type to manage the items', 'nnpress' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-clock',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => 'tracking-items',
			'exclude_from_search'   => false,
			'rewrite'               => $rewrite,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);

		register_post_type( 'nn_tracker', $args );

	}

	public function nnpress_custom_new_archive_post_status(){

		register_post_status( 'dispatched', array(
			'label'                     => _x( 'Dispatched', 'post' ),
			'public'                    => true,
			'exclude_from_search'       => false,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Dispatched <span class="count">(%s)</span>', 'Dispatched <span class="count">(%s)</span>' ),
		) );


		register_post_status( 'intransist', array(
			'label'                     => _x( 'Intransist', 'post' ),
			'public'                    => true,
			'exclude_from_search'       => false,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Intransist <span class="count">(%s)</span>', 'Intransist <span class="count">(%s)</span>' ),
		) );


		register_post_status( 'localpost', array(
			'label'                     => _x( 'Local Post', 'post' ),
			'public'                    => true,
			'exclude_from_search'       => false,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Local Post <span class="count">(%s)</span>', 'Local Post <span class="count">(%s)</span>' ),
		) );
	}



}


class wp_custom_post_status
{
	/**
	 * Name of the post status
	 * Must be lower case
	 * 
	 * @access protected
	 * @var string
	 */
	public $post_status;
	/**
	 * Post type (slug) where the post status should appear
	 * 
	 * @access protected
	 * @var string/array
	 */
	public $post_type = array( 'post', 'page' );
	/**
	 * Custom Args for the post status
	 * 
	 * @access protected
	 * @var string
	 */
	public $args;
	/**
	 * Construct
	 * @return void
	 */
	public function __construct()
	{
		#echo '<pre>'; print_r( $this ); echo '</pre>';
		// We need to have at least a post status name
		if ( ! isset( $this->post_status ) )
			return;
		add_action( 'init', array( $this, 'add_post_status' ), 0 );
		foreach ( array( 'post', 'post-new' ,'edit') as $hook )
			add_action( "admin_footer-{$hook}.php", array( $this,'extend_submitdiv_post_status' ) );
	}
	/**
	 * Add a new post status of "Unavailable"
	 * 
	 * @return void
	 */
	public function add_post_status()
	{
		global $wp_post_statuses;
		$defaults = array(
			 'label_count'               => false
			// defaults to FALSE
			,'hierarchical'              => false
			// defaults to FALSE
			,'public'                    => true
			// If NULL, then inherits "public"
			,'publicly_queryable'        => null
			// most important switch
			,'internal'                  => false
			// If NULL, inherits from "internal"
			,'exclude_from_search'       => null
			// If NULL, inherits from "internal"
			,'show_in_admin_all_list'    => null
			// If NULL, inherits from "internal"
			,'show_in_admin_status_list' => null
			// If NULL, will be set to FALSE
			,'protected'                 => null
			// If NULL, will be set to FALSE
			,'private'                   => null
			// not set by the core function - defaults to NULL
			,'show_in_admin_all'         => null
			// defaults to "post"
			,'capability_type'           => 'post'
			,'single_view_cap'           => null 
			// @internal use only - don't touch
			,'_builtin'                  => false
			,'_edit_link'                => 'post.php?post=%d'
		);
		// if FALSE, will take the 1st fn arg
		$defaults['label'] = __( 
		 	 ucwords( str_replace( 
		 	 	 array( '_', '-' )
				,array( ' ', ' ' )
		 	 	,$this->post_status
			 ) )
		 	,'nnpress' 
		 );
		// Care about counters:
		// If FALSE, will be set to array( $args->label, $args->label ), which is not desired
		$defaults['label_count'] = _n_noop( 
			 "{$defaults['label']} <span class='count'>(%s)</span>"
			,"{$defaults['label']} <span class='count'>(%s)</span>"
			,'nnpress'
		);
		// Register the status: Merge Args with defaults
		register_post_status( 
			 $this->post_status
			,wp_parse_args( 
				 $this->args
				,$defaults 
			 )
		);
	}
	/**
	 * Adds post status to the "submitdiv" Meta Box and post type WP List Table screens
	 * 
	 * @return void
	 */
	public function extend_submitdiv_post_status()
	{
		// Abort if we're on the wrong post type, but only if we got a restriction
		if ( isset( $this->post_type ) )
		{
			global $post_type;
			if ( is_array( $this->post_type ) )
			{
				if ( in_array( $post_type, $this->post_type ) )
					return;
			}
			elseif ( $this->post_type !== $post_type )
			{
				return;
			}
		}
		// Our post status and post type objects
		global $wp_post_statuses, $post;
		// Get all non-builtin post status and add them as <option>
		$options = $display = '';
		foreach ( $wp_post_statuses as $status )
		{
			if ( ! $status->_builtin )
			{
				// Match against the current posts status
				$selected = selected( $post->post_status, $status->name, false );
				// If we one of our custom post status is selected, remember it
				$selected AND $display = $status->label;
				// Build the options
				$options .= "<option{$selected} value='{$status->name}'>{$status->label}</option>";
			}
		}
		?>
		<script type="text/javascript">
			jQuery( document ).ready( function($) 
			{
				<?php
				// Add the selected post status label to the "Status: [Name] (Edit)" 
				if ( ! empty( $display ) ) : 
				?>
					$( '#post-status-display' ).html( '<?php echo $display; ?>' )
				<?php 
				endif; 
				// Add the options to the <select> element
				?>
				$( '.edit-post-status' ).one( 'click', function(e)
				{

					var select = $( '#post-status-select' ).find( 'select' );
					$( select ).append( "<?php echo $options; ?>" );

				} );
				$('.wp-list-table .editinline').one('click' , function(e)
				{
					
					var select = $('.inline-edit-status').find('select');
					$( select ).append( "<?php echo $options; ?>" );
				} );
			} );
		</script>
		<?php
	}
}

add_action( 'after_setup_theme', array( 'unavailable_post_status', 'init' ) );
class unavailable_post_status extends wp_custom_post_status
{
	/**
	 * @access protected
	 * @var string
	 */
	static protected $instance;
	/**
	 * Creates a new instance. Called on 'after_setup_theme'.
	 * May be used to access class methods from outside.
	 *
	 * @return void
	 */
	static public function init()
	{
		null === self :: $instance and self :: $instance = new self;
		return self :: $instance;
	}
	public function __construct()
	{
		// Set your data here. Only "$post_status" is required.
		$this->post_status = 'shipped';
		// The post types where you want to add the custom status. Allowed are string and array
		$this->post_type = 'nn_tracker';
		// @see parent class: defaults inside add_post_status()
		$this->args = array();
		parent :: __construct();
	}
}
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
			'supports'              => array( 'title','thumbnail', 'comments',),
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

	public function nnpress_tracker_type() {

		$labels = array(
			'name'                       => _x( 'Items Types', 'Taxonomy General Name', 'nnpress' ),
			'singular_name'              => _x( 'Item Type', 'Taxonomy Singular Name', 'nnpress' ),
			'menu_name'                  => __( 'Types', 'nnpress' ),
			'all_items'                  => __( 'All Types', 'nnpress' ),
			'parent_item'                => __( 'Parent Type', 'nnpress' ),
			'parent_item_colon'          => __( 'Parent Type:', 'nnpress' ),
			'new_item_name'              => __( 'New Item Type', 'nnpress' ),
			'add_new_item'               => __( 'Add New Type', 'nnpress' ),
			'edit_item'                  => __( 'Edit Item type', 'nnpress' ),
			'update_item'                => __( 'Update Item type', 'nnpress' ),
			'view_item'                  => __( 'View Item type', 'nnpress' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'nnpress' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'nnpress' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'nnpress' ),
			'popular_items'              => __( 'Popular Items', 'nnpress' ),
			'search_items'               => __( 'Search Items', 'nnpress' ),
			'not_found'                  => __( 'Not Found', 'nnpress' ),
			'no_terms'                   => __( 'No items', 'nnpress' ),
			'items_list'                 => __( 'Items list', 'nnpress' ),
			'items_list_navigation'      => __( 'Items list navigation', 'nnpress' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
		);
		register_taxonomy( 'tracker_type', array( 'nn_tracker' ), $args );

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

		register_post_status( 'recived', array(
			'label'                     => _x( 'Recived', 'post' ),
			'public'                    => true,
			'exclude_from_search'       => false,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Recived <span class="count">(%s)</span>', 'Local Post <span class="count">(%s)</span>' ),
		) );
	}

	public function ninteen_required_plugins(){

	    $plugins = array(
	        array(
	            'name'               => 'Meta Box',
	            'slug'               => 'meta-box',
	            'required'           => true,
	            'force_activation'   => flase,
	            'force_deactivation' => false,
	        ),

	    );

	    $config  = array(
		    'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    //
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',
	        'strings'          => array(
	            'page_title'                      => __( 'Install Required Plugins', 'glamo' ),
	            'menu_title'                      => __( 'Install Plugins', 'glamo' ),
	            'installing'                      => __( 'Installing Plugin: %s', 'glamo' ),
	            'oops'                            => __( 'Something went wrong with the plugin API.', 'glamo' ),
	            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
	            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
	            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
	            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
	            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
	            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
	            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
	            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
	            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
	            'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
	            'return'                          => __( 'Return to Required Plugins Installer', 'glamo' ),
	            'plugin_activated'                => __( 'Plugin activated successfully.', 'glamo' ),
	            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'glamo' ),
	            'nag_type'                        => 'updated',
	        )
	    );

    	tgmpa( $plugins, $config );

	}

	public function ninteen_meta_boxes( $meta_boxes )
		{
			
			$prefix = 'nnpress_';


			$meta_boxes[] = array(

				'title' => esc_html__( 'Package Details', 'nnpress' ),

				'post_types' => array( 'nn_tracker' ),
				// Where the meta box appear: normal (default), advanced, side. Optional.
				'context'    => 'normal',
				// Order of meta box: high (default), low. Optional.
				'priority'   => 'high',
				// Auto save: true, false (default). Optional.
				'autosave'   => true,
				'fields' => array(
					
					array(

						'name'       => esc_html__( 'Order Date', 'your-prefix' ),
						'id'         => $prefix .'order_datetime',
						'type'       => 'datetime',
						// jQuery datetime picker options.
						// For date options, see here http://api.jqueryui.com/datepicker
						// For time options, see here http://trentrichardson.com/examples/timepicker/
						'js_options' => array(
							'stepMinute'     => 15,
							'showTimepicker' => true,
						),
					),
					
					// WYSIWYG/RICH TEXT EDITOR
					array(
						'name'    => esc_html__( 'Item Description', 'nnpress' ),
						'id'      => $prefix .'item_decription',
						'type'    => 'wysiwyg',
						// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
						'raw'     => false,
						'options' => array(
							'textarea_rows' => 4,
							'teeny'         => true,
							'media_buttons' => false,
						),
					),
					// DIVIDER
					array(
						'type' => 'divider',
					),
					
				)
			);
			return $meta_boxes;
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
		$this->post_status = 'notfound';
		// The post types where you want to add the custom status. Allowed are string and array
		$this->post_type = 'nn_tracker';
		// @see parent class: defaults inside add_post_status()
		$this->args = array();
		parent :: __construct();
	}
}


<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://gmindia.tech
 * @since      1.0.0
 *
 * @package    Gmindia_Event_Management
 * @subpackage Gmindia_Event_Management/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Gmindia_Event_Management
 * @subpackage Gmindia_Event_Management/includes
 * @author     vishnu kumar <vk.asokan@gmindia.tech>
 */
class Gmindia_Event_Management_Loader {

    /**
     * The array of actions registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
     */
    protected $actions;

    /**
     * The array of filters registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
     */
    protected $filters;

    /**
     * Initialize the collections used to maintain the actions and filters.
     *
     * @since    1.0.0
     */
    public function __construct() {

        $this->actions = array();
        $this->filters = array();

    }

    /**
     * Add a new action to the collection to be registered with WordPress.
     *
     * @since    1.0.0
     * @param    string               $hook             The name of the WordPress action that is being registered.
     * @param    object               $component        A reference to the instance of the object on which the action is defined.
     * @param    string               $callback         The name of the function definition on the $component.
     * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
     * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
     */
    public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
        $this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
    }

    /**
     * Add a new filter to the collection to be registered with WordPress.
     *
     * @since    1.0.0
     * @param    string               $hook             The name of the WordPress filter that is being registered.
     * @param    object               $component        A reference to the instance of the object on which the filter is defined.
     * @param    string               $callback         The name of the function definition on the $component.
     * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
     * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
     */
    public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
        $this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
    }

    /**
     * A utility function that is used to register the actions and hooks into a single
     * collection.
     *
     * @since    1.0.0
     * @access   private
     * @param    array                $hooks            The collection of hooks that is being registered (that is, actions or filters).
     * @param    string               $hook             The name of the WordPress filter that is being registered.
     * @param    object               $component        A reference to the instance of the object on which the filter is defined.
     * @param    string               $callback         The name of the function definition on the $component.
     * @param    int                  $priority         The priority at which the function should be fired.
     * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback.
     * @return   array                                  The collection of actions and filters registered with WordPress.
     */
    private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

        $hooks[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args
        );

        return $hooks;

    }

    /**
     * Register the filters and actions with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {

        foreach ( $this->filters as $hook ) {
            add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
        }

        foreach ( $this->actions as $hook ) {
            add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
        }

    }

}



/**
 * Register a custom post type called "Event" with taxonomy registration.
 */
function custom_event_init() {
    $labels = array(
        'name'                  => _x( 'Événements', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Événement', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Événements', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Événement', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Événement', 'textdomain' ),
        'new_item'              => __( 'New Événement', 'textdomain' ),
        'edit_item'             => __( 'Edit Événement', 'textdomain' ),
        'view_item'             => __( 'View Événement', 'textdomain' ),
        'all_items'             => __( 'All Événements', 'textdomain' ),
        'search_items'          => __( 'Search Événements', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Événements:', 'textdomain' ),
        'not_found'             => __( 'No Événements found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No Événements found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Événement Cover Image', 'Overrides the “Featured Image” phrase for this post type.', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type.', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type.', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type.', 'textdomain' ),
        'archives'              => _x( 'Événement archives', 'The post type archive label used in nav menus.', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into Événement', 'Overrides the “Insert into post” phrase (used when inserting media into a post).', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Événement', 'Overrides the “Uploaded to this post” phrase (used when viewing media attached to a post).', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter evénements list', 'Screen reader text for the filter links heading on the post type listing screen.', 'textdomain' ),
        'items_list_navigation' => _x( 'Événements list navigation', 'Screen reader text for the pagination heading on the post type listing screen.', 'textdomain' ),
        'items_list'            => _x( 'Événements list', 'Screen reader text for the items list heading on the post type listing screen.', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'menu_icon'          => 'dashicons-calendar',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'evenement' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'gmi-event', $args ); // Registering the custom post type

//     // Registering taxonomy for the custom post type
//     register_taxonomy(
//         'gmi_event_category', // Taxonomy name
//         'gmi-event', // Associated post type
//         array(
//             'label'        => __( 'Événement Categories', 'textdomain' ),
//             'rewrite'      => array( 'slug' => 'event-category' ),
//             'hierarchical' => true,
//             'show_in_rest' => true,
//         )
//     );

//     // Registering taxonomy for the custom post type
//     register_taxonomy(
//         'gmi_location_category', // Taxonomy name
//         'gmi-event', // Associated post type
//         array(
//             'label'        => __( 'Événement Locations', 'textdomain' ),
//             'rewrite'      => array( 'slug' => 'location-category' ),
//             'hierarchical' => true,
//             'show_in_rest' => true,
//             'labels'       => array(
//                 'name'              => __( 'Événement Locations', 'textdomain' ),
//                 'singular_name'     => __( 'Événement Location', 'textdomain' ),
//                 'search_items'      => __( 'Search Locations', 'textdomain' ),
//                 'all_items'         => __( 'All Locations', 'textdomain' ),
//                 'parent_item'       => __( 'Parent Location', 'textdomain' ),
//                 'parent_item_colon' => __( 'Parent Location:', 'textdomain' ),
//                 'edit_item'         => __( 'Edit Location', 'textdomain' ),
//                 'update_item'       => __( 'Update Location', 'textdomain' ),
//                 'add_new_item'      => __( 'Add New Location', 'textdomain' ),
//                 'new_item_name'     => __( 'New Location Name', 'textdomain' ),
//                 'menu_name'         => __( 'Événement Locations', 'textdomain' ),
//             ),
//         )
//     );
	
	
	

	// Registering taxonomy for event tags
	register_taxonomy(
		'gmi_event_tag', // Taxonomy name
		'gmi-event', // Associated post type
		array(
			'label'        => __( 'Événement Tags', 'textdomain' ),
			'rewrite'      => array( 'slug' => 'event-tag' ),
			'hierarchical' => false,
			'show_in_rest' => true,
		)
	);

	// Modify the $args array to include 'taxonomies' parameter
	$args = array(
		'labels'             => $labels,
		'menu_icon'          => 'dashicons-calendar', 
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		'taxonomies'         => array('gmi_event_tag'), // Add event tag taxonomy
		'show_in_rest'       => true,
	);

	// Modify the taxonomy query to include tag based on user selection


    // Register custom field for event date range
    add_action( 'add_meta_boxes', 'add_event_date_meta_box' );
    add_action( 'save_post', 'save_event_date_meta_box' );
}

add_action( 'init', 'custom_event_init' );

// Add meta box for event date range
function add_event_date_meta_box() {
    add_meta_box(
        'event_date_meta_box',
        'Event Date, Time, and Venue',
        'event_date_meta_box_callback',
        'gmi-event',
        'normal',
        'default'
    );
}

// Callback function to display event date meta box
function event_date_meta_box_callback( $post ) {
    // Add nonce for security
    wp_nonce_field( basename( __FILE__ ), 'event_date_nonce' );

    // Retrieve current values for the fields
    $event_date = get_post_meta( $post->ID, 'event_date', true );
    $event_time = get_post_meta( $post->ID, 'event_time', true );
    $event_venue = get_post_meta( $post->ID, 'event_venue', true );

    // Output the HTML for the meta box
    ?>
    <p>
        <label for="event_date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" value="<?php echo esc_attr( $event_date ); ?>" />
    </p>
    <p>
        <label for="event_time">Event Time:</label>
        <input type="text" id="event_time" name="event_time" value="<?php echo esc_attr( $event_time ); ?>" />
    </p>
    <p>
        <label for="event_venue">Event Venue:</label>
        <input type="text" id="event_venue" name="event_venue" value="<?php echo esc_attr( $event_venue ); ?>" />
    </p>
    <?php
}

// Save event date meta box data
function save_event_date_meta_box( $post_id ) {
    // Check if nonce is set
    if ( ! isset( $_POST['event_date_nonce'] ) || ! wp_verify_nonce( $_POST['event_date_nonce'], basename( __FILE__ ) ) ) {
        return $post_id;
    }

    // Check if this is an autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    // Check user's permissions
    if ( 'gmi-event' === $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }

    // Save event date
    if ( isset( $_POST['event_date'] ) ) {
        update_post_meta( $post_id, 'event_date', sanitize_text_field( $_POST['event_date'] ) );
    }

    // Save event time
    if ( isset( $_POST['event_time'] ) ) {
        update_post_meta( $post_id, 'event_time', sanitize_text_field( $_POST['event_time'] ) );
    }

    // Save event venue
    if ( isset( $_POST['event_venue'] ) ) {
        update_post_meta( $post_id, 'event_venue', sanitize_text_field( $_POST['event_venue'] ) );
    }
}

function custom_post_body_class($classes) {
    global $post;

    // Check if it's a singular view of your custom post type
    if (is_singular('gmi-event')) {
        // Add your custom class to the body classes array
        $classes[] = 'elementor-kit-5';
    }

    return $classes;
}
add_filter('body_class', 'custom_post_body_class');

add_action( 'template_redirect', 'custom_event_template_redirect' );
function custom_event_template_redirect() {
    if ( is_singular( 'gmi-event' ) ) {
        include plugin_dir_path( __FILE__ ) . 'single-event-template.php';
        exit();
    }
}

function custom_event_archive_template( $template ) {
    if ( is_post_type_archive( 'gmi-event' ) ) {
        $new_template = plugin_dir_path( __FILE__ ) . 'archive-event.php';
        if ( file_exists( $new_template ) ) {
            return $new_template;
        }
    }
    return $template;
}
add_filter( 'template_include', 'custom_event_archive_template', 99 );

function theme_enqueue_scripts() {
    wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );



// Custom shortcode for post archive
function custom_post_archive_shortcode($atts) {
    ob_start();

    // Query the posts
    $query = new WP_Query(array(
        'post_type' => 'gmi-event', // Replace 'your_post_type' with your actual post type
        'posts_per_page' => -1 // -1 to retrieve all posts
    ));

    // Output the HTML structure
    ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <style>
                .event-grid {
                    display: flex;
                    flex-wrap: wrap;
                    margin: 0 auto;
                    max-width: 1260px;
                }

				.event-item {
					width: 100%;
					margin-bottom: 20px;
					padding: 10px;
					background: #fff;
					box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
					border-radius: 10px;
				}

                .event-item .event-thumbnail img {
                    width: 100%;
                	box-shadow: 0 2px 50px rgba(0, 0, 0, 0.08);
               		border-radius: 10px;
                   /* height: 200px;
                    object-fit: cover; */
                }
                
                .entry-content-event {
                    padding: 15px 0px;
                }

                .event-date-tag {
                    font-size: 12px;
                    font-weight: 600;
                    margin: 15px 0px 15px 0px;
                    padding: 7px 9px 6px 9px;
                    width: fit-content;
                    background-color: #F5F5F5;
                    border-radius: 4px 4px 4px 4px;
                }
                
                .excerpt {
                    max-height: 3 * 1.2em; /* Adjust line height and number of lines as needed */
                    overflow: hidden;
                    line-height: 1.2em; /* Ensure proper line height */
                }

                @media (max-width: 768px) {
                    .event-item {
                        width: 100%;
                    }
                    .event-item {
                        margin-bottom: 20px;
                        padding: 20px;
                        margin-right: 10px;
                        margin-left: 10px;
                    }
                }
            </style>
            
            <div class="event-grid">
                <?php
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        ?>
                        <div class="event-item">
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="event-thumbnail">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('large'); ?>
                                        </a>
                                    <?php endif; ?>
                                </div><!-- .event-thumbnail -->

                                <div>
                                    <?php
                                    $event_date = get_post_meta(get_the_ID(), 'event_date', true);

                                    if (!empty($event_date)) :
                                        // Attempt to create a DateTime object from the event date
                                        $date_object = DateTime::createFromFormat('Y-m-d', $event_date); // Adjust the input format as necessary

                                        if ($date_object) {
                                            // Format the date as 'Friday, March 31'
                                            $formatted_date = date_format($date_object, 'l, F j');
                                            // Convert to uppercase and echo
                                            echo '<p class="event-date-tag">' . strtoupper(esc_html($formatted_date)) . '</p>';
                                        } else {
                                            // Fallback in case the date format doesn't match or parsing fails
                                            echo '<p class="event-date-tag">' . esc_html($event_date) . '</p>';
                                        }
                                    endif;
                                    ?>
                                </div><!-- .entry-content -->


                                <div class="event-content">
                                    <header class="entry-header">
                                        <h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    </header><!-- .entry-header -->
									
									<?php
                                        $excerpt = get_the_excerpt();
                                        $excerpt = wp_trim_words($excerpt, 18, '...'); // Limit to 40 words
                                        echo '<div class="excerpt">' . $excerpt . '</div>';
                                    ?>

                                    <div class="entry-content-event">
                                        <?php
                                        $event_time = get_post_meta(get_the_ID(), 'event_time', true);
                                        $event_venue = get_post_meta(get_the_ID(), 'event_venue', true);

                                        if (!empty($event_time)) :
                                            echo '<p style="margin: 0;"><i class="far fa-clock"></i>  ' . esc_html($event_time) . '</p>';
                                        endif;

                                        if (!empty($event_venue)) :
                                            echo '<p style="margin: 0;"><i class="fas fa-map-marker-alt"></i>&nbsp;  ' . esc_html($event_venue) . '</p>';
                                        endif;
                                        ?>
                                    </div><!-- .entry-content -->
                                </div><!-- .event-content -->
                            </article><!-- #post-<?php the_ID(); ?> -->
                        </div><!-- .event-item -->
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p><?php esc_html_e('No events found.', 'textdomain'); ?></p>
                <?php endif; ?>
            </div><!-- .event-grid -->
        </main><!-- #main -->
    </div><!-- #primary -->
    <?php
    $output = ob_get_clean();
    return $output;
}
add_shortcode('gmi-event', 'custom_post_archive_shortcode');




class GMI_Event_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'gmi_event_widget',
            __( 'Recent Event Widget', 'text_domain' ),
            array(
                'description' => __( 'Displays recent GMI event posts', 'text_domain' ),
            )
        );
    }
	
	
	public function widget( $args, $instance ) {
    $query_args = array(
        'post_type'      => 'gmi-event',
        'posts_per_page' => $instance['posts_per_page'],
    );

    $query = new WP_Query( $query_args );

    if ( $query->have_posts() ) {
        echo $args['before_widget'];
		echo '<h3 class="widgettitle">' . $args['before_title'] . apply_filters( 'widget_title', 'Recent Events' ) . $args['after_title'] . '</h3>';
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_id = get_the_ID();
            echo '<div class="recent-post-widget">';
            echo '<div class="post-img" style="width: 100px; float: left; padding-right: 15px; padding-top: 15px;">';
            // Display the post thumbnail if it exists.
            if ( has_post_thumbnail( $post_id ) ) {
                echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( $post_id, 'thumbnail' ) . '</a>';
            }
            echo '</div>';
            echo '<div class="post-desc" style="height: 120px;">';
            // Display the post title.
            echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
            // Display the post date.
            $event_date = get_post_meta(get_the_ID(), 'event_date', true);
			$formatted_date = date("j F Y", strtotime($event_date));
            echo '<span class="date"><i class="fa fa-calendar"></i>' . esc_html($formatted_date) . '</span>';
            echo '</div>';
            echo '</div>';
        }
        echo $args['after_widget'];
        wp_reset_postdata();
    }
}



//     public function widget( $args, $instance ) {
//         $query_args = array(
//             'post_type'      => 'gmi-event',
//             'posts_per_page' => $instance['posts_per_page'],
//         );

//         $query = new WP_Query( $query_args );

//         if ( $query->have_posts() ) {
//             echo $args['before_widget'];
//             echo '<h3 class="widgettitle">' . $args['before_title'] . apply_filters( 'widget_title', 'Recent Event' ) . $args['after_title'] . '</h3>';
//             while ( $query->have_posts() ) {
//                 $query->the_post();
//                 echo '<p><a style="color: black;" href="' . get_permalink() . '">' . get_the_title() . '</a></p>';
//             }
//             echo $args['after_widget'];
//             wp_reset_postdata();
//         }
//     }

    public function form( $instance ) {
        $posts_per_page = ! empty( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : __( '5', 'text_domain' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e( 'Number of posts to display:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" type="text" value="<?php echo esc_attr( $posts_per_page ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['posts_per_page'] = ( ! empty( $new_instance['posts_per_page'] ) ) ? strip_tags( $new_instance['posts_per_page'] ) : '';
        return $instance;
    }
}

function register_gmi_event_widget() {
    register_widget( 'GMI_Event_Widget' );
}
add_action( 'widgets_init', 'register_gmi_event_widget' );




class Event_Tag_Widget extends WP_Widget {
    // Constructor
    public function __construct() {
        parent::__construct(
            'event_tag_widget',
            __( 'Event Tags', 'textdomain' ),
            array(
                'description' => __( 'Display event tags.', 'textdomain' ),
            )
        );
    }

    // Widget Output
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $args['before_widget'];

        // Display widget title
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // Display event tags
        $tags = get_terms( array(
            'taxonomy' => 'gmi_event_tag',
            'hide_empty' => false,
        ) );

        if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
            echo '<ul>';
            foreach ( $tags as $tag ) {
                echo '<li><a style="margin: 15px 0px 15px 0px; padding: 7px 9px 6px 9px; width: fit-content; background-color: #F5F5F5; border-radius: 4px 4px 4px 4px;" href="' . get_post_type_archive_link( 'gmi-event' ) . '?gmi_event_tag=' . $tag->slug . '">' . $tag->name . '</a></li>';
            }
            echo '</ul>';
        }

        echo $args['after_widget'];
    }

    // Widget Form
    public function form( $instance ) {
        $title = isset( $instance['title'] ) ? $instance['title'] : '';

        // Widget Title Field
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php
    }

    // Update Widget Settings
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
}

// Register Custom Widget
function register_event_tag_widget() {
    register_widget( 'Event_Tag_Widget' );
}
add_action( 'widgets_init', 'register_event_tag_widget' );


add_filter( 'get_the_archive_title', 'modify_archive_title' );



add_filter( 'get_the_archive_title', 'modify_archive_title' );
function modify_archive_title( $title ) {
    if ( is_post_type_archive( 'gmi-event' ) ) {
        $title = 'Événements' . single_term_title( ' / ', false );
    }
    return $title;
}


// function university_post_types() {
//   register_post_type('event', array(
//     'public' => true,
//     'show_in_rest' => true,
//     'labels' => array(
//       'name' => 'Events',
//       'add_new_item' => 'Add New Event',
//       'edit_item' => 'Edit Event',
//       'all_items' => 'All Events',
//       'singular_name' => 'Event'
//     ),
//     'menu_icon' => 'dashicons-calendar'
//   ));
// }
 
// add_action('init', 'university_post_types');



//  // Register custom post type
//  function custom_post_type_event() {
//  $labels = array(
//      'name'               => 'Events',
//      'singular_name'      => 'Event',
//      'menu_name'          => 'Events',
//      // Add more labels as needed
//  );

//  $args = array(
//      'labels'             => $labels,
//      'public'             => true,
//      'has_archive'        => true,
//      'rewrite'            => array( 'slug' => 'events' ),
//      // Add more arguments as needed
//  );

//  register_post_type( 'event', $args );
// }
// add_action( 'init', 'custom_post_type_event' );

// // Flush rewrite rules on plugin activation
// function event_management_plugin_activate() {
//  custom_post_type_event();
//  flush_rewrite_rules();
// }
// register_activation_hook( __FILE__, 'event_management_plugin_activate' );

// // Flush rewrite rules on plugin deactivation
// function event_management_plugin_deactivate() {
//  flush_rewrite_rules();
// }
// register_deactivation_hook( __FILE__, 'event_management_plugin_deactivate' );
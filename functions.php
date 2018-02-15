<?php
/**
 * Review Site functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Review_Site
 */

if ( ! function_exists( 'review_site_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function review_site_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Review Site, use a find and replace
		 * to change 'review-site' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'review-site', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'Primary Menu' => esc_html__( 'primary-menu', 'review-site' ),
			'Movies Menu' => esc_html__( 'movies-menu', 'review-site' ),
			'Books Menu' => esc_html__( 'books-menu', 'review-site' ),
			'Games Menu' => esc_html__( 'games-menu', 'review-site' ),
			'Blog Menu' => esc_html__( 'blog-menu', 'review-site' ),
			'Quicklinks Menu' => esc_html__( 'quicklinks-menu', 'review-site' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'review_site_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'review_site_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function review_site_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'review_site_content_width', 640 );
}
add_action( 'after_setup_theme', 'review_site_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function review_site_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Quicklinks', 'review-site' ),
		'id'            => 'quicklinks',
		'description'   => esc_html__( 'Add widgets here.', 'review-site' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'About', 'review-site' ),
		'id'            => 'about',
		'description'   => esc_html__( 'Add widgets here.', 'review-site' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'review_site_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function review_site_scripts() {
	//styles
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7', 'all' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/fontawesome.min.css', array(), '', 'all' );
	wp_enqueue_style( 'review-site-style', get_stylesheet_uri() );

	//scripts
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
	wp_enqueue_script( 'rating', get_template_directory_uri() . '/js/jquery.starrating.min.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'review_site_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*
	-------------------------
	Movies Custom Post Type
	-------------------------
 */
function movies_custom_post_type() {
	$movies_labels = array(
		'name'				=> 'Movies',
		'singular_name'		=> 'Movie',
		'add_new'			=> 'Add Movie',
		'all_items'			=> 'All Movies',
		'add_new_item'		=> 'Add Movie',
		'edit_item'			=> 'Edit Movie',
		'new_item'			=> 'New Movie',
		'view_item'			=> 'View Movie',
		'search_item'		=> 'Search Movies',
		'not_found'			=> 'No movie found',
		'not_found-in_trash'=> 'No movie found in trash',
		'parent_item_colon'	=> 'Parent Item'
	);
	$movies_args = array(
		'labels'			=> $movies_labels,
		'public'			=> true,
		'has_archive'		=> true,
		'publicly_queryable'=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'movies' ),
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'supports'			=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'comments' ),
		'menu_position'		=> 5,
		'menu_icon'			=> 'dashicons-feedback',
		'exclude_from_search'=> false
	);
	register_post_type( 'movies', $movies_args );
}
add_action( 'init', 'movies_custom_post_type' );

//Movies Custom Taxonomies
function movies_custom_taxonomies() {
	$movies_labels = array(
		'name'				=> 'Movies Types',
		'singular_name'		=> 'Movie Type',
		'search_items'		=> 'Search Movies Types',
		'all_items'			=> 'All Movie Types',
		'parent_item'		=> 'Parent Movie Types',
		'parent_item_colon'	=> 'Parent Movie Types:',
		'edit_item'			=> 'Edit Movie Type',
		'update_item'		=> 'Update Movie Type',
		'add_new_item'		=> 'Add New Movie Type',
		'new_item_name'		=> 'New Type Movie Type',
		'menu_name'			=> 'Movie Types'
	);
	$movies_args = array(
		'hierarchical'		=> true,
		'labels'			=> $movies_labels,
		'show_ui'			=> true,
		'show_admin_column'	=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'movie_type' )
	);
	register_taxonomy( 'movie_type', array( 'movies' ), $movies_args );
}
add_action( 'init', 'movies_custom_taxonomies' );

/*
	-------------------------
	Books Custom Post Type
	-------------------------
 */
function books_custom_post_type() {
	$books_labels = array(
		'name'				=> 'Books',
		'singular_name'		=> 'Book',
		'add_new'			=> 'Add Book',
		'all_items'			=> 'All Books',
		'add_new_item'		=> 'Add Book',
		'edit_item'			=> 'Edit Book',
		'new_item'			=> 'New Book',
		'view_item'			=> 'View Book',
		'search_item'		=> 'Search Books',
		'not_found'			=> 'No books found',
		'not_found-in_trash'=> 'No books found in trash',
		'parent_item_colon'	=> 'Parent Item'
	);
	$books_args = array(
		'labels'			=> $books_labels,
		'public'			=> true,
		'has_archive'		=> true,
		'publicly_queryable'=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'books' ),
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'supports'			=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'comments' ),
		'menu_position'		=> 5,
		'menu_icon'			=> 'dashicons-feedback',
		'exclude_from_search'=> false
	);
	register_post_type( 'books', $books_args );
}
add_action( 'init', 'books_custom_post_type' );

//Books Custom Taxonomies
function books_custom_taxonomies() {
	$books_labels = array(
		'name'				=> 'Books Types',
		'singular_name'		=> 'Book Type',
		'search_items'		=> 'Search Books Types',
		'all_items'			=> 'All Book Types',
		'parent_item'		=> 'Parent Book Types',
		'parent_item_colon'	=> 'Parent Book Types:',
		'edit_item'			=> 'Edit Book Type',
		'update_item'		=> 'Update Book Type',
		'add_new_item'		=> 'Add New Book Type',
		'new_item_name'		=> 'New Type Book Type',
		'menu_name'			=> 'Book Types'
	);
	$books_args = array(
		'hierarchical'		=> true,
		'labels'			=> $books_labels,
		'show_ui'			=> true,
		'show_admin_column'	=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'book_type' )
	);
	register_taxonomy( 'book_type', array( 'books' ), $books_args );
}
add_action( 'init', 'books_custom_taxonomies' );

/*
	-------------------------
	Games Custom Post Type
	-------------------------
 */
function games_custom_post_type() {
	$games_labels = array(
		'name'				=> 'Games',
		'singular_name'		=> 'Game',
		'add_new'			=> 'Add Game',
		'all_items'			=> 'All Games',
		'add_new_item'		=> 'Add Game',
		'edit_item'			=> 'Edit Game',
		'new_item'			=> 'New Game',
		'view_item'			=> 'View Game',
		'search_item'		=> 'Search Games',
		'not_found'			=> 'No games found',
		'not_found-in_trash'=> 'No games found in trash',
		'parent_item_colon'	=> 'Parent Item'
	);
	$games_args = array(
		'labels'			=> $games_labels,
		'public'			=> true,
		'has_archive'		=> true,
		'publicly_queryable'=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'games' ),
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'supports'			=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'comments' ),
		'menu_position'		=> 5,
		'menu_icon'			=> 'dashicons-feedback',
		'exclude_from_search'=> false
	);
	register_post_type( 'games', $games_args );
}
add_action( 'init', 'games_custom_post_type' );

//Games Custom Taxonomies
function games_custom_taxonomies() {
	$games_labels = array(
		'name'				=> 'Games Types',
		'singular_name'		=> 'Game Type',
		'search_items'		=> 'Search Games Types',
		'all_items'			=> 'All Games Types',
		'parent_item'		=> 'Parent Game Types',
		'parent_item_colon'	=> 'Parent Game Types:',
		'edit_item'			=> 'Edit Game Type',
		'update_item'		=> 'Update Game Type',
		'add_new_item'		=> 'Add New Game Type',
		'new_item_name'		=> 'New Type Game Type',
		'menu_name'			=> 'Game Types'
	);
	$games_args = array(
		'hierarchical'		=> true,
		'labels'			=> $games_labels,
		'show_ui'			=> true,
		'show_admin_column'	=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'game_type' )
	);
	register_taxonomy( 'game_type', array( 'games' ), $games_args );
}
add_action( 'init', 'games_custom_taxonomies' );

/**
*
*	Functions for editing comment form
*
*/

//Comment Template Filters
function ea_comment_textarea_placeholder( $args ) {
	$args['comment_field']        = str_replace( 'textarea', 'textarea placeholder="comment..."', $args['comment_field'] );
	return $args;
}
add_filter( 'comment_form_defaults', 'ea_comment_textarea_placeholder' );

 // Comment Form Fields Placeholder
function be_comment_form_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$label     = $req ? '*' : ' ' . __( '(optional)', 'text-domain' );
	$aria_req  = $req ? "aria-required='true'" : '';

	foreach( $fields as &$field ) {
		$field = str_replace( 'id="author"', 'id="author" placeholder="name"', $field );
		$field = str_replace( 'id="email"', 'id="email" placeholder="email"', $field );
	}
	return $fields;
}
add_filter( 'comment_form_default_fields', 'be_comment_form_fields' );

// Add fields after default fields above the comment box, always visible
add_action( 'comment_form_logged_in_after', 'additional_fields' );
add_action( 'comment_form_after_fields', 'additional_fields' );

function additional_fields () {
	echo '<p class="comment-form-rating">
	<span class="commentratingbox">';

	for( $i=1; $i <= 10; $i++ )
	echo '<span class="commentrating"><input type="radio" name="rating" id="rating" value="'. $i .'"/>'. $i .'</span>';

	echo'</span></p>';

}

// Save the comment meta data along with comment
add_action( 'comment_post', 'save_comment_meta_data' );
function save_comment_meta_data( $comment_id ) {
	if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != '') )
	$rating = wp_filter_nohtml_kses($_POST['rating']);
	add_comment_meta( $comment_id, 'rating', $rating );
}

// Add the filter to check if the comment meta data has been filled or not
add_filter( 'preprocess_comment', 'verify_comment_meta_data' );
function verify_comment_meta_data( $commentdata ) {
	if ( ! isset( $_POST['rating'] ) )
	wp_die( __( 'Error: You did not add your rating. Hit the BACK button of your Web browser and resubmit your comment with rating.' ) );
	return $commentdata;
}

add_filter( 'get_comment_date', 'meks_convert_to_time_ago', 10, 1 ); //override date display

/* Callback function for post time and date filter hooks */
function meks_convert_to_time_ago() {
	printf( _x( '%s ago', '%s = human-readable time difference', 'your-text-domain' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
}

function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
        <div class="comment-author vcard">
					<?php
            if ( $args['avatar_size'] = 80 ) {
                echo get_avatar( $comment, $args['avatar_size'] );
            } ?>
							<ul class="wrap"><?php
						printf( __( '<li class="title">%s</li>' ), get_comment_author_link() ); ?>
						<a class="time" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
                /* translators: 1: date, 2: time */
                printf(
                    __('<li>%1$s</li>'),
                    get_comment_date()
                ); ?>
            </a>
					</ul>
						<?php
						?>
        </div><?php
        if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php
        } ?>
        <div class="comment-meta commentmetadata"><?php
            edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
        </div>

				<?php $rating = get_comment_meta( get_comment_ID(), 'rating'); ?>
				<div class="comment-text-wrap">
					<p class="rating"><img src="<?php echo get_template_directory_uri() . '/img/star-small.png' ?>" alt=""> <?php echo $rating[0]; ?></p>
					<p><?php comment_text();?></p>
				</div>

        <div class="reply"><?php
                comment_reply_link(
                    array_merge(
                        $args,
                        array(
                            'add_below' => $add_below,
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth']
                        )
                    )
                ); ?>
        </div><?php
    if ( 'div' != $args['style'] ) : ?>
        </div><?php
    endif;
}

function wpbeginner_numeric_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="navigation"><ul>' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="previus">%s</li>' . "\n", get_previous_posts_link('<') );

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li class="next">%s</li>' . "\n", get_next_posts_link('>') );

    echo '</ul></div>' . "\n";
}

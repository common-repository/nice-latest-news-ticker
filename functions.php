<?php 
// Order Column Value
function nice_ticker_custom_column($columns)

{
	unset( $columns['date'] );
   $columns['id'] = __('Nice Ticker Shortcode','nice_ticker');
   	$columns['date'] = __('Date','nice_ticker');;


   return $columns;
}

add_filter('manage_nice_ltn_ticker_posts_columns', 'nice_ticker_custom_column');



// Add Shortcode in posts Column
function nice_ticker_custom_column_data($column, $post_id)

{

global $post;

$post_id = $post -> ID;	

?>
<input type="text" name="shortc_value" style="width:180px;" value='[nice_ticker id="<?php echo $post_id ?>"]'>

<?php

}

add_action('manage_nice_ltn_ticker_posts_custom_column', 'nice_ticker_custom_column_data', 10, 2);


// Function Register
function register_nice_ticker_post_type() {

	$labels = array(
		'name'               => 'Nice News Ticker',
		'singular_name'      => 'Nice News Ticker',
		'add_new'            => 'Add New Ticker',
		'add_new_item'       => 'Add New News Ticker  ',
		'edit_item'          => 'Edit News Ticker',
		'new_item'           => 'New News Ticker',
		'all_items'          => 'All News Ticker',
		'view_item'          => 'View News Ticker',
		'search_items'       => 'Search News Ticker',
		'not_found'          =>  'No News Ticker found',
		'not_found_in_trash' => 'No News Ticker in Trash',
		'menu_name'          => 'Nice News Ticker',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'nice_ltn_ticker' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-format-chat',
		'supports'           => array( 'title')
	);

	register_post_type( 'nice_ltn_ticker', $args );

}
add_action( 'init', 'register_nice_ticker_post_type' );


// Remove Row
function nice_ticker_remove_row_actions( $actions )
{
    if( get_post_type() === 'nice_ltn_ticker' )
        unset( $actions['view'] );
    return $actions;
}
add_filter( 'post_row_actions', 'nice_ticker_remove_row_actions', 10, 1 );
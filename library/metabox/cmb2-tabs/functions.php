<?php

function nice_ticker_tabs_metaboxes($post_id) {

	$box_options = array(
		'id'           => 'nice_ticker_metabox_field',
		'title'        => __( 'Nice Ticker Sections', 'cmb2' ),
		'object_types' => array( 'nice_ltn_ticker' ),
		'show_names'   => true,
		'show_in_rest' => 'read_and_write',

	);

    $post_id =0;

	if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
    $post_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
  }


	// Setup meta box
	$cmb = new_cmb2_box( $box_options );

	// setting tabs
	$tabs_setting           = array(
		'config' => $box_options,
		'tabs'   => array()
	);


	$tabs_setting['tabs'][] = array(
		'id'     => 'nice_ticker_tab1',
		'title'  => __( 'Nice Ticker Shortcodes', 'cmb2' ),
		'fields' => array(


			array(
                  'name' => 'Nice Ticker For Post And Page',
                  'id' => 'nice_ticker_shortcode1',
                  'type' => 'title',
                  'default' => '[nice_ticker id="'.$post_id.'"]',
             'desc' => '<input type=\'text\' value=\'[nice_ticker id="'.$post_id.'"]\'>'
			),

			array(
                  'name' => 'Shortcode For Using Theme File',
                  'id' => 'nice_ticker_shortcode2',
                  'type' => 'title',
                  'default' => '<?php echo do_shortcode("[nice_ticker id="'.$post_id.'"]");',
                  'desc' => '<input type=\'text\' value=\'<?php echo do_shortcode("[nice_ticker id="'.$post_id.'"]"); ?>\'>'
			),
			
		
		)
	);




$tabs_setting['tabs'][] = array(
		'id'     => 'nice_ticker_tab2',
		'title'  => __( 'Nice Ticker Contents', 'cmb2' ),
		'fields' => array(
					
			array(
				'id'      => 'nice_ticker_cl_repeat_group',
				'desc'   => 'Nice News Ticker Repeatable Field',
				'type'    => 'group',
				'options' => array(
					'group_title'   => __( '{#} Nice Ticker Group Title', 'cmb2' ),
					'add_button'    => __( 'Add Nice Ticker Item', 'cmb2' ),
					'remove_button' => __( 'Remove Nice Ticker Item', 'cmb2' ),
					'sortable'      => true,
					'closed'   => true,
					'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ),
				),
				'after_group' => 'nice_ticker_add_js_for_repeatable_titles',
				
				'fields'  => array(
                    

					array(
						
						'name' => 'News Ticker Title',
                        'id' => 'nice_ticker_title',
                        'type' => 'text'
					),
					
					array(
						'name' => __( 'News Ticker Title Link', 'cmb2' ),
						'id'   => 'nice_ticker_title_link',
						'type' => 'text_url',
					)
				)
			)
		)
	);





	$tabs_setting['tabs'][] = array(
		'id'     => 'nice_ticker_tab3',
		'title'  => __( 'Settings', 'cmb2' ),
		'fields' => array(


                  array(
						
						'name' => 'News Ticker Heading',
                        'id' => 'nice_ticker_heading',
                        'type' => 'text'
					),

                   array(
						
						'name' => 'News Ticker Heading Font Color',
                        'id' => 'nice_ticker_heading_font_color',
                        'type' => 'colorpicker',
                         'default' => '#fff',
					),

               	array(
				'name'    => 'News Ticker Heading Background Color',
	            'id'      => 'nice_ticker_heading_bg',
	            'type'    => 'colorpicker',
	            'default' => '#1e2969',
			),  

				array(
				'name'    => 'News Ticker Heading Hover Background Color',
	            'id'      => 'nice_ticker_heading_bg_hover',
	            'type'    => 'colorpicker',
	            'default' => '#060e3c',
			),

					

			
		)
	);
	

	// set tabs
	$cmb->add_field( array(
		'id'   => '__news_ticker_tabs',
		'type' => 'tabs',
		'tabs' => $tabs_setting
	) );
}

add_filter( 'cmb2_init', 'nice_ticker_tabs_metaboxes');



// Scripts For Repeatable Title

function nice_ticker_add_js_for_repeatable_titles() {
	add_action( is_admin() ? 'admin_footer' : 'wp_footer', 'niceticker_add_js_for_repeatable_titles_to_footer' );
}

function niceticker_add_js_for_repeatable_titles_to_footer() {
	?>
	<script type="text/javascript">
	jQuery( function( $ ) {
		var $box = $( document.getElementById( 'nice_ticker_metabox_field' ) );

		var replaceTitles = function() {
			$box.find( '.cmb-group-title' ).each( function() {
				var $this = $( this );
				var txt = $this.next().find( '[id$="nice_ticker_title"]' ).val();
				var rowindex;

				if ( ! txt ) {
					txt = $box.find( '[data-grouptitle]' ).data( 'grouptitle' );
					if ( txt ) {
						rowindex = $this.parents( '[data-iterator]' ).data( 'iterator' );
						txt = txt.replace( '{#}', ( rowindex + 1 ) );
					}
				}

				if ( txt ) {
					$this.text( txt );
				}
			});
		};

		var replaceOnKeyUp = function( evt ) {
			var $this = $( evt.target );
			var id = 'title';

			if ( evt.target.id.indexOf(id, evt.target.id.length - id.length) !== -1 ) {
				$this.parents( '.cmb-row.cmb-repeatable-grouping' ).find( '.cmb-group-title' ).text( $this.val() );
			}
		};

		$box
			.on( 'cmb2_add_row cmb2_shift_rows_complete', replaceTitles )
			.on( 'keyup', replaceOnKeyUp );

		replaceTitles();
	});
	</script>
	<?php
}
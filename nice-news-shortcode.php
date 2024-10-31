<?php 

// Short Code Field For Nice News Ticker
function nice_ticker_shortcode_field($atts)

{
    
	  extract(shortcode_atts(array( 'id' => NULL), $atts));

    global $post;

    $output = '';

    $post_id = (NULL === $id) ? $post -> ID : $id;

         
  $post_meta = get_post_meta($post_id, 'nice_ticker_cl_repeat_group', true);
    
    $nice_ticker_heading =get_post_meta($post_id,'nice_ticker_heading', true);

    $nice_ticker_heading_font_color =get_post_meta($post_id,'nice_ticker_heading_font_color', true);

    $nice_ticker_heading_bg =get_post_meta($post_id,'nice_ticker_heading_bg', true);

    $nice_ticker_heading_bg_hover =get_post_meta($post_id,'nice_ticker_heading_bg_hover', true);


  $output = "<div class='nice_ticker_container'>
    <div class='wrap'>
    <div class='jctkr-label  label_style".$post_id."'>
                <strong>".$nice_ticker_heading."</strong>
              </div>
    <div class='js-conveyor-newsticker'>
  <ul>";
      if(!empty($post_meta)):

    foreach($post_meta as $single_value):

   $output .= "<li>";
   if(!empty($single_value['nice_ticker_title_link'])):

     $output .= "<a href='".$single_value['nice_ticker_title_link']."'>
                <span>".$single_value['nice_ticker_title']."</b></span>
                </a>";
    else:

     $output .= "<span>".$single_value['nice_ticker_title']."</b></span>

    </li>";

  endif;

  endforeach;
  
  endif;

  $output .="</ul> </div> </div> </div>";

?>

<style type="text/css">

.label_style<?php echo $post_id; ?> {   

  background:<?php echo $nice_ticker_heading_bg; ?>; 
  color:<?php echo $nice_ticker_heading_font_color; ?>;
  height: 35px;
  padding:1px 18px;
  font-size: 19px;
  text-shadow: 0 1px 2px rgba(69, 78, 140,1);
  cursor: default;
  display: inline-block;

 }

 .label_style<?php echo $post_id; ?>:hover{
  background:<?php echo $nice_ticker_heading_bg_hover; ?>;
}

</style>

<script>
  jQuery(function() {
    jQuery('.js-conveyor-newsticker').jConveyorTicker({reverse_elm: true});
  });
</script>

  
	<?php	
  
    return $output;

}

add_shortcode('nice_ticker', 'nice_ticker_shortcode_field');
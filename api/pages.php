<?php
// required : wordpress 5.7.1
// wp data API

require( '../wp-blog-header.php' );

$the_query = null;
$the_query = new WP_Query(
  array( 'post_type' => 'page' , 'posts_per_page'=>-1) 
);

$items = [];
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
//echo '<div>' . get_the_content() . '</div>';
    $item = array(
      'ID' => $post->ID,
      'post_title' => get_the_title() ,
      'post_content' => get_the_content() ,
      'post_date' => get_the_date(),
    );
    $items[] = $item;
	}
	wp_reset_postdata();
}
//var_dump($items);
echo json_encode($items);



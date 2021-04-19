<?php
// required : wordpress 5.7.1
// wp posts data API
// /api/posts.php

require( '../wp-blog-header.php' );

$PAGE = 1;
$the_query = null;
if(isset($_GET['page'])){
  $PAGE = $_GET['page'];
  $the_query = new WP_Query(
    array( 'post_type' => 'post' , 'paged' => (int)$PAGE ) 
  );
}else{
  $the_query = new WP_Query(
    array( 'post_type' => 'post' , 'posts_per_page'=>-1) 
  );
}
$items = [];
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
    $item = array(
      'ID' => $post->ID,
      'post_title' => get_the_title() ,
      'post_content' => get_the_content() ,
      'post_date' => get_the_date(),
    );
    $items[] = $item;
//    echo '<div>' . $post->ID . '</div>';
	}
	wp_reset_postdata();
}
//var_dump($items);
echo json_encode($items);



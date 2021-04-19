<?php
// required : wordpress 5.7.1
// wp posts data API

require( '../wp-blog-header.php' );

$ID = 0;
if(isset($_GET['id'])){
  $ID = $_GET['id'];
//  var_dump($_GET['id']);
}
$the_query = new WP_Query(
  array( 'post_type' => 'post' , 'post__in' => array($ID), ) 
);
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

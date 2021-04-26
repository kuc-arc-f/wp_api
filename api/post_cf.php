<?php
// required : wordpress 5.7.1
// posts custom field data API

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
    /**/
    //echo '<div>' . $category_id . ", name=" .$category_name . '</div>';
    $custom_field = get_post_custom( $post->ID );
//var_dump($custom_field);
    $categories = get_the_category();
    $category_id = '';
    $category_name = '';
    if ( $categories ) {
      $category = $categories[0];
      $category_id = $category->term_id;
      $category_name = $category->name;
    }    
    $item = array(
      'ID' => $post->ID,
      'post_title' => get_the_title() ,
      'post_content' => get_the_content() ,
      'post_date' => get_the_date(),
      'category_id' => $category_id,
      'category_name' => $category_name,
      'post_custom' => $custom_field,
    );
    $items[] = $item;
//echo '<div>' . $post->ID . '</div>';
	}
	wp_reset_postdata();
}
// var_dump($items);
echo json_encode($items);



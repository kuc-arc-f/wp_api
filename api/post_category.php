<?php
// required : wordpress 5.7.1
// wp posts data API

require( '../wp-blog-header.php' );

$CAT_ID = 0;
if(isset($_GET['cat_id'])){
  $CAT_ID = $_GET['cat_id'];
//var_dump($CAT_ID);
//exit();
}
$the_query = new WP_Query( 
  'cat=' . $CAT_ID
);
$items = [];
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
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
    );
    $items[] = $item;
//echo '<div>' . $post->ID . '</div>';
	}
	wp_reset_postdata();
}
//var_dump($items);
echo json_encode($items);



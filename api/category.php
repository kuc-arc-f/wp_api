<?php
// required : wordpress 5.7.1
// wp data API

require( '../wp-blog-header.php' );

$args = array(
  'orderby' => 'name',
  'parent' => 0
  );
$categories = get_categories( $args );
$items = [];
foreach ( $categories as $category ) {
//  var_dump($category );
  $item = array(
    'ID' => $category->cat_ID,
    'name' => $category->name,
  );
  $items[] = $item;  
//	echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><br/>';
}
//var_dump($items);
echo json_encode($items);




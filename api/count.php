<?php
// required : wordpress 5.7.1
// wp posts data API

require( '../wp-blog-header.php' );

$the_query = new WP_Query(
  array( 'post_type' => 'post' ) 
);
$ret = array("count" => $the_query->found_posts );
//var_dump($the_query->post_count );
echo json_encode($ret);

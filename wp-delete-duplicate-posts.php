<?php
/*
Plugin Name: Delete all duplicate posts
Plugin URI: 
Description: Deletes duplicate posts based on their title
Author: podz
Version: 2.0
Author URI:
*/
function WPDeleteDuplicatePosts(){
	global $wpduplicate;
	$wpdeletingpost = $wpduplicate->prefix;
	
	$wpduplicate->query("DELETE bad_rows . * FROM ".$wpdeletingpost."posts AS bad_rows INNER JOIN (
		SELECT ".$wpdeletingpost."posts.post_title, MIN( ".$wpdeletingpost."posts.ID ) AS min_id
		FROM ".$wpdeletingpost."posts
		GROUP BY post_title
		HAVING COUNT( * ) >1
		) AS good_rows ON ( good_rows.post_title = bad_rows.post_title
		AND good_rows.min_id <> bad_rows.ID )");
}
add_action('publish_post', 'WPDeleteDuplicatePosts');

?>
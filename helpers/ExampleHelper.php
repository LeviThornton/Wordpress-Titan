<?php
/**
 * ExampleViewHelper class is an example view helper to that will display
 * list of post with no limit by constructing a wp_query and passing it to the 
 * postUnsortedList() method.
 * 
 * @example ExampleViewHelper:this(array("posts_per_page",-1))->postUnsortedList();
 * 
 */
class ExampleViewHelper extends wpTitan {

	public function postUnsortedList() {

		$loop = $this->_results;

		echo "<ul>";
		while ( $loop->have_posts() ) {
			$loop->the_post();
			echo '<li>'.get_the_title().'</li>';
		}
		echo "</ul>";
		
		wp_reset_postdata();
	}
}
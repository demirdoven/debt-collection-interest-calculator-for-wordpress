function custom_scripts(){
    global $post;
	wp_enqueue_style('datepicker', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/themes/base/jquery-ui.css', array(), '21.06.2017', 'all');
	wp_enqueue_script('colorpickerjs', get_template_directory_uri() . '/custom.js', array('jquery', 'jquery-ui-datepicker'), '21.06.2017', 'all');
}
add_action('wp_enqueue_scripts', 'custom_scripts');

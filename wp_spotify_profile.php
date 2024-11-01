<?php
/*
Plugin Name: Spotify Profile Link
Plugin URI: http://leonbarrett.com
Description: Adds a button to your Wordpress blog, with a link to your Spotify profile
Author: Leon Barrett
Version: 0.1
Author URI: http://leonbarrett.com
*/

function add_styles(){

$plugin_dir = get_bloginfo('url').'/wp-content/plugins/spotify-profile-link/';
	
	$text =  '<link rel="stylesheet" href="'.$plugin_dir.'spotify_styles.css" type="text/css" />';
	
	echo($text);

}
 
function widget_spotify_profile($args) {
  extract($args);
 
  $options = get_option("widget_spotify_profile");
  if (!is_array( $options ))
{
$options = array('username' => '', 'linktext' => 'Add me on Spotify');
  }

$plugin_dir = get_bloginfo('url').'/wp-content/plugins/spotify-profile-link/';
   echo $before_widget;
?>  

  <div id="spotify_add_widget">
  		
  		<a href="http://www.spotify.com" target="_blank"><img src="<?php echo $plugin_dir;?>logo.png" alt="Spotify" id="spotify_logo"/></a>

		<div id="spotify_link">
			<a href="http://open.spotify.com/user/<?php echo($options['username'])?>" target="_blank" class="big_button"><span><?php echo($options['linktext'])?></span></a>
		</div>
	
		
	<div class="clear"></div>
	
		
	</div>
<?php
 echo $after_widget;
//return; 

}
 
function spotify_profile_control()
{
  $options = get_option("widget_spotify_profile");
  if (!is_array( $options ))
{
$options = array('username' => '', 'linktext' => 'Add me on Spotify', 'usestyles' => '1');
  }
 
  if ($_POST['spotify_profile_userName'])
  {
    $options['username'] = htmlspecialchars($_POST['spotify_profile_userName']);
    $options['linktext'] = htmlspecialchars($_POST['spotify_profile_linkText']);
    update_option("widget_spotify_profile", $options);
  }
 
?>
  <p>
    <label for="spotify_profile_userName">Spotify Username: </label>
    <input type="text" id="spotify_profile_userName" name="spotify_profile_userName" value="<?php echo $options['username'];?>" />
  </p>
  <p>
    <label for="spotify_profile_linkText">Link display text: </label>
    <input type="text" id="spotify_profile_linkText" name="spotify_profile_linkText" value="<?php echo $options['linktext'];?>" />
  </p>
<?php
}
 
function spotify_profile_init()
{
  register_sidebar_widget(__('Spotify Profile Link'), 'widget_spotify_profile');
  register_widget_control(   'Spotify Profile Link', 'spotify_profile_control');
}

add_action('wp_head', 'add_styles');

add_action("plugins_loaded", "spotify_profile_init");


?>
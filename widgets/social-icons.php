<?php
/**
 * Closemarketing
 *
 * @package WordPress
 * @subpackage Closemarketing
 * @author Closemarketing <info@closemarketing.es>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Function that creates the widget
 *
 * @return void
 */
function widget_wsg_social() {
	register_widget( 'WSG_Social' );
}
add_action( 'widgets_init', 'widget_wsg_social' );

/**
 * Class for the widget
 */
class WSG_Social extends WP_Widget {

	function __construct() {
		$widget_ops = array(
            'classname' => 'widget_social', 
            'description' => __('Adds social icons with URLs included in Yoast SEO', 'widgets-so-genesis'
        ));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('socialtext', __('Social Icons','widgets-so-genesis'), $widget_ops, $control_ops);
	}

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'iconsize' => '' , 'iconstyle' => '', 'title' =>'' ) );

        if(isset($instance['customclass']) ) $customclass = $instance['customclass']; else $customclass = '';
        if(isset($instance['tripadvisor']) ) $tripadvisor = $instance['tripadvisor']; else $tripadvisor = '';
        $title = esc_attr($instance['title']);
        $iconsize = esc_textarea($instance['iconsize']);
        $iconstyle = esc_textarea($instance['iconstyle']);   
    ?>
    <p><?php _e('It uses the URLs defined in Yoast SEO / Social tab.','widgets-so-genesis');?></p>
    
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'widgets-so-genesis'); ?></label>
        <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" style="width:100%;"/>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('customclass'); ?>"><?php _e('Custom class for Icon:', 'widgets-so-genesis'); ?></label>
      <input id="<?php echo $this->get_field_id('customclass'); ?>" name="<?php echo $this->get_field_name('customclass'); ?>" type="text" value="<?php echo $customclass; ?>"  style="width:100%"/>
      <p><?php _e('If it is in blank, it will use fa class from fontawesome.','widgets-so-genesis');?></p>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'iconsize' ); ?> ">
            <?php _e('Icon Size', 'widgets-so-genesis'); ?>:
        </label>
        <select id="<?php echo $this->get_field_id( 'iconsize' ); ?>" name="<?php echo $this->get_field_name( 'iconsize' ); ?>">

            <option value="fa-5x" <?php
                if($instance['iconsize'] == "fa-5x")
                    echo 'selected="selected"';
            ?>><?php _e('Extra Large','widgets-so-genesis');?> 5x</option>

            <option value="fa-4x" <?php
                if($instance['iconsize'] == "fa-4x")
                    echo 'selected="selected"';
            ?>><?php _e('Large','widgets-so-genesis');?> 4x</option>

            <option value="fa-3x" <?php
                if($instance['iconsize'] == "fa-3x")
                    echo 'selected="selected"';
            ?>><?php _e('Medium','widgets-so-genesis');?> 3x</option>

            <option value="fa-2x" <?php
                if($instance['iconsize'] == "fa-2x")
                    echo 'selected="selected"';
            ?>><?php _e('Small','widgets-so-genesis');?> 2x</option>

            <option value="fa-lg" <?php
                if($instance['iconsize'] == "fa-lg")
                    echo 'selected="selected"';
            ?>><?php _e('Extra Small','widgets-so-genesis');?> 1x</option>
        </select>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'iconstyle' ); ?> ">
            <?php _e('Icon Style', 'widgets-so-genesis'); ?>:
        </label>
        <select id="<?php echo $this->get_field_id( 'iconstyle' ); ?>" name="<?php echo $this->get_field_name( 'iconstyle' ); ?>">
            <option value="" <?php
                if($instance['iconstyle'] == "")
                    echo 'selected="selected"';
            ?>><?php _e('Simple','widgets-so-genesis');?></option>

            <option value="-square" <?php
                if($instance['iconstyle'] == "-square")
                    echo 'selected="selected"';
            ?>><?php _e('Square','widgets-so-genesis');?></option>
        </select>
    </p>
    <h3><?php _e('Shows other social that are not in Yoast.', 'widgets-so-genesis'); ?></h3>
    <p>   
        <label for="<?php echo $this->get_field_id('tripadvisor'); ?>"><?php _e('Tripadvisor URL:', 'widgets-so-genesis'); ?></label>
        <input id="<?php echo $this->get_field_id('tripadvisor'); ?>" name="<?php echo $this->get_field_name('tripadvisor'); ?>" type="text" value="<?php echo $tripadvisor; ?>"  style="width:100%"/>
    </p>
    <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] =  $new_instance['title'];
        $instance['iconsize'] =  $new_instance['iconsize'];
        $instance['iconstyle'] =  $new_instance['iconstyle'];
        $instance['customclass'] = $new_instance['customclass'];
        $instance['tripadvisor'] = $new_instance['tripadvisor'];
        return $instance;
    }

	function widget( $args, $instance ) {
		extract($args);
		$iconsize = apply_filters( 'widget_iconsize', empty( $instance['iconsize'] ) ? '' : $instance['iconsize'], $instance );
		$iconstyle = apply_filters( 'widget_iconstyle', empty( $instance['iconstyle'] ) ? '' : $instance['iconstyle'], $instance );
        if(isset($instance['title'])) $title =$instance['title']; else $title = '';
        if(isset($instance['customclass']) ) $classIcon = $instance['customclass']; else $classIcon = 'fa';
        if(isset($instance['tripadvisor']) ) $tripadvisor = $instance['tripadvisor']; else $tripadvisor = '';

		echo $before_widget; 
        
        $wpseo_social = get_option('wpseo_social'); 
        
        if($title) echo '<h3 class="widget-title">'.$title.'</h3>';

        if($wpseo_social['facebook_site'])
            echo '<a href="'.$wpseo_social['facebook_site'].'"><i class="'.$classIcon.' '.$iconsize.' '.$classIcon.'-facebook'.$iconstyle.'" rel="nofollow"></i></a>';
        if($wpseo_social['twitter_site'])
            echo '<a href="https://twitter.com/'.$wpseo_social['twitter_site'].'"><i class="'.$classIcon.' '.$iconsize.' '.$classIcon.'-twitter'.$iconstyle.'" rel="nofollow"></i></a>';
        if($wpseo_social['linkedin_url'])
            echo '<a href="'.$wpseo_social['linkedin_url'].'"><i class="'.$classIcon.' '.$iconsize.' '.$classIcon.'-linkedin'.$iconstyle.'" rel="nofollow"></i></a>';
        if($wpseo_social['instagram_url'])
            echo '<a href="'.$wpseo_social['instagram_url'].'"><i class="'.$classIcon.' '.$iconsize.' '.$classIcon.'-instagram'.$iconstyle.'" rel="nofollow"></i></a>';
        if($wpseo_social['google_plus_url'])
            echo '<a href="'.$wpseo_social['google_plus_url'].'"><i class="'.$classIcon.' '.$iconsize.' '.$classIcon.'-google-plus'.$iconstyle.'" rel="nofollow"></i></a>';
        if($wpseo_social['youtube_url'])
            echo '<a href="'.$wpseo_social['youtube_url'].'"><i class="'.$classIcon.' '.$iconsize.' '.$classIcon.'-youtube'.$iconstyle.'" rel="nofollow"></i></a>';
        if($wpseo_social['pinterest_url'])
            echo '<a href="'.$wpseo_social['pinterest_url'].'"><i class="'.$classIcon.' '.$iconsize.' '.$classIcon.'-pinterest'.$iconstyle.'" rel="nofollow"></i></a>';
        if($tripadvisor)
            echo '<a href="'.$tripadvisor.'"><i class="'.$classIcon.' '.$iconsize.' '.$classIcon.'-tripadvisor'.$iconstyle.'" rel="nofollow"></i></a>';

		echo $after_widget;
	}


} //from class

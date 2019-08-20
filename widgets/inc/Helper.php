<?php 
namespace HubTagAddonsElementor\Widgets\Inc; 

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size as Group_Control_Image_Size;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Utils as Utils;



trait Helper 

{
    /**
     * Get all elementor page templates
     *
     * @return array
     */
    public function ht_get_page_templates()
    {
        $page_templates = get_posts(array(
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ));

        $options = array();

        if (!empty($page_templates) && !is_wp_error($page_templates)) {
            foreach ($page_templates as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }
        return $options;
    }




}

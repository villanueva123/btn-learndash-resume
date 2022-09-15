<?php
/**
 * Plugin Name: Learndash Resume Inside Course Grid
 * Description: Add Resume Button Inside the Course Grid
 * Version: 1.0.0
 * Author: Business Tech Ninjas
 * Author URI: http://businesstechninjas.com/
 * Plugin URI: http://businesstechninjas.com/
 * Text Domain: btn-learndash-resume
 */

 if (defined('ABSPATH') ) {
        if ( in_array( 'sfwd-lms/sfwd_lms.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            define('BTN_LEARNDASH_RESUME_PLUGIN_DIR', __DIR__ . '/');
            require_once BTN_LEARNDASH_RESUME_PLUGIN_DIR . 'classes/btn-learndash-resume.php';
            btn_courses_resume();
        }
 }

?>
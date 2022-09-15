<?php
class btn_courses_resume{

    /**
     * Init The Class
     */
    public function init(){
        $this->plugins_loaded();
    }

    /**
	 * Plugins Loaded Functionality
	 */
    function plugins_loaded(){
            add_filter("ld_course_list", [$this, "course_list_add_resume_button" ], 10, 3);
            add_filter("learndash_course_grid_class",[$this, "course_grid_course_class" ], 10, 2);
    }

    //Add Course Resume Button
    function course_list_add_resume_button($output, $atts, $filter){
        $btn_course_lists = get_posts( $filter );
        $content = "";
        foreach ( $btn_course_lists as $course ) {
            $id = $course->ID;
            $resume = do_shortcode('[ld_course_resume course_id="'.$id.'"]');
            if(!empty($resume)){
                $content .= "<div class=\"btn-course-grid-course-resume\" data-id=\"btn-course-grid-id-{$id}\">";
                   $content .= do_shortcode('[ld_course_resume course_id="'.$id.'"]');
                $content .="</div>";
            }
       }
        $output .= $content;
        $output .="<script>
                    (function($) {
                        var resumeButton = document.querySelectorAll('.btn-course-grid-course-resume');
                        resumeButton.forEach((resume, index) => {
                            var wrapper = resume.getAttribute('data-id'),
                                resumeHtml = resume.outerHTML;
                            document.querySelector('.'+wrapper+' .course-progress-wrap').insertAdjacentHTML('afterend', resumeHtml);
                            resume.remove();
                        });
                      })( jQuery );
        </script>";
        return $output;
    }


    //Add Class with unique id
    function course_grid_course_class($course_class, $course_id){
        $course_class .= "btn-course-grid-id-{$course_id}" ;
        return $course_class;
    }


    /**
     * Returns the instance.
     *
     * @since  1.0.0
     * @access public
     * @return object
     */
    public static function get_instance() {
      static $instance = null;
      if ( is_null( $instance ) ) {
        $instance = new self;
        $instance->init();

      }
      return $instance;
    }

    /**
     * Private Construct
     *
     * @since  1.0.0
     * @access private
     */
    private function __construct(){}

}

/**
 * Gets the instance of the `btn_courses` class.
 *
 * @since  1.0.0
 * @access public
 * @return object
*/
function btn_courses_resume(){
    return btn_courses_resume::get_instance();
}

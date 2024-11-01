<?php
/**
 * Adds Simple Info Widget Widget
 */

class Simple_Info_Widget extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        parent::__construct(
            'siw_widget', // Base ID
            'Simple Info Widget', // Name
            array('description' => __('Easily display your business phone number, address and hours.', 'siw'),) // Args
        );

        add_action('wp_enqueue_scripts', array($this, 'add_siw_widget_css'));

    }


    /**
     * Adds Open Table Widget Stylesheets
     */

    function add_siw_widget_css()
    {

        //Stylesheet
        $css = plugins_url(SIW_PLUGIN_NAME . '/includes/style/simple-info-widget.css', dirname(__FILE__));
        wp_register_style('siw_widget', $css);
        wp_enqueue_style('siw_widget');


    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args   Widget arguments.
     * @param array $instance Saved values from database.
     */
    function widget($args, $instance)
    {
        extract($args);
        if (isset($instance['title'])) $title = apply_filters('widget_title', $instance['title']);
        $phoneLabel = $instance['phone_label'];
        $phone = $instance['phone'];
        $addressLabel = $instance['address_label'];
        $address = $instance['address'];
        $hoursLabel = $instance['hours_label'];
        $hours = $instance['hours'];

        /*
         * Output Widget Content
         */
        //Widget Output
        if (isset($before_widget)) echo $before_widget;

        // if the title is set & the user hasn't disabled title output
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        ?>

        <div class="simple-info-widget">
            <ul>
                <li class="simple-info-phone">
                    <span class="simple-info-label"><?php echo empty($phoneLabel) ? 'Phone' : $phoneLabel; ?></span> <span class="simple-info-info"><?php echo $phone; ?></span>
                </li>
                <li class="simple-info-address">
                    <span class="simple-info-label"><?php echo empty($addressLabel) ? 'Address' : $addressLabel; ?></span> <span class="simple-info-info"><address><?php echo wpautop($address); ?></address></span>
                </li>
                <li class="simple-info-hours">
                    <span class="simple-info-label"><?php echo empty($hoursLabel) ? 'Hours' : $hoursLabel; ?></span> <span class="simple-info-info"><?php echo wpautop($hours); ?></span>
                </li>
            </ul>
        </div>


        <?php

        if (isset($after_widget)) echo $after_widget;

    }


    /**
     * @DESC: Saves the widget options
     * @SEE WP_Widget::update
     */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['phone_label'] = strip_tags($new_instance['phone_label']);
        $instance['phone'] = strip_tags($new_instance['phone']);
        $instance['address_label'] = strip_tags($new_instance['address_label']);
        $instance['address'] = strip_tags($new_instance['address']);
        $instance['hours_label'] = strip_tags($new_instance['hours_label']);
        $instance['hours'] = strip_tags($new_instance['hours']);

        return $instance;
    }


    /**
     * Back-end widget form.
     * @see WP_Widget::form()
     */
    function form($instance)
    {

        $title = esc_attr($instance['title']);
        $phoneLabel = esc_attr($instance['phone_label']);
        $phone = esc_attr($instance['phone']);
        $addressLabel = esc_attr($instance['address_label']);
        $address = esc_attr($instance['address']);
        $hoursLabel = esc_attr($instance['hours_label']);
        $hours = esc_attr($instance['hours']);


        include('includes/widget-form.php');


    } //end form function

} //end Open_Table_Widget Class

/*
 * @DESC: Register Open Table widget
 */
add_action('widgets_init', create_function('', 'register_widget( "Simple_Info_Widget" );'));



<?php
/*
 *  @description: Widget form options in WP-Admin
 *  @since 1.0
 *  @created: 08/08/13
 */
?>

<!-- Title -->
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
</p>

<!-- Phone Label -->
<p>
    <label for="<?php echo $this->get_field_id('phone_label'); ?>"><?php _e('Phone Label', 'siw'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('phone_label'); ?>" name="<?php echo $this->get_field_name('phone_label'); ?>" type="text" value="<?php echo $phoneLabel; ?>" placeholder="Phone"/>
</p>
<!-- Phone -->
<p>
    <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone', 'siw'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" placeholder="888-555-1532"/>
</p>

<!-- Address Label -->
<p>
    <label for="<?php echo $this->get_field_id('address_label'); ?>"><?php _e('Address Label', 'siw'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('address_label'); ?>" name="<?php echo $this->get_field_name('address_label'); ?>" type="text" value="<?php echo $addressLabel; ?>" placeholder="Address" />
</p>
<!-- Address -->
<p>
    <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address Label', 'siw'); ?></label>
    <textarea class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" rows="3" cols="25"><?php echo $address; ?></textarea>
</p>

<!-- Hours Label -->
<p>
    <label for="<?php echo $this->get_field_id('hours_label'); ?>"><?php _e('Hours Label', 'siw'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('hours_label'); ?>" name="<?php echo $this->get_field_name('hours_label'); ?>" type="text" value="<?php echo $hoursLabel; ?>" placeholder="Hours" />
</p>
<!-- Hours -->
<p>
    <label for="<?php echo $this->get_field_id('hours'); ?>"><?php _e('Hours', 'siw'); ?></label>
    <textarea class="widefat" id="<?php echo $this->get_field_id('hours'); ?>" name="<?php echo $this->get_field_name('hours'); ?>" rows="3" cols="25"><?php echo $hours; ?></textarea>
</p>
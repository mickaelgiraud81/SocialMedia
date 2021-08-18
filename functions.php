<?php

add_action( 'widgets_init', 'new_social_zone' );

function new_social_zone() {

    register_widget( 'SocialMedia_widget');
}
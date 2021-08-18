<?php

add_action( 'widgets_init', 'new_social_zone' );

function new_social_zone() {

    register_sidebar( array(
        'name'          => 'icone media réseaux sociaux',
        'id'            => 'nouvelle_zone',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
        'class'         => 'icons_social',
    ) );
}
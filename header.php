<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">

    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>

    <!-- google font "Josefin Sans" -->
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:200,300,400,600' rel='stylesheet' type='text/css'>
    <!-- google font "Crimson Text" -->
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,600" rel="stylesheet">


</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

    <header id="masthead" class="site-header" role="banner">
        <div class="header-content">
            <ul class="menu menu-categories">
                <li>
                    <a href="/">
                        accueil
                    </a>
                </li>
                <?php

                //for each category, show 5 posts
                $cat_args = array(
                    'orderby' => 'name',
                    'order' => 'ASC'
                );
                $categories = get_categories($cat_args);

                foreach ($categories as $category) {
                    $post_args = array(
                        'showposts' => 1,
                        'category__in' => array($category->term_id),
                        'caller_get_posts' => 1
                    );

                    $header_posts = get_posts($post_args);


                    if ($header_posts) {
                        foreach ($header_posts as $header_post) {

                            //print_r($header_post);
                            //setup_postdata($header_post); ?>
                            <li>
                                <a href="<?php echo $header_post->guid ?>">
                                    <?php echo $category->name; ?>
                                </a>
                            </li>
                            <?php
                        } // foreach($posts
                    } // if ($posts
                } // foreach($categories
                ?>
            </ul>

            <ul class="menu menu-contact">
                <li>
                    <a href="https://www.instagram.com/atelier109paris/" title="atelier109paris" target="_blank">
                        instagram
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/alexgastaut/" target="_blank">
                        facebook
                    </a>
                </li>
                <?php
                // other pages
                $pages = get_pages();
                foreach ($pages as $page) {
                    ?>
                    <li>
                        <a href="<?php echo get_page_link($page->ID); ?>">
                            <?php echo $page->post_title; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </header><!-- #masthead -->


    <div class="site-content-contain">
        <div id="content" class="site-content">

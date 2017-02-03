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
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <?php wp_list_categories(array(
                    // todo order by custom
                    'title_li' => __(''), // title
                    'orderby' => 'name',
                    'show_count' => false
                )); ?>
            </ul>

            <ul class="menu menu-contact">
                <li>
                    <a href="#">
                        instagram
                    </a>
                </li>
                <li>
                    <a href="#">
                        facebook
                    </a>
                </li>
                <li>
                    <a href="#">
                        biographie
                    </a>
                </li>
                <li>
                    <a href="#">
                        contact
                    </a>
                </li>
            </ul>
        </div>

    </header><!-- #masthead -->


    <div class="site-content-contain">
        <div id="content" class="site-content">

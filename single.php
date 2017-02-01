<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

    <div class="wrap single">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php
                $cat_name = get_the_category($post->ID)[0]->cat_name;
                $all_posts = query_posts('post_type=post&orderby=date&order=ASC&category_name=' . $cat_name);

                // find index number of the post in its category
                $post_index = 0;
                foreach ($all_posts as $p){
                    $post_index++;
                    if($p->ID === $post->ID){
                        break;
                    }
                }

                // reset the global $post array before using it in the loop
                wp_reset_query();

                // pan to (add extra zeros)
                if(strlen(strval($post_index)) < 2){
                    $post_index = "0" . strval($post_index);
                }

                function getAttachedImageFromPost($the_post, $format = 'thumbnail'){
                    $post_attachments = get_posts(array(
                        'post_type' => 'attachment',
                        'numberposts' => -1,
                        'post_status' => null,
                        'post_parent' => $the_post->ID
                    ));
                    $img_src = $post_attachments ? wp_get_attachment_image_src($post_attachments[0]->ID, $format) : 'no attachment image in this post';
                    //print_r($prev_post);

                    return '<img src="' . $img_src[0] . '" alt="' . $the_post->post_title . '">';
                }

                /* Start the Loop */
                while (have_posts()) : the_post();

                    // get post image
                    $attachments = get_posts(array(
                        'post_type' => 'attachment',
                        'numberposts' => -1,
                        'post_status' => null,
                        'post_parent' => $post->ID
                    ));
                    $post_image = $attachments ? wp_get_attachment_image($attachments[0]->ID, 'medium') : 'no attachment image in this post';

                    ?>
                    <div class="post-container">
                        <div class="nav-container prev-post-container">
                            <div class="nav-link prev-post-link">
                                <?php
                                $prev_post = get_previous_post(true);
                                if($prev_post){
                                    $prev_post_image = getAttachedImageFromPost($prev_post);
                                    previous_post_link('%link', '<span class="arrow icon-prev"></span>' . $prev_post_image, true);
                                }
                                ?>
                            </div>
                        </div>

                        <div class="post-content">
                            <!-- IMAGE POST -->
                            <div class="image-container">
                                <a href="/" class="button-back">
                                    &lt; retour à l'accueil
                                </a>
                                <div class="image-post">
                                    <div class="pattern"></div>
                                    <?php echo $post_image; ?>
                                </div>
                                <a href="#" class="button JS_toggler" data-toggler-group="popin" data-toggler-id="popin-more">
                                    more details
                                </a>
                            </div>

                            <!-- TEXT CONTENT -->
                            <div class="content-container">
                                <div class="post-number">
                                    &lt;<?php echo $post_index; ?>&gt;
                                </div>
                                <h1 class="post-title">
                                    <?php the_title(); ?>
                                </h1>

                                <div class="the-content">
                                    <?php the_content(); ?>
                                </div>

                                <a href="#" class="button button-big bg-2">
                                    commander
                                </a>
                            </div>
                        </div>


                        <div class="nav-container next-post-container">
                            <div class="nav-link next-post-link">
                                <?php
                                $next_post = get_next_post(true);
                                if($next_post){
                                    $next_post_image = getAttachedImageFromPost($next_post);
                                    next_post_link('%link', '<span class="arrow icon-next"></span>' . $next_post_image, true);
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                    <?php

                endwhile; // End of the loop.
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->



    <div class="popin popin-add-list JS_item_toggler" data-toggler-itemid="popin-more" data-toggler-group="popin">

        <!-- MASK -->
        <div class="mask JS_toggler active" data-toggler-id="popin-more" data-toggler-group="popin" data-toggler-action="close"></div>


        <div class="content-scroll">
            <div class="content-wrapper">
                <div class="popin-content">
                    <div class="popin-ground">
                        <span class="popin-close JS_toggler active" data-toggler-id="popin-more" data-toggler-group="popin" data-toggler-action="close">
                            <i class="icon-close"></i>
                        </span>

                        lol

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();

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
                $all_posts = query_posts('post_type=post&orderby=date&order=ASCe&category_name=' . $cat_name);

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
                                $prev_post_attachments = get_posts(array(
                                    'post_type' => 'attachment',
                                    'numberposts' => -1,
                                    'post_status' => null,
                                    'post_parent' => $prev_post->ID
                                ));
                                $prev_post_image = $prev_post_attachments ? wp_get_attachment_image_src($prev_post_attachments[0]->ID, 'thumbnail') : 'no attachment image in this post';
                                //print_r($prev_post);

                                $toto = '<img src="' . $prev_post_image[0] . '" alt="' . $prev_post->post_title . '">';
                                ?>

                                <?php previous_post_link('%link', $toto, TRUE); ?>
                            </div>
                        </div>

                        <div class="post-content">
                            <!-- IMAGE POST -->
                            <div class="image-container">
                                <a href="/" class="button-back">
                                    &lt; retour à l'accueil
                                </a>
                                <div class="image-post">
                                    <?php echo $post_image; ?>
                                </div>
                                <a href="#" class="button">
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
                                $next_post_attachments = get_posts(array(
                                    'post_type' => 'attachment',
                                    'numberposts' => -1,
                                    'post_status' => null,
                                    'post_parent' => $next_post->ID
                                ));
                                $next_post_image = $next_post_attachments ? wp_get_attachment_image_src($next_post_attachments[0]->ID, 'thumbnail') : 'no attachment image in this post';
                                //print_r($prev_post);

                                $toto2 = '<img src="' . $next_post_image[0] . '" alt="' . $next_post->post_title . '">';
                                ?>

                                <?php next_post_link('%link', $toto2, TRUE); ?>
                            </div>
                        </div>
                    </div>


                    <?php

                endwhile; // End of the loop.
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->

<?php get_footer();

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
                                <?php previous_post_link('%link', 'previous post in category', TRUE); ?>
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
                                    &lt;01&gt;
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
                                <?php next_post_link('%link', 'next post in category', TRUE); ?>
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

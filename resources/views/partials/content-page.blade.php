@php the_content() @endphp

@if(is_page('publications'))

@include('partials.files')


@endif

@if(is_page('steering-group'))

@if(is_user_logged_in())
<?php
    $loop = new WP_Query(array('post_type' => 'steering_group', 'paged' => $paged, 'orderby' => 'title'));
    if ($loop->have_posts()) :
        echo '<div class="flex">';
        while ($loop->have_posts()) : $loop->the_post(); ?>
            <a href="<?php the_permalink(); ?>"  class="h-48 w-48 block bg-blue-600 hover:bg-blue-800 rounded p-4 shadow-inner shadow-md mr-4 mb-4 ">
                <h2 class="text-white">
                        {{date('F j, Y', strtotime( get_the_title() ))}} 
                </h2>

                
    </a>
        <?php endwhile;
        echo '</div>';

        if ($loop->max_num_pages > 1) : ?>
            <div id="nav-below" class="navigation">
                <div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Previous', 'domain')); ?></div>
                <div class="nav-next"><?php previous_posts_link(__('Next <span class="meta-nav">&rarr;</span>', 'domain')); ?></div>
            </div>
        <?php endif;
    endif;
    wp_reset_postdata();
?>

@else

{!!login_with_ajax()!!}

@endif

@endif
{!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}

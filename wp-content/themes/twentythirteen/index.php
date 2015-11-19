<?php 
/*page of News*/
get_header();

?>

<div id="primary" class="content-area back_news">
    <div id="content" class="site-content" role="main">
        <?php if (have_posts()): ?>
			<?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('content', get_post_format()); ?>
            <?php endwhile; ?>

            <?php twentythirteen_paging_nav(); ?>
        <?php else : ?>
            <?php get_template_part('content', 'none'); ?>
        <?php endif; ?>

    </div><!-- #content -->
    
    <div class="floatLeft rightClmn absol_right24">
        <div class="prev vert_butt"></div>	
        <div class="gallery vertical_gal">
            <ul>
                <li>
                    <a href="/kypit-valuty/tera-online/">
                        <img data-game="Купить золото" src="/wp-content/themes/twentythirteen/images/vertical/terra.png" alt=""/>
                    </a>
                </li>
                <li>
                    <a href="/kypit-valuty/lineage-2/">
                        <img data-game="Купить адену" src="/wp-content/themes/twentythirteen/images/vertical/lineage2.png" alt=""/>
                    </a>
                </li>
                <li>
                    <a href="/kypit-valuty/perfect-world/" >
                        <img data-game="Купить юани" src="/wp-content/themes/twentythirteen/images/vertical/perfect-world.png" alt=""/>
                    </a>
                </li>
                <li>
                    <a href="/kypit-valuty/arche-age/">
                        <img data-game="Купить золото" src="/wp-content/themes/twentythirteen/images/vertical/arche-age.png" alt=""/>
                    </a>
                </li>
                <li>
                    <a href="/kypit-valuty/aion/">
                        <img data-game="Купить кинары" src="/wp-content/themes/twentythirteen/images/vertical/aion.png" alt=""/>
                    </a>
                </li>
            </ul>
        </div>
        <div class="next vert_butt"></div>				
    </div><!--.floatLeft .rightClmn-->
</div><!-- #primary -->



<?php //get_sidebar(); ?>
<?php get_footer(); ?>

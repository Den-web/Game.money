<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <meta name="viewport" content="width=device-width">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <?php wp_head(); ?>
    </head>
    <!--mark up-->
    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
            <header id="masthead" class="site-header" role="banner">
                <div id="navbar" class="navbar">
                    <nav id="site-navigation" class="navigation main-navigation" role="navigation">
                        <button class="menu-toggle"></button>
                        <a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e('Skip to content', 'twentythirteen'); ?>"><?php _e('Skip to content', 'twentythirteen'); ?></a>
                        <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu')); ?>
                        <div class="login_top">
                            <div class='login-left'>
                                <a href="#" class="add_user">
                                </a>
                            </div>
                            <div class='login-left loginz' >

                            </div>
                        </div>
                    </nav><!-- #site-navigation -->
                </div><!-- #navbar -->
                <div id="logo" class="main-navigation logoWidth" onClick='location.href = "/"'></div>

                <?php if (is_front_page()) { // действие для главной страницы ?>
                    <div class="margin0auto width_980 firstPanelBaner" >
                        <div class="loginBack">
                            <a class="recall-button rcl-login" href="/lichnyj-kabinet/">
                                <span class="loginEnter"></span>
                            </a>
                            <a href="#"><span class="newUser"></span></a>
                        </div>
                    </div>
                    <?php echo do_shortcode("[espro-slider id=43]"); ?>
                    <div class="secondPanelBaner-wraper">
                        <div class="margin0auto width_980 secondPanelBaner" ></div>
                        <div class="bottomPanelBaner" >
                            <div class="first_bottom_butt butt_bott">
                                <a href="/postavshikam/">
                                    <div class="font-size14 font-roboto-bold textTransform color_def textDecoration_none">
                                        Продать
                                    </div>
                                    <div class="font-size12 font-roboto-bold textTransform color_def textDecoration_none">
                                        валюту
                                    </div>
                                </a>
                            </div>
                            <div class="second_bottom_butt butt_bott">
                                <a href="/kypit-zoloto/">
                                    <img src="/wp-content/themes/twentythirteen/images/money_bottom.png" />
                                    <div class="font-roboto-bold textTransform color_def font-size10 textDecoration_none">
                                        Купить валюту
                                    </div>
                                </a>
                            </div>
                            <div class="third_bottom_butt butt_bott">
                                <a href="/kypit-personaja/">
                                    <img src="/wp-content/themes/twentythirteen/images/people_bot.png" />
                                    <div class="font-roboto-bold textTransform color_def font-size10 textDecoration_none">
                                        Купить персонажа
                                    </div>
                                </a>
                            </div>
                            <div class="four_bottom_butt butt_bott">
                                <a href="/postavshikam/">
                                    <div class="font-size14 font-roboto-bold textTransform color_def textDecoration_none">
                                        Продать
                                    </div>
                                    <div class="font-size12 font-roboto-bold textTransform color_def textDecoration_none">
                                        персонажа
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div><!--.secondPanelBaner-wraper-->    
                <?php } else { ?>
                    <div class="thirdPanel-wraper" >    
                        <?php
                        $page = single_post_title('', false);
                        if ($page === 'Новости') {
                            echo "<div class='title_h1 font-size18 font-roboto-bold textTransform'>" . $page . "</div>";
                        } 
                        elseif ($page === 'О нас') {
                            echo "<div class='title_h1 font-size18 font-roboto-bold textTransform'>" . $page . "</div>";
                        } 
                        elseif ($page === 'Поставщикам') {
                            echo "<div class='title_h1 font-size18 font-roboto-bold textTransform'>" . $page . "</div>";
                        } 
                        elseif ($page === 'ОплатаДоставка') {
                            echo "<div class='title_h1 font-size18 font-roboto-bold textTransform'>Оплата Доставка</div>";
                        } 
                        elseif ($page === 'Гарант') {
                            echo "<div class='title_h1 font-size18 font-roboto-bold textTransform'>" . $page . " сделки</div>";
                        } 
                        elseif ($page === 'Купить валюту') {
                            echo "<div class='title_h1 font-size18 font-roboto-bold textTransform'>Купить валюту</div>";
                        } 
                        elseif ($page === 'Купить персонажа') {
                            echo "<div class='title_h1 font-size18 font-roboto-bold textTransform'>" . $page . "</div>";
                        } 
                        else if ($page === 'Личный кабинет') {
                            echo "<div class='title_h1 font-size18 font-roboto-bold textTransform'>" . $page . "</div>";
                        }
                        else if ($page === 'Купить валюту Lineage 2') {
                            echo "<div class='title_h1 font-size18 font-roboto-bold textTransform lineagefont'>" . $page . "</div>";
                        }
                         else if ($page === 'Купить валюту Tera Online') {
                            echo "<div class='title_h1 font-size14 font-roboto-bold textTransform'>" . $page . "</div>";
                        }
                        else if ($page === 'Купить валюту Perfect world') {
                            echo "<div class='title_h1 font-size12 font-roboto-bold textTransform lineheight12px'>" . $page . "</div>";
                        }
                        else if ($page === 'Купить валюту Arche Age') {
                            echo "<div class='title_h1 font-size14 font-roboto-bold textTransform lineheight12px'>" . $page . "</div>";
                        }
                        else if ($page === 'Купить валюту Aion') {
                            echo "<div class='title_h1 font-size15 font-roboto-bold textTransform lineheight12px'>" . $page . "</div>";
                        }
                    }//else 
                    ?>
                </div>    
            </header><!-- #masthead -->

            <div id="main" class="site-main">

<?php global $rcl_options, $user_LK; ?>

<?php rcl_before(); ?>

<div id="rcl-<?php echo $user_LK; ?>" class="wprecallblock profie">
    <?php rcl_notice(); ?>

    <?php $class = (isset($rcl_options['buttons_place'])&&$rcl_options['buttons_place']==1)? "left-buttons":""; ?>
    <div id="rcl-tabs" style="width:75%; float:left">
        <div id="lk-content" class="rcl-content">
            <?php rcl_tabs(); ?>
        </div>
		<div class="lk_inform">
			Разработанная нами система накопительных бонусов по праву является одной из лучших на 
			сегодняшний день среди онлайн обменников. Основной тезис нашей бонусной программы – привлечь 
			наибольшее число постоянных пользователей и обеспечить им лучшие условия для обмена.
			Бонусная программа является накопительной и растет после каждой операции обмена валют с использованием 
			аккаунта. 
		</div>
		<div>
			<div class="level">Ваш уровень: &nbsp;<span id="your_level"></span></div>
			<?
				$id = 347;
				$post = get_post($id); 
				$content = $post->post_content;
				echo $content;
			?>
		</div>
    </div>
	<div id="lk-conteyner" style="width:20%; float:left">
        <div class="lk-sidebar">
            <div class="lk-avatar">
                <?php rcl_avatar(120); //вставка авы ?>
            </div>
            <?php //rcl_sidebar(); ?>
        </div>
    </div>
</div><!--.profie-->

<div class="floatLeft rightClmn">
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


<?php rcl_after(); ?>


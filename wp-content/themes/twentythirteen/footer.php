<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

</div><!-- #main -->
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info footBack">
        <?php wp_nav_menu('menu=bottom_menu'); ?>	
        <div class="bottom-block">
            <div class="games markup">
                <div class="head-footer">Игры</div>
                <div class='left'><a href="/?p=187">Tera Online</a></div>
                <div class='left'><a href="/?p=189">Lineage 2</a></div>
                <div class='left'><a href="/?p=191">Perfect world</a></div>
                <div class='left'><a href="/?p=193">Arche Age</a></div>
                <div class='left'><a href="/?p=195">Aion</a></div>
            </div>
            <div class="payment markup">
                <div class="head-footer">Способы оплаты</div>
                <div class='money-left'>
                    <a href="#">
                        <img src='/wp-content/themes/twentythirteen/images/qiwi.png' />
                    </a>
                </div>
                <div class='money-left webmoney'>
                    <a href="#">
                        <img src='/wp-content/themes/twentythirteen/images/web_money.png' />
                    </a>
                </div>
                <div class='money-end'>
                    <a href="#">
                        <img src='/wp-content/themes/twentythirteen/images/yandex.png' />
                    </a>
                </div>
            </div>
            <div class="contact-us markup">
                <div class="head-footer">Свяжитесь с нами</div>
                <div class='skype'>
                    <a href="skype:SkypeUser?call">
                        <img src='/wp-content/themes/twentythirteen/images/skype.png' />
                    </a>
                </div>
                <div class='icq'>
                    <a href="#">
                        <img src='/wp-content/themes/twentythirteen/images/icq.png' />
                    </a>
                </div>
            </div>
            <div class="social markup">
                <div class="head-footer">Мы в соцсетях</div>
                <div class='soc-left firstchild'>
                    <a href="#">
                        <img src='/wp-content/themes/twentythirteen/images/facebook.png' />
                    </a>
                </div>
                <div class='soc-left'>
                    <a href="#">
                        <img src='/wp-content/themes/twentythirteen/images/vk.png' />
                    </a>
                </div>
                <div class='soc-left'>
                    <a href="#">
                        <img src='/wp-content/themes/twentythirteen/images/odnoklassniki.png' />
                    </a>
                </div>
                <div class='soc-left'>
                    <a href="#">
                        <img src='/wp-content/themes/twentythirteen/images/twitter.png' />
                    </a>
                </div>
            </div>
            <div class="login markup">
                <div class="head-footer">Вход/Регистрация</div>
                <div class='login-left'>
                    <a href="/account/">
                        <img src='/wp-content/themes/twentythirteen/images/login.png' />
                    </a>
                </div>
                <div class='login-left'>
                    <a href="#">
                        <img src='/wp-content/themes/twentythirteen/images/add_user.png' />
                    </a>
                </div>
            </div>
        </div><!--.bottom-block-->
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<script src="/wp-content/assets/jcarousellite.js" type="text/javascript"></script>
<script src="/wp-content/themes/twentythirteen/js/adition.js" type="text/javascript"></script>
<script src="http://www.xiper.net/examples/js-plugins/gallery/jcarousellite/js/jquery.mousewheel.min.js" type="text/javascript"></script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter32280164 = new Ya.Metrika({id:32280164,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
<div>
	<img src="//mc.yandex.ru/watch/32280164" style="position:absolute; left:-9999px;" alt="" />
</div>
</noscript>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-25440798-18', 'auto');
  ga('send', 'pageview');

</script>
<!-- /Yandex.Metrika counter -->
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'tw3PPBraFp';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->
<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>
</body>
</html>
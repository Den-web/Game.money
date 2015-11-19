<?php

if ( ! defined( 'ABSPATH' ) ) exit;


function ewic_stt_page() {
	
	?>
    
    <div class="wrap">
    <div class="metabox-holder">
			<div class="postbox">
            <h3 style="padding-bottom: 8px; border-bottom: 1px solid #CCC;"><span class="setpre"></span><?php _e( 'Global Settings', 'easywic' ); ?></h3>
            <form id="easywic_settings">
            <div style="padding: 5px 15px 15px 15px;">
            <h4><?php _e( "Auto Update Plugin", "easywic" ); ?> :</h4>
            <div style="margin-top: 10px;">
			<?php $ewic_opt_updt = get_option("ewic-settings-automatic_update"); ?>
            <input type="radio" name="ewic_sett_autoupd" onclick="ewic_ajax_autoupdt(this);" <?php echo $ewic_opt_updt == "active" ? "checked=\"checked\"" : "";?> value="active"><label style="vertical-align: baseline;"><?php _e( "Enable", "easywic" ); ?></label>
            <input type="radio" name="ewic_sett_autoupd" onclick="ewic_ajax_autoupdt(this);" <?php echo $ewic_opt_updt == "inactive" ? "checked=\"checked\"" : "";?> style="margin-left: 10px;" value="inactive"><label style="vertical-align: baseline;"><?php _e( "Disable", "easywic" ); ?></label>
            </div>
            </div>
            </form>
           </div>
	</div>
    </div>

<style>
.setpre {
	display:none;
	margin-right:10px;
	float: left;
	width:16px;
	height:16px;
	background-repeat:no-repeat;
	}
</style>

<script type="text/javascript">
/*<![CDATA[*/
	var ewicloader;
	function ewic_ajax_autoupdt(cmd) {
		
		window.clearTimeout(ewicloader);
		
		jQuery('.setpre').show().css('background-image','url(<?php echo EWIC_URL . '/inc/images/89.gif'; ?>)');
		var data = {
			action: 'ewic_ajax_autoupdt',
			security: '<?php echo wp_create_nonce( "easywic-lite-nonce"); ?>',				
			cmd: jQuery(cmd).val(),
			};
			
			jQuery.post(ajaxurl, data, function(response) {
				
				if (response == 1) {
					jQuery('.setpre').css('background-image','url(<?php echo EWIC_URL . '/inc/images/valid.png'; ?>)');
					ewicloader = window.setTimeout(function() {
					jQuery('.setpre').fadeOut();
					}, 3000);
					}						
					else {
						jQuery('.setpre').hide();
						alert('Ajax request failed, please refresh your browser window.');
						}
						
						
						
					});
	
	}
/*]]>*/
</script> 
	
<?php	
	
}

?>
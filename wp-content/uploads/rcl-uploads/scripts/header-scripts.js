var SliderOptions = '';jQuery(function(){ function setAttr_rcl(prmName,val){ var res = ''; var d = location.href.split('#')[0].split('?'); var base = d[0]; var query = d[1]; if(query) { var params = query.split('&'); for(var i = 0; i < params.length; i++) { var keyval = params[i].split('='); if(keyval[0] != prmName) { res += params[i] + '&'; } } } res += prmName + '=' + val; return base + '?' + res; } function get_ajax_content_tab(id){ var lk = parseInt(jQuery('.wprecallblock').attr('id').replace(/\D+/g,'')); var dataString = 'action=rcl_ajax_tab&id='+id+'&lk='+lk+'&locale='+jQuery('html').attr('lang'); jQuery.ajax({ type: 'POST', data: dataString, dataType: 'json', url: wpurl+'wp-admin/admin-ajax.php', success: function(data){ if(data['result']==100){ jQuery('#lk-content').html(data['content']); } else { alert('Error'); } rcl_preloader_hide(); } }); return false; } jQuery('.rcl-tab-button').on('click','.ajax_button',function(){ if(jQuery(this).hasClass('active'))return false; rcl_preloader_show('#lk-content > div'); var id = jQuery(this).parent().data('tab'); jQuery('.rcl-tab-button .recall-button').removeClass('active'); jQuery(this).addClass('active'); var url = setAttr_rcl('tab',id); if(url != window.location){ if ( history.pushState ){ window.history.pushState(null, null, url); } } get_ajax_content_tab(id); return false; }); /* Пополняем личный счет пользователя */ jQuery('body').on('click','.add_count_user',function(){ var count = jQuery('.value_count_user'); var addcount = count.val(); var dataString = 'action=rcl_add_count_user&count='+addcount; jQuery.ajax({ type: 'POST', data: dataString, dataType: 'json', url: wpurl+'wp-admin/admin-ajax.php', success: function(data){ if(data['otvet']==100){ jQuery('.redirectform').html(data['redirectform']); } else { alert('Ошибка проверки данных.'); } } }); return false; }); jQuery('body').on('click','.go_to_add_count',function(){ jQuery('.count_user').slideToggle(); return false; }); });function rcl_zoom_avatar(e){ var link = jQuery(e); var src = link.data('zoom'); jQuery('body > div').last().after('<div id=\'rcl-preview\'><img class=aligncenter src=\''+src+'\'></div>'); jQuery( '#rcl-preview img' ).load(function() { jQuery( '#rcl-preview' ).dialog({ modal: true, draggable: false, imageQuality: 1, resizable: false, width:355, close: function (e, data) { jQuery( this ).dialog( 'close' ); jQuery( '#rcl-preview' ).remove(); }, buttons: { Ок: function() { jQuery( this ).dialog( 'close' ); } } }); }); } function rcl_more_view(e){ var link = jQuery(e); var icon = link.children('i'); link.parent().children('div').slideToggle(); icon.toggleClass('fa-plus-square-o fa-minus-square-o'); }/* Оплачиваем заказ средствами из личного счета */ function rcl_pay_order_private_account(e){ var idorder = jQuery(e).data('order'); var dataString = 'action=rcl_pay_order_private_account&idorder='+ idorder; jQuery.ajax({ type: 'POST', data: dataString, dataType: 'json', url: wpurl+'wp-admin/admin-ajax.php', success: function(data){ if(data['otvet']==100){ jQuery('.order_block').find('.pay_order').each(function() { if(jQuery(e).attr('name')==data['idorder']) jQuery(e).remove(); }); jQuery('.redirectform').html(data['recall']); jQuery('.usercount').html(data['count']); jQuery('.order-'+data['idorder']+' .remove_order').remove(); jQuery('#manage-order').remove(); }else{ rcl_notice('Недостаточно средств на счету! Сумма заказа: '+data['recall'],'error'); } } }); return false; }
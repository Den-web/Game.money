jQuery(function($){ $('#userpicupload').fileupload({ dataType: 'json', type: 'POST', url: wpurl+'wp-admin/admin-ajax.php', formData:{action:'rcl_avatar_upload'}, loadImageMaxFileSize: 10485760, autoUpload:false, previewMaxWidth: 900, previewMaxHeight: 900, imageMinWidth:150, imageMinHeight:150, disableExifThumbnail: true, progressall: function (e, data) { var progress = parseInt(data.loaded / data.total * 100, 10); $('#avatar-upload-progress').show().html('<span>'+progress+'%</span>'); }, processalways: function (e, data) { $.each(data.files, function (index, file) { $('#rcl-preview').remove(); if(file.size>10485760){ rcl_notice('Превышен максимальный размер для изображения! Макс. 10MB','error'); return false; } var canvas = data.files[0].preview; var dataURL = canvas.toDataURL(); $( '#rcl-preview' ).remove(); $('body > div').last().after('<div id=\'rcl-preview\' title=\'Загружаемое изображение\'><img src=\''+dataURL+'\'></div>'); var image = $('#rcl-preview img'); image.load(function() { var img = $(this); var height = img.height(); var width = img.width(); var jcrop_api; img.Jcrop({ aspectRatio: 1, minSize:[150,150], onSelect:function(c){ img.attr('data-width',width).attr('data-height',height).attr('data-x',c.x).attr('data-y',c.y).attr('data-w',c.w).attr('data-h',c.h); } },function(){ jcrop_api = this; }); $( '#rcl-preview' ).dialog({ modal: true, imageQuality: 1, width: width+32, resizable: false, close: function (e, data) { jcrop_api.destroy(); $( '#rcl-preview' ).remove(); }, buttons: { Ok: function() { data.submit(); $( this ).dialog( 'close' ); } } }); }); }); }, submit: function (e, data) { var image = $('#rcl-preview img'); if (parseInt(image.data('w'))){ var src = image.attr('src'); var width = image.data('width'); var height = image.data('height'); var x = image.data('x'); var y = image.data('y'); var w = image.data('w'); var h = image.data('h'); data.formData = { coord: x+','+y+','+w+','+h, image: width+','+height, action:'rcl_avatar_upload' }; } }, done: function (e, data) { if(data.result['error']){ rcl_notice(data.result['error'],'error'); return false; } $('#rcl-contayner-avatar .rcl-user-avatar img').attr('src',data.result['avatar_url']); $('#avatar-upload-progress').hide().empty(); $( '#rcl-preview' ).remove(); rcl_notice(data.result['success'],'success'); } }); $('#webcamupload').click(function(){ $( '#rcl-preview' ).remove(); $('body > div').last().after('<div id=\'rcl-preview\' title=\'Снимок с камеры\'></div>'); var webCam = new SayCheese('#rcl-preview', { audio: true }); $( '#rcl-preview' ).dialog({ modal: true, imageQuality: 1, resizable: false, width:355, close: function (e, data) { webCam.stop(); $( this ).dialog( 'close' ); $( '#rcl-preview' ).remove(); }, open: function (e, data) { webCam.start(); }, buttons: { Снимок: function() { webCam.takeSnapshot(320, 240); } } }); webCam.on('snapshot', function(snapshot) { var img = document.createElement('img'); $(img).on('load', function() { $('#rcl-preview').html(img); }); img.src = snapshot.toDataURL('image/png'); var dataString = 'action=rcl_avatar_upload&src='+img.src; $.ajax({ type: 'POST', data: dataString, dataType: 'json', url: wpurl+'wp-admin/admin-ajax.php', success: function(data){ if(data['error']){ rcl_notice(data['error'],'error'); return false; } $( '#rcl-preview' ).dialog('close'); $('#rcl-contayner-avatar .rcl-user-avatar img').attr('src',data['avatar_url']); $( '#rcl-preview' ).remove(); rcl_notice(data['success'],'success'); } }); }); });});
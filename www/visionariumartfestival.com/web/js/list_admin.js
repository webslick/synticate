// Загрузка аватара
function load_avatar() {
    $("#input_avatar").click();
}

// ==========================================
var _obj_tmp = false;
var _obj_tmp_id = false;
var _def_avatar = '/images/users/no_avatar.jpg';

function read_url( input ) {    
    if (input.files[0]) {
        var reader = new FileReader();
        var resize = false;        
        reader.onload = function(e) {
            $("#modal_avatar").show();
            resize = $('#load_avatar').croppie({
                url: e.target.result,
                viewport: {
                    width: 150,
                    height: 150,
                    type: 'circle'
                },
                boundary: {
                    width: 200,
                    height: 200
                }
            });
   
            $("#save_avatar").on('click', function() {
                resize.croppie('result', 'base64').then(function(dataImg) {                    
                    var data = [{ image: dataImg }, { name: 'myimgage.jpg' }];
                    //ajax data
                    //console.log( data );
                    $('.user_avatar').attr('src', dataImg);
                    $('.user_avatar_'+_obj_tmp_id).attr('src', dataImg);
                    $("#modal_avatar").hide();
                });
            });
        }
        reader.readAsDataURL(input.files[0]);
        $("#input_avatar").val('');
        $('#load_avatar').croppie('destroy');
        $("#save_avatar").unbind( "click" )
    }    
}

// Создание / редактирование / удаление пользователя
function admin_event( _this, _event ) {
    var to_server = false;
    var user_data = false;
    var event_box = $(".admin_event_box");

    switch( _event ) {
        // Создание пользователя
        case 'newuser':
            if( _obj_tmp_id ){
                $("#"+_obj_tmp_id).show();
            }
            _obj_tmp = event_box;
            $(".admin-list-wrap").prepend(_obj_tmp);
            $(_obj_tmp).show();
                $(_obj_tmp).find(".fa-close-1").click(function(){
                    $(_obj_tmp).hide();    
                });
            form_reset();
            var inputs = $(_obj_tmp).find("input");
            for(i=0;i<inputs.length;i++){
                $(inputs[i]).val('');
                if( $(inputs[i]).attr("id") == 'edit_pass' ) {
                    $(inputs[i]).attr("placeholder","Password");
                }    
            }
            $(_obj_tmp).find(".user_avatar").attr('src', _def_avatar);
            $(_obj_tmp).attr("id",0);
        break;

        
        // Редактирование пользователя
        case 'edituser':
            var main_obj = $( _this ).parents()[3];
            var _tmp = $( event_box ).remove();
            $( main_obj ).hide();
            $("#"+_obj_tmp_id).hide();
            
            var user_id = $( main_obj ).attr("id");
            var user_name = $( main_obj ).find("div.admin-name").text().trim();
            var user_phone = $( main_obj ).find("div.admin-phone").text().trim();
            var user_email = $( main_obj ).find("div.admin-email").text().trim();
            var user_avatar = $( main_obj ).find(".user_avatar_"+user_id).attr('src');
            
            
            $(_tmp).attr("id","item_"+user_id);
                             
            $(_tmp).find("#edit_name").val(user_name);
            $(_tmp).find("#edit_phone").val(user_phone);
            $(_tmp).find("#edit_email").val(user_email);
            $(_tmp).find("#edit_pass").attr("placeholder","********");
            $(_tmp).find(".user_avatar").attr('src', user_avatar);
            
            _obj_tmp = _tmp;
            
            $( "#"+user_id ).before( _obj_tmp );
                        
            $( _obj_tmp ).show();
            
            if( _obj_tmp_id ) {
                $("#"+_obj_tmp_id).show();                
                _obj_tmp_id = user_id;
            } else {                
                _obj_tmp_id = user_id;
            }            
            
            $(".fa-close-1").on('click', function(e) {
                $(_tmp).hide();
                $("#"+_obj_tmp_id).show();
                _obj_tmp_id = false;                
            });            
            form_reset();
        break;
        
        // Сохранение пользователя
        case 'saveuser':
            var main_obj = $(_this).parents()[1];
            var item_id = $( main_obj ).attr("id").split("_")[1];
            var avatar = $('.user_avatar').attr("src");
            if( item_id ){
                avatar = $('.user_avatar_'+item_id).attr("src");       
            }
            user_data = {
                Id: item_id,
                name: encodeURIComponent( $( main_obj ).find("#edit_name").val() ),
                phone: encodeURIComponent( $( main_obj ).find("#edit_phone").val() ),
                email: encodeURIComponent( $( main_obj ).find("#edit_email").val() ),
                pass: $( main_obj ).find("#edit_pass").val(),
                img: encodeURIComponent( avatar )
            };
            to_server = true;            
        break;
        
        // Удаление пользователя
        case 'removeuser':
            var item_id = $( $( _this ).parents()[3] ).attr("id");
            user_data = {
                Id: item_id
            };
            to_server = true;
        break;
        
        // Root права
        case 'toggleroot':
            var item_id = $(_this).attr("for").split("_")[2];
            user_data = {
                Id: item_id
            };
            to_server = true;
        break;
    }
    
    // Исполнительный ajax
    if( to_server ) {        
        if( _event == 'removeuser' ) {            
            confirm_popup( 'Remove this user?', function() {
                $("#ajax_preloader").show().find("span").html("remove user sync").show();
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: "/admin/"+_event,
                    data: user_data,
                    success: function( res ) {
                        _obj_tmp_id = user_id;
                        send_message( "User removed", "message_success" );
                        
                        $("#ajax_preloader").hide().find("span").html("").hide();
                        refresh_item();
                    }
                });
            });
        } else {
            $("#ajax_preloader").show().find("span").html("save user sync").show();
            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "/admin/"+_event,
                data: user_data,
                success: function( res ) {
                    //console.log(res);
                    _obj_tmp_id = user_id;
                    switch(_event){
                        case 'saveuser':
                            form_marker( res );
                        break;
                        case 'toggleroot':
                            send_message( "Data saved successfully", "message_success" );
                            $("#ajax_preloader").hide().find("span").html("").hide();
                        break;
                    }                    
                }
            });            
        }
        to_server = false;
    }
}

// Маркеровка ошибочных полей в форме
function form_marker( res ) {
    $.each( res.err, function( k, v ) {
        $("#edit_"+v).parent().addClass('err');
    });                
    $.each( res.data, function( k, v ) {
        $("#edit_"+k).parent().removeClass('err');
        $("#edit_"+k).val(v);                    
    });
    $("#ajax_preloader").hide().find("span").html("").hide();
    if( res.success ){
        send_message( "Data saved successfully", "message_success" );
        refresh_item();
    }    
}

// Удаление err подсветки в форме и очищение полей
function form_reset() {
    var obj = $(".admin-data").find("input");
    for( i=0;i<obj.length;i++ ){
        $( obj[i] ).parent().removeClass("err").val('');
    }
    $( "input[type=text], input[type=password]" ).focus(function() {
        $(this).parent().removeClass("err");
    });
}

// Обновление группы пользователей
function refresh_item() {
    $("#ajax_preloader").show().find("span").html("refreshing sync").show();
    $.ajax({
        type: "POST",
        url: "/admin/users",        
        success: function( res ) {
            var content = $( $( res ) ).find(".admin-list-wrap").html();
            $(".admin-list-wrap").html( content );
            
            $("#ajax_preloader").hide().find("span").html("").hide();
            //console.log(content);
        }
    });
}

// Отображение / Скрытие сообщения о выполненном действии
function send_message( text, obj_id ) {    
    $( "#" + obj_id ).html(text);
    $( "#" + obj_id ).fadeIn( 500 );
    setTimeout(function() {
        $( "#" + obj_id ).fadeOut( 2000 );
    },2000);
}

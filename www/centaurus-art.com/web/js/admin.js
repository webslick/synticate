// Создание нового элемента
//==================================================
$(document).ready(function() {    
    $(".new_item").click(function() {
        var _this = $(this);
        var p = window.location.href;
        var page = p.split("/")[3];
        var type = $(this).data().type;
        
        $("#ajax_preloader").show();
        $.ajax({
            type: "GET",
            url: "/admin/make?page="+page+"&type="+type,
            success: function( data ) {
                var _tmp = $(data);
                var item = $(_tmp).find("article.article-item");
                $(".article-wrap").prepend(item);
                //$(".article-wrap").append(item);
                $( $(item).find("li")[0] ).click();
                //$("#new").parent().after(item);
                //console.log(item);
                $("#ajax_preloader").hide();
            }
        });
        return false;    
    });
});

// Редактирование, удаление елемента popup
//==================================================
function load_modal( _this, _url ) {
    $("#ajax_preloader").show();
    $.ajax({
        type: "GET",            
        url: _url,
        success: function( data ) {            
            $("#ajax_modal_content").html( data );
            $("#ajax_preloader").hide();
            //console.log( data );
        }
    });        
}

function event_admin( _this, url ) {
    var _this_obj = $( _this ).parents();
    var id = $( $( _this ).parents()[1] ).attr("id");
    if( id ) {
        var item_type = $( _this ).parents().find("input[type=radio]:checked").data();
        var title = $(_this_obj).find(".c-title").val();
        
        var published = false;
        if( $(_this_obj).find("input[type=checkbox]:checked")[0] ){
            published = true;
        }
        
        //var more = $("#more").serializeArray();
        var img = $(_this_obj).find(".img_preview").attr("src");
        var content = CKEDITOR.instances.editor.getData();
        
        item_data = {
            Id: id,
            type: item_type.type,
            content: encodeURIComponent(content),        
            name: encodeURIComponent(title),
            content_href: encodeURIComponent($("#youtube").val()),
            gallery_href: encodeURIComponent($("#gallery_href").val()),
            published: published,
            img:img
            
        };
        
        $("#ajax_preloader").show();
        $.ajax({
            type: "POST",            
            url: url,
            data: item_data,
            success: function( data ) {
                var obj = $(data).find(".article-wrap").html();
                $(".article-wrap").html(obj);
                $( ".article-wrap" ).sortable( "refresh" );
                $("#ajax_preloader").hide();
            }
        });
        $("#ajax_modal_content").html("");               
    }
}

// Удаление элемента
//==================================================
function remove_admin( _this, url ) {
    confirm_popup( 'Remove this item?', function() {
        $("#ajax_preloader").show();
        $.ajax({
            type: "GET",            
            url: url,
            success: function( data ) {
                $( $(_this).parents()[3] ).remove();
                $("#ajax_preloader").hide();    
            }
        });
    });   
}

// Сортировка
//==================================================
$(document).ready(function(){
    
    var t = $( ".article-wrap" ).sortable({
        tolerance: "pointer",
        handle: ".flex.sb"
    });
    $( t ).disableSelection();
    $( t ).on( "sortstop", function() {
        items_list = $(this).sortable("toArray");
        $.ajax({
            type: "POST",
            url: "/admin/sort",
            data:{
                items_list: items_list
            },success: function( data ) {
                console.log( data );
            }
        });        
    });
    
    //mobile
    var mouseProto = $.ui.mouse.prototype,
        _mouseInit = mouseProto._mouseInit,
        touchHandled;
    mouseProto._mouseInit = function () {    
    var self = this;    
    // Delegate the touch handlers to the widget's element
    self.element
        .bind('taphold', $.proxy(self, '_touchStart'))   // IMPORTANT!MOD FOR TAPHOLD TO START SORTABLE
        .bind('touchmove', $.proxy(self, '_touchMove'))
        .bind('touchend', $.proxy(self, '_touchEnd'));    
    // Call the original $.ui.mouse init method
    _mouseInit.call(self);
    };
});

// Инициализация поп-ап окна
//==================================================
function init_popup( _id, _el ) {
    
    // Загрузка файла на сервер
    $(".fileUpload").liteUploader({
        script: "/admin/loadimage",
        rules: {
            allowedFileTypes: "image/jpeg,image/png,image/gif",
            //maxSize: 250000
        },
        params: {
            item_id: _id
        }
    }).on("lu:before", function (e, files) {
        console.log( files );
        var el = document.querySelector(".preview");
    
        Array.prototype.forEach.call(files, function (file) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                //var image = document.createElement("img");
                //image.src = e.target.result;
                //image.width = '100';
                //el.appendChild(image);
                $(el).find("img").attr("src",e.target.result);
                $($(_el).find("img")[0]).attr("src",e.target.result).show();
            };
    
            reader.readAsDataURL(file);
        });
    }).on("lu:success", function (e, response) {
        console.log(response);
    });
    $(".fileUpload").change(function () {
        $(this).data("liteUploader").startUpload();
    });
    $(".load_img").click(function(){
        $(".fileUpload").click();
    });    
    //===
    
    // Сохранение информации
    $(".save").click(function() {
        var id = $(this).attr("id");
        var name = $("#name").val();
        var content = CKEDITOR.instances.editor.getData();
        
        $("#ajax_preloader").show();        
        $.ajax({
            type: "POST",
            url: "/admin/save",
            data: {
                id: id,
                name: encodeURIComponent(name),
                content: encodeURIComponent(content)
            },success: function( data ) {
                $( $(_el).find("h2")[0] ).html(name);
                $( $(_el).find(".art-text-block")[0] ).html(content);
                $( ".article-wrap" ).sortable( "refresh" );
                $("#ajax_preloader").hide();                
                //$.magnificPopup.close();
            }
        });
    });
    //===
    
    // Визивиг
    //ClassicEditor.create( document.querySelector( '#editor' ) );
    CKEDITOR.replace( 'editor' );
    //===
}

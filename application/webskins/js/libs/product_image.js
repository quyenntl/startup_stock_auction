function $m(theVar){
	return document.getElementById(theVar);
}
function remove(theVar){
	var theParent = theVar.parentNode;
	theParent.removeChild(theVar);
    
    //window.location.reload();
}
function addEvent(obj, evType, fn){
	if(obj.addEventListener)
	    obj.addEventListener(evType, fn, true)
	if(obj.attachEvent)
	    obj.attachEvent("on"+evType, fn)
}
function removeEvent(obj, type, fn){
	if(obj.detachEvent){
		obj.detachEvent('on'+type, fn);
	}else{
		obj.removeEventListener(type, fn, false);
	}
}

function uploadComplete(str){    
    var obj = jQuery.parseJSON(str);
    if(obj.error == 1)
    {
        $("#upload-notice").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>'+ obj.html +'</div>');
    }
    else if(obj.error == 0)
    {
        var picture = '<img src="'+obj.image+'" id="crop-area">';
        $(".modal-img").html(picture);
        $("#crop-img-name").val(obj.img_name);
        $('#original_img').val(obj.img_name);
        $('#modal-crop-img').modal('show');
    }
    else if(obj.error == 'width_err')
    {
        $("#upload-notice").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>Chiều dài ảnh quá lớn! Tối đa 1200px</div>');
    }
    else if(obj.error == 'height_err')
    {
        $("#upload-notice").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>Chiều cao ảnh quá lớn! Tối đa 1000px</div>');
    }
    else if(obj.error == 'mime_err')
    {
        $("#upload-notice").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>Ảnh phải có định dạng: jpg, png, gif!</div>');
    }
    else if(obj.error == 'size_err')
    {
        $("#upload-notice").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>Ảnh vượt quá dung lượng cho phép! Tối đa 2MB</div>');
    }
   
}

function uploadCrop(str){
    var obj = jQuery.parseJSON(str);
   
    if(obj.error == 1){
        $("#crop-notice").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>Kích thước hoặc định dạng ảnh không đúng!</div>');
    }else{
        var picture = '<img src="'+obj.image+'">';
        $("#img-croped").html(picture);
        //setTimeout(function(){ reload()}, 1500);
    }
   
}

function reload(){
    window.location.reload();
}
function isWebKit(){
    return RegExp(" AppleWebKit/").test(navigator.userAgent);
}
function ajaxUpload(form,url_action,id_element,html_show_loading,html_error_http,mode){
    var detectWebKit = isWebKit();
    form = typeof(form)=="string"?$m(form):form;
    var erro="";
    if(form==null || typeof(form)=="undefined"){
        erro += "The form of 1st parameter does not exists.\n";
    }else if(form.nodeName.toLowerCase()!="form"){
        erro += "The form of 1st parameter its not a form.\n";
    }
    if($m(id_element)==null){
        erro += "The element of 3rd parameter does not exists.\n";
    }
    if(erro.length>0){
        alert("Error in call ajaxUpload:\n" + erro);
        return;
    }
    var iframe = document.createElement("iframe");
    iframe.setAttribute("id","ajax-temp");
    iframe.setAttribute("name","ajax-temp");
    iframe.setAttribute("width","0");
    iframe.setAttribute("height","0");
    iframe.setAttribute("border","0");
    iframe.setAttribute("style","width: 0; height: 0; border: none;");
    form.parentNode.appendChild(iframe);
    window.frames['ajax-temp'].name="ajax-temp";
    var doUpload = function(){
        removeEvent($m('ajax-temp'),"load", doUpload);
        if(!mode)
            var cross = "javascript: parent.uploadComplete(document.body.innerHTML);";
        else
            var cross = "javascript: parent.uploadCrop(document.body.innerHTML);";
        //cross += "window.parent.$m('"+id_element+"').innerHTML = document.body.innerHTML; void(0);";
        $m(id_element).innerHTML = html_error_http;
        $m('ajax-temp').src = cross;
        if(detectWebKit){
            remove($m('ajax-temp'));
        }else{
            setTimeout(function(){ remove($m('ajax-temp'))}, 250);
        }
    }
    addEvent($m('ajax-temp'),"load", doUpload);
    form.setAttribute("target","ajax-temp");
    form.setAttribute("action",url_action);
    form.setAttribute("method","post");
    form.setAttribute("enctype","multipart/form-data");
    form.setAttribute("encoding","multipart/form-data");
    if(html_show_loading.length > 0){
        $m(id_element).innerHTML = html_show_loading;
    }
    form.submit();
}
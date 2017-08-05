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

    if(obj.error == 1){
        $("#upload-notice").html('<div class="alert alert-error"><a type="button" class="close" data-dismiss="alert">×</a>'+obj.html+'</div>');
        $(obj.notice_element).html('<div class="alert alert-error"><a type="button" class="close" data-dismiss="alert">×</a>'+obj.html+'</div>');
    }else{
        var picture = '<img src="'+obj.image+'">';
        $(".result-view").hide().html(picture).fadeIn(200);
        $("#upload-notice").html('<div class="alert alert-success"><a type="button" class="close" data-dismiss="alert">×</a>'+obj.html+'</div>');
        $(obj.notice_element).html('<div class="alert alert-success"><a type="button" class="close" data-dismiss="alert">×</a>'+obj.html+'</div>');
        $(obj.name_value).val(obj.image_name);
    }
}
function reload(){
    window.location.reload();
}
function isWebKit(){
    return RegExp(" AppleWebKit/").test(navigator.userAgent);
}
function ajaxUpload(form,url_action,id_element,html_show_loading,html_error_http){
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
        var cross = "javascript: parent.uploadComplete(document.body.innerHTML);";
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
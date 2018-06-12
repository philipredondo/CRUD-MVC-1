<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!------ Include the above in your HEAD tag ---------->
<style>
.container{
    margin-top:20px;
}
.image-preview-input {
    position: relative;
    overflow: hidden;
    margin: 0px;    
    color: #333;
    background-color: #fff;
    border-color: #ccc;    
}
.image-preview-input input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
}
</style>
<?php $filenamex='lol.png';?>
<div class="container">
    <div class="row">    
        <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">  
           <form>
		   <div class="input-group ">
				
			   <input type="text" class="form-control image-preview-filename" disabled="disabled"> 
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input" onChange="submitRev();">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="image-preview-filename"/> <!-- rename it -->
                    </div>
                </span>
				
            </div><!-- /input-group image-preview [TO HERE]--> 
			<input type="hidden" value="upload"	id="uploadbtn" name="uploadbtn" onClick="fileUpload(this.form,'test.php','upload'); return false;" >
			<div id="upload"></div>
			<form>
        </div>
    </div>
</div>


<script>
$('.image-preview-filename').val("<?php echo $filenamex;?>");
 $(".image-preview-clear").show();
$(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});
function submitRev() {
    document.getElementById("uploadbtn").click(); 
}
function fileUpload(form, action_url, div_id) {
	// Create the iframe...
	var iframe = document.createElement("iframe");
	iframe.setAttribute("id", "upload_iframe");
	iframe.setAttribute("name", "upload_iframe");
	iframe.setAttribute("width", "0");
	iframe.setAttribute("height", "0");
	iframe.setAttribute("border", "0");
	iframe.setAttribute("style", "width: 0; height: 0; border: none;");
						 
							// Add to document...
	form.parentNode.appendChild(iframe);
	window.frames['upload_iframe'].name = "upload_iframe";
						 
	iframeId = document.getElementById("upload_iframe");
						 
							// Add event...
	var eventHandler = function () {
						 
			if (iframeId.detachEvent) iframeId.detachEvent("onload", eventHandler);
			else iframeId.removeEventListener("load", eventHandler, false);
						 
									// Message from server...
			if (iframeId.contentDocument) {
				content = iframeId.contentDocument.body.innerHTML;
			} else if (iframeId.contentWindow) {
				content = iframeId.contentWindow.document.body.innerHTML;
			} else if (iframeId.document) {
										content = iframeId.document.body.innerHTML;
			}
						 
			document.getElementById(div_id).innerHTML = content;
						 
			// Del the iframe...
			setTimeout('iframeId.parentNode.removeChild(iframeId)', 250);
		}
						 
	if (iframeId.addEventListener) iframeId.addEventListener("load", eventHandler, true);
	if (iframeId.attachEvent) iframeId.attachEvent("onload", eventHandler);
						 
	// Set properties of form...
	form.setAttribute("target", "upload_iframe");
	form.setAttribute("action", action_url);
	form.setAttribute("method", "post");
	form.setAttribute("enctype", "multipart/form-data");
	form.setAttribute("encoding", "multipart/form-data");
						 
	// Submit the form...
	form.submit();
}
</script>
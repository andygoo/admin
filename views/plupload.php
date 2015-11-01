
<?= HTML::script('media/plupload/plupload.full.min.js')?>
<script>
function FileProgress(file, targetID) {
    this.fileProgressID = file.id;
    this.file = file;
    this.fileProgressWrapper = $('#' + this.fileProgressID);
    
    if (!this.fileProgressWrapper.length) {
		var html = '<div class="up-item" id="' + file.id +'">';
			html += '<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			html += '<img class="img-thumbnail" src="">';
	    	html += '<div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div></div>';
			html += '</div>';
		this.fileProgressWrapper = $(html);
		$('#'+targetID).prepend(this.fileProgressWrapper);
		
		previewImage(file,function(imgsrc){
			$('#'+file.id).find('img').attr('src', imgsrc);
		});
    }
}
FileProgress.prototype.setProgress = function(percentage) {
    percentage = parseInt(percentage, 10);
    var progressbar = this.fileProgressWrapper.find('.progress-bar');
    progressbar.attr('aria-valuenow', percentage).css('width', percentage + '%');
};
FileProgress.prototype.setComplete = function(up, file, info) {
    this.fileProgressWrapper.find('.progress').hide();
    this.fileProgressWrapper.find('.close').hide();
};

function previewImage(file,callback) {
	if(!file || !/image\//.test(file.type)) return;
	if(file.type=='image/gif') {
		var fr = new mOxie.FileReader();
		fr.onload = function(){
			callback(fr.result);
			//fr.destroy();
			fr = null;
		}
		fr.readAsDataURL(file.getSource());
	}else{
		var preloader = new mOxie.Image();
		preloader.onload = function() {
			preloader.downsize(300, 300);
			var imgsrc = preloader.type=='image/jpeg' ? preloader.getAsDataURL('image/jpeg',80) : preloader.getAsDataURL();
			callback && callback(imgsrc);
			preloader.destroy();
			preloader = null;
		};
		preloader.load(file.getSource());
	}
}
</script>


$(document).ready(function (){
    var $modal = $('#cropThumbnailModal');
    var thumbnail = document.getElementById('sample_thumbnail_image');
    var cropper;

    $('#tour-thumbnail').change(function (event) {
        var files = event.target.files;

        var done = function (url) {
            thumbnail.src = url;
            $modal.modal('show');
        };

        if(files && files.length > 0)
        {
            reader = new FileReader();
            reader.onload = function (e) {
                done(reader.result);
            }
        }

        reader.readAsDataURL(files[0]);
    });

    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(thumbnail, {
            dragMode: 'move',
            minCropBoxWidth:400,
            minCropBoxHeight:267,
            autoCropArea: 0.1,
            viewMode: 3,
            cropBoxResizable: false,
            preview: '#preview-thumbnail'
        });
    }).on('hidden.bs.modal', function(){
        cropper.destroy();
        cropper = null;
    });

    $('#crop-thumbnail').click(function(){
        canvas = cropper.getCroppedCanvas({
            width:400,
            height:400
        });

        canvas.toBlob(function(blob){
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function(){
                var base64data = reader.result;
                $.ajax({
                    url: window.location.origin + '/api/files/upload-crop-image',
                    method:'POST',
                    data:{
                        image: base64data,
                        url: 'tours/thumbnails/'
                    },
                    success:function(data)
                    {
                        $modal.modal('hide');
                        $('input[name="thumbnail"]').val(data.url);
                        $('#tour-thumbnail-image').attr('src', data.data);
                    }
                });
            };
        });
    });
});

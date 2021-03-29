$(document).ready(function () {
    var $modalAvatar = $('#cropAvatarModal');
    var $modalThumbnail = $('#cropThumbnailModal');
    var avatar = document.getElementById('sample_avatar_image');
    var thumbnail = document.getElementById('sample_thumbnail_image');
    var cropper;

    $('#attraction-avatar').change(function (event) {
        var files = event.target.files;

        var done = function (url) {
            avatar.src = url;
            $modalAvatar.modal('show');
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

    $('#attraction-thumbnail').change(function (event) {
        var files = event.target.files;

        var done = function (url) {
            thumbnail.src = url;
            $modalThumbnail.modal('show');
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

    $modalAvatar.on('shown.bs.modal', function() {
        cropper = new Cropper(avatar, {
            aspectRatio: 1,
            autoCropArea: 1,
            viewMode: 3,
            cropBoxResizable: false,
            preview: '#preview-avatar'
        });
    }).on('hidden.bs.modal', function(){
        cropper.destroy();
        cropper = null;
    });

    $modalThumbnail.on('shown.bs.modal', function() {
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

    $('#crop-avatar').click(function(){
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
                        url: 'attractions/avatars/'
                    },
                    success:function(data)
                    {
                        $modalAvatar.modal('hide');
                        $('input[name="avatar"]').val(data.url);
                        $('#uploaded-attraction-avatar').attr('src', data.data);
                    }
                });
            };
        });
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
                        url: 'attractions/thumbnails/'
                    },
                    success:function(data)
                    {
                        $modalThumbnail.modal('hide');
                        $('input[name="thumbnail"]').val(data.url);
                        $('#uploaded-attraction-thumbnail').attr('src', data.data);
                    }
                });
            };
        });
    });
});

$(document).on('change', '#images', function () {
    var i = $(this).prev('label').clone();
    var file = $(this)[0].files[0].name;
    $(this).prev('label').text(file);
});

const cloneFile = (e) => {
    fileForm = $(".multi-file-images").eq(0).clone();
    fileForm.find('input').val("");
    fileForm.find('.custom-file-label').text("Chọn ảnh");
    fileForm.insertBefore($(e));
}

function clearFile(e) {
    if ($('.multi-file-images').length == 1) {
        $(e).prevAll('input').val("");
        $(e).prevAll('.custom-file-label').text("Chọn ảnh");
    } else {
        $(e).prev().prev('.multi-file-images').remove();
    }
}

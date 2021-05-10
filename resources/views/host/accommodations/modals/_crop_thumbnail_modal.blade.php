<!-- Crop Accommodation Thumbnail Modal-->
<div class="modal fade" id="cropThumbnailModal" tabindex="-1" role="dialog" aria-labelledby="cropThumbnailModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropThumbnailModalLabel">Cắt ảnh</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-contatiner">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_thumbnail_image" />
                        </div>
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="preview" id="preview-thumbnail"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                <button class="btn btn-primary" type="button" id="crop-thumbnail">Cắt</button>
            </div>
        </div>
    </div>
</div>

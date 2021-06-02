<!-- Remove Tour Album Image Modal-->
<div class="modal fade" id="removeTourInfoModal" tabindex="-1" role="dialog" aria-labelledby="removeTourInfoLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeTourInfoLabel">Bạn muốn xóa địa điểm hành trình này?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" method="POST" id="form-remove-tour-info">
            @method('DELETE')
            @csrf
            <div class="modal-body">Chọn "Xóa" bên dưới nếu bạn đã sẵn sàng xóa.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                <button class="btn btn-primary" type="submit">Xóa</button>
            </div>
            </form>
        </div>
    </div>
</div>

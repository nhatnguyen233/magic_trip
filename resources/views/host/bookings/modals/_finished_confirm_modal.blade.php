<!-- Finished Confirm Modal-->
<div class="modal fade" id="finishedConfirmModal" tabindex="-1" role="dialog" aria-labelledby="finishedConfirmLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="" method="POST" id="form-finished-confirm">
            @method('PUT')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="finishedConfirmLabel">Xác nhận muốn hoàn thành lịch book này?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đồng ý" bên dưới nếu bạn đã chắc chắn.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <button class="btn btn-danger" type="submit">Đồng ý</button>
                </div>
            </div>
        </form>
    </div>
</div>

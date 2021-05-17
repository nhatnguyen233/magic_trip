<!-- Remove Accommodation Album Image Modal-->
<div class="modal fade" id="removeAccommodationModal" tabindex="-1" role="dialog" aria-labelledby="removeImageLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="form-remove-accommodation">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeImageLabel">Bạn muốn xóa chỗ ở này?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đồng ý" bên dưới nếu bạn đã sẵn sàng xóa.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <button class="btn btn-primary" type="submit">Xóa</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Remove Cart Modal-->
<div class="modal fade" id="removeCartModal" tabindex="-1" role="dialog" aria-labelledby="removeCartModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeCartModalLabel">Bạn thực sự muốn xóa?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" method="POST" id="form-remove-cart">
            @method('DELETE')
            @csrf
            <div class="modal-body">Chọn "Đồng ý" bên dưới nếu bạn đã sẵn sàng xóa.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                <button class="btn btn-danger" type="submit">Xóa</button>
            </div>
            </form>
        </div>
    </div>
</div>

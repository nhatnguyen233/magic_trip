<!-- Remove Category category Modal-->
<div class="modal fade" id="removeCategoryModal" tabindex="-1" role="dialog" aria-labelledby="removeCategoryLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="form-remove-category">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeCategoryLabel">Bạn muốn xóa danh mục này?</h5>
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

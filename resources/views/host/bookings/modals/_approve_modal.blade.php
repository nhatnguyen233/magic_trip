<!-- Approve Modal-->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="" method="POST" id="form-approve">
            @method('PUT')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveLabel">Bạn chắc chắn chấp nhận lịch book này?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Chọn "Đồng ý" bên dưới nếu bạn đã chắc chắn.
                    <input type="text" name="number_of_slots" id="number-of-slots" hidden/>
                    <input type="text" name="date_of_book" id="date-of-book" hidden/>
                    <input type="text" name="tour_id" id="tour-id" hidden/>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <button class="btn btn-danger" type="submit">Đồng ý</button>
                </div>
            </div>
        </form>
    </div>
</div>

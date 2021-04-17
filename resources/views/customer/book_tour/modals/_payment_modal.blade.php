{{--<!-- Payment Modal-->--}}
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentLabel">Xác nhận thanh toán?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="form-payment">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="row d-flex flex-column align-items-center">
                        <button type="submit" class="btn btn-success w-50" id="order-payment">Thanh toán</button>
                        <br>
                        <button type="button" class="btn btn-danger w-50" data-dismiss="modal">Hủy bỏ</button>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <p class="m-auto">Chọn "Thanh toán" nếu bạn đã chắc chắn.</p>
            </div>
        </div>
    </div>
</div>

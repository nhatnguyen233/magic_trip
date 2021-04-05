<!-- Payment Order Modal -->
<div class="modal fade" id="paymentModalCenter" tabindex="-1" role="dialog" aria-labelledby="paymentModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalCenterTitle">Chọn phương thức thanh toán</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex flex-column align-items-center">
                    <button type="button" class="btn btn-success w-50" id="payment-offline">Thanh toán Offline</button>
                    <br>
                    <button type="button" class="btn btn-danger w-50" id="payment-online">Thanh toán Online</button>
                </div>
            </div>
            <div class="modal-footer">
                <p class="m-auto">Thanh toán ngay nếu chọn phương thức thanh toán Offline</p>
            </div>
        </div>
    </div>
</div>

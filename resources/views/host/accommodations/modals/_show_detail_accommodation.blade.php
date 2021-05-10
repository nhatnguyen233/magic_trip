<!-- Show Accommodation Modal-->
<div class="modal fade" id="showAccommodationModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="#" method="GET">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Thông tin chi tiết</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Tên Căn Hộ</label>
                        <input type="text" id="accommodation-name" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="phone">Địa chỉ</label>
                        <input type="text" id="accommodation-address" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="date">Vĩ độ</label>
                        <input type="text" id="accommodation-latitude" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="time">Kinh độ</label>
                        <input type="text" id="accommodation-longitude"  class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="attraction-images">Album ảnh</label>
                        <div class="row" id="accommodation-images"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                </div>
            </div>
        </form>
    </div>
</div>
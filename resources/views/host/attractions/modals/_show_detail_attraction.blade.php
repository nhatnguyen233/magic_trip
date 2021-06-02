<!-- Show Attraction Modal-->
<div class="modal fade" id="showAttractionModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
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
                        <label for="username">Tên địa điểm</label>
                        <input type="text" id="attraction-name" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="phone">Địa chỉ</label>
                        <input type="text" id="attraction-address" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="date">Vĩ độ</label>
                        <input type="text" id="attraction-latitude" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="time">Kinh độ</label>
                        <input type="text" id="attraction-longitude"  class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="attraction-images">Album ảnh</label>
                        <div class="row" id="attraction-images"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                </div>
            </div>
        </form>
    </div>
</div>
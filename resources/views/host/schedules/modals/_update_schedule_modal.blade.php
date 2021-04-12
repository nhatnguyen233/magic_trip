<!-- Modal -->
<div class="modal fade" id="editScheduleModal" tabindex="-1" role="dialog" aria-labelledby="editScheduleModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post">
            @method('PUT')
            @csrf
                <div class="modal-header">
                    <h5 class="version_2" id="editScheduleModalTitle">
                        <i class="fa fa-map-marker mr-2" style="color: #ddd;"></i>Sửa lịch cho Tour
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box_general">
                        <div class="tour-attractions mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="edit_departure_time">Thời gian bắt đầu <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control datetimepicker-input" id="edit_departure_time"
                                                   data-toggle="datetimepicker" data-target="#edit_departure_time" name="departure_time"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="number_max_slots">Số lượng tối đa</label>
                                        <input type="number" class="form-control" name="number_max_slots"
                                               id="number_max_slots" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

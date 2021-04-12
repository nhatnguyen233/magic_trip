<!-- Modal -->
<div class="modal fade" id="createScheduleModal" tabindex="-1" role="dialog" aria-labelledby="createScheduleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="" method="post" enctype="multipart/form-data"
              id="tour-schedules" class="form-list-schedule">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="version_2" id="createScheduleModal">
                        <i class="fa fa-map-marker mr-2" style="color: #ddd;"></i>Thêm lịch cho Tour
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box_general">
                            <div class="tour-attractions mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tour">Tour du lịch <span class="text-danger">*</span></label>
                                            <div class="styled-select">
                                                <select name="tour_id" id="tour" required>
                                                    @if(isset(request()->route('tour')->id))
                                                        <option value="{{ request()->route('tour')->id }}" selected>
                                                            {{ request()->route('tour')->name }}
                                                        </option>
                                                    @else
                                                        <option selected disabled>---- Chọn tour du lịch ----</option>
                                                        @foreach($tours as $item)
                                                            <option @if($tour->id ?? (session()->get('tour')->id ?? old('tour_id')) == $item->id)
                                                                    selected
                                                                    @endif
                                                                    value={{ $item->id }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="create_departure_time">Thời gian bắt đầu <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control datetimepicker-input" id="create_departure_time"
                                                       data-toggle="datetimepicker" data-target="#create_departure_time" name="departure_time"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="number_max_slots">Số lượng tối đa</label>
                                            <input type="number" class="form-control" name="number_max_slots"
                                                   id="number_max_slots" value="{{ old('number_max_slots') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-primary create-tour-schedule">Tạo</button>
                </div>
            </div>
        </form>
    </div>
</div>

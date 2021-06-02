<!-- Modal -->
<div class="modal fade" id="infoModalCenter" tabindex="-1" role="dialog" aria-labelledby="infoModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="version_2" id="infoModalLongTitle">
                    <i class="fa fa-map-marker mr-2" style="color: #ddd;"></i>Thêm địa điểm du lịch
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data"
                  id="tour-infos" class="form-list-info">
            @csrf
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
                                <div class="form-group">
                                    <label for="attraction-tour">Chọn địa điểm <span class="text-danger">*</span></label>
                                    <div class="styled-select">
                                        <select name="attraction_id" id="tour-attraction" required>
                                            <option selected disabled>---- Chọn địa điểm ----</option>
                                            @foreach($attractions as $item)
                                                <option @if(old('attraction_id') == $item->id)
                                                        selected
                                                        @endif
                                                        value={{ $item->id }}>
                                                    {{ $item->name . ' -' . $item->district->name . ', ' . $item->province->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tour-accommodation">Chọn nơi nghỉ <span class="text-danger">*</span></label>
                                    <div class="styled-select">
                                        <select name="accommodation_id" id="tour-accommodation" required>
                                            <option selected disabled>---- Chọn nơi nghỉ ----</option>
                                            @foreach($accommodations as $item)
                                                <option @if(old('accommodation_id') == $item->id)
                                                        selected
                                                        @endif
                                                        value={{ $item->id }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order-number">Thứ tự hành trình</label>
                                    <input type="number" class="form-control" name="order_number" id="order-number"
                                    value="{{ request()->route('tour')->infos ? request()->route('tour')->infos->count()+1 : old('order_number') }}" readonly/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle-tour-info">Phương tiện</label>
                                    <input type="text" class="form-control" name="vehicle_info"
                                           id="vehicle-tour-info" value="{{ old('vehicle_info') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="start-time">Thời gian bắt đầu <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control datetimepicker-input" id="start-time"
                                               data-toggle="datetimepicker" data-target="#start-time" name="start_time"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="limit-time">Khoảng thời gian <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="limit_time"
                                               id="limit-time" value="{{ old('limit_time') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /row-->
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

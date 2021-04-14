@extends('layouts.host.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" />
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Reviews</li>
      </ol>
      <div class="box_general">
        <div class="header_box">
          <h2 class="d-inline-block">Reviews List</h2>
          <div class="filter">
            <select name="orderby" class="selectbox">
              <option value="Any time">Any time</option>
              <option value="Latest">Latest</option>
              <option value="Oldest">Oldest</option>
            </select>
          </div>
        </div>
        <div class="list_general reviews">
          <ul>
            <li>
              <span>June 15 2017</span>
              <span class="rating"><i class="fa fa-fw fa-star yellow"></i><i class="fa fa-fw fa-star yellow"></i><i
                  class="fa fa-fw fa-star yellow"></i><i class="fa fa-fw fa-star yellow"></i><i
                  class="fa fa-fw fa-star"></i></span>
              <figure><img src="img/item_1.jpg" alt=""></figure>
              <h4>Hotel Mariott <small>by M.Twain</small></h4>

              <p>Lorem ipsum dolor sit amet, dolores mandamus moderatius ea ius, sed civibus vivendum imperdiet ei, amet
                tritani sea id. Ut veri diceret fierent mei, qui facilisi suavitate euripidis ad. In vim mucius menandri
                convenire, an brute zril vis. Ancillae delectus necessitatibus no eam, at porro solet veniam mel, ad
                everti nostrud vim. Eam no menandri pertinacia deterruisset.</p>
              <p class="inline-popups"><a href="#modal-reply" data-effect="mfp-zoom-in" class="btn_1 gray"><i
                    class="fa fa-fw fa-reply"></i> Reply to this review</a></p>
            </li>
            <li>
              <span>June 15 2017</span>
              <span class="rating"><i class="fa fa-fw fa-star yellow"></i><i class="fa fa-fw fa-star yellow"></i><i
                  class="fa fa-fw fa-star yellow"></i><i class="fa fa-fw fa-star"></i><i
                  class="fa fa-fw fa-star"></i></span>
              <figure><img src="img/item_2.jpg" alt=""></figure>
              <h4>Da Alfredo <small>by M.Giuliani</small></h4>
              <p>Ex omnis error aliquam quo, eu eos atqui accusam, ex nec sensibus erroribus principes. No pro albucius
                eloquentiam accommodare. Mei id illud posse persius. Nec eu dico lucilius delicata, qui propriae
                voluptaria eu.</p>
              <p class="inline-popups"><a href="#modal-reply" data-effect="mfp-zoom-in" class="btn_1 gray"><i
                    class="fa fa-fw fa-reply"></i> Reply to this review</a></p>
            </li>
            <li>
              <span>June 15 2017</span>
              <span class="rating"><i class="fa fa-fw fa-star yellow"></i><i class="fa fa-fw fa-star yellow"></i><i
                  class="fa fa-fw fa-star yellow"></i><i class="fa fa-fw fa-star yellow"></i><i
                  class="fa fa-fw fa-star"></i></span>
              <figure><img src="img/item_3.jpg" alt=""></figure>
              <h4>Pompidue Museum <small>by G.Lukas</small></h4>
              <p>Cum id mundi admodum menandri, eum errem aperiri at. Ut quas facilis qui, euismod admodum persequeris
                cum at. Summo aliquid eos ut, eum facilisi salutatus ne. Mazim option abhorreant ne his. Mel simul
                iisque albucius at, probatus indoctum efficiendi mei ei. Veniam percipit ei sea.</p>
              <p class="inline-popups"><a href="#modal-reply" data-effect="mfp-zoom-in" class="btn_1 gray"><i
                    class="fa fa-fw fa-reply"></i> Reply to this review</a></p>
            </li>
          </ul>
        </div>
      </div>
      <!-- /box_general-->
      <nav aria-label="...">
        <ul class="pagination pagination-sm add_bottom_30">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav>
      <!-- /pagination-->
    </div>
    <!-- /container-fluid-->
  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>

  <!-- Reply to review popup -->
  <div id="modal-reply" class="white-popup mfp-with-anim mfp-hide">
    <div class="small-dialog-header">
      <h3>Reply to review</h3>
    </div>
    <div class="message-reply margin-top-0">
      <div class="form-group">
        <textarea cols="40" rows="3" class="form-control"></textarea>
      </div>
      <button class="btn_1">Reply</button>
    </div>
  </div>

@endsection

@section('script')
    <script src="{{ asset('admin/js/admin-datatables.js') }}"></script>
    <script src="{{ asset('js/front/moment.min.js') }}"></script>
    <script src="{{ asset('tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.js') }}" crossorigin="anonymous"></script>
    <script>
        $(document).on('click', '#removeSchedule', function () {
            var id = $(this).data('id');
            var url = window.location.origin + '/host/schedules/' + id;
            $('#form-remove-schedule').attr('action', url);
        });
    </script>
@endsection
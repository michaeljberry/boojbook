<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Booj Book</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ url('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ url('assets/modules/izitoast/css/iziToast.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/modules/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

  <style>
  .main-content {
    padding-top: 100px !important;
  }
  .img-book {
    width: 50px;
    height: 70px;
    object-fit: cover;
    border: 1px solid #eee;
  }
  </style>
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('assets/css/components.css') }}">
</head>

<body class="layout-3">
  <div id="app">
    <div class="main-wrapper container">
      <nav class="navbar navbar-secondary navbar-expand-lg" style="top: 0px;">
        <div class="container">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>List of Books</h1>
            <div class="section-header-breadcrumb">
              <a href="javascript:;" id="create-book" class="btn btn-primary btn-sm">Create Book</a>
            </div>
          </div>

          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="book-table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date Publish</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($books as $key => $book)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img src="{{ url($book->photo_display) }}" alt="" class="img-book"></td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->date_publish_display }}</td>
                        <td></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2021
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>
  @include('modals.book')

  <!-- General JS Scripts -->
  <script src="{{ url('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ url('assets/modules/popper.js') }}"></script>
  <script src="{{ url('assets/modules/tooltip.js') }}"></script>
  <script src="{{ url('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('assets/js/stisla.js') }}"></script>
  
  <script src="{{ url('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
  <script src="{{ url('assets/modules/datatables/datatables.min.js') }}"></script>
  <script src="{{ url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
  <script src="{{ url('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

  <script>
  $(document).ready(function () {
    $('#create-book').click(function() {
      $('#bookModal').modal();
    });

    <?php if(session()->has('msg')){ ?>
    iziToast.success({
      title: 'Great!',
      message: '<?php echo session()->get('msg'); ?>',
      position: 'topRight'
    });
    <?php } ?>

    var tableColumn = localStorage.getItem("table-column");
    var tableOrder = localStorage.getItem("table-order");
    if(tableColumn === null && tableOrder === null){
      tableColumn = 2;
      tableOrder = 'asc';
    }

    var table = $("#book-table").dataTable({
      "columnDefs": [
        { "sortable": false, "targets": [0,1,5] }
      ],
      "order": [[ tableColumn, tableOrder ]]
    });

    table.on('click', 'th', function() {
      var info = table.fnSettings().aaSorting;
      localStorage.setItem("table-column", info[0][0]);
      localStorage.setItem("table-order", info[0][1]);
    });
  });
  </script>
  
  <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
  {!! JsValidator::formRequest('App\Http\Requests\BookRequest', '#bookForm'); !!}
</body>
</html>
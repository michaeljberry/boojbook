@extends('layouts.app', ['page_title' => 'Dashboard'])
@section('content')
<div class="main-wrapper container">
  @include('layouts.header')
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
                    <th></th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date Publish</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="elements">
                  @foreach($books as $key => $book)
                  <tr id="item-{{ $book->id }}">
                    <td>{{ $book->order_id }}</td>
                    <td><img src="{{ url($book->photo_display) }}" alt="" class="img-book"></td>
                    <td><a href="javascript:;" onclick="viewBook(<?php echo $book->id; ?>)">{{ $book->title }}</a></td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->date_publish_display }}</td>
                    <td>
                      <div class="btn-group dropleft">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu" style="width:120px !important">
                          <a class="dropdown-item" href="javascript:;" onclick="updateBook(<?php echo $book->id; ?>)">Edit</a>
                          <a class="dropdown-item" href="javascript:;" onclick="deleteBook(<?php echo $book->id; ?>)">Delete</a>
                        </div>
                      </div>
                    </td>
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
  @include('layouts.footer')
</div>
@include('modals.book')
@endsection

@section('page-css')
<link rel="stylesheet" href="{{ url('assets/modules/izitoast/css/iziToast.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

<style>
.img-book {
  width: 50px;
  height: 70px;
  object-fit: cover;
  border: 1px solid #eee;
}
.input-group-text, select.form-control:not([size]):not([multiple]), .form-control:not(.form-control-sm):not(.form-control-lg) {
  font-size: 13px;
  padding: 6px 10px !important;
  height: 32px !important;
}
</style>
@endsection

@section('page-js')
<script src="{{ url('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ url('assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ url('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

<script>
var table;
$(document).ready(function () {
  $('#create-book').click(function() {
    $('#book_id').val('');
    $('#bookForm')[0].reset();
    $('#bookModal').modal();
  });

  <?php if(session()->has('msg')){ ?>
  iziToast.success({
    title: 'Great!',
    message: '<?php echo session()->get('msg'); ?>',
    position: 'topRight'
  });
  <?php } ?>

  // var tableColumn = localStorage.getItem("table-column");
  // var tableOrder = localStorage.getItem("table-order");
  // if(tableColumn === null && tableOrder === null){
    var tableColumn = 0;
    var tableOrder = 'asc';
  // }

  table = $("#book-table").dataTable({
    "columnDefs": [
      { "sortable": false, "targets": [0,1,5] },
      {
        "targets": [0],
        "visible": false,
        "searchable": false
      }
    ],
    "order": [[ tableColumn, tableOrder ]],
  });

  // table.on('click', 'th', function() {
  //   var info = table.fnSettings().aaSorting;
  //   localStorage.setItem("table-column", info[0][0]);
  //   localStorage.setItem("table-order", info[0][1]);
  // });

  $('#deletephoto').click(function() {
    if(confirm('Are you sure you want to delete this photo?')){
      var id = $("#book_id").val();
      $.ajax({
        type: "POST",
        url: "{{ url('book/deletephoto') }}",
        data: {id: id},
        dataType: "json",
        success: function (response) {
          $('#photoFile').hide();
          $('#inputFile').show();
        }
      });
    }
  });

  $('#elements').sortable({
    axis: 'y',
    update: function (event, ui) {
      var data = $(this).sortable('serialize');
      // POST to server using $.post or $.ajax
      $.ajax({
        data: data,
        type: 'POST',
        url: "{{ url('book/sort') }}"
      });
    }
  });
});

function viewBook(id){
  $.ajax({
    type: "GET",
    url: "{{ url('book') }}/"+id,
    dataType: "json",
    success: function (response) {
      $('#card-content').html(response.bookContent);
      $('#viewBookModal').modal();
    }
  });
}

function updateBook(id){
  $.ajax({
    type: "GET",
    url: "{{ url('book') }}/"+id+"/edit",
    dataType: "json",
    success: function (response) {
      $('#book_id').val(id);
      $('#title').val(response.book.title);
      $('#author').val(response.book.author);
      $('#date_publish').val(response.book.date_publish);
      $('#title').val(response.book.title);
      if(response.book.photo){
        $('#photoFile').show();
        $('#inputFile').hide();
      } else {
        $('#photoFile').hide();
        $('#inputFile').show();
      }
      $('#bookModal').modal();
    }
  });
}

function deleteBook(id){
  if(confirm('Are you sure you want to delete this book?')){
    $.ajax({
      type: "DELETE",
      url: "{{ url('book') }}/"+id,
      dataType: "json",
      success: function (response) {
        table.draw();
      }
    });
  }
}
</script>
{!! JsValidator::formRequest('App\Http\Requests\BookRequest', '#bookForm'); !!}
@endsection
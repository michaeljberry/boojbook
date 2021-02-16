@extends('layouts.app', ['page_title' => 'Datatable'])
@section('content')
<div class="main-wrapper container">
  @include('layouts.header')
  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data using Yajra</h1>
      </div>

      <div class="section-body">
        <div class="card">
          <div class="card-body">
            <table class="table table-hover" id="yajra-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Client Name</th>
                  <th>Contract Date</th>
                  <th>Status</th>
                  <th>Result</th>
                  <th>Program</th>
                  <th>Track</th>
                </tr>
              </thead>
              <tbody>
                @foreach($clients as $key => $client)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $client->first_name.' '.$client->first_name }}</td>
                  <td>{{ $client->created_at }}</td>
                  <td>Active</td>
                  <td>Good</td>
                  <td>{{ (!empty($client->program)) ? $client->program->name : '' }}</td>
                  <td>On Track</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
  @include('layouts.footer')
</div>
@endsection

@section('page-css')
<link rel="stylesheet" href="{{ url('assets/modules/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/datatables-keytable/css/keyTable.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/datatables-responsive/css/responsive.bootstrap4.css') }}">
@endsection

@section('page-js')
<script src="{{ url('assets/modules/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/modules/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/modules/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('assets/modules/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/modules/DataTables-1.10.12/extensions/Pagination/input.js') }}"></script>

<script type="text/javascript">
var yajraTable;
$(document).ready(function() {
  // yajraTable = $('#yajra-table').DataTable({
  //   "ajax": "{{ url('json/client.json') }}"
  // });
});
</script>
@endsection
@extends('layout.master')

@section('title')
    Laporan Pendapatan: {{ tanggal_indonesia($tanggalAwal, false) }} s/d {{ tanggal_indonesia($tanggalAkhir, false) }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ public_path('AdminLTE-2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('breadcrumb')
    @parent
    <li class="active">Laporan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <button onclick="updatePeriode()" class="btn btn-info btn-sm btn-flat">
                    <i class="fa fa-plus-circle"></i> Ubah Periode
                </button>
                <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank" class="btn btn-success btn-sm btn-flat">
                    <i class="fa fa-file-pdf-o"></i> Export PDF
                </a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Penjualan</th>
                        <th>Pembelian</th>
                        <th>Pengeluaran</th>
                        <th>Pendapatan</th>
                    </thead>
                  </table>
            </div>
          </div>
        </div>
      </div>

      @includeIf('laporan.form')
@endsection

@push('scripts')
<script src="{{ public_path('AdminLTE-2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    let table;

    $(function () {
        // // sidebar collapse
        // $('body').addClass('sidebar-collapse');
        
      table = $('.table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'tanggal'},
            {data: 'penjualan'},
            {data: 'pembelian'},
            {data: 'pengeluaran'},
            {data: 'pendapatan'},
        ],
        dom: 'Brt',
        bSort: false,
        bPaginate: false,
      });

      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });
    });

    function updatePeriode(){
        $('#modal-form').modal('show');
    }
  </script>
@endpush
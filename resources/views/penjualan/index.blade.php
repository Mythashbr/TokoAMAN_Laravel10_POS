@extends('layout.master')

@section('title')
    Daftar Penjualan
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Penjualan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-penjualan">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Kode Member</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th>Diskon</th>
                        <th>Total Bayar</th>
                        <th>Kasir</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
          </div>
        </div>
      </div>

      @includeIf('penjualan.detail')
@endsection

@push('scripts')
<script>
    let table, table1;

    $(function () {
        // // sidebar collapse
        // $('body').addClass('sidebar-collapse');

      table = $('.table-penjualan').DataTable({
        processing: true,
        autoWidth: false,
        ajax: {
            url: '{{ route('penjualan.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'tanggal'},
            {data: 'kode_member'},
            {data: 'total_item'},
            {data: 'total_harga'},
            {data: 'diskon'},
            {data: 'bayar'},
            {data: 'kasir'},
            {data: 'aksi', searchable: false, sortable: false},
        ]
      });

      table1 = $('.table-detail').DataTable({
        processing: true,
        bsort: false,
        dom: 'Brt',
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'kode_produk'},
            {data: 'nama_produk'},
            {data: 'harga_jual'},
            {data: 'jumlah'},
            {data: 'subtotal'}
        ]
      })
    });
    
    function showDetail(url) {
        $('#modal-detail').modal('show');

        table1.ajax.url(url);
        table1.ajax.reload();
    }

    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
            $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'delete'
        })
            .done((response) => {
                table.ajax.reload();
                toastr.success('Data berhasil dihapus!')
            })
            .fail((errors) => {
                toastr.error('Gagal menghapus data!')
                    return;
                });
        }
    }
</script>
@endpush
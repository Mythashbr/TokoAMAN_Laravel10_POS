@extends('layout.master')

@section('title')
    Daftar User
@endsection

@section('breadcrumb')
    @parent
    <li class="active">User</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <button type="button" onclick="addForm('{{ route('user.store') }}')" class="btn btn-success btn-sm btn-flat">
                    <i class="fa fa-plus-circle"></i> Tambah
                </button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                  </table>
            </div>
          </div>
        </div>
      </div>

      @includeIf('user.form')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
        // // sidebar collapse
        // $('body').addClass('sidebar-collapse');

      table = $('.table').DataTable({
        processing: true,
        autoWidth: false,
        ajax: {
            url: '{{ route('user.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'name'},
            {data: 'email'},
            {data: 'aksi', searchable: false, sortable: false},
        ]
      });

      $('#modal-form').validator().on('submit', function(e) {
        if(! e.preventDefault()) {
            $.post( $('#modal-form form').attr('action'), $('#modal-form form').serialize())
                .done((response) => {
                    $('#modal-form').modal('hide');
                    table.ajax.reload();
                    toastr.success('Data berhasil disimpan!')
                })
                .fail((errors) => {
                    toastr.error('Gagal menyimpan data!')
                    return;
                });
        }
      });
    });

    function addForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah user');
        
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=name]').focus();

        $('#password, #password_confirmation').attr('required', true);
    }
    
    function editForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Ubah user');
        
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=name]').focus();

        $('#password, #password_confirmation').attr('required', false);

        $.get(url)
            .done((response) => {
                $('#modal-form [name=name]').val(response.name);
                $('#modal-form [name=email]').val(response.email);
            })
            .fail((errors) => {
                toastr.error('Gagal mengubah data!')
                    return;
                });
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
@extends('backend.layouts.master')

@section('main_section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content col-md-8">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                Add Role
            </button>
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Roles Table</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Role Name</th>
                                <th scope="col">Register Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $serial = 1;
                            @endphp
                            @forelse ($roles as $role)
                                <tr>
                                    <th scope="row">{{ $serial++ }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    <td> <button type="button" class="btn btn-primary editButton"
                                            data-id="{{ $role->id }}" data-name="{{ $role->name }}"
                                            data-toggle="modal" data-target="#editModal">
                                            Edit </button></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data Not Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formData">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Role Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Role Name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formDataEdit">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Update Role Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_name">Role Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name"
                                placeholder="Enter Role Name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="idd">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.editButton').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                $('#idd').val(id);
                $('#edit_name').val(name);
            });
            $('#formData').submit(function(e) {
                e.preventDefault();
                var formData = new FormData($('#formData')[0]); // Corrected 'FormData'
                $.ajax({
                    url: "{{ url('store-role-ajax') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                    },
                    complete: function(done) {
                        if (done.status == 200) {
                            location.reload(true);
                        }
                    }
                });
            });
            $('#formDataEdit').submit(function(e) {
                e.preventDefault();
                var formData = new FormData($('#formDataEdit')[0]); // Corrected 'FormData'
                $.ajax({
                    url: "{{ url('update-role-ajax') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                    },
                    complete: function(done) {
                        if (done.status == 200) {
                            location.reload(true);
                        }
                    }
                });
            });
        });
    </script>
@endsection

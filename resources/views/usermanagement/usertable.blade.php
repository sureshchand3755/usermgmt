@extends('layouts.master')
@section('content')
<link href="{{ URL::to('assets/css/custom_style.css') }}" rel="stylesheet">
{{-- message --}}
{!! Toastr::message() !!}

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List</h4>
                        <a class="btn btn-secondary shadow btn-xs sharp me-1" href="#" data-toggle="modal" id="createNewUser"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive12">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Position</label>
                                    {!! Form::select('position_id', $position, null, ['class' => 'form-select', 'id' => 'dposition_id']) !!}
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Department</label>
                                    {!! Form::select('department_id', $department, null, ['class' => 'form-select', 'id' => 'ddepartment_id']) !!}
                                </div>
                            </div>
                            <table id="exampleList" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Depart.</th>
                                        <th>Pos.</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Expense Modal -->
<div id="ajaxModel" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading">Add User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user/store') }}" method="POST" id="add_user_form" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="e_user_id" id="user_id">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="a_name" name="name">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="a_email" name="email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Mobile</label>
                            <input type="tel" class="form-control" id="a_phone_number" name="phone_number">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Department</label>
                            {!! Form::select('department_id', $department, null, ['class' => 'form-select', 'id' => 'department_id']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Position</label>
                            {!! Form::select('position_id', $position, null, ['class' => 'form-select', 'id' => 'position_id']) !!}
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Status</label>
                            {!! Form::select('user_type_id', $status, null, ['class' => 'form-select', 'id' => 'user_type_id']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Country</label>
                            {!! Form::select('country_id', $country, null, ['class' => 'form-select', 'id' => 'country_id']) !!}
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">State</label>
                            <select id="state_id" name="state_id" class="form-select">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Upload File</label>
                            <div class="input-group mb-6">
                                <div class="form-file">
                                    <input type="file" class="form-file-input form-control" name="upload">
                                </div>
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary-save submit-btn"  id="saveBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Expense Modal -->

<!-- View User Modal -->
<div class="modal custom-modal fade" id="view_user" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>View User</h3>
                    <button type="button" class="close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-btn">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <p id="v_name"></p>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Email</label>
                            <p id="v_email"></p>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Mobile</label>
                            <p id="v_mobile"></p>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Department</label>
                            <p id="v_department"></p>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Position</label>
                            <p id="v_position"></p>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Country</label>
                            <p id="v_country"></p>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">State</label>
                            <p id="v_state"></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /View User Modal -->

<!-- Delete User Modal -->
<div class="modal custom-modal fade" id="delete_user" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete User</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <form action="{{ route('user/delete') }}" method="POST">
                        @csrf
                        <input type="hidden" id="e_id" name="id">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary-cus continue-btn submit-btn">Delete</button>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary-cus cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete User Modal -->
@section('script')

    <!-- Bootstrap Core JS -->
    <script src="{{URL::to('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::to('assets/js/jquery.toaster.js')}}"></script>
<!-- jQuery validation plugin -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    {{-- show data on model or edit --}}
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#user_id').hide();

        $('#createNewUser').click(function () {
            $('#saveBtn').val("create-user");
            $('#user_id').val('');
            $('#add_user_form').trigger("reset");
            $('#modelHeading').html("Create New User");
            $('#ajaxModel').modal('show');
        });
        $(document).on('click','.editUser',function()
        {
            var id = $(this).data('id');
            var url = "{{ route('user.edit', ':id') }}";
            url = url.replace(':id', id);
            $.get(url, function (data) {
                $('#modelHeading').html("Edit User");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#user_id').val(id);
                $('#a_user_id').val(data.user_id);
                $('#a_name').val(data.name);
                $('#a_email').val(data.email);
                $('#a_phone_number').val(data.phone_number);
                $('#department_id').val(data.department_id);
                $('#position_id').val(data.position_id);
                $('#user_type_id').val(data.user_type_id);
                $('#country_id').val(data.country_id);
                stateList(data.country_id, data.state_id);
            })
        });
    </script>

    {{-- delete user --}}
    <script>
        $(document).on('click','.viewUser',function()
        {
            var id = $(this).data('id');
            var url = "{{ route('user.view', ':id') }}";
            url = url.replace(':id', id);
            $.get(url, function (data) {
                $('#v_name').text(data.name);
                $('#v_email').text(data.email);
                $('#v_mobile').text(data.phone_number);
                $('#v_department').text(data.department.name);
                $('#v_position').text(data.position.name);
                $('#v_country').text(data.country.name);
                $('#v_state').text(data.state.name);
            })
        });

        $(document).on('click','.delete_user',function()
        {
            var id = $(this).data('id');
            $('#e_id').val(id);
        });
        $(document).on('click','.changestatus',function()
        {
            var id = $(this).data('id');
            var url = "{{ route('user.changestatus', ':id') }}";
            url = url.replace(':id', id);
            $.get(url, function (data) {
                console.log(data)
            })
        });

        $(document).ready( function () {

            $('#country_id').on('change', function () {
                var idCountry = this.value;
                $("#state_id").html('');
                $.ajax({
                    url: "{{url('user/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state_id').html('<option value="">Select State</option>');
                        $.each(result.states, function (key, value) {
                            $("#state_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });                    }
                });
            });
            var table = $('#exampleList').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('getlist') }}",
                        data: function (d) {
                        d.position_id = $('select[name=position_id]').val();
                        d.department_id = $('select[name=department_id]').val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'department', name: 'department'},
                    {data: 'position', name: 'position'},
                    {data: 'country', name: 'country'},
                    {data: 'state', name: 'state'},
                    {data: 'status_name', name: 'status_name'},
                    {data: 'action', name: 'action'},
                ]
            });
            $('#position_id').on('change', function () {
                table.draw();
            });
            // $("#add_user_form").validate({
            //     rules: {
            //         name: "required",
            //         email: "required",
            //         phone_number: "required",
            //         role_name: "required",
            //         status: "required"
            //     },
            //     messages: {
            //         name: "Please enter name",
            //         email: "Please enter email",
            //         phone_number: "Please enter mobile number",
            //         role_name: "Please select role",
            //         status: "Please select status",
            //     }
            // });
        } )

        function stateList(country_id, state_id){
            $.ajax({
                    url: "{{url('user/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state_id').html('<option value="">Select State</option>');
                        $.each(result.states, function (key, value) {
                            $("#state_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#state_id').val(state_id)
                    }

                });
        }
    </script>

@endsection
@endsection

@extends('layouts.container')

@section('title', 'TODO')
@section('page_js')
    <script type="text/javascript" nonce="{{ csp_nonce() }}">
        document.addEventListener('DOMContentLoaded', function(e) {
            $('#navbarVerticalMenu').find('#task-schedule-menu').addClass('active');

            var oTable = $('#taskTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('todo.index') }}",
                columns: [{
                        data: 'title'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'priority',
                    },
                    {
                        data: 'due_date'
                    },
                    {
                        data: 'action',
                        className: 'sticky-col'
                    },
                ],
            });

            $('#taskTable').on('click', '.delete-record', function(e) {
                e.preventDefault();
                ajaxMasterRecordDelete($(this), oTable);
            });



            $(document).on('click', '.open-modal-form', function(e) {
                e.preventDefault();
                $('#openModal').find('.modal-content').html('');
                $('#openModal').modal('show').find('.modal-content').load($(this).attr('href'), function() {
                    const form = document.getElementById('taskForm');

                    $(form).find(".select2").select2({
                        dropdownParent: $(form),
                        width: '100%',
                        dropdownAutoWidth: true
                    });

                    $(form).find("input[name='due_date']").attr('data-toggle', 'datepicker')
                        .datepicker({
                            language: 'en-GB',
                            autoHide: true,
                            format: 'yyyy-mm-dd',
                            zIndex: 1100,
                        });

                    const fv = FormValidation.formValidation(form, {
                        fields: {
                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'The title is required',
                                    },
                                },
                            },
                            due_date: {
                                validators: {
                                    notEmpty: {
                                        message: 'The date is required',
                                    },
                                },
                            },
                            description: {
                                validators: {
                                    notEmpty: {
                                        message: 'The description is required',
                                    },
                                },
                            },

                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap5: new FormValidation.plugins.Bootstrap5(),
                            submitButton: new FormValidation.plugins.SubmitButton(),
                            icon: new FormValidation.plugins.Icon({
                                valid: 'bi bi-check2-square',
                                invalid: 'bi bi-x-lg',
                                validating: 'bi bi-arrow-repeat',
                            }),
                        },
                    }).on('core.form.valid', function(event) {
                        $url = fv.form.action;
                        $form = fv.form;
                        data = $($form).serialize();
                        var successCallback = function(response) {
                            $('#openModal').modal('hide');
                            toastr.success(response.message, 'Success', {
                                timeOut: 5000
                            });
                            console.log(response);
                            oTable.ajax.reload(null, false);
                        }
                        ajaxSubmit($url, 'POST', data, successCallback);
                    });
                });
            });
        });
    </script>
@endsection
@section('page-content')

    <div class="m-content">
        <div class="pb-3 mb-3 border-bottom">
            <div class="d-flex align-items-center">
                <div class="brd-crms flex-grow-1">
                    <nav aria-label="breadcrumb">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}"
                                    class="text-decoration-none">{{ __('label.home') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                {{ __('label.income-budget') }}
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                        </ol>
                    </nav>
                    <h4 class="m-0 mt-1 lh1 fs-6 text-uppercase fw-bold text-primary">@yield('title')</h4>
                </div>
                <div class="add-info justify-content-end">
                    <button data-toggle="modal" class="btn btn-warning btn-sm open-modal-form"
                        href="{{ route('todo.create') }}">
                        <i class="bi-plus"></i> Add New
                    </button>
                </div>
            </div>
        </div>
        <div class="container-fluid-s">
            <div class="border-0 shadow-sm card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="taskTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Task</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Due Date</th>
                                    <th style="width: 10%" class="sticky-col">{{ __('label.action') }}</th>
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

@stop

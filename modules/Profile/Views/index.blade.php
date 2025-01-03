@extends('layouts.container')

@section('title', 'TODO')

@section('page_js')
    <script type="text/javascript" nonce="{{ csp_nonce() }}">
        document.addEventListener('DOMContentLoaded', function(e) {
            $('#navbarVerticalMenu').find('#profile-menu').addClass('active');

            const form = document.getElementById('profileForm');

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
    </script>
@endsection
@section('page-content')

    <div class="m-content">

        <div class="page-header pb-3 mb-3 border-bottom">
            <div class="d-flex align-items-center">
                <div class="brd-crms flex-grow-1">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{!! route('dashboard.index') !!}" class="text-decoration-none">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                        </ol>
                    </nav>
                    <h4 class="m-0 lh1 mt-1 fs-6 text-uppercase fw-bold text-primary">@yield('title')</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid-s">
            <form action="{{ route('profile.update', $user->user_code) }}" id="profileForm" method="POST"
                enctype="multipart/form-data" autocomplete="off">
                <div class="mb-4">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header border-0">
                                    <div class="box-info-area-adduser fw-bold fs-6">Credentials</div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3 row mx-2">
                                        <label class="form-label">{!! __('label.user-id') !!}</label>
                                        <input type="text" disabled="disabled" value="{!! $user->user_code !!}"
                                            class="form-control form-control-sm" tabindex="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header border-0">
                                    <div class="box-info-area-adduser fw-bold fs-6">{{ __('label.information') }}</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row mx-2">
                                                <label class="form-label required-label">{!! __('label.full-name') !!}
                                                </label>
                                                <input type="text" name="full_name" value="{!! old('full_name') ?: $user->full_name !!}"
                                                    placeholder="" class="form-control form-control-sm" tabindex="5">
                                                @if ($errors->has('full_name'))
                                                    <div class="fv-plugins-message-container invalid-feedback">
                                                        <div data-field="full_name">
                                                            {!! $errors->first('full_name') !!}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group mb-3 row mx-2">
                                                <label class="form-label required-label">{!! __('label.mobile-no') !!}
                                                </label>
                                                <input type="number" name="mobile_number" value="{!! old('mobile_number') ?: $user->mobile_number !!}"
                                                    placeholder="" class="form-control form-control-sm" tabindex="6">
                                                @if ($errors->has('mobile_number'))
                                                    <div class="fv-plugins-message-container invalid-feedback">
                                                        <div data-field="mobile_number">
                                                            {!! $errors->first('mobile_number') !!}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group mb-3 row mx-2">
                                                <label class="form-label required-label">{!! __('label.email') !!}
                                                </label>
                                                <input type="email" name="email_address" value="{!! old('email_address') ?: $user->email_address !!}"
                                                    placeholder="" class="form-control form-control-sm" tabindex="7">
                                                @if ($errors->has('email_address'))
                                                    <div class="fv-plugins-message-container invalid-feedback">
                                                        <div data-field="email_address">
                                                            {!! $errors->first('email_address') !!}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-0 text-end">
                                <button type="submit" name="btn" class="btn btn-primary btn-sm">
                                    {{ __('label.update') }}
                                </button>
                                <a href="{!! route('dashboard.index') !!}" class="btn btn-danger btn-sm">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
                {!! csrf_field() !!}
                {!! method_field('PUT') !!}
            </form>
        </div>
    </div>
@stop

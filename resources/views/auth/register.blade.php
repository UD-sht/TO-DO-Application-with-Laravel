@extends('auth.loginmaster')

@section('title', 'User Login')

@push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function(e) {

            const form = document.getElementById('userForm');

            const strongPassword = function() {
                return {
                    validate: function(input) {
                        const value = input.value;
                        if (value === '') {
                            return {
                                valid: true,
                            };
                        }

                        // Check the password strength
                        if (value.length < 8) {
                            return {
                                valid: false,
                                message: 'The password must be more than 8 characters long',
                            };
                        }

                        // The password does not contain any uppercase character
                        if (value === value.toLowerCase()) {
                            return {
                                valid: false,
                                message: 'The password must contain at least one upper case character',
                            };
                        }

                        // The password does not contain any uppercase character
                        if (value === value.toUpperCase()) {
                            return {
                                valid: false,
                                message: 'The password must contain at least one lower case character',
                            };
                        }

                        // The password does not contain any digit
                        if (value.search(/[0-9]/) < 0) {
                            return {
                                valid: false,
                                message: 'The password must contain at least one digit',
                            };
                        }

                        if (!value.match(/\W/)) {
                            return {
                                valid: false,
                                message: 'The password must contain at least one special character',
                            };
                        }

                        return {
                            valid: true,
                        };
                    },
                };
            };



            const fv = FormValidation.formValidation(form, {
                    fields: {
                        user_code: {
                            validators: {
                                notEmpty: {
                                    message: 'The user code is required.',
                                },
                                remote: {
                                    message: 'The user code is already taken',
                                    method: 'POST',
                                    url: baseUrl + '/api/validate/employee-code',
                                },
                            },
                        },
                        user_password: {
                            validators: {
                                notEmpty: {
                                    message: 'The password is required.',
                                },
                                checkPassword: {
                                    message: 'The password is too weak.',
                                },
                            },
                        },
                        retype_user_password: {
                            validators: {
                                identical: {
                                    compare: function() {
                                        return form.querySelector(
                                                '[name="user_password"]')
                                            .value;
                                    },
                                    message: 'The confirm password did not match with password.',
                                },
                            }
                        },
                        full_name: {
                            validators: {
                                notEmpty: {
                                    message: 'The full name is required.',
                                },
                            },
                        },
                        mobile_number: {
                            validators: {
                                notEmpty: {
                                    message: 'The mobile number is required.',
                                },
                            },
                        },
                        email_address: {
                            validators: {
                                notEmpty: {
                                    message: 'The email address is required.',
                                },
                                emailAddress: {
                                    message: 'The email address is not valid.',
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap5: new FormValidation.plugins.Bootstrap5(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                        icon: new FormValidation.plugins.Icon({
                            valid: 'bi bi-check2-square',
                            invalid: 'bi bi-x-lg',
                            validating: 'bi bi-arrow-repeat',
                        }),
                    },
                }).registerValidator('checkPassword', strongPassword)
                .on('core.form.valid', function(event) {
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

            $(form).on('input', '[name="user_password"]', function() {
                fv.revalidateField('user_password');
            }).on('input', '[name="retype_user_password"]', function() {
                fv.revalidateField('retype_user_password');
            });
        });
    </script>
@endpush
@section('page-content')

    <div class="login d-flex justify-content-center align-items-center">
        <div class="auth-content overflow-hidden rounded-3">
            <div class="col-12">
                <form action="{{ route('register.store') }}" id="userForm" method="post" enctype="multipart/form-data"
                    autocomplete="off">
                    <div class="mb-4">
                        <div class="border-0 shadow-sm card">
                            <div class="border-0 card-header d-flex justify-content-center">
                                <div class="box-info-area-adduser fw-bold fs-2 text-dark">Register Form</div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 form-group">
                                    <label class="form-label">{!! __('label.user-id') !!}</label>
                                    <input type="number" name="user_code" placeholder="" value="{!! old('user_code') !!}"
                                        class="form-control form-control-sm" tabindex="1">
                                    @if ($errors->has('user_code'))
                                        <div class="fv-plugins-message-container invalid-feedback">
                                            <div data-field="user_code">{!! $errors->first('user_code') !!}</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3 form-group">
                                    <label class="form-label required-label">{!! __('label.full-name') !!}</label>
                                    <input type="text" name="full_name" value="{!! old('full_name') !!}" placeholder=""
                                        class="form-control form-control-sm" tabindex="2">
                                    @if ($errors->has('full_name'))
                                        <div class="fv-plugins-message-container invalid-feedback">
                                            <div data-field="full_name">{!! $errors->first('full_name') !!}</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3 form-group">
                                    <label class="form-label required-label">{!! __('label.mobile-no') !!}</label>
                                    <input type="number" name="mobile_number" value="{!! old('mobile_number') !!}"
                                        placeholder="" class="form-control form-control-sm" tabindex="3">
                                    @if ($errors->has('mobile_number'))
                                        <div class="fv-plugins-message-container invalid-feedback">
                                            <div data-field="mobile_number">{!! $errors->first('mobile_number') !!}</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3 form-group">
                                    <label class="form-label required-label">{!! __('label.email') !!}</label>
                                    <input type="email" name="email_address" value="{!! old('email_address') !!}"
                                        placeholder="" class="form-control form-control-sm" tabindex="4">
                                    @if ($errors->has('email_address'))
                                        <div class="fv-plugins-message-container invalid-feedback">
                                            <div data-field="email_address">{!! $errors->first('email_address') !!}</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3 form-group">
                                    <label class="form-label">{!! __('label.password') !!}</label>
                                    <span class="input-info-s">
                                        <i class="fa la-info-circle" data-toggle="tooltip"
                                            title="Your password must be at least 6 characters long, contain letters and numbers, and must not contain special characters or emoji and must not start or end with spaces."></i>
                                    </span>
                                    <input type="password" name="user_password" placeholder=""
                                        class="form-control form-control-sm{{ $errors->has('user_password') ? ' p-d-m' : '' }}"
                                        tabindex="5">
                                    @if ($errors->has('user_password'))
                                        <div class="fv-plugins-message-container invalid-feedback">
                                            <div data-field="user_password">{!! $errors->first('user_password') !!}</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3 form-group">
                                    <label class="form-label">{!! __('label.password-retype') !!}</label>
                                    <input type="password" name="retype_user_password" placeholder=""
                                        class="form-control form-control-sm{{ $errors->has('retype_user_password') ? ' p-d-m' : '' }}"
                                        tabindex="6">
                                    @if ($errors->has('retype_user_password'))
                                        <div class="fv-plugins-message-container invalid-feedback">
                                            <div data-field="retype_user_password">{!! $errors->first('retype_user_password') !!}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="border-0 card-footer text-end">
                                <button type="submit" name="btn" class="btn btn-success btn-sm">Save</button>
                                <a href="{!! route('login') !!}" class="btn btn-danger btn-sm">Cancel</a>
                            </div>
                        </div>
                    </div>
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>
    </div>

@endsection

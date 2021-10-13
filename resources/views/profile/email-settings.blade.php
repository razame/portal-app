@extends('layouts.main')


@section('title')
    <title>{{config('app.name')}} | Email Settings</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
            <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center mr-1">
                    <!--begin::Mobile Toggle-->
                    <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                        <span></span>
                    </button>
                    <!--end::Mobile Toggle-->
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Email Settings</h2>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                            <li class="breadcrumb-item text-muted">
                                <a href="" class="text-muted">Profile</a>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="" class="text-muted">Email Settings</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center flex-wrap">
                    <!--begin::Button-->
                    <!--end::Button-->
                    <!--begin::Dropdown-->
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Profile Email Settings-->
                <div class="d-flex flex-row">
                    <!--begin::Aside-->
                    @include('profile.partials.aside')
                    <!--end::Aside-->
                    <!--begin::Content-->
                    <div class="flex-row-fluid ml-lg-8">
                        <!--begin::Card-->
                        <div class="card card-custom">
                            <!--begin::Header-->
                            <div class="card-header py-3">
                                <div class="card-title align-items-start flex-column">
                                    <h3 class="card-label font-weight-bolder text-dark">Change Email</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account Email</span>
                                </div>
                                <div class="card-toolbar">
                                    <button id="save_changes" type="button" class="btn btn-success mr-2">Save Changes</button>
                                    <button id="reset" type="button" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="form" id="change-email-form">
                                <div class="card-body">
                                    <!--begin::Alert-->
                                    @include('layouts.messages')
                                    <!--end::Alert-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Email</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input id="old_email" type="email" class="form-control form-control-lg form-control-solid mb-2" value="" placeholder="Current Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Email</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input id="email" type="email" class="form-control form-control-lg form-control-solid" value="" placeholder="New Email">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Profile Email Settings-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

    <script>

    </script>
@endsection


@section('scripts')
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $('#reset').on('click', function(){
            $('#change-email-form').trigger("reset");
        });

        $('#save_changes').on('click', function(){
            $('#change-email-form').submit();
        });

        $('#change-email-form').submit(function(e){
            e.preventDefault();
        }).validate({
            // initialize the plugin
            rules: {
                old_email: "required",
                email: "required"
            },
            messages: {
                old_email: "<span class='alert alert-danger'>Old Email is required</span>",
                email: "<span class='alert alert-danger'>New Email is required</span>"
            },
            submitHandler: function() {

                $('#save_changes').attr('disabled', 'disabled');

                let old_email = $('#old_email').val();
                let email = $('#email').val();

                $.ajax({
                    url: "{{route('changeEmail')}}",
                    method: 'POST',
                    data: {
                        old_email: old_email,
                        email: email,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (result, textStatus, xhr){

                        if(xhr.status === 404){
                            showAlert('error-message-div', ['Unauthorized']);
                            setTimeout(function (){
                                location.reload();
                            }, 1000);
                        }

                        else if(xhr.status === 200 && result === email){
                            showAlert('saved-success-message-div');
                            $('.email').html(email);
                        }

                        else {
                            showAlert('error-message-div', result);
                        }

                    },
                    error: function (result, textStatus, xhr){
                        showAlert('error-message-div', result.responseJSON);
                    },
                    complete: function (){
                        $('#save_changes').removeAttr('disabled');
                        $('#change-email-form').trigger("reset");
                    }
                })
            }
        });
    </script>
@endsection

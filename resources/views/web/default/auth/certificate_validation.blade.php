@extends(getTemplate().'.layouts.app')

@section('content')
    <div class="container">
        <div class="row login-container">
            <div class="col-12 col-md-6 pl-0">
                <img src="{{ getPageBackgroundSettings('certificate_validation') }}" class="img-cover" alt="Login">
            </div>

            <div class="col-12 col-md-6">

                <div class="login-card">
                    <h1 class="font-20 font-weight-bold">{{ trans('site.certificate_validation') }}</h1>
                    <p class="font-14 text-gray mt-15">{{ trans('site.certificate_validation_hint') }}</p>


                    <form method="post" action="/certificate_validation/validate" class="mt-35">
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label class="input-label" for="code">{{ trans('public.certificate_id') }}:</label>
                            <input type="tel" name="certificate_id" class="form-control" id="certificate_id" aria-describedby="certificate_idHelp">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">{{ trans('site.captcha') }}</label>
                            <div class="row align-items-center">
                                <div class="col">
                                    <input type="text" name="captcha" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <img id="captchaImageComment" class="captcha-image" src="">

                                    <button type="button" id="refreshCaptcha" class="btn-transparent ml-15">
                                        <i data-feather="refresh-ccw" width="24" height="24" class=""></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="formSubmit" class="btn btn-primary btn-block mt-20">{{ trans('cart.validate') }}</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="certificateModal" class="d-none">
        <h3 class="section-title after-line">{{ trans('site.certificate_is_valid') }}</h3>
        <div class="mt-25 d-flex flex-column align-items-center">
            <img src="/assets/default/img/check.png" alt="" width="120" height="117">
            <p class="mt-10">{{ trans('site.certificate_is_valid_hint') }}</p>
            <div class="w-75">

                <div class="mt-15 d-flex justify-content-between">
                    <span class="text-gray font-weight-bold">{{ trans('quiz.student') }}:</span>
                    <span class="text-gray modal-student"></span>
                </div>

                <div class="mt-15 d-flex justify-content-between">
                    <span class="text-gray font-weight-bold">{{ trans('admin/main.mobile') }}:</span>
                    <span class="text-gray modal-student-mobile"></span>
                </div>

                <div class="mt-10 d-flex justify-content-between">
                    <span class="text-gray font-weight-bold">{{ trans('public.date') }}:</span>
                    <span class="text-gray"><span class="modal-date"></span></span>
                </div>

                <div class="mt-10 d-flex justify-content-between">
                    <span class="text-gray font-weight-bold">{{ trans('webinars.webinar') }}:</span>
                    <span class="text-gray"><span class="modal-webinar"></span></span>
                </div>

                <div class="mt-10 d-flex justify-content-between">
                    <span class="text-gray font-weight-bold">{{ trans('admin/main.classes_durations') }}:</span>
                    <span class="text-gray"><span class="modal-webinar-duration"></span></span>
                </div>

                <div class="mt-10 d-flex justify-content-between">
                    <span class="text-gray font-weight-bold">{{ trans('admin/main.attach') }}:</span>
                    <span class="text-gray"><a class="modal-webinar-attachment" target="_blank"></a></span>
                </div>

            </div>
        </div>

        <div class="mt-30 d-flex align-items-center justify-content-end">
            <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">{{ trans('public.close') }}</button>
        </div>
    </div>

@endsection

@push('scripts_bottom')
    <script>
        (function ($) {
            "use strict";

            var certificateNotFound = '{{ trans('site.certificate_not_found') }}';
            var close = '{{ trans('public.close') }}';

            if ($('#captchaImageComment').attr("src") === '') {
                refreshCaptcha();
            }

            $('body').on('click', '#refreshCaptcha', function (e) {
                e.preventDefault();
                refreshCaptcha();
            });

            $('body').on('click', '#formSubmit', function (e) {
                e.preventDefault();
                const $this = $(this);
                $this.addClass('loadingbar primary').prop('disabled', true);

                const $form = $this.closest('form');
                const action = $form.attr('action');

                const data = $form.serializeObject();

                $.post(action, data, function (result) {
                    if (result && result.code === 404) {
                        Swal.fire({
                            icon: 'error',
                            html: '<h3 class="font-20 text-center text-dark-blue">' + certificateNotFound + '</h3>',
                            showConfirmButton: true,
                            showCancelButton: false,
                            confirmButtonText: close,
                            confirmButtonColor: '#f63c3c',
                            dangerMode: true
                        });
                    } else if (result && result.code === 200) {
                        const certificate = result.certificate;


                        $('#certificateModal .modal-student').text(certificate.student);
                        $('#certificateModal .modal-student-mobile').text(certificate.student_mobile);
                        $('#certificateModal .modal-webinar').text(certificate.webinar_title);
                        $('#certificateModal .modal-webinar-duration').text((certificate.course_duration/60)+"Hour");
                        $('#certificateModal .modal-date').text(certificate.date);
                        if(certificate.certificate_attachment!=null)
                        {
                            $('#certificateModal .modal-webinar-attachment').attr('href',certificate.certificate_attachment);
                            $('#certificateModal .modal-webinar-attachment').attr("download", "download");
                            $('#certificateModal .modal-webinar-attachment').text("{{trans('quiz.download_certificate')}}");
                        }else
                            $('#certificateModal .modal-webinar-attachment').text("{{trans('admin/main.no_certificate_attach')}}");

                        let modal = '<div id="validCertificateModal">';
                        modal += $('#certificateModal').html();
                        modal += '</div>';

                        Swal.fire({
                            html: modal,
                            showCancelButton: false,
                            showConfirmButton: false,
                            customClass: {
                                content: 'p-0 text-left',
                            },
                            width: '36rem',
                        });
                    }
                }).fail(err => {
                    var errors = err.responseJSON;
                    if (errors && errors.errors) {
                        Object.keys(errors.errors).forEach((key) => {
                            const error = errors.errors[key];
                            let element = $form.find('[name="' + key + '"]');
                            element.addClass('is-invalid');
                            element.parent().find('.invalid-feedback').text(error[0]);
                        });
                    }
                }).always(() => {
                    refreshCaptcha();
                    $this.removeClass('loadingbar primary').prop('disabled', false);
                })
            })
        })(jQuery)
    </script>
@endpush

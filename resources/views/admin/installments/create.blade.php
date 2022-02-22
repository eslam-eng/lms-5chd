@extends('admin.layouts.app')

@push('styles_top')
    <link href="/assets/default/vendors/sortable/jquery-ui.min.css"/>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{trans('admin/main.new') }} {{ trans('admin/main.installment') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="/admin/installment">{{ trans('admin/main.installment') }}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('admin/main.new') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="/admin/installment/store"
                                  method="Post">
                                {{ csrf_field() }}

                                <div class="form-group mt-15 ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="input-label d-block">{{ trans('admin/main.select_student') }}</label>

                                            <select name="student_id" id="student_id" class="form-control select2 @error('student_id')  is-invalid @enderror">
                                                <option disabled selected>{{ trans('admin/main.select_student') }}</option>
                                                @foreach($students as $student)
                                                    <option value="{{ $student->id }}">{{$student->full_name."/".$student->mobile}}</option>
                                                @endforeach
                                            </select>

                                            @error('student_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-15 ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="input-label d-block">{{ trans('admin/main.select_webinar') }}</label>

                                            <select name="webinar_id" id="webinar_id" class="form-control select2 @error('webinar_id')  is-invalid @enderror">
                                                <option disabled selected>{{ trans('admin/main.select_webinar') }}</option>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}">{{$course->title."/".$course->slug}}</option>
                                                @endforeach
                                            </select>

                                            @error('webinar_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-15">
                                    <div id="webinarInstallmentTable"></div>
                                    @error('installment_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                {{--                                payment value--}}
                                <div class="form-group mt-15">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="input-label">{{ trans('admin/main.payment_value') }}</label>
                                            <input type="number" min="1" id="payment_value" name="payment_value" value="{{  old('payment_value') }}" class="form-control @error('payment_value')  is-invalid @enderror"/>
                                            @error('payment_value')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="input-label d-block">{{ trans('admin/main.payment_type') }}</label>
                                            <select name="payment_type" class="custom-select @error('payment_type')  is-invalid @enderror">
                                                <option value="1" selected>{{ trans('admin/main.payment_type1') }}</option>
                                                <option value="2">{{ trans('admin/main.payment_type2') }}</option>
                                            </select>

                                            @error('payment_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group mt-15">
                                    <div class="row">
{{--                                        <div class="col-md-6 bg-info">--}}
{{--                                            <label class="input-label">{{ trans('admin/main.webinar_price') }}</label>--}}
{{--                                            <input readonly class="form-control" id="show_course_price">--}}
{{--                                        </div>--}}
                                        <div class="col-md-6">
                                            <label class="input-label">{{ trans('admin/main.discount_value') }}</label>
                                            <input type="number" min="1" id="discount_value" name="discount_value" value="{{  old('discount_value') }}" class="form-control @error('discount_value')  is-invalid @enderror"/>
                                            @error('discount_value')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 bg-warning">
                                            <label class="input-label">{{ trans('admin/main.webinar_remain') }}</label>
                                            <p class="form-control" id="priceremain">0</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-15">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="input-label">{{ trans('admin/main.installment_notes') }}</label>
                                            <input type="test" min="1" id="notes" name="note" value="{{  old('note') }}" class="form-control @error('note')  is-invalid @enderror"/>
                                            @error('note')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>


                                {{--is installments --}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input id="isInstallment" type="checkbox" name="is_installment"--}}
{{--                                               class="custom-control-input" checked>--}}
{{--                                        <label class="custom-control-label"--}}
{{--                                               for="hasSubCategory">{{ trans('admin/main.installment') }}</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <section>--}}
{{--                                    <h2 class="section-title after-line">{{ trans('admin/main.installment_info') }}</h2>--}}
{{--                                    <br>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group mt-15 ">--}}
{{--                                                <label class="input-label d-block">{{ trans('admin/main.installment_type') }}</label>--}}

{{--                                                <select name="installment_interval_type" class="custom-select @error('installment_interval_type')  is-invalid @enderror">--}}
{{--                                                    <option value="day">{{ trans('admin/main.day') }}</option>--}}
{{--                                                    <option value="month" selected>{{ trans('admin/main.month') }}</option>--}}
{{--                                                    <option value="year">{{ trans('admin/main.year') }}</option>--}}
{{--                                                </select>--}}

{{--                                                @error('installment_interval_type')--}}
{{--                                                <div class="invalid-feedback">--}}
{{--                                                    {{ $message }}--}}
{{--                                                </div>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group mt-15">--}}
{{--                                                <label class="input-label">{{ trans('admin/main.installment_interval_num') }}</label>--}}
{{--                                                <input type="number" min="1" name="installment_interval_num" value="{{  old('installment_interval_num') }}" class="form-control @error('installment_interval_num')  is-invalid @enderror"/>--}}
{{--                                                @error('installment_interval_num')--}}
{{--                                                <div class="invalid-feedback">--}}
{{--                                                    {{ $message }}--}}
{{--                                                </div>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group mt-15">--}}
{{--                                                <label class="input-label">{{ trans('admin/main.installment_num') }}</label>--}}
{{--                                                <input type="number" min="1" name="installment_num" value="{{  old('installment_num') }}" class="form-control @error('installment_num')  is-invalid @enderror"/>--}}
{{--                                                @error('installment_num')--}}
{{--                                                <div class="invalid-feedback">--}}
{{--                                                    {{ $message }}--}}
{{--                                                </div>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </section>--}}

                                <div class="text-right mt-4">
                                    <button class="btn btn-primary">{{ trans('admin/main.submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/sortable/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function () {
            // $('body').on('change', '#webinar_id', function (e) {
            //     coursePrice = $(this).find(':selected').data('price');
            //     $("#show_course_price").val(coursePrice);
            //     $("#payment_value").attr('max',coursePrice)
            // });

            var coursePrice = 0 ;
            var remainPrice =0;

            $("#webinar_id").change(function (){
                var course_id = $("#webinar_id").val();
                $('#webinarInstallmentTable').empty();
                var Table = '<table id="installmentPlans" class="table table-bordered table-striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th></th>' +
                    '<th>title</th>' +
                    '<th>price</th>' +
                    '<th>duration</th>' +
                    '<th>istallment num</th></tr></thead><tbody>';
                setTimeout(function () {
                    $.ajax({
                        url: "{{url('admin/installment/course/plans')}}",
                        data:{
                            'course_id':course_id
                        },
                        type: 'post',
                        success: function (data) {
                            if (data.status){
                                $.each(data.courses,function (key,value) {
                                    Table+='<tr><td><input type="radio" class="installmentPlanId" data-price="'+value.price+'" name="installment_plan_id" value="'+value.id+'"></td><td>'+value.title+'</td><td class="bg-info font-weight-bold text-white">'+value.price+'</td><td>'+value.installment_interval_number+'/'+value.installment_type+'</td><td>'+value.installment_num+'</td></tr>'
                                });
                                $("#webinarInstallmentTable").html(Table+'</tbody></table>')
                            }else
                                $.toast({
                                    heading: 'error',
                                    text: data.message,
                                    bgColor: 'f63c3c',
                                    textColor: 'white',
                                    hideAfter: 10000,
                                    position: 'bottom-right',
                                    icon: 'error'
                                });
                        },
                        error: function (data) {
                            alert('there is an error');
                        }
                    });
                }, 300);
            });

            $(document).on('change', '.installmentPlanId',function() {
                if ($(this).is(":checked")) {
                     coursePrice = $(this).data('price');
                }
            });
            $("#payment_value").keyup(function () {
                if ($('input[name=installment_plan_id]:checked').length > 0)
                {
                    let payment_value = $("#payment_value").val();
                    if(payment_value>coursePrice)
                    {
                        $("#payment_value").val(coursePrice)
                        var remainPrice = 0;
                    }else
                    {
                        remainPrice = coursePrice - payment_value;
                    }
                    $("#priceremain").html(remainPrice);
                }else {
                    $.toast({
                        heading: 'error',
                        text: 'please select Installment Plan',
                        bgColor: 'f63c3c',
                        textColor: 'white',
                        hideAfter: 10000,
                        position: 'bottom-right',
                        icon: 'error'
                    });
                }
            });
            $("#discount_value").keyup(function () {
                if ($('input[name=installment_plan_id]:checked').length > 0){
                    var discount_value = parseInt($("#discount_value").val());
                    var payment_value = parseInt($("#payment_value").val());
                    $("#priceremain").html(coursePrice-(discount_value+payment_value));
                }else
                {
                    $.toast({
                        heading: 'error',
                        text: 'please select Installment Plan',
                        bgColor: 'f63c3c',
                        textColor: 'white',
                        hideAfter: 10000,
                        position: 'bottom-right',
                        icon: 'error'
                    });
                }

            });
        })
    </script>
@endpush

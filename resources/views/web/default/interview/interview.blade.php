@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <style>
        * {
            margin: 0;
            padding: 0
        }

        html {
            height: 100%
        }

        #grad1 {
            background-color: : #9C27B0;
            background-image: linear-gradient(120deg, #FF4081, #81D4FA)
        }

        #msform {
            text-align: center;
            position: relative;
            margin-top: 20px
        }

        #msform fieldset .form-card {
            background: white;
            border: 0 none;
            border-radius: 0px;
            /*box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);*/
            padding: 20px 40px 30px 40px;
            /*box-sizing: border-box;*/
            width: 94%;
            margin: 0 3% 20px 3%;
            position: relative
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;
            position: relative
        }

        #msform fieldset:not(:first-of-type) {
            display: none
        }

        #msform fieldset .form-card {
            text-align: left;
            color: #9E9E9E
        }

        #msform input,
        #msform textarea {
            padding: 0px 8px 4px 8px;
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 16px;
            letter-spacing: 1px
        }

        #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: none;
            font-weight: bold;
            border-bottom: 2px solid skyblue;
            outline-width: 0
        }

        #msform .action-button {
            width: 115px;
            background: #2e9724;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
        }

        #msform .action-button-previous {
            width: 115px;
            background: #944b4b;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
        }

        select.list-dt {
            border: none;
            outline: 0;
            border-bottom: 1px solid #ccc;
            padding: 2px 5px 3px 5px;
            margin: 2px
        }

        select.list-dt:focus {
            border-bottom: 2px solid skyblue
        }

        .card {
            z-index: 0;
            border: none;
            border-radius: 0.5rem;
            position: relative
        }

        .fs-title {
            font-size: 25px;
            color: #2C3E50;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: left
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey
        }

        #progressbar .active {
            color: #000000
        }

        #progressbar li {
            list-style-type: none;
            font-size: 13px;
            width: 25%;
            float: left;
        }

        #progressbar #account:before {
            font-family: FontAwesome;
            content: "1"
        }

        #progressbar #personal:before {
            font-family: FontAwesome;
            content: "2"
        }


        #progressbar #confirm:before {
            font-family: FontAwesome;
            content: "3"
        }

        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 18px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 0;
            top: 25px;
            z-index: -1
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: skyblue
        }

        .radio-group {
            position: relative;
            margin-bottom: 25px
        }

        .radio {
            display: inline-block;
            width: 204;
            height: 104;
            border-radius: 0;
            background: lightblue;
            box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            cursor: pointer;
            margin: 8px 2px
        }

        .radio:hover {
            box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
        }

        .radio.selected {
            box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
        }

        .fit-image {
            width: 100%;
            object-fit: cover
        }
    </style>
@endpush


@section('content')
    <section class="section">
        <div class="container-fluid" id="grad1">
            <div class="row justify-content-center mt-0">
                <div class="col-11 col-sm-9 col-md-10 text-center p-0 mt-3 mb-2">
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                        <h2><strong>{{trans('admin/main.interview_question')}}</strong></h2>
                        <p>Fill all field to go to next step</p>
                        <div class="row">
                            <div class="col-md-12 mx-0">
                                <form id="msform" method="post">
                                    @csrf
                                    <input type="hidden" name="student_id" value="{{$student_id}}">
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active" id="account"><strong>{{trans('admin/main.cultural_information')}}</strong></li>
                                        <li id="personal"><strong>{{trans('admin/main.technical_information')}}</strong></li>
                                        <li id="confirm"><strong>Finish</strong></li>
                                    </ul> <!-- fieldsets -->
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title">{{trans('admin/main.cultural_information')}}</h2>
                                            {{--                                            culture Questions--}}
                                            @if(!empty($cultureQuestions))
                                                @foreach($cultureQuestions as $key=>$cultureQuestion)
                                                    <label class="font-14 font-weight-bold text-dark" for="question{{$key}}">
                                                        <input type="hidden" name="questions[]" value="{{$cultureQuestion->id}}">{{$cultureQuestion->question}}?
                                                    </label>
                                                    <input type="text" name="answers[]" class="form-control" id="question{{$key}}" placeholder="{{trans('admin/main.your_answer')}}">
                                                @endforeach
                                            @else
                                                <div class="alert alert-danger">No Questions please try again later</div>
                                            @endif
                                        </div>
                                        <input type="button" name="next" class="next action-button btn btn-info" value="Next Step" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title">{{trans('admin/main.technical_information')}}</h2>
                                            @if(!empty($technicalQuestions))
                                                @foreach($technicalQuestions as $key=>$technicalQuestion)
                                                    <label class="font-14 font-weight-bold text-dark" for="question{{$key}}"><input type="hidden" name="questions[]" value="{{$technicalQuestion->id}}">{{$technicalQuestion->question}}?</label>
                                                    <input type="text" name="answers[]" class="form-control" id="question{{$key}}" placeholder="{{trans('admin/main.your_answer')}}">
                                                @endforeach
                                            @else
                                                <div class="alert alert-danger">No Questions please try again later</div>
                                            @endif
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                        <input type="button" id="submit" name="submit" class="next action-button" value="Confirm" />
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title text-center">Success !</h2> <br><br>
                                            <br>
                                            <div class="row justify-content-center">
                                                <div class="col-7 text-center">
                                                    <h5>Your answered Sent Successfully, Thank You</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script>
        $(document).ready(function(){

            var current_fs, next_fs, previous_fs; //fieldsets
            var opacity;

            $(".next").click(function(){

                current_fs = $(this).parent();
                next_fs = $(this).parent().next();

//Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
                next_fs.show();
//hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {
// for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({'opacity': opacity});
                    },
                    duration: 600
                });
            });

            $(".previous").click(function(){

                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();

//Remove class active
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
                previous_fs.show();

//hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {
// for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        previous_fs.css({'opacity': opacity});
                    },
                    duration: 600
                });
            });

            $('.radio-group .radio').click(function(){
                $(this).parent().find('.radio').removeClass('selected');
                $(this).addClass('selected');
            });

            $("#submit").click(function(e){
                e.preventDefault();
                var data = $("#msform").serialize();
                setTimeout(function () {
                    $.ajax({
                        url: "/interview/answers",
                        data:data,
                        type: 'post',
                        success: function (data) {
                            console.log(data)
                            if (data.status)
                            {
                                $.toast({
                                    heading: "message",
                                    text: data.message,
                                    bgColor: '#3d8152',
                                    textColor: 'white',
                                    hideAfter: 10000,
                                    position: 'bottom-right',
                                    icon: 'success'
                                });
                                window.location.href= {{url('/')}};
                            }else
                            {
                                $.toast({
                                    heading: "message",
                                    text: {{trans('quiz.failed')}},
                                    bgColor: '#d73b3b',
                                    textColor: 'white',
                                    hideAfter: 10000,
                                    position: 'bottom-right',
                                    icon: 'error'
                                });
                            }
                        },
                        error: function (data) {
                            $.toast({
                                heading: {{trans('public.fail')}},
                                text: {{trans('quiz.failed')}},
                                bgColor: '#d73b3b',
                                textColor: 'white',
                                hideAfter: 10000,
                                position: 'bottom-right',
                                icon: 'error'
                            });
                        }
                    });
                }, 300);
            })

        });
    </script>
@endpush

@extends('templates.frontend-layout')

@section('title')
    Bienvenido
@endsection

@section('content')
    <section id="first_section" class="row justify-content-center">
        <div class="col-12 col-md-8 description">
            <div id="main_message" class="row">
                <div class="col-12 col-md-4 offset-md-1 px-4">
                    <h2>@if(isset($content)) {{ $content->tt_presentation }} @else "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit" @endif</h2>
                </div>
                <div class="col-12 col-md-6">
                    <p>@if(isset($content)) {{ $content->msg_presentation }} @else Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel pharetra libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas feugiat condimentum congue. Praesent eleifend sodales justo, a dictum ipsum. Praesent vel gravida massa. Praesent tempor odio sed sem pulvinar pulvinar. Maecenas vulputate risus eu erat condimentum, sit amet auctor ante pretium. Sed tempor nec massa placerat elementum. @endif</p>
                </div>
                <div class="col-12 text-center">
                    <div class="link-button" role="button"><a href="@if(isset($content)) {{ $content->lnk_btn_presentation }} @else # @endif">@if(isset($content)) {{ $content->txt_btn_presentation }} @else Lorem ipsum dolor @endif</a></div>
                </div>
            </div>
            <div class="row align-justify-center">
                <div class="col-12 division text-center">
                    <span class="dashicons dashicons-awards mx-auto"></span>
                </div>
            </div>
            <div id="short_messeges" class="row">
                <div class="col-12 col-md-5">
                    <div id="first_slogan">
                        <img src="@if(isset($content)) {{ asset("images/frontend/" . $content->img_slogan_one) }} @else /images/cabanias/cabanas13.jpg @endif" alt="@if(isset($content)) {{ $content->img_slogan_one }}@endif" class="img-fluid">
                        <h2>@if(isset($content)) {{ $content->tt_slogan_one }} @else ed quam nulla, faucibus at velit ac, pretium vestibulum erat. @endif</h2>
                        <p>@if(isset($content)) {{ $content->desc_slogan_one }} @else Cras molestie neque elit, quis gravida elit blandit vel. Fusce leo augue, vehicula vel cursus sed, tristique non massa. Aenean varius laoreet elementum. Nullam suscipit sapien non enim pulvinar rhoncus. Morbi tristique, nunc quis semper dignissim, augue sapien condimentum ante, at interdum tellus massa pretium magna. Cras varius lacus vitae mauris iaculis pretium. Nullam suscipit sapien non enim pulvinar rhoncus. @endif</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="col-12">
                        <div id="second_slogan" @if(isset($content)) style="background-image: url({{ asset("images/frontend/" . $content->img_slogan_two) }})" @endif>
                            <h2>@if(isset($content)) {{ $content->tt_slogan_two }} @else ed quam nulla, faucibus at velit ac, pretium vestibulum erat.@endif</h2>
                            <p>@if(isset($content)) {{ $content->desc_slogan_two }} @else Cras molestie neque elit, quis gravida elit blandit vel. Fusce leo augue, vehicula vel cursus sed, tristique non massa. Aenean varius laoreet elementum. Nullam suscipit sapien non enim pulvinar rhoncus. Morbi tristique, nunc quis semper dignissim, augue sapien condimentum ante, at interdum tellus massa pretium magna. Cras varius lacus vitae mauris iaculis pretium. @endif</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="third_slogan" @if(isset($content)) style="background-image: url({{ asset("images/frontend/" . $content->img_slogan_three) }})" @endif>
                            <h2>@if(isset($content)) {{ $content->tt_slogan_three }} @else ed quam nulla, faucibus at velit ac, pretium vestibulum erat. @endif</h2>
                            <p>@if(isset($content)) {{ $content->desc_slogan_three }} @else Cras molestie neque elit, quis gravida elit blandit vel. Fusce leo augue, vehicula vel cursus sed, tristique non massa. Aenean varius laoreet elementum. Nullam suscipit sapien non enim pulvinar rhoncus. Morbi tristique, nunc quis semper dignissim, augue sapien condimentum ante, at interdum tellus massa pretium magna. Cras varius lacus vitae mauris iaculis pretium. @endif</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-justify-center">
                <div class="col-12 division handsicon text-center">
                    <i class="fa fa-handshake-o" aria-hidden="true"></i>
                </div>
            </div>
            <div id="short_messages_2" class="row @if(isset($content)) @if(!$content->show_slogans_456) hidden @endif @endif">
                <div class="col-12 col-md-11">
                    <div id="fourth_slogan" @if(isset($content)) style="background-image: url({{ asset("images/frontend/" . $content->img_slogan_four) }}) @endif">
                        <h2>@if(isset($content)) {{ $content->tt_slogan_four }} @else Donec vitae molestie magna. Pellentesque nec odio congue, cursus velit in, lacinia lorem. @endif</h2>
                        <p>@if(isset($content)) {{ $content->desc_slogan_four }} @else Nunc lobortis ut magna tristique consectetur. Ut maximus ultricies ullamcorper. Etiam a risus lorem. Mauris condimentum ex nunc, eu suscipit lacus tristique at. Donec condimentum dui id porttitor pellentesque. Phasellus maximus non ex et eleifend. Pellentesque facilisis scelerisque turpis sed tristique. Praesent viverra egestas mi. Nam efficitur pulvinar arcu quis egestas. Nunc lobortis ut magna tristique consectetur. Ut maximus ultricies ullamcorper. Etiam a risus lorem. Mauris condimentum ex nunc, eu suscipit lacus tristique at. Donec condimentum dui id porttitor pellentesque. Phasellus maximus non ex et eleifend. Pellentesque facilisis scelerisque turpis sed tristique. Praesent viverra egestas mi. Nam efficitur pulvinar arcu quis egestas. Nunc lobortis ut magna tristique consectetur. Ut maximus ultricies ullamcorper. Etiam a risus lorem. Mauris condimentum ex nunc, eu suscipit lacus tristique at. Donec condimentum dui id porttitor pellentesque. Phasellus maximus non ex et eleifend. Pellentesque facilisis scelerisque turpis sed tristique. Praesent viverra egestas mi. Nam efficitur pulvinar arcu quis egestas. @endif</p>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div id="fifth_slogan">
                        <img src="@if(isset($content)) {{ asset("images/frontend/" . $content->img_slogan_five) }} @else /images/cabanias/cabanas5.jpg @endif" alt="@if(isset($content)) {{ $content->img_slogan_five }} @endif" class="img-fluid">
                        <h2>@if(isset($content)) {{ $content->tt_slogan_five }} @else Donec lobortis sit amet nunc sit amet venenatis. @endif</h2>
                        <p>@if(isset($content)) {{ $content->desc_slogan_five }} @else Mauris a velit suscipit, malesuada nunc quis, faucibus eros. Aliquam tincidunt nisi id erat dapibus, in vulputate urna consequat. Nam accumsan at lectus sit amet dapibus. Nam eget dui sapien. Nulla ac ligula accumsan, egestas enim ut, ultrices mauris. Donec a eros vel metus lobortis blandit. @endif</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div id="sixth_slogan">
                        <img src="@if(isset($content)) {{ asset("images/frontend/" . $content->img_slogan_six) }} @else /images/cabanias/cabanas2.jpg @endif" alt="@if(isset($content)) {{ $content->img_slogan_six }} @endif" class="img-fluid">
                        <h2>@if(isset($content)) {{ $content->tt_slogan_six }} @else Donec lobortis sit amet nunc sit amet venenatis.@endif</h2>
                        <p>@if(isset($content)) {{ $content->desc_slogan_six }} @else Mauris a velit suscipit, malesuada nunc quis, faucibus eros. Aliquam tincidunt nisi id erat dapibus, in vulputate urna consequat. Nam accumsan at lectus sit amet dapibus. Nam eget dui sapien. Nulla ac ligula accumsan, egestas enim ut, ultrices mauris. Donec a eros vel metus lobortis blandit.@endif</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="testimonies" class="row @if(isset($content)) @if(!$content->show_testimonies) hidden @endif @endif">
        <div class="col-12 col-md-8 offset-md-2 py-5">
            <h2 class="text-center">{{ strtoupper('testimonios') }}</h2>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{asset('images/profiles/pelado2.png')}}" class="img-fluid rounded-circle" alt="">
                        <blockquote class="text-left">In condimentum nulla congue dui pretium mollis. Integer dui ante, rhoncus a nunc quis, rhoncus condimentum arcu. Duis maximus aliquam mauris a hendrerit. Nunc maximus cursus enim ac convallis. Aenean nec mi neque. Nam vulputate quis mi tempor commodo. Curabitur augue nisl, finibus nec turpis vulputate, convallis tincidunt nulla. Nam eros orci, tristique vitae ultrices quis, laoreet et velit. Fusce posuere, elit nec imperdiet euismod, magna erat venenatis risus, id accumsan nisi nisl ac magna. </blockquote>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('images/profiles/chica-rodete.png')}}" class="img-fluid rounded-circle" alt="">
                        <blockquote class="text-left">In condimentum nulla congue dui pretium mollis. Integer dui ante, rhoncus a nunc quis, rhoncus condimentum arcu. Duis maximus aliquam mauris a hendrerit. Nunc maximus cursus enim ac convallis. Aenean nec mi neque. Nam vulputate quis mi tempor commodo. Curabitur augue nisl, finibus nec turpis vulputate, convallis tincidunt nulla. Nam eros orci, tristique vitae ultrices quis, laoreet et velit. Fusce posuere, elit nec imperdiet euismod, magna erat venenatis risus, id accumsan nisi nisl ac magna. </blockquote>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('images/profiles/chico-barba.png')}}" class="img-fluid rounded-circle" alt="">
                        <blockquote class="text-left">In condimentum nulla congue dui pretium mollis. Integer dui ante, rhoncus a nunc quis, rhoncus condimentum arcu. Duis maximus aliquam mauris a hendrerit. Nunc maximus cursus enim ac convallis. Aenean nec mi neque. Nam vulputate quis mi tempor commodo. Curabitur augue nisl, finibus nec turpis vulputate, convallis tincidunt nulla. Nam eros orci, tristique vitae ultrices quis, laoreet et velit. Fusce posuere, elit nec imperdiet euismod, magna erat venenatis risus, id accumsan nisi nisl ac magna. </blockquote>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('images/profiles/rubia.png')}}" class="img-fluid rounded-circle" alt="">
                        <blockquote class="text-left">In condimentum nulla congue dui pretium mollis. Integer dui ante, rhoncus a nunc quis, rhoncus condimentum arcu. Duis maximus aliquam mauris a hendrerit. Nunc maximus cursus enim ac convallis. Aenean nec mi neque. Nam vulputate quis mi tempor commodo. Curabitur augue nisl, finibus nec turpis vulputate, convallis tincidunt nulla. Nam eros orci, tristique vitae ultrices quis, laoreet et velit. Fusce posuere, elit nec imperdiet euismod, magna erat venenatis risus, id accumsan nisi nisl ac magna. </blockquote>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('images/profiles/pelado1.png')}}" class="img-fluid rounded-circle" alt="">
                        <blockquote class="text-left">In condimentum nulla congue dui pretium mollis. Integer dui ante, rhoncus a nunc quis, rhoncus condimentum arcu. Duis maximus aliquam mauris a hendrerit. Nunc maximus cursus enim ac convallis. Aenean nec mi neque. Nam vulputate quis mi tempor commodo. Curabitur augue nisl, finibus nec turpis vulputate, convallis tincidunt nulla. Nam eros orci, tristique vitae ultrices quis, laoreet et velit. Fusce posuere, elit nec imperdiet euismod, magna erat venenatis risus, id accumsan nisi nisl ac magna. </blockquote>
                    </div>
                </div>

                <!-- Controls -->
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    @include('frontend.modals.modal-frontend')
    {{--@include('frontend.modals.modal-maintenance')--}}
@endsection

@section('scripts')
    <script text="text/javascript">
        $(document).ready(function (e) {
            $('#maintenance .modal-header')
                .css('background-color', '#333333')
                .css('color', '#ffffff');
            $('#maintenance .modal-footer')
                .css('background-color', '#333333');
            $('#maintenance')
                .modal('show');
        });
    </script>
@endsection
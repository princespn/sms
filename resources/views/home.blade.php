@extends('layouts.guest')

@section('css')
    <!-- Awselect CSS -->
	<link href="{{URL::asset('plugins/awselect/awselect.min.css')}}" rel="stylesheet" />
	<!-- Green Audio Player CSS -->
	<link href="{{ URL::asset('plugins/audio-player/green-audio-player.css') }}" rel="stylesheet" />
    <!-- Data Table CSS -->
	<link href="{{URL::asset('plugins/swiper/swiper.min.css')}}" rel="stylesheet" />
@endsection

@section('content')

        <section id="main-wrapper">
            
            <div class="h-100vh justify-center min-h-screen">
                <img id="bg-shape" src="{{ URL::asset('img/files/bg.png') }}" alt="">

                <div class="container-fluid">

                    <div class="central-banner">
                        <div class="row text-center">
                            <div class="col-md-6 col-sm-12 pt-9 pl-9">
                                <div class="text-container">
                                    <h2>AI Powered <span>Text to Speech</span> Converter</h2>
                                    <p class="pl-6 pr-6">{{ __('Create realistic voices for any text in seconds by using') }} <br> {{ __('over 745+ realistic voices across 128+ languages & dialects') }}.</p>

                                    <a href="{{ route('register') }}" class="btn btn-primary special-action-button">{{ __('Get Started Now') }}</a>

                                    @if (config('tts.vendor_logos') == 'show')
                                        <div class="vendors">
                                            <h6>Powered By</h6>
                                            <span class="mr-3"><img src="{{ URL::asset('img/csp/aws-sm.png') }}" alt=""></span>
                                            <span class="mr-3"><img src="{{ URL::asset('img/csp/azure-sm.png') }}" alt=""></span>
                                            <span class="mr-3"><img src="{{ URL::asset('img/csp/gcp-sm.png') }}" alt=""></span>
                                            <span><img src="{{ URL::asset('img/csp/ibm-sm.png') }}" alt=""></span>
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="image-container pr-6 mt-6">
                                    <img src="{{ URL::asset('img/files/home-bg.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>

            </div>  
        </section>

        <!-- SECTION - LIVE DEMO 
        ========================================================-->
        @if (config('frontend.synthesize.status') == 'on')
            <section id="demo-wrapper">

                <div class="container pb-9">     

                    <div class="row text-center">                    

                        <!-- TITLE -->
                        <div class="col-md-12" id="about-title">
                            
                            <div class="title">
                                <h6>{{ __('Experience') }} <span>AI Voices</span></h6>
                                <p class="p-about">{{ __('Try out live demo without logging in, or login to enjoy all SSML features') }}</p>
                            </div>

                        </div> <!-- END TITLE -->

                    </div>          
                                    
                    <div class="row justify-content-md-center">
                        
                        <div class="col-md-9">

                            <div class="card special-shadow border-0">
                                <div class="card-body p-5">                        
                                    <form id="synthesize-text-form" action="{{ route('tts.listen') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
            
                                        <div class="row" id="frontend-language-select">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">									
                                                    <select id="languages" name="language" data-placeholder="{{ __('Pick Your Language') }}:" data-callback="language_select">	
                                                        @foreach ($languages as $language)
                                                            <option value="{{ $language->language_code }}" data-img="{{ URL::asset($language->language_flag) }}" @if (config('tts.default_language') == $language->language_code) selected @endif> {{ $language->language }}</option>
                                                        @endforeach											
                                                    </select>
                                                </div>
                                            </div>
            
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">									
                                                    <select id="voices" name="voice" data-placeholder="{{ __('Choose Your Voice') }}:" data-callback="voice_select">
                                                        @foreach ($voices as $voice)
                                                            <option value="{{ $voice->voice_id }}" 
                                                                id="{{ $voice->voice_id }}"
                                                                @if (config('tts.vendor_logos') == 'show') data-img="{{ URL::asset($voice->vendor_img) }}" @endif
                                                                data-id="{{ $voice->voice_id }}" 
                                                                data-lang="{{ $voice->language_code }}" 
                                                                data-type="{{ $voice->voice_type }}"
                                                                data-gender="{{ $voice->gender }}"	
                                                                data-voice="{{ $voice->voice }}"	
													            data-url="{{ URL::asset($voice->sample_url) }}"
                                                                @if (config('tts.user_neural') == 'disable')
                                                                    data-usage= "@if ((config('frontend.synthesize.neural') == 'disable') && ($voice->voice_type == 'neural')) avoid-clicks @endif"	
                                                                @endif	
                                                                @if (config('tts.default_voice') == $voice->voice_id) selected @endif																						
                                                                data-class="@if (config('tts.default_language') !== $voice->language_code) remove-voice @endif"> 
                                                                {{ $voice->voice }} 														
                                                            </option>
                                                        @endforeach									
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 pt-1">
                                                <button type="button" class="result-play result-play-sm mr-2" onclick="resultPlay(this)" src="" type="audio/mpeg" id="preview"><i class="fa fa-play"></i></button><span class="fs-12 font-weight-bold">Preview <span id="preview-name"></span></span>
                                            </div>
                                        </div>
            
            
                                        <div class="row">
            
                                            <div class="col-md-12">
                                                <div class="input-box mb-0" id="textarea-box">
                                                    <textarea class="form-control" name="textarea" id="textarea" rows="7" placeholder="{{ __('Select your Language and Voice') }}... {{ __('Enter your text here to synthesize') }}... " required></textarea>
                                                    <label class="input-label">
                                                        <span class="input-label-content input-label-main">Text to Speech</span>
                                                    </label>
                                                </div>								
                                                    
                                                <p class="jQTAreaExt"></p>
            
                                                <div id="textarea-settings">								
                                                    <div class="character-counter">
                                                        <span><em class="jQTAreaCount"></em>/<em class="jQTAreaValue"></em> {{ __('characters used') }}</span>
                                                    </div>
            
                                                    <div class="clear-button">
                                                        <button type="button" id="clear-text">{{ __('Clear Text') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>	
                                        
                                        <div class="mt-5 text-center" id="waveform-box">      
                                            
                                            <div id="waveform"></div>                                            
                                           
                                            <div id="controls" class="mt-4 mb-3">
                                                <button id="backwardBtn" class="result-play result-play-sm mr-2"><i class="fa fa-backward"></i></button>
                                                <button id="playBtn" class="result-play result-play-sm mr-2"><i class="fa fa-play"></i></button>
                                                <button id="stopBtn" class="result-play result-play-sm mr-2"><i class="fa fa-stop"></i></button>
                                                <button id="forwardBtn" class="result-play result-play-sm mr-2"><i class="fa fa-forward"></i></button>							
                                            </div>  
                                        </div>
            
                                        <div class="card-footer border-0 text-center mb-0">
                                            <span id="processing"><img src="{{ URL::asset('/img/svgs/processing.svg') }}" alt=""></span>
                                            <button type="button" class="btn btn-primary main-action-button special-action-button mr-2" id="frontend-listen-text">{{ __('Listen') }}</button>                                            
                                        </div>							
            
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div> 

                </div> <!-- END CONTAINER -->

                <!-- NOTIFICATION MODAL -->
                <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true" data-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-circle color-red"></i> {{ __('Text-to-Speech Notification') }}</h4>
                                <button type="button" class="close" data-dismiss="modal" id="modal-close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pb-4 pl-6">        
                                <span id="notificationMessage" class="fs-13"></span>
                            </div>
                            <div class="modal-footer pr-6">
                                <button type="button" class="btn btn-cancel mb-5" data-dismiss="modal" id="listen-close">{{ __('Close') }}</button>
                            </div>				
                        </div>
                    </div>
                </div>
                <!-- END NOTIFICATION MODAL -->
                
            </section> <!-- END LIVE DEMO SECTION -->
        @endif

        <!-- SECTION - USE CASES
        ========================================================-->
        <section id="cases-wrapper">

            <div class="container-fluid" id="curve-container">
                <div class="curve-box">
                    <div class="overflow-hidden curve">
                        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="#f5f9fc"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="container pt-9">

                <div class="row text-center mb-7">
                    <div class="col-md-12 title">
                        <h6><span>Unlimited</span> {{ __('Use Cases') }}</h6>
                        <p>{{ __('Create any type of audio content as you prefer') }}</p>
                    </div>
                </div>


                <div class="row">

                    <div class="blog-slider">
                        <div class="blog-slider__wrp swiper-wrapper">

                            @foreach ($cases as $case)
                                <div class="blog-slider__item swiper-slide">
                                    <div class="blog-slider__img">
                                        <img src="{{ URL::asset($case->image_url) }}" alt="">
                                    </div>
                                    <div class="blog-slider__content">
                                        <div class="blog-slider__title">{{ $case->title }}</div>
                                        <div class="blog-slider__text">{!! $case->text !!}.</div>
                                        <div class="audio-box">
                                            <!-- VOICE AUDIO FILE -->
                                            <div class="voice-player">                                      																	
                                                <div class="text-center player">
                                                    <audio class="voice-audio" preload="none">
                                                        <source src="{{ URL::asset($case->audio_url) }}" type="audio/mpeg">
                                                    </audio>	
                                                </div>                                        								
                                            </div><!-- END VOICE AUDIO FILE -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="blog-slider__pagination"></div>

                    </div>

                </div>

            </div>

        </section>


        <!-- PARTNER BANNER SECTION
        ========================================================-->
        @if (config('tts.vendor_logos') == 'show')
            <section id="partners-banner">
                
                <div class="container">
                    
                    <div class="row text-center">
                        

                        <!-- PARTNER CLASS -->
                        <div class="col-sm-12 col-md-4">
                            
                            <div id="partner-group">
                                
                                <h6><span>Powered</span> By</h6>

                                <p>Powered by leading Cloud Service Providers who offer Standard TTS voices, and also Neural Text-to-Speech (NTTS) voices that deliver advanced improvements in speech quality through a new machine learning approach.</p>

                            </div>

                        </div> <!-- END PARTNER CLASS -->

                        
                        <!-- FOOTER LOGOS -->
                        <div class="col-sm-12 col-md-8 pt-6" id="partner-logo">

                            <ul>
                                <li class="logo-1"><img src="{{ URL::asset('img/csp/aws-logo.png') }}" alt=""></li>
                                <li class="logo-2"><img src="{{ URL::asset('img/csp/azure-logo.png') }}" alt=""></li>
                                <li class="logo-3"><img src="{{ URL::asset('img/csp/gcp-logo.png') }}" alt=""></li>
                                <li class="logo-4"><img src="{{ URL::asset('img/csp/ibm-logo.png') }}" alt=""></li>                            
                            </ul>			

                        </div> <!-- END PARTNER LOGOS -->

                    </div> <!-- END ROW -->

                </div> <!-- END CONTAINER -->

            </section> <!-- END PARTNER BANNER STYLES -->
        @endif


        <!-- SECTION - FEATURES
        ========================================================-->
        <section id="features-wrapper">

            <div class="container">

                <div class="row text-center mb-7">
                    <div class="col-md-12 title">
                        <h6><span>Text to Speech</span> {{ __('Benefits') }}</h6>
                        <p>{{ __('Enjoy the full flexibility of the platform with ton of features') }}</p>
                    </div>
                </div>
                
                <div class="row">
                    
                    <!-- LIST OF SOLUTIONS -->
                    <div class="row d-flex" id="solutions-list">
                        

                        <!-- SOLUTION -->
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-6">
                                
                            <div class="solution">
                                
                                <div class="solution-content">
                                    
                                    <div class="solution-logo">
                                        <i class="fa fa-magic"></i>
                                    </div>
                                
                                    <h5>{{ __('Over 70+ Languages') }}</h5>
                                    
                                    <p>Lorem ipsum dolor sit amet est consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                </div>                         

                            </div>

                        </div> <!-- END SOLUTION -->


                        <!-- SOLUTION -->
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-6">
                                
                            <div class="solution">
                                
                                <div class="solution-content">
                                    
                                    <div class="solution-logo">
                                        <i class="mdi mdi-access-point"></i>
                                    </div>
                                
                                    <h5>{{ __('Over 630+ Voices') }}</h5>
                                    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                </div>

                            </div>

                        </div> <!-- END SOLUTION -->


                        <!-- SOLUTION -->
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-6">
                                
                            <div class="solution">
                                
                                <div class="solution-content">
                                    
                                    <div class="solution-logo">
                                        <i class="mdi mdi-audiobook"></i>
                                    </div>
                                
                                    <h5>{{ __('Various Audio Formats') }}</h5>
                                    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                </div>

                            </div>

                        </div> <!-- END SOLUTION -->


                        <!-- SOLUTION -->
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-6">
                                
                            <div class="solution">
                                
                                <div class="solution-content">
                                    
                                    <div class="solution-logo">
                                        <i class="fa fa-magic"></i>
                                    </div>
                                
                                    <h5>{{ __('Amazing Voice Effects') }}</h5>
                                    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                </div>

                            </div>

                        </div> <!-- END SOLUTION -->


                        <!-- SOLUTION -->
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-6">
                                
                            <div class="solution">
                                
                                <div class="solution-content">
                                    
                                    <div class="solution-logo">
                                        <i class="mdi mdi-upload-network"></i>
                                    </div>
                                
                                    <h5>{{ __('Share Results Easily') }}</h5>
                                    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                </div>                                

                            </div>

                        </div> <!-- END SOLUTION -->


                        <!-- SOLUTION -->
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-6">
                                
                            <div class="solution">
                                
                                <div class="solution-content">
                                    
                                    <div class="solution-logo">
                                        <i class="fa fa-google-wallet"></i>
                                    </div>
                                
                                    <h5>{{ __('Multiple Payment Options') }}</h5>
                                    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                </div>

                            </div>

                        </div> <!-- END SOLUTION -->


                        <!-- SOLUTION -->
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-6">
                                
                            <div class="solution">
                                
                                <div class="solution-content">
                                    
                                    <div class="solution-logo">
                                        <i class="fa fa-th-large"></i>
                                    </div>
                                
                                    <h5>{{ __('Standard & Neural Voices') }}</h5>
                                    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>
                                    
                                </div>            

                            </div>

                        </div> <!-- END SOLUTION -->


                        <!-- SOLUTION -->
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-6">
                                
                            <div class="solution">
                                
                                <div class="solution-content">
                                    
                                    <div class="solution-logo">
                                        <i class="mdi mdi-account-alert"></i>
                                    </div>
                                
                                    <h5>{{ __('Great Customer Support') }}</h5>
                                    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                </div>

                            </div>

                        </div> <!-- END SOLUTION -->

                        
                    </div> <!-- END LIST OF SOLUTIONS -->

                </div>

            </div>

        </section>


        <!-- SECTION - CUSTOMER FEEDBACKS
        ========================================================-->
        <section id="feedbacks-wrapper">

            <div class="container-fluid" id="curve-container">
                <div class="curve-box">
                    <div class="overflow-hidden curve">
                        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="#f5f9fc"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="container pt-9 text-center">


                <!-- SECTION TITLE -->
                <div class="row mb-7">

                    <div class="title">
                        <h6>{{ __('Customer') }} <span>{{ __('Reviews') }}</span></h6>
                        <p>{{ __('We guarantee that you will be one of them as well') }}</p>
                    </div>

                </div> <!-- END SECTION TITLE -->

                
                <div class="row text-center">                    
                    

                    <!-- CUSTOMER FEEDBACKS -->
                    <div id="feedbacks">


                        <!-- FEEDBACK -->
                        <div class="feedback">						
                            
                            <!-- COMMENTER -->
                            <div class="feedback-image">
                                <img src="{{ URL::asset('img/feedback/feedback-1.jpg') }}" alt="Feedback" class="rounded-circle"><span class="fa fa-quote-left"></span>
                            </div>	
                            <p class="feedback-reviewer">Stella Mac Smith</p>
                            <p class="fs-12">Los Angeles - California</p>				
                            
                            <!-- MAIN COMMENT -->
                            <p class="comment"><sup><span class="fa fa-quote-left"></span></sup> Everything is perfect, CloudPolly saves me a ton of time to create audio for my text content, both for video and for audiobooks. <br /> Thanks so much for all your help! <sub><span class="fa fa-quote-right"></span></sub></p>
                            
                            <span>{{ __('Overall rating of our service') }}</span>
                            <ul>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                            </ul>

                        </div> <!-- END FEEDBACK -->



                        <!-- FEEDBACK -->
                        <div class="feedback">						
                            
                            <!-- COMMENTER -->
                            <div class="feedback-image">
                                <img src="{{ URL::asset('img/feedback/feedback-2.jpg') }}" alt="Feedback" class="rounded-circle"><span class="fa fa-quote-left"></span>
                            </div>	
                            <p class="feedback-reviewer">Tina Kandelaki</p>
                            <p class="fs-12">Campbridge - United Kingdom</p>				
                            
                            <!-- MAIN COMMENT -->
                            <p class="comment"><sup><span class="fa fa-quote-left"></span></sup> My favourite Text to Speech platform! User friendly interface, lot's of languages and voices available plus each one has various voice effects associated with them. <sub><span class="fa fa-quote-right"></span></sub></p>
                            
                            <span>{{ __('Overall rating of our service') }}</span>
                            <ul>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star-half-full"></li>
                            </ul>

                        </div> <!-- END FEEDBACK -->



                        <!-- FEEDBACK -->
                        <div class="feedback">						
                            
                            <!-- COMMENTER -->
                            <div class="feedback-image">
                                <img src="{{ URL::asset('img/feedback/feedback-3.jpg') }}" alt="Feedback" class="rounded-circle"><span class="fa fa-quote-left"></span>
                            </div>	
                            <p class="feedback-reviewer">San Sebastian</p>
                            <p class="fs-12">Bogota - Columbia</p>				
                            
                            <!-- MAIN COMMENT -->
                            <p class="comment"><sup><span class="fa fa-quote-left"></span></sup> One of the best platforms to use Text to Speech services. Availability of voices get's you existed! Highly recommended. <sub><span class="fa fa-quote-right"></span></sub></p>
                            
                            <span>{{ __('Overall rating of our service') }}</span>
                            <ul>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                            </ul>

                        </div> <!-- END FEEDBACK -->



                </div> <!-- END CUSTOMER FEEDBACKS -->


                    
                </div> <!-- END ROW -->
                
            </div> <!-- END CONTAINER -->

            <div class="container">

                <div class="row text-center position-relative action-call-wrapper">

                    <div id="action-call" class="w-100 h-100"></div>

                    <div class="col-md-12 action-content">
                        <h5 class="mb-4">{{ __('Try for Free') }}</h5>
                        <h4>{{ __('Try Text to Speech Synthesize for Free') }}</h4>
                        <p class="mb-5">{{ __('You will receive free credits upon registration') }}</p>

                        <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Sign Up Now') }}</a>
                        <p class="fs-10 mt-2">{{ __('No credit card required') }}</p>
                    </div>
                </div>
            </div>
            
        </section> <!-- END SECTION CUSTOMER FEEDBACK -->

@endsection

@section('js')
    <!-- Green Audio Player JS -->
    <script src="{{ URL::asset('plugins/audio-player/green-audio-player.js') }}"></script>
    <script src="{{ URL::asset('js/audio-player.js') }}"></script>
    <script src="{{ URL::asset('js/wavesurfer.min.js') }}"></script>

	<!-- Awselect JS -->
	<script src="{{URL::asset('plugins/jqtarea/plugin-jqtarea.min.js')}}"></script>
	<script src="{{URL::asset('plugins/awselect/awselect-custom.js')}}"></script>
     <script src="{{URL::asset('js/awselect.js')}}"></script>

     <!-- Custom js-->
     <script src="{{URL::asset('plugins/swiper/swiper.min.js')}}"></script>
     <script src="{{URL::asset('js/slick.min.js')}}"></script>
     <script src="{{URL::asset('js/frontend.js')}}"></script>
     

     <script type="text/javascript">
		$(function () {

			"use strict";

			$(document).ready(function(){
				$("#textarea").jQTArea({
					setLimit: {{ $max_chars }},
					setExt: "W",
					setExtR: true 
				});
			});

		});

	</script>

@endsection
    
        
       
        
       
    


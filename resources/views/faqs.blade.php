@extends('layouts.guest')

@section('content')

    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="section-title">
                    <!-- SECTION TITLE -->
                    <div class="text-center mb-9 mt-9" id="contact-row">

                        <div class="title">
                            <h6><span>{{ __('FAQs') }}</span></h6>
                            <p>{{ __('Got questions? We have all answers for you.') }}</p>
                        </div>

                    </div> <!-- END SECTION TITLE -->
                </div>
            </div>
        </div>
    </div>

    <section id="faq-wrapper">

        <div class="container-fluid" id="curve-container">
            <div class="curve-box">
                <div class="overflow-hidden curve">
                    <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="#fff"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="container pt-6">

            <div class="row justify-content-md-center">

                @if ($faq_exists)

                    @foreach ($categories as $category)
                        <div class="col-md-10 col-sm-12"> 

                            <h6 class="faq-category">{{ ucfirst($category->name) }}</h6> 

                            @foreach ( $faqs as $faq )
     
                                @if ($category->name == $faq->category)
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $faq->id }}">
                                                <h5 class="mb-0">
                                                <span class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{ $faq->id }}" aria-expanded="false" aria-controls="collapse-{{ $faq->id }}">
                                                    {{ $faq->question }}
                                                </span>
                                                </h5>
                                            </div>
                                        
                                            <div id="collapse-{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}" data-parent="#accordion">
                                                <div class="card-body">
                                                    {!! $faq->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif                                                        
                                
                            @endforeach
                        </div>  
                    @endforeach                    

                @else
                    <div class="row text-center">
                        <div class="col-sm-12 mt-6 mb-6">
                            <h6 class="fs-12 font-weight-bold text-center">{{ __('No FAQ answers were published yet') }}</h6>
                        </div>
                    </div>
                @endif
     
            </div>        
        </div>

    </section>
@endsection


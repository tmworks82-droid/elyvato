@extends('layouts.front.app')
@section('title')
  {{ $title }}
@endsection

@section('content')
<style>
  p{
    color:#1a1919;
  }

.ratio-box {
  aspect-ratio: 16 / 9;
  width: 100%;
  overflow: hidden;
}

.blog-image {
  width: 100%;
  height: 100%;
  object-fit: contain; /* or 'cover' if you want crop instead */
  object-position: center;
}

</style>
<!-- Latest Font Awesome (6.4.0+) -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
/>

   <!-- Blog Section -->
    <section class="breadcumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcumb-style1">
              <div class="breadcumb-list">
                <a class="text-dark" href="#">Blog</a>
                <a  class="text-dark" href="#">{{ $title }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Blog Section Area -->
    <section class="our-blog pt40">
      <div class="container">
        <div class="row wow fadeInUp" data-wow-delay="100ms">
          <div class="col-lg-12">
            <h2 class="blog-title">{{$blog->title}}</h2>
            <!-- <div class="blog-single-meta">
              <div class="post-author d-sm-flex align-items-center">
                <img class="mr10" src="{{url($blog->featured_image)}}" alt="" style="width: 100%;
    height: 405px;">
    <a class="pr15 body-light-color" href="#">Leslie Alexander</a>
    <a class="ml15 pr15 body-light-color" href="#">Business</a>
    <a class="ml15 body-light-color" href="#">{{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}</a>
              </div>
            </div> -->
          </div>
        </div>
      </div>
      <div class="mx-auto maxw1600 mt60 wow fadeInUp" data-wow-delay="300ms">
        <div class="row">
          <div class="col-lg-12">
            <div class="large-thumb ratio-box">
              <img class="w-100 bdrs16 blog-image" src="{{ url($blog->featured_image) }}" alt="">
            </div>

          </div>
        </div>
      </div>
      <div class="container">
        <div class="roww wow fadeInUp" data-wow-delay="500ms">
          <div class="col-xl-8 offset-xl-2">
            <div class="ui-content mt45 mb60">
              <h5 class="mb20">{{$blog->title}}</h5>
              <p class="mb25 ff-heading text">{!! $blog->content !!}</p>
         
            </div>
            {{--<div class="blockquote-style1 mb60">
              <blockquote class="blockquote">
                <p class="fst-italic fz15 fw500 ff-heading dark-color">Aliquam hendrerit sollicitudin purus, quis rutrum mi accumsan nec. Quisque bibendum orci ac nibh facilisis, at malesuada orci congue.</p>
                <h5 class="quote-title">Luis Pickford</h5>
              </blockquote>
            </div>--}}
            <div class="ui-content">
              <h4 class="title mb25">What you'll find more </h4>
            </div>
            <div class="row">
              <div class="col-auto">
                <div class="ui-content">
                  <div class="list-style1">
                    <ul>
                      @php
                          $categories = is_array($blog->category) ? $blog->category : json_decode($blog->category ?? '[]', true);
                          $services = collect(Service())->keyBy('id'); // Maps service ID to service
                      @endphp

                      @if(!empty($categories))
                          @foreach($categories as $catId)
                              @if(isset($services[$catId]))
                                  <li>
                                      <i class="far fa-check text-thm3 bgc-thm3-light"></i> {{ $services[$catId]->name }}
                                  </li>
                              @endif
                          @endforeach
                      @endif

                    </ul>
                  </div>
                </div>
              </div>
              {{--<div class="col-auto ms-xl-5">
                <div class="ui-content">
                  <div class="list-style1">
                    <ul>
                      <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Build & test a complete mobile app.</li>
                      <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Learn to design mobile apps & websites.</li>
                      <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Design 3 different logos.</li>
                      <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Create low-fidelity wireframe.</li>
                      <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Downloadable exercise files.</li>
                    </ul>
                  </div>
                </div>
              </div>--}}
            </div>
            
            <div class="bdrt1 bdrb1 d-block d-sm-flex justify-content-between pt50 pt30-sm pb50 pb30-sm">
              <div class="blog_post_share d-flex align-items-center mb10-sm">
                <span class="me-2">Share this post</span>
              
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <!-- Twitter (X) Share -->
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}" target="_blank">
                    <img src="{{url('front/images/icons/x-twitter-brands-solid.svg')}}"
                      alt="X logo" width="16" height="24" />
                </a>

                  <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(Request::url()) }}" target="_blank">
                      <i class="fab fa-linkedin-in"></i>
                  </a>
              </div>
             
            </div>
            <div class="bsp_comments bdrb1 d-block d-sm-flex justify-content-between pt30 pb45 pb30-sm">
              <div class="mbp_first d-flex">
                <div class="flex-shrink-0"> <img src="{{url('front/images/blog/comments-1.png')}}" class="mr-3" alt="comments-1.png"> </div>
                <div class="flex-grow-1 ml30">
                  <h5 class="mb0">Brooklyn Simmons</h5>
                  <p class="text">Etiam vitae leo et diam pellentesque porta. Sed eleifend ultricies risus, vel rutrum erat commodo ut. Praesent finibus congue euismod. Nullam scelerisque massa vel augue placerat, a tempor sem egestas. , <br>Curabitur placerat finibus lacus.</p>
                </div>
              </div>
            </div>
            <div class="mbp_pagination_tab bdrb1">
              <div class="row justify-content-between pt45 pt30-sm pb45 pb30-sm">
                  <div class="col-md-6">
                    @if($previous)
                    <div class="pag_prev">
                        <a href="{{ url('blog/'.$previous->slug) }}">
                            <h5><span class="fas fa-chevron-left pe-2"></span> Previous Post</h5>
                            <p class="fz14 text mb-0">{{ \Illuminate\Support\Str::limit($previous->title, 60) }}</p>
                        </a>
                    </div>
                    @else
                      <div class="pag_prev">
                    <a href="#">
                      <h5><span class="fas fa-chevron-left pe-2"></span> Previous Post</h5>
                      <p class="fz14 text mb-0">Given Set was without from god divide rule Hath</p>
                    </a>
                  </div>
                    @endif
                </div>

                <div class="col-md-6 text-end">
                    @if($next)
                    <div class="pag_next">
                        <a href="{{ url('blog/'.$next->slug) }}">
                            <h5>Next Post <span class="fas fa-chevron-right ps-2"></span></h5>
                            <p class="fz14 text mb-0">{{ \Illuminate\Support\Str::limit($next->title, 60) }}</p>
                        </a>
                    </div>
                    @else
                    <div class="pag_next">
                        <a href="#" class="text-end">
                          <h5>Next Post<span class="fas fa-chevron-right ps-2"></span></h5>
                          <p class="fz14 text mb-0">Tree earth fowl given moveth deep lesser After</p>
                        </a>
                      </div>
                    @endif
                </div>
            </div>

            </div>
            
           
          </div>
        </div>
      </div>
    </section>

    <!-- Explore Apartment -->
    <section class="bgc-thm3 pb90 pb30-md">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 wow fadeInUp" data-wow-delay="00ms">
            <div class="main-title">
              <h2 class="title">Recent Blog</h2>
              <p class="paragraph">See how you can up your career status</p>
            </div>
          </div>
        </div>
        <div class="row wow fadeInUp" data-wow-delay="300ms">
           @if(!empty($blogs) && count($blogs) > 0)
                      @foreach($blogs as $blog)
                          <div class="col-sm-6 col-xl-3">
                              <div class="blog-style1">
                                  <div class="blog-img">   
                                      <img class="w-100" src="{{ asset($blog->featured_image ?? 'front/images/blog/blog-1.jpg') }}" alt="">
                                  </div>
                                  
                                  <div class="blog-content">
                                      <a class="date text-dark" href="#">{{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}</a>
                                      <h4 class="title mt-1">
                                          <a href="{{ route('blog.single.page', $blog->slug) }}">{{ $blog->title }}</a>
                                      </h4>
                                      <p class="text mb-0">
                                          {!! \Illuminate\Support\Str::words(strip_tags($blog->content), 10, '...') !!}
                                      </p>
                                  </div>
                              </div>
                          </div>
                      @endforeach
                      @endif
          
        </div>
      </div>
    </section>

@endsection
@section('scripts')
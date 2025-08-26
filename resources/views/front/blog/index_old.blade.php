@extends('layouts.front.app')
@section('title')
  {{ $title }}
@endsection

@section('content')


   <!-- Breadcumb Sections -->
    <section class="breadcumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcumb-style1">
              <div class="breadcumb-list">
                <a class="text-dark" href="#">Home</a>
                <a class="text-dark" href="#">{{$title}}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    

    <!-- Blog Section Area -->
    <section class="our-blog pt-0">
      <div class="container">
        <h1 class="text-dark mb-4 fs-2">{{$title}}</h1>
        <div class="row wow fadeInUp" data-wow-delay="300ms">
          <div class="col-xl-12">
            
            <div class="navtab-style1">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active fz15 text" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                  <div class="row">
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
                                          {!!  \Illuminate\Support\Str::words(strip_tags($blog->content), 10, '...') !!}
                                      </p>
                                  </div>
                              </div>
                          </div>
                      @endforeach
                      @else
                      <p class="text-muted text mb-0">No blog posts available at the moment. Please check back soon!</p>

                  @endif

                  </div>
                </div>
                
              </div>
            </div>
            
          </div>
        </div>
        <div class="row">
          @if (!empty($blogs) && $blogs->lastPage() > 1)
          <div class="mbp_pagination text-center">
            <ul class="page_navigation">
              {{-- Previous Page --}}
              <li class="page-item {{ $blogs->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $blogs->previousPageUrl() ?? '#' }}">
                  <span class="fas fa-angle-left"></span>
                </a>
              </li>

              {{-- Page Links --}}
              @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                @if ($i == $blogs->currentPage())
                  <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">{{ $i }} <span class="sr-only">(current)</span></a>
                  </li>
                @elseif ($i == 1 || $i == $blogs->lastPage() || ($i >= $blogs->currentPage() - 1 && $i <= $blogs->currentPage() + 1))
                  <li class="page-item">
                    <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                  </li>
                @elseif ($i == $blogs->currentPage() - 2 || $i == $blogs->currentPage() + 2)
                  <li class="page-item"><a class="page-link" href="#">...</a></li>
                @endif
              @endfor

              {{-- Next Page --}}
              <li class="page-item {{ !$blogs->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $blogs->nextPageUrl() ?? '#' }}">
                  <span class="fas fa-angle-right"></span>
                </a>
              </li>
            </ul>

            {{-- Page Summary --}}
            <p class="mt10 mb-0 pagination_page_count text-center">
              Showing {{ $blogs->firstItem() }} – {{ $blogs->lastItem() }} of {{ $blogs->total() }} blog{{ $blogs->total() > 1 ? 's' : '' }}
            </p>
          </div>
        @endif

        </div>
      </div>
    </section>

@endsection
@section('scripts')
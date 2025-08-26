@php
    $title = $blog->title;
    $metaDescription = $blog->meta_description;
    $robotsMeta = 'index, follow';
    $canonical = url()->current();
    $featuredImage = '/'.$blog->featured_image;
@endphp



@extends('layouts.front.app')

@section('pageContent')

{{-- ============================= single blog post with sidebar section ============================= --}}
<section class="section-padding-top section-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 pe-lg-5 mb-4 mb-lg-0" itemscope itemtype="https://schema.org/BlogPosting">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="https://elyvato.com" itemprop="item">
                                <span itemprop="name">Home</span>
                            </a>
                            <meta itemprop="position" content="1" />
                        </li>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="https://elyvato.com/blog" itemprop="item">
                                <span itemprop="name">Blog</span>
                            </a>
                            <meta itemprop="position" content="2" />
                        </li>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="#" class="breadcrumb-nlink" itemprop="item">
                                <span itemprop="name">{{$blog->title}}</span>
                            </a>
                            <meta itemprop="position" content="3" />
                        </li>
                    </ol>
                </nav>
                {{-- blog post title --}}
                <h1 class="mb-3 mb-lg-4 fw-bold" itemprop="headline">{{$blog->title}}</h1>
                {{-- blog post meta --}}
                <div class="d-flex flex-wrap gap-3 mb-3 mb-lg-4">
                    <div class="pe-3 border-end border-2">
                        
                       
            
            
                        {{--@php
                          $categories = is_array($blog->category) ? $blog->category : json_decode($blog->category ?? '[]', true);
                          $services = collect(Service())->keyBy('id'); // Maps service ID to service
                      @endphp--}}

                      @php
                        // Decode only if it's a string, fallback to empty array if failed
                        $categories = is_string($blog->category) ? json_decode($blog->category, true) : (is_array($blog->category) ? $blog->category : []);
                    @endphp
                      
                    @if (!empty($categories))
                        @foreach ($categories as $cate)
                            <a href="{{ route('blog.category.page', ['blogSlug' => $blog->slug, 'categorySlug' => getServiceNamebyId($cate)->slug]) }}" class="badge text-bg-dark" itemprop="about">{{ getServiceNamebyId($cate)->name }}</a>

                        @endforeach
                    @endif

                      {{--@if(!empty($categories))
                                @foreach($categories as $catId)
                                    @if(isset($services[$catId]))
                                    
                                <a href="{{ route('service-sow-list', ['slug' => $services[$catId]->slug]) }}" class="badge text-bg-dark" itemprop="about">{{ $services[$catId]->name }}</a>

                                    @endif
                                @endforeach
                            @endif--}}

                    </div>
                    <div class="pe-3 border-end border-2 text-muted dropdown">
                        <span class="d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-share-line"></i> Share</span>
                        <ul class="dropdown-menu single-post-share-dropdown-menu px-2">
                            <li><a class="dropdown-item rounded d-flex align-items-center gap-1" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank"><i class="ri-facebook-fill"></i>Facebook</a></li>
                            <li><a class="dropdown-item rounded d-flex align-items-center gap-1" href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(Request::url()) }}" target="_blank"><i class="ri-linkedin-box-fill"></i>Linkdin</a></li>
                            <li> <a class="dropdown-item rounded d-flex align-items-center gap-1"
                                    href="https://wa.me/?text={{ urlencode(Request::url()) }}"
                                    target="_blank">
                                    <i class="ri-whatsapp-line"></i>Whatsapp
                                </a>
                                </li>

                            {{--<li><a class="dropdown-item rounded d-flex align-items-center gap-1" href="#" target="_blank"><i class="ri-file-copy-line"></i>Link Copy</a></li> --}}

                        </ul>
                    </div>
                    <div class="text-muted">
                        <time itemprop="datePublished" datetime="2025-07-17">{{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}</time>
                        <meta itemprop="dateModified" content="2025-07-17">
                    </div>
                </div>
                {{-- post featured image goes here --}}
                <div class="ratio ratio-16x9 rounded-2 mb-4">
                    <img src="{{ url($blog->featured_image) }}" alt="Blog Post Title" class="w-100 object-fit-cover rounded-2" itemprop="image">
                </div>
                {{-- post description goes here --}}
                <div itemprop="articleBody">
                    <p>{!! $blog->content !!}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sticky-lg-top-90">
                    <div class="border p-3 rounded-2 bg-light mb-3">
                        <div class="d-flex align-items-center gap-3 flex-wrap mb-3" itemprop="author" itemscope itemtype="https://schema.org/Person">
                            <img src="{{ url(GetProfile($blog->created_by)) }}" alt="Author Image" class="rounded-circle" width="60" height="60">
                            <div>
                                <h3 class="fs-5 mb-1 fw-bold" itemprop="name">{{GetUser($blog->created_by)->name}}</h3>
                                <p class="mb-0">{{GetRoleName($blog->created_by)}}</p>
                            </div>
                        </div>
                        {{--<p class="mb-0">
                            Incorporating gratitude into our daily where we write down three things we are grateful for each day.
                        </p>--}}
                        {{-- Publisher (optional, often recommended for full schema compliance) --}}
                        
                        <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="d-none">
                            <meta itemprop="name" content="Elyvato">
                            <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                                <meta itemprop="url" content="https://elyvato.com/logo.png"> {{-- Replace with actual logo URL --}}
                            </div>
                        </div>
                    </div>

                    <div class="border p-3 rounded-2 mb-3">
                        <h3 class="fs-5 fw-bold mb-3">Related Posts</h3>
                        <ul class="list-unstyled single-post-rp-list mb-0">
                            @if(!empty($blogs) && count($blogs) > 0)
                                @foreach($blogs as $blog)
                                    <li>
                                        <a href="{{ route('blog.single.page', $blog->slug) }}">{{ $blog->title }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="border p-3 rounded-2">
                        <h3 class="fs-5 fw-bold mb-3">Post Categories</h3>

                        @php
    $displayedCategories = [];  // Initialize an empty array to store displayed categories
@endphp

<div class="d-flex flex-wrap gap-2">
    @if(!empty($categories))
        @foreach($categories as $catId)
            @php
                $category = getServiceNamebyId($catId); // Retrieve category details
            @endphp

            @if (!in_array($catId, $displayedCategories))  <!-- Check if the category has already been displayed -->
                @php
                    $displayedCategories[] = $catId;  // Add the category to the displayed list
                @endphp

                <a href="{{ route('blog.category.page', ['blogSlug' => $blog->slug, 'categorySlug' => $category->slug]) }}" class="btn btn-main">
                    {{ $category->name }}
                </a>
            @endif
        @endforeach
    @endif
</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

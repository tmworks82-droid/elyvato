<nav class="navbar sticky-lg-top border-bottom navbar-expand-lg bg-white py-3" itemscope itemtype="http://schema.org/SiteNavigationElement">
    {{-- Navbar content --}}
  <div class="container">
    <a class="navbar-brand" href="/">
      @if(!empty(GetProfile(Auth::user()->id)))
        <img src="{{ GetProfile(Auth::user()->id) }}" alt="Elyvato Logo" height="35">
        @else
            <img src="{{ url('front/assets/images/default_dp.png') }}" alt="Elyvato Logo" height="35">
        @endif
        <span class="visually-hidden">Elyvato</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0 gap-2 gap-lg-3 d-none d-lg-flex">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="/services" role="button" aria-expanded="false" data-bs-auto-close="outside" itemprop="url">
            <span itemprop="name">Services</span> <i class="ri-arrow-drop-down-line ms-1"></i>
          </a>
          <ul class="dropdown-menu px-2 shadow-sm border border-light-subtle">
            <li class="dropend">
                <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center" href="/gig-list" role="button" aria-expanded="false" itemprop="url"><i class="ri-image-edit-line me-2"></i><span itemprop="name">Graphic Design</span>  <i class="ri-arrow-drop-right-line ms-auto"></i></a>
                <ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Logo (2D)</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Social Media Post</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Flyer/Poster</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Infographic Design</a></li>
                    </div>
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Brochure (Tri/Bi-fold)</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Entire Social Media/MCM Kit</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">(KV, Standee, Leaflets, Poster)</a></li>
                    </div>
                </ul>
            </li>
            
            <li class="dropend">
                <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center" href="/gig-list" type="button" id="dropdownMenuB" aria-expanded="false" itemprop="url"><i class="ri-video-line me-2"></i><span itemprop="name">Video Editing</span>  <i class="ri-arrow-drop-right-line ms-auto"></i></a>
                <ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">YouTube Video Editing (Long Form)</a></li>
                    <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Brand Film</a></li>
                    <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Interview Edits (Podcast)</a></li>
                    <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Event Highlight Reels</a></li>
                    <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Reel Edit (15-30 Sec)</a></li>
                    </div>
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Explainer Video</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Testimonial Edit</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Training/How to Video</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Subtitling/Translation</a></li>
                    </div>
                </ul>
            </li>
            <li class="dropend">
                <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center" href="/gig-list" type="button" id="dropdownMenuB" aria-expanded="false" itemprop="url"><i class="ri-macbook-line me-2"></i><span itemprop="name">Animation & Vfx</span>  <i class="ri-arrow-drop-right-line ms-auto"></i></a>
                <ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">3D Product Renders</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Character</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Modelling + Texturing + Rigging</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Green Screen Cleanup</a></li>
                    </div>
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Object Tracking & Match</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Move</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">AR Video</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">VR Video</a></li>
                    </div>
                </ul>
            </li>
            <li class="dropend">
                <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center" href="/gig-list" type="button" id="dropdownMenuB" aria-expanded="false" itemprop="url"><i class="ri-vidicon-2-line me-2"></i><span itemprop="name">Shoots</span>  <i class="ri-arrow-drop-right-line ms-auto"></i></a>
                <ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">On Ground Shoot</a></li>
                    </div>
                    <div></div>
                </ul>
            </li>
            <li class="dropend">
                <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center" href="/gig-list" type="button" id="dropdownMenuB" aria-expanded="false" itemprop="url"><i class="ri-file-list-3-line me-2"></i><span itemprop="name">Content Writting</span>  <i class="ri-arrow-drop-right-line ms-auto"></i></a>
                <ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Blog Writting</a></li>
                    </div>
                </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about" itemprop="url"><span itemprop="name">About</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog" itemprop="url"><span itemprop="name">Blog</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact" itemprop="url"><span itemprop="name">Contact</span></a>
        </li>
      </ul>
      {{-- mobile navigation --}}
      <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0 gap-2 gap-lg-3 d-block d-lg-none">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            Services <i class="ri-arrow-drop-down-line ms-1"></i>
          </a>
          <ul class="dropdown-menu px-2 shadow-sm border border-light-subtle">
            <li class="dropend">
                <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center" href="/services" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-image-edit-line me-2"></i>Graphic Design  <i class="ri-arrow-drop-right-line ms-auto"></i></a>
                <ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Logo (2D)</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Social Media Post</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Flyer/Poster</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Infographic Design</a></li>
                    </div>
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Brochure (Tri/Bi-fold)</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Entire Social Media/MCM Kit</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">(KV, Standee, Leaflets, Poster)</a></li>
                    </div>
                </ul>
            </li>
            
            <li class="dropend">
                <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center" href="/gig-list" type="button" id="dropdownMenuB" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-video-line me-2"></i>Video Editing  <i class="ri-arrow-drop-right-line ms-auto"></i></a>
                <ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">YouTube Video Editing (Long Form)</a></li>
                    <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Brand Film</a></li>
                    <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Interview Edits (Podcast)</a></li>
                    <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Event Highlight Reels</a></li>
                    <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Reel Edit (15-30 Sec)</a></li>
                    </div>
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Explainer Video</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Testimonial Edit</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Training/How to Video</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Subtitling/Translation</a></li>
                    </div>
                </ul>
            </li>
            <li class="dropend">
                <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center" href="/gig-list" type="button" id="dropdownMenuB" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-macbook-line me-2"></i>Animation & Vfx  <i class="ri-arrow-drop-right-line ms-auto"></i></a>
                <ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">3D Product Renders</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Character</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Modelling + Texturing + Rigging</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Green Screen Cleanup</a></li>
                    </div>
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Object Tracking & Match</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Move</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">AR Video</a></li>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">VR Video</a></li>
                    </div>
                </ul>
            </li>
            <li class="dropend">
                <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center" href="/gig-list" type="button" id="dropdownMenuB" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-vidicon-2-line me-2"></i>Shoots  <i class="ri-arrow-drop-right-line ms-auto"></i></a>
                <ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">On Ground Shoot</a></li>
                    </div>
                    <div></div>
                </ul>
            </li>
            <li class="dropend">
                <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center" href="/gig-list" type="button" id="dropdownMenuB" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-file-list-3-line me-2"></i>Content Writting  <i class="ri-arrow-drop-right-line ms-auto"></i></a>
                <ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
                    <div>
                      <li class="px-2"><a class="dropdown-item rounded" href="/gig-list">Blog Writting</a></li>
                    </div>
                </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact">Contact</a>
        </li>
      </ul>
      <div class="d-flex align-items-start ms-3 ms-lg-0 align-items-lg-center flex-column flex-lg-row gap-3 gap-lg-4">
        {{-- search button --}}
        <button class="navbar-search-btn p-0 d-flex align-items-center" type="button" data-bs-toggle="modal" data-bs-target="#navSearchModal">
            <i class="ri-search-2-line me-1 me-lg-0"></i><span class="d-inline d-lg-none">Search</span>
        </button>
        {{-- dashboard button --}}
        <a class="btn btn-main" href="/user/dashboard">Dashboard</a>
      </div>
    </div>
  </div>
</nav>


{{-- navbar search modal --}}
<div class="modal fade" id="navSearchModal" tabindex="-1" aria-labelledby="navSearchModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-transparent position-relative mt-5">
      <div class="modal-body dropdown navbar-search-dropdown">
        <div class="input-group mb-3" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="input-group-text  border-0 bg-white" id="basic-addon1">
                <i class="ri-search-2-line"></i>
            </span>
            <input type="text" class="form-control border-0 navbar-search-modal-input focus-shadow-none py-3" placeholder="What are you looking for?" aria-label="Search" aria-describedby="basic-addon1">
        </div>
        <ul class="dropdown-menu">
            <li class="px-2"><a class="dropdown-item rounded mb-2" href="#">Logo (2d)</a></li>
            <li class="px-2"><a class="dropdown-item rounded mb-2" href="#">Graphic Design</a></li>
            <li class="px-2"><a class="dropdown-item rounded mb-2" href="#">Video Editing</a></li>
          </ul>
      </div>
        <button type="button" class="btn-close position-absolute navbar-search-modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
  </div>
</div>


@php
	$title = $sows->meta_title ?? $title . ' - Elyvato';
	$metaDescription = $sows->meta_description ?? 'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
	$robotsMeta = 'index, follow';
	$canonical = 'https://elyvato.com';
	$featuredImage = '/images/tmw-team.JPG';
@endphp


@section('styles')

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<!-- Flatpickr CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

	<style>
		/* here calender css  */

		.calendar {
			/*width: 100%;*/
			font-family: "Poppins", sans-serif;
			color: black;
			max-width: 800px;
			background: white;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			padding: 20px;
			border-radius: 10px;
		}

		.calendar-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.calendar-weekdays,
		.calendar-days {
			display: grid;
			grid-template-columns: repeat(7, 1fr);
			margin-top: 10px;
		}

		.calendar-weekdays div {
		    font-family: "Poppins", sans-serif;
			font-weight: bold;
			text-align: center;
			padding: 5px;
			background: #eee;
			border: 1px solid #ddd;
		}

		.calendar-days div {
		    font-family: "Poppins", sans-serif;
		    text-align: center;
			height: 42px;
			width: 44px;
			padding: 5px;
			border: 1px solid #eee;
			position: relative;
			border-radius: 30px;
            background: #e9f6ff;
            cursor: pointer;
		}

		.calendar-days .event {
		    font-family: "Poppins", sans-serif;
			background: #e1f5fe;
			padding: 3px;
			font-size: 10px;
			margin-top: 3px;
			border-left: 3px solid #039be5;
		}


		.calendar-days .today {
			background-color: #0069ff;
			border: 2px solid #0069ff;
			border-radius: 30px;
			color:white;
			cursor: pointer;
		}

		.calendar-days .disabled {
			color: #aaa;
			background-color: #f8f9fa;
			pointer-events: none;
			opacity: 0.6;
			cursor: disabled;
		}

		.calendar-days .selected {
			background-color: #98bcf0;
            color: #2526ff;
            border-radius: 30px;
            border: 2px solid #98bcf0;
            cursor: pointer;
		}
		
		
		/*here time slot css */
		
		.time-slots {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.time-slot-btn {
  border: 1px solid #007bff;
  background: #fff;
  color: #007bff;
  font-size: 16px;
  font-weight: 600;
  text-align: center;
  padding: 14px;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

.time-slot-btn:hover {
  background: #e6f0ff;
}

.time-slot-btn.active {
  background: #007bff;
  color: #fff;
}

.time-slot-btn:disabled {
    
  background: #f5f5f5;
  border-color: #ddd;
  color: #aaa;
  cursor: disabled;
}


#prev, #next{
    cursor: pointer;
}
		
		
#timeSlotsContainer {
    font-family: "Poppins", sans-serif;
    height: 366px;
    overflow-y: scroll;   /* still scrollable */
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE/Edge */
}

#timeSlotsContainer::-webkit-scrollbar {
    display: none; /* Chrome, Safari */
}


.time-slot-btn{
    padding:8px;
    width: 90px;
}
</style>
@endsection

@extends('layouts.front.app')

@section('pageContent')

	{{-- ============================= breadcrumb section ============================= --}}
	<section class="pt-4">
		<div class="container">
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
				<ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
					<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
						<a href="https://elyvato.com" itemprop="item">
							<span itemprop="name">Home</span>
						</a>
						<meta itemprop="position" content="1" />
					</li>
					<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
						<a href="https://elyvato.com/{{$serviceSlug}}" itemprop="item">
							<span itemprop="name">{{$servicename}}</span>
						</a>
						<meta itemprop="position" content="2" />
					</li>
					<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
						<a href="https://elyvato.com/{{ $serviceSlug }}/{{$subserviceSlug}}" itemprop="item">
							<span itemprop="name">{{$subservice_name}}</span>
						</a>
						<meta itemprop="position" content="3" />
					</li>
					<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
						<a href="#" class="breadcrumb-nlink" itemprop="item">
							<span itemprop="name">{{$title}}</span>
						</a>
						<meta itemprop="position" content="4" />
					</li>
				</ol>
			</nav>
		</div>
	</section>

	{{-- ============================= service cards with tabs section ============================= --}}
	<section class="pt-4 section-padding-bottom">
		<div class="container">
			<div class="row justify-content-between align-items-center mb-3">
				<div class="col">
					<h1 class="fw-bold fs-3">{{ ucwords($title) }}</h1>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8 mb-4 mb-lg-0 pe-lg-5">
					{{-- info cards --}}
					<div class="row mb-3 mb-lg-4">
						<div class="col-sm-6 col-md-5 col-lg-6 col-xl-4 mb-3 mb-sm-0">
							<div class="gig-detail-card h-100 border rounded p-3 d-flex align-items-center gap-3">
								<div class="gig-detail-card-icon-box">
									<i class="ri-calendar-line"></i>
								</div>
								<div>
									<h3 class="fs-5 mb-1">Delivery Time</h3>
									<p class="mb-0 text-sm">{{ $sows->estimated_time }}</p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-5 col-lg-6 col-xl-4">
							<div class="gig-detail-card h-100 border rounded p-3 d-flex align-items-center gap-3">
								<div class="gig-detail-card-icon-box">
									<i class="ri-medal-line"></i>
								</div>
								<div>
									<h3 class="fs-5 mb-1">Quality Level</h3>
									<p class="mb-0 text-sm">Professional</p>
								</div>
							</div>
						</div>
						
						@if($sows->is_subscription=='yes')
						<div class="col-sm-6 col-md-5 col-lg-6 col-xl-4">
							<div class="gig-detail-card h-100 border rounded p-3 d-flex align-items-center gap-3">
								<div class="gig-detail-card-icon-box">
									<i class="ri-vip-crown-2-line"></i>
								</div>
								
								<div>
									<h3 class="fs-5 mb-1">Subscription GIG</h3>
									<p class="mb-0 text-sm">{{ucwords($sows->subscription_time)}}</p>
								</div>
							</div>
						</div>
						@endif
					</div>

					<div class="my-3 my-md-5">

						<div class="owl-carousel service-thumbnail-carousel">
							@foreach ($sows->allFiles as $index => $thumb)

								@php
									$hash = chr(97 + $index);
								@endphp
								<div class="item" data-hash="{{ $hash }}">
									<div class="ratio ratio-16x9 position-relative">

										<!-- <img src="{{ asset('front/assets/images/home-freelancer.jpg') }}" alt="thumbnail"	class="object-fit-cover"> -->
										@php
											$VideoId = null;

											if ($thumb->file_type === 'video') {
												preg_match('/embed\/([^"?&]+)/', $thumb->video, $matches);
												$VideoId = $matches[1] ?? null;
											}
										@endphp

										@if($thumb->file_type == 'image')

											<img src="{{ url($thumb->image_path) }}" alt="thumbnail" class="object-fit-cover">

										@elseif($thumb->file_type == 'video')
												 <img src="https://img.youtube.com/vi/{{ $VideoId }}/hqdefault.jpg" alt="YouTube Thumbnail"  class="object-fit-cover">

											<div class="position-absolute top-0 left-0 w-100 h-100 d-flex align-items-center justify-content-center gig-detail-play-btn"
												data-bs-toggle="modal" data-bs-target="#videoModal" data-videoid="{{ $VideoId }}">
												<i class="ri-play-circle-line"></i>
											</div>

										@endif
									</div>
								</div>
							@endforeach

						</div>
						<div class="row mt-4">
							@foreach ($sows->allFiles as $index => $thumb)
								@php
									$hash = chr(97 + $index);
								@endphp
								<div class="col-2 col-sm-2 col-md-2 col-lg-2">
									<a href="#{{ $hash }}" class="ratio ratio-16x9 position-relative">

									@php
											$VideoId = null;

											if ($thumb->file_type === 'video') {
												preg_match('/embed\/([^"?&]+)/', $thumb->video, $matches);
												$VideoId = $matches[1] ?? null;
											}
										@endphp

										@if($thumb->file_type == 'image' )

											<img src="{{ url($thumb->image_path) }}" alt="Video editing"
												class="object-fit-cover rounded-2 cursor-pointer">

										@elseif($thumb->file_type == 'video')
												 <img src="https://img.youtube.com/vi/{{ $VideoId }}/hqdefault.jpg" alt="YouTube Thumbnail"  class="object-fit-cover">

											<div class="position-absolute top-0 left-0 w-100 h-100 d-flex align-items-center justify-content-center gig-detail-play-btn">
												 <i class="ri-play-circle-line"></i> 
											</div>
										@endif
									</a>
								</div>
							@endforeach
						</div>
					</div>

					{{-- gig desctipion --}}
					<div class="mb-3 mb-md-5">
						{!! $sows->description !!}
					</div>
					{{-- service tags --}}


					{{-- faqs --}}
					<h3 class="fw-semibold mb-3 fs-4">Frequently Asked Questions</h3>
					<div class="accordion" id="faqaccordion" itemscope itemtype="https://schema.org/FAQPage">

						<div class="accordion" id="faqaccordion">
							@foreach ($faqs as $index => $faq)
								@php
									$hash = chr(97 + $index); // a, b, c...
									$isFirst = $index === 0;
								@endphp
								<div class="accordion-item" itemscope itemprop="mainEntity"
									itemtype="https://schema.org/Question">
									<h3 class="accordion-header" id="heading{{ $hash }}">
										<button class="accordion-button {{ $isFirst ? '' : 'collapsed' }}"
											type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $hash }}"
											aria-expanded="{{ $isFirst ? 'true' : 'false' }}"
											aria-controls="collapse{{ $hash }}" itemprop="name">
											{{ $faq->question }}
										</button>
									</h3>
									<div id="collapse{{ $hash }}"
										class="accordion-collapse collapse {{ $isFirst ? 'show' : '' }}"
										aria-labelledby="heading{{ $hash }}" data-bs-parent="#faqaccordion" itemscope
										itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
										<div class="accordion-body" itemprop="text">
											{{ $faq->answer }}
										</div>
									</div>
								</div>
							@endforeach
						</div>
						<input type="hidden" id="isLoggedIn" value="{{ Auth::check() ? '1' : '0' }}">
					</div>
				</div>
				{{-- right sidebar --}}
				<div class="col-lg-4 relative">
					<div class="sticky-top-lg-onav">
						<div class="card mb-3 mb-lg-4">
							<div class="card-body">
								<div class="mb-3 pb-3 border-bottom">
									<h3 class="fs-5 fw-medium w-100 border-bottom pb-2 mb-3">Standard</h3>
									@if(!empty($sows->min_price) && $sows->offer_price > 0)
									@php
									
									
										$original_price = $sows->min_price;
										$offer_price = $sows->offer_price;
										$discount_amount = $original_price - $offer_price; // 1500 - 1000 = 500
										$discount_percentage = ($discount_amount / $original_price) * 100;
											@endphp
											<h4 class="fs-2 fw-semibold mb-3">₹ {{ number_format($sows->offer_price) }} /-</h4>
									<small class="text-success"> <s>₹ {{ number_format($sows->min_price) }}</s> {{ round($discount_percentage) }}% Off</small>
								   @else
											<h4 class="fs-2 fw-semibold mb-3">₹ {{ number_format($sows->min_price) }} /-</h4>
									@endif



									<h5 class="fw-semibold">{{$sows->title}}</h5>
									<p> {!!  trimWords($sows->description) !!} </p>
								</div>
								<div class="mt-3 pb-3">
									<p class="mb-2 d-flex align-items-center gap-2"><i
											class="ri-hourglass-fill text-main"></i>{{$sows->estimated_time}}</p>
									<p class="d-flex align-items-center gap-2"><i
											class="ri-checkbox-circle-fill text-main"></i>Source file</p>
									
									@if($sows->is_subscription=='yes')
									<p class="d-flex align-items-center gap-2"><i
											class="ri-vip-crown-2-line text-main"></i>{{ucwords($sows->subscription_time)}} Subscription</p>
									@endif
								</div>
								<button type="button"
									class="btn btn-md-large btn-main w-100 d-flex align-items-center gap-2 justify-content-center"
									data-bs-toggle="modal" data-bs-target="#bookingModal"><i class="ri-phone-line"></i>Book
									Call</button>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<a href="{{url('contact')}}"
									class="mb-3 btn btn-md-large btn-accent w-100 d-flex align-items-center gap-2 justify-content-center">Contact
									Us<i class="ri-arrow-right-up-line"></i></a>
								<a href="{{route('post.custom.requirement', $sows->slug)}}"
									class="btn btn-md-large btn-outline-accent w-100 d-flex align-items-center gap-2 justify-content-center">Custom
									Requirement<i class="ri-arrow-right-up-line"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-padding-top section-padding-bottom bg-light">
		<div class="container">
			<div class="row service-cards">
				<h2 class="fw-bold mb-3">People Who Viewed This Service Also Viewed</h2>
				
				@foreach (Service()->take(4) as $service)
					<div class="col-md-6 col-lg-4 col-xl-3">
						<div class="h-100 bg-white border border-light-subtle rounded service-card shadow-sm d-flex flex-column">
							<div class="service-card-image-box rounded-top">
								<img src="{{ asset($service->service_icon) }}" alt="{{ $service->name }}"
									class="img-fluid service-card-image">
							</div>
							<div class="service-card-content p-4 d-flex flex-column flex-grow-1">
								<div class="mb-4">
									<h3 class="fw-bold mb-3">
										<a href="{{ route('service-sow-list', ['slug' => $service->slug]) }}">
											{{ $service->name }}
										</a>
									</h3>
									<p class="mb-0">{{ $service->description }}</p>
								</div>
								<div class="mt-auto">
									<a href="{{ route('service-sow-list', ['slug' => $service->slug]) }}"
										class="service-card-link d-inline-flex align-items-center">View Services <i
											class="ri-arrow-right-line"></i></a>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>

	<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content border-0">
				<div class="modal-body p-0 position-relative">
					<div class="ratio ratio-16x9">
						<iframe id="youtubeIframe" src="" title="YouTube video player" frameborder="0"
							allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
							referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>></iframe>
					</div>
					<button type="button" class="btn-close position-absolute gig-list-modal-close-btn"
						data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="bookingModalLabel">Schedule Your Discovery Call</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">

					<div class="marquee-wrapper mb-2">
						
							<!--<p class="fs-5 fw-medium mb-0">-->
								
							<!--</p>-->
							<div class="btn-accent p-2" role="alert" style=" border-radius: 6px;">
                              Book your expert call for just ₹9 — fully adjusted in your project cost.
                            </div>

						<input type="hidden" name="selected_date" id="selectedDateInput">
					</div>
					<div class="row mb-3">
						<div class="col-sm-8 calendar">
							<div class="calendar-header">
								<i id="prev" class="ri-arrow-left-circle-fill"></i>
								<h2 id="monthYear"></h2>
								<i id="next" class="ri-arrow-right-circle-fill"></i>
							</div>
							<div class="calendar-weekdays">
								<div>Sun</div>
								<div>Mon</div>
								<div>Tue</div>
								<div>Wed</div>
								<div>Thu</div>
								<div>Fri</div>
								<div>Sat</div>
							</div>
							<div class="calendar-days" id="calendarDays"></div>
						</div>
					

					<!-- Time slot buttons container -->
					<input type="hidden" name="time_slot" id="timeSlot">
					 
				        
                        <div class="col-sm-4" id="timeSlotsContainer" class="time-slots">
                            <h6 class="text-center" id="today_date_show"></h6>
                        </div>
                    
                </div>

					@if(!Auth::check())
						<div class="form-floating mb-3">
							<input type="email" class="form-control focus-shadow-none" name="email" id="email"
								placeholder="name@example.com" required>
							<label for="email">Email address</label>
						</div>

						<div class="form-floating mb-3">
							<input type="mobile" class="form-control focus-shadow-none" name="mobile" id="mobile"
								placeholder="123456789" required>
							<label for="email">Phone Number</label>
						</div>

					@endif


					<p class="mb-0 text-accent">The ₹9 charge helps us ensure genuine interest and prevent spam. Don’t worry it’s fully adjusted in your project cost.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

					<button type="button" data-id="{{ $sows->id }}" data-price="9"
						class="btn btn-main proceed-booking-btn">Book Now</button>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('scripts')
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	<!-- Flatpickr JS -->
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script>
		$(document).ready(function () {
			$('.service-thumbnail-carousel').owlCarousel({
				items: 1,
				loop: true,
				margin: 40,
				nav: true,
				dots: false,
				lazyLoad: true,
				URLhashListener: true,
				slideTransition: 'linear',
				mouseDrag: true,
				touchDrag: true,
				startPosition: 'URLHash'
			});
		});

		$(document).on('click', '[data-bs-toggle="modal"][data-videoid]', function () {
			var videoId = $(this).data('videoid');
			var embedUrl = 'https://www.youtube.com/embed/' + videoId + '?rel=0&autoplay=1';
			$('#youtubeIframe').attr('src', embedUrl);
		});

		// When modal is closed
		$('#videoModal').on('hidden.bs.modal', function () {
			$('#youtubeIframe').attr('src', '');
		});

		document.addEventListener('DOMContentLoaded', function () {
			flatpickr("#formDate", {
				dateFormat: "Y-m-d",
				minDate: "today",
				defaultDate: "today",
				allowInput: false
			});
		});


		// here start new booking js 

		const calendarDays = document.getElementById("calendarDays");
		const monthYear = document.getElementById("monthYear");
		const prev = document.getElementById("prev");
		const next = document.getElementById("next");

		let currentDate = new Date();
    
		const events = {
			//   "2025-06-11": ["Employment (Semi...)"],
		};

		let selectedDate = null;

		function renderCalendar(date) {
			const year = date.getFullYear();
			const month = date.getMonth();
			const today = new Date();
			today.setHours(0, 0, 0, 0);

			const firstDay = new Date(year, month, 1);
			const lastDay = new Date(year, month + 1, 0);
			const startDay = firstDay.getDay();

			monthYear.innerText = date.toLocaleString("default", { month: "long", year: "numeric" });
			calendarDays.innerHTML = "";

			for (let i = 0; i < startDay; i++) {
				// calendarDays.innerHTML += `<div></div>`;
			}

			for (let day = 1; day <= lastDay.getDate(); day++) {
				const dateObj = new Date(year, month, day);
				const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
				const dayEvents = events[dateStr] || [];

				let classes = [];
				if (dateObj.getTime() < today.getTime()) {
					classes.push('disabled');
				}
				if(
					dateObj.getDate() === today.getDate() &&   
					dateObj.getMonth() === today.getMonth() &&
					dateObj.getFullYear() === today.getFullYear()
				) {
					classes.push('today');
				}
				if (selectedDate === dateStr) {
					classes.push('selected');
				}

				let html = `<div class="${classes.join(' ')}" data-date="${dateStr}"><strong>${day}</strong>`;
				dayEvents.forEach(e => {
					html += `<div class="event">${e}</div>`;
				});
				html += `</div>`;

				calendarDays.innerHTML += html;
			}

			attachDateClickListeners();
		}

		function attachDateClickListeners() {
			const dateDivs = document.querySelectorAll("#calendarDays div:not(.disabled)");
			const bookedSlots = @json($bookedSlots);
            const liveStartTime = @json($liveStartTime);
			dateDivs.forEach(div => {
				div.addEventListener("click", function () {
					selectedDate = this.getAttribute("data-date");
					document.getElementById("selectedDateInput").value = selectedDate;
					renderCalendar(currentDate);
					// alert(selectedDate);
					// alert(bookedSlots);
					generateTimeSlots(10, 19, 30, selectedDate, bookedSlots,liveStartTime); //  added params
				});
			});
		}


		prev.addEventListener("click", () => {
			currentDate.setMonth(currentDate.getMonth() - 1);
			renderCalendar(currentDate);
		});

		next.addEventListener("click", () => {
			currentDate.setMonth(currentDate.getMonth() + 1);
			renderCalendar(currentDate);
		});

		renderCalendar(currentDate);

		// here is time slot list 



		document.addEventListener("DOMContentLoaded", function () {
			const bookedSlots = @json($bookedSlots);
           console.log(bookedSlots);
			const today = new Date().toISOString().split('T')[0];
			selectedDate = today;
			document.getElementById("selectedDateInput").value = today;
// 			generateTimeSlots(1, 23, 30, today, bookedSlots);  here not show time  on load page 
		});





function generateTimeSlots(startHour = 7, endHour = 23, interval = 30, selectedDate = null, bookedSlots = [], liveStartTime) {
    const container = document.getElementById("timeSlotsContainer");
    container.innerHTML = "";
     
    //  $('#today_date_show').text(selectedDate);
    
     

 
    
     
     const formattedDate = new Date(selectedDate).toLocaleDateString("en-US", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric"
    });

    // Example output: "Saturday, August 16, 2025"



     
    const now = new Date();
    const isToday = selectedDate === now.toISOString().split("T")[0];

 
       // If today selected AND manager is not live → show message and stop
    if (isToday && liveStartTime === false) {
        container.innerHTML = `<button type="button" class="btn btn-sm bg-danger text-white">Book next day slot</button>`;
        return;
    }

function getNextInterval(date, interval) {
    let minutes = date.getMinutes();
    let hours = date.getHours();

    if (minutes === 0 || minutes === 30) {
        // already on an exact slot → go to the next interval
        minutes += interval;
        if (minutes === 60) {
            hours++;
            minutes = 0;
        }
    } else if (minutes < 30) {
        // round up to 30
        minutes = 30;
    } else {
        // minutes > 30 → round up to next hour
        hours++;
        minutes = 0;
    }

    return new Date(date.getFullYear(), date.getMonth(), date.getDate(), hours, minutes, 0, 0);
}



    const todayStart = getNextInterval(now, interval); // next half-hour from now

    for (let hour = startHour; hour <= endHour; hour++) {
        for (let min = 0; min < 60; min += interval) {
            const hourStr = String(hour).padStart(2, '0');
            const minStr = String(min).padStart(2, '0');
            const timeValue = `${hourStr}:${minStr}`;
            const fullDateTime = `${selectedDate} ${hourStr}:${minStr}:00`;

            const slotDateTime = new Date(`${selectedDate}T${timeValue}`);
            
            // Skip if slot is before today's current rounded time
            if (isToday && slotDateTime < todayStart) continue;

            // Skip if already booked
            if (bookedSlots.includes(fullDateTime)) continue;

            // Format display in 12-hour (am/pm)
            const display = slotDateTime.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit', hour12: true });

            // Create button
            const btn = document.createElement("button");
            btn.type = "button";
            btn.className = "time-slot-btn m-1";
            btn.textContent = display;

            btn.addEventListener("click", () => {
                document.querySelectorAll(".time-slot-btn").forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                document.getElementById("timeSlot").value = timeValue;
            });

            container.appendChild(btn);
        }
    }

    // If no slots remain
    if (container.innerHTML === "") {
        container.innerHTML = `<p style="color:#999; font-size:14px;">No available slots for today</p>`;
    }
}




		$('#customBooking').click(function () {
			sowId = $(this).data("id");
			$('#sow_id').val(sowId);

		})




		//  proceed to book a call


		// here customize razorpay system
		//  Main Button Click Event
		$(document).on('click', '.proceed-booking-btn', function (e) {
			e.preventDefault();

            let $btn = $('.proceed-booking-btn');
            $btn.prop('disabled', true).text('Processing...');
    
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			let time = $('#timeSlot').val();
			let day = $('#selectedDateInput').val();
			//  alert(day); 
			//  alert(time);
			let isLoggedIn = $('#isLoggedIn').val();
			let sow_id = $(this).data('id');
			let price = $(this).data('price');

			if (isLoggedIn == 0) {

				let email = $('#email').val();  // Get email
				let mobile = $('#mobile').val();  // Get mobile

				// Basic validation
				if (!email || !mobile) {
					Swal.fire("Missing Info", "Please complete your details by entering your email ID and contact information.", "warning");
				        $btn.prop('disabled', false).text('Book Now');
				} else {
					RegisteUsername(email, mobile,sow_id, price, time, day);
				}

			} else {
				createRazorpayOrder(sow_id, price, time, day, isLoggedIn); // Call the order function
			}

		});

		// register user if not login 

		function RegisteUsername(email, mobile,sow_id, price, time, day) {
		    let $btn = $('.proceed-booking-btn');
            $btn.prop('disabled', true).text('Processing...');
            
			$.ajax({
				url: "{{ url('registeration') }}",
				type: 'POST',
				data: {
					email: email,
					mobile: mobile
				},
				success: function (response) {
					if(response.success) {
						  let userId = response.data?.user_id || null;
						//   alert('run razorpay now 1');

						// Swal.fire("Success", response.message, "success");

						// Swal.fire("Success", res.message, "success").then(() => {
						// 	createRazorpayOrder(sow_id, price, time, day, userId);
						// });

						Swal.fire({
							title: "Info",
							text: response.message,
							icon: "success",
							confirmButtonText: "Processing...", // Change button text here
							timer: 3000,
    						timerProgressBar: true,
						}).then(() => {
							createRazorpayOrder(sow_id, price, time, day, userId);
						});


						// callback(true, userId); // Continue to Razorpay
					} else {
						if (response.message === "Your account already registered.") {
						  let userId = response.data?.user_id || null;
							// Swal.fire("Info", response.message, "info");
							// alert('run razorpay now 2');

							// Swal.fire("Info", response.message, "success").then(() => {
							// 	createRazorpayOrder(sow_id, price, time, day, userId);
							// });

							Swal.fire({
								title: "Info",
								text: response.message,
								icon: "success",
								confirmButtonText: "PleaseWait...",  // Change button text here
								timer: 3000,
								timerProgressBar: true,
							}).then(() => {
								createRazorpayOrder(sow_id, price, time, day, userId);
							});
						
							// callback(true, UserId); // Still proceed to Razorpay
						} else {
				// 			alert('run razorpay now 3');
							Swal.fire("Error", response.message || "Registration failed.", "error");
							callback(false);
							
							$btn.prop('disabled', false).text('Book Now');
						}
					}
				},
				error: function (xhr, status, error) {
					console.error(error);
					Swal.fire("Error", "Something went wrong. Try again.", "error");
					callback(false);
					$btn.prop('disabled', false).text('Book Now');
				}
			});
		}

		//  STEP 1: Call this to begin the Razorpay process
		function createRazorpayOrder(sow_id, price, time, day, user_id) {
			PleaseWait();

            let $btn = $('.proceed-booking-btn');
            $btn.prop('disabled', true).text('Processing...');
            
			$.ajax({
				url: "{{ route('razorpay.order.create') }}",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					price: price
				},
				success: function (orderData) {
					Swal.close();

					let options = {
						key: orderData.razorpay_key,
						amount: orderData.amount,
						currency: orderData.currency,
						name: "Elyvato",
						description: "Call Sechdule Payment",
						image: "https://elyvato.com/front/assets/images/elyvato-header-logo.png",
						order_id: orderData.order_id,
						handler: function (response) {
							storeBooking(response, sow_id, price, time, day, user_id); 
						},
						theme: {
							color: "#8c32f6"
						}
					};

					let rzp = new Razorpay(options);
					rzp.open();
				},
				error: function () {
					Swal.close();
					Swal.fire("Error", "Failed to create order.", "error");
					$btn.prop('disabled', false).text('Book Now');
				}
			});
		}



		// STEP 2: Call this after Razorpay success
		function storeBooking(response, sow_id, price, time, day, user_id) {
			PleaseWait();
			
			let $btn = $('.proceed-booking-btn');
            $btn.prop('disabled', true).text('Processing...');

			$.ajax({
				url: "{{ route('user.proceed.booking') }}",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					sow_id: sow_id,
					price: price,
					time: time,
					day: day,
					user_id:user_id,
					razorpay_payment_id: response.razorpay_payment_id,
					razorpay_order_id: response.razorpay_order_id,
					razorpay_signature: response.razorpay_signature
				},
				success: function (res) {
					Swal.close();
					Swal.fire("Success", res.message, "success").then(() => {
						window.location.href = "{{ url('/booking-details') }}/"+res.booking_id;
					});
				},
				error: function () {
					Swal.close();
					Swal.fire("Error", "Technical error!", "error");
					$btn.prop('disabled', false).text('Book Now');
				}
			});
		}



	</script>
@endsection
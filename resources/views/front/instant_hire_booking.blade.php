@php
    $title = $instanthire->seo_title ?? $title;
    $metaDescription =
        $instanthire->meta_description ??
        'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'noindex, nofollow';
    $canonical = 'https://elyvato.com';
    $featuredImage = asset($instanthire->image) ?? '/front/assets/images/elyvato-header-logo.png';
@endphp


@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .owl-dots {
            display: flex;
            justify-content: center;
            position: absolute;
            bottom: 10px;
            width: 100%;
        }

        .owl-dot:nth-child(n+4) {
            display: none;
            /* Hide all dots starting from the 4th one */
        }


        /* here calender css  */

        .calendar {
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
            color: white;
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


        #prev,
        #next {
            cursor: pointer;
        }


        #timeSlotsContainer {
            font-family: "Poppins", sans-serif;
            height: 348px;
            overflow-y: scroll;
            /* still scrollable */
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE/Edge */
        }

        #timeSlotsContainer::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari */
        }


        .time-slot-btn {
            padding: 8px;
            width: 90px;
        }
    </style>
@endsection

@extends('layouts.front.app')

@section('pageContent')

    {{-- ============================= single blog post with sidebar section ============================= --}}
    <section class="section-padding-top section-padding-bottom">
        <div class="container">
            <div class="row">
                @if (Auth::check())
                    <input type="hidden" id="check" value="true">
                @else
                    <input type="hidden" id="check" value="false">
                @endif
                <div class="col-lg-8 pe-lg-5 mb-4 mb-lg-0">
                    <h1 class="mb-2 fw-bold">Instantly Hire the Right Talent for Your Business</h1>
                    <p class="mb-3 mb-md-4">Your project, your choice – explore skilled professionals ready to work with
                        you.</p>

                    <div class="mb-4">
                        <span class="btn-accent p-2 mb-3" style=" border-radius: 6px;"> Book your instant call for just ₹9 —
                            fully adjusted in your project cost. </span>
                    </div>

                    <form id="hire_talent" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">


                                <input type="hidden" name="selected_date" id="selectedDateInput">

                                <div class="form-floating mb-3">
                                    {{-- <input type="text" class="form-control w-100 focus-shadow-none" id="formDate"
                                placeholder="Select a date" readonly>
                            <label for="formDate" class="text-sm text-muted mb-1">Select A Date</label> --}}

                                    <div class="calendar">
                                        <div class="calendar-header">
                                            <i id="prev" class="fas fa-angle-left"></i>
                                            <h2 id="monthYear"></h2>
                                            <i id="next" class="fas fa-angle-right"></i>
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
                                    <input type="hidden" name="sow_id" value="">
                                </div>
                            </div>
                            <input type="hidden" name="time_slot" id="timeSlot">

                            <div class="col-sm-4" id="timeSlotsContainer" class="time-slots">
                                <h6 class="text-center" id="today_date_show"></h6>
                            </div>
                        </div>

                        {{-- <div class="form-floating mb-3">

                            <select id="timeSlot" name="time_slot" class="form-select focus-shadow-none">
                                <option value="">Select a time slot</option>
                            </select>

                            <label for="time-picker">Select a Time Slot</label>
                        </div> --}}
                        <input type="hidden" name="call_boking_price" id="call_boking_price" value="9">

                        <div class="form-floating mb-3">

                            @if (empty($instanthire))
                                <select class="form-select focus-shadow-none" id="hire_talent" name="hire_talent">
                                    @foreach (Hiretalent() as $talent)
                                        @if ($talent->is_available == 1)
                                            <option value="{{ $talent->id }}">{{ $talent->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                <select class="form-select focus-shadow-none" id="hire_talent" name="hire_talent">

                                    <option value="{{ $instanthire->id }}" selected>{{ $instanthire->name }}</option>

                                </select>
                            @endif

                            <label for="role_designation">Hire Talent</label>
                        </div>



                        <div class="form-floating mb-3">
                            <input type="number" class="form-control focus-shadow-none" name="cost_amount" id="cost_amount"
                                placeholder="4500" required>
                            <label for="budget">Your Budget (₹)</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control focus-shadow-none" name="brief_description" id="brief_description"
                                style="min-height:100px" required></textarea>
                            <label for="brief_description">Your Requirements</label>
                        </div>

                        <button type="submit" value="Post hire talent" class="btn btn-main hire-talent">Hire Now </button>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="sticky-lg-top-90">
                        <div class="border p-3 rounded-2 bg-light">
                            <h2 class="fs-5 fw-bold mb-3">Testimonials</h2>
                            <div class="testimonial-slider owl-carousel">
                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Elyvato has completely changed the way we handle content
                                                production. Seamless and reliable!</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">

                                                <div>
                                                    <p class="mb-0">By — Priya Kapoor</p>
                                                    <p class="mb-0 text-sm">Marketing Head, D2C Brand</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">The team understood our niche very well. A few delays, but
                                                final content was spot on.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">

                                                <div>
                                                    <p class="mb-0">By Zoya Rahman.</p>
                                                    <p class="mb-0 text-sm">Health Blogger</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Finally, a platform that actually understands how the
                                                Indian content market works. Love it!</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Ramesh Vaidya.</p>
                                                    <p class="mb-0 text-sm">Freelancer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Video editors were top-notch. Only reason for 4 stars is a
                                                slight lag in preview delivery.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <p class="mb-0">By Yusuf Qureshi.</p>
                                                    <p class="mb-0 text-sm">Content Consultant</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Elyvato understood the requirements quickly and gave us
                                                practical solutions. It is only possible when the team is already expert
                                                with community product strategy</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">

                                                <div>
                                                    <p class="mb-0">By Steve Zhou.</p>
                                                    <p class="mb-0 text-sm"> Senior BD Manager, BIGO</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">What Fiverr couldn’t deliver in 5 days, Elyvato gave me in
                                                24 hours — and better.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Nikhil Jain. </p>
                                                    <p class="mb-0 text-sm">Founder, Media Startup</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Elyvato team is being run by a bunch of responsible and
                                                professional people. They've been available for me 24x7. It's a go-to
                                                company for startups like us.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <p class="mb-0">By Donny Singh</p>
                                                    <p class="mb-0 text-sm">APT Consultancy, Canada</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Their managed delivery is a game changer. I don’t have to
                                                chase 10 people anymore.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Aditya Khanna</p>
                                                    <p class="mb-0 text-sm">Digital Lead</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">From script to subtitles, we got everything done in 3
                                                languages. Smoothest workflow we’ve seen.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Karishma Rawat.</p>
                                                    <p class="mb-0 text-sm">OTT Content Team</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Impressed by the platform's speed and the quality of the
                                                talent. Didn’t expect this level at these prices.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Vikram Iyer.</p>
                                                    <p class="mb-0 text-sm">Founder, Bootstrapped SaaS</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">As a freelancer, Elyvato actually pays on time. That’s
                                                rare. And the project briefs are super clear.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Divya S.</p>
                                                    <p class="mb-0 text-sm">Content Writer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">We got a fully localized product video for Amazon in 72
                                                hours. No follow-ups needed.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Tushar Goyal.</p>
                                                    <p class="mb-0 text-sm"> Ecom Seller</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">I handed off an entire blog series to them and they nailed
                                                voice, research, and tone. Total win.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Meenakshi Dubey.</p>
                                                    <p class="mb-0 text-sm">Content Lead</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Elyvato is what Indian content services needed. Reliable
                                                people, accountable delivery.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Siddharth Malhotra.</p>
                                                    <p class="mb-0 text-sm">Co-founder, AdTech Firm</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Our explainer video project was handled end-to-end, and it
                                                looked premium.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Aakash Sinha.</p>
                                                    <p class="mb-0 text-sm">Founder, Fintech App</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i>
                                                </li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Tried them for one project — ended up giving them 5 more.
                                                Elyvato delivers.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Juhi Patel.</p>
                                                    <p class="mb-0 text-sm">Social Media Manager</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Super impressed by the voiceover quality. Turnaround could
                                                be faster, but worth it.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Ankush Taneja.</p>
                                                    <p class="mb-0 text-sm">YouTuber</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>

                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Had a minor revision request but the team was quick and
                                                polite. Very professional.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Reena Mishra.</p>
                                                    <p class="mb-0 text-sm">Podcast Host</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">Great delivery and UI, though onboarding could be smoother
                                                for first-time users.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Mohit Arora.</p>
                                                    <p class="mb-0 text-sm">Startup Founder</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">High-quality copy at 1/3rd the price of what we usually
                                                pay. Will definitely use again.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Shalini Nair</p>
                                                    <p class="mb-0 text-sm">Brand Manager</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="card-body p-0">
                                            <!-- Rating star -->
                                            <ul class="list-unstyled mb-2">
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                                <li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
                                            </ul>
                                            <!-- Content -->
                                            <p class="fw-medium">First project went well. Minor hiccup in TAT but they made
                                                up for it with quality.</p>
                                        </div>

                                        <div class="card-footer border-0 bg-transparent p-0">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
                                                <div>
                                                    <p class="mb-0">By Harshit Sharma.</p>
                                                    <p class="mb-0 text-sm">Freelancer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection


@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        $(document).ready(function() {
            $('.testimonial-slider').owlCarousel({
                loop: true,
                margin: 40,
                nav: false,
                dots: true,
                lazyLoad: true,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 1
                    }
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#formDate", {
                dateFormat: "Y-m-d",
                minDate: "today",
                defaultDate: "today",
                allowInput: false
            });
        });


        // here start date time functionality

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

            monthYear.innerText = date.toLocaleString("default", {
                month: "long",
                year: "numeric"
            });
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
                if (
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
                div.addEventListener("click", function() {
                    selectedDate = this.getAttribute("data-date");
                    document.getElementById("selectedDateInput").value = selectedDate;
                    renderCalendar(currentDate);
                    // alert(selectedDate);
                    // alert(bookedSlots);
                    generateTimeSlots(10, 19, 30, selectedDate, bookedSlots,
                    liveStartTime); //  added params
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


        document.addEventListener("DOMContentLoaded", function() {
            const bookedSlots = @json($bookedSlots);
            console.log(bookedSlots);
            const today = new Date().toISOString().split('T')[0];
            selectedDate = today;
            document.getElementById("selectedDateInput").value = today;
            // generateTimeSlots(1, 23, 30, today, bookedSlots);  here not show time  on load page 
        });




        function generateTimeSlots(startHour = 7, endHour = 23, interval = 30, selectedDate = null, bookedSlots = [],
            liveStartTime) {
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
                container.innerHTML =
                    `<button type="button" class="btn btn-sm bg-danger text-white">Book next day slot</button>`;
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
                    const display = slotDateTime.toLocaleTimeString([], {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true
                    });

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



        // end here 


        // here start booking 
        $('#hire_talent').on('submit', function(e) {
            e.preventDefault();

            let $btn = $('.hire-talent');
            $btn.prop('disabled', true).text('Processing...');

            let costAdmount = $('#cost_amount').val();
            let check = $('#check').val();
            // alert(check);
            let sow_id = $('#sow_id').val();
            let price = $('#call_boking_price').val();
            let = timeSlot = $('#timeSlot').val();

            if (check == 'false') {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Please login first.",
                    timer: 3000, // auto close after 3 sec
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "{{ url('login') }}";
                });
            } else if (costAdmount <= 0 && !$.isNumeric(costAdmount)) {
                Swal.fire("Error", "Budget amount must be a non-empty number.", "error");
                $btn.prop('disabled', false).text('Post Custom Gig');

            } else if (timeSlot == '') {
                Swal.fire("Error", "Select Date and Time", "error");
                $btn.prop('disabled', false).text('Post Custom Gig');
            } else {

                let formData = new FormData(this);

                //  Instead of saving immediately, trigger Razorpay
                createRazorpayOrderAndPay(price, formData);
            }

        });



        function createRazorpayOrderAndPay(price, formData) {
            // alert(price);
            PleaseWait(); // Show loading

            let $btn = $('.hire-talent');
            $btn.prop('disabled', true).text('Processing...');


            $.ajax({
                url: "{{ route('razorpay.order.create') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    price: price
                },
                success: function(orderData) {
                    Swal.close(); // Hide wait popup

                    let options = {
                        key: orderData.razorpay_key,
                        amount: orderData.amount,
                        currency: orderData.currency,
                        name: "Elyvato",
                        description: "Instant Hire",
                        image: "https://elyvato.com/front/assets/images/elyvato-header-logo.png",
                        order_id: orderData.order_id,
                        handler: function(response) {
                            storeCustomBooking(response, formData);
                        },
                        theme: {
                            color: "#8c32f6"
                        }
                    };

                    let rzp = new Razorpay(options);
                    rzp.open();
                },
                error: function() {
                    Swal.close();
                    Swal.fire("Error", "Bad Gateway error.", "error");
                    $btn.prop('disabled', false).text('Hire');
                }
            });
        }

        function storeCustomBooking(response, formData) {
            PleaseWait();

            let $btn = $('.hire-talent');
            $btn.prop('disabled', true).text('Processing...');

            // Append Razorpay fields to formData
            formData.append('razorpay_payment_id', response.razorpay_payment_id);
            formData.append('razorpay_order_id', response.razorpay_order_id);
            formData.append('razorpay_signature', response.razorpay_signature);


            $.ajax({
                url: "{{ route('user.proceed.hire') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.close();
                    if (response.success == true) {
                        Swal.fire("Success", response.message, "success").then(() => {
                            window.location.href = "{{ url('/booking-details') }}/" + response
                                .booking_id;
                        });
                    } else {
                        Swal.fire("Error", response.message || "Unknown error", "error");
                        $btn.prop('disabled', false).text('Hire');
                    }
                },
                error: function(xhr) {
                    Swal.close();
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = Object.values(errors).map(msgArr => msgArr.join(', ')).join('<br>');
                        Swal.fire("Validation Error!", errorMessages, "error");
                        $btn.prop('disabled', false).text('Hire');
                    } else {
                        Swal.fire("Error", "Something went wrong.", "error");
                        $btn.prop('disabled', false).text('Hire');
                    }
                }
            });
        }
    </script>
@endsection

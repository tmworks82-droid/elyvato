@php
    $title = 'Dashboard - Elyvato';
    $robotsMeta = 'noindex, nofollow';
@endphp


 @extends('layouts.front.user-app')


@section('pageContent')

<style>
    th{
            font-weight: 600;
    }
</style>
{{-- header --}}
<div class="mb-3 mb-lg-4">
    <div class="d-flex gap-3 flex-wrap">
        <button class="btn d-inline d-lg-none p-0 fs-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <i class="ri-menu-2-line"></i>
        </button>
        <h1 class="fw-bold mb-0">Dashboard</h1>
    </div>
</div>
<div class="alert alert-success" role="alert">
  Welcome {{Auth::user()->username ?? strstr(Auth::user()->email, '@', true)}}
</div>


{{-- dashboard cards --}}
<div class="overflow-x-hidden mb-3 mb-lg-4">
    <div class="row">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="border rounded-2 p-3 h-100">
                <p class="mb-2">Total Bookings</p>
                <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-0">
                    <h2 class="mb-0 fs-1">{{count($bookings)}}</h2>
                    <div class="dashboard-card-icon-box d-flex align-items-center justify-content-center rounded-circle">
                        <i class="ri-calendar-2-line text-main fs-2"></i>
                    </div>
                </div>
                <p class="mb-0"><span class="text-main">{{$recentBookingCount}}</span> Recently Booked</p>
            </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="border rounded-2 p-3 h-100">
                <p class="mb-2">Completed Bookings</p>
                <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-0">
                    <h2 class="mb-0 fs-1">{{$complete_booking}}</h2>
                    <div class="dashboard-card-icon-box d-flex align-items-center justify-content-center rounded-circle">
                        <i class="ri-calendar-check-line text-main fs-2"></i>
                    </div>
                </div>
                <p class="mb-0"><span class="text-main">{{ $recentcomplete_BookingCount }}</span> Recently Completed</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="border rounded-2 p-3 h-100">
                <p class="mb-2">In Queue Bookings</p>
                <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-0">
                    <h2 class="mb-0 fs-1">{{ $pending_booking }}</h2>
                    <div class="dashboard-card-icon-box d-flex align-items-center justify-content-center rounded-circle">
                        
                        <i class="ri-calendar-schedule-line text-main fs-2"></i>
                    </div>
                </div>
                <p class="mb-0"><span class="text-main">{{ $newlyAddedCount }}</span> Newly Added</p>
            </div>
        </div>
    </div>
</div>

{{-- recent bookings --}}
<div class="overflow-x-hidden">
    <div class="border rounded-2 p-3">
        <div class="w-100 d-flex align-items-center justify-content-between gap-2 flex-wrap mb-3">
            <h2 class="fs-5 fw-bold mb-0">Recent Bookings</h2>
            <a href="{{url('booking-list')}}" class="btn btn-sm btn-outline-main">View All</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-sm mb-0">
                <thead>
                    <tr>
                    <th scope="col" class="bg-light">#</th>
                    <th scope="col" class="bg-light">Service Name</th>
                    <th scope="col" class="bg-light">Initial Payment %</th>
                    <th scope="col" class="bg-light">Initial Paid Amount</th>
                    <th scope="col" class="bg-light">Total Amount</th>
                    <th scope="col" class="bg-light">Booking Status</th>
                    <th scope="col" class="bg-light">Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($bookings as $index => $booking)
                   
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $booking->statementOfWork->service->name ?? 'no service'}}</td>
                        <td>{{ $booking->initial_payment_percentage }} %</td>
                        <td>{{ $booking->initial_paid_amount}}</td>
                        <td>{{ $booking->total_price }}</td>
                        <td>
                            @if($booking->status=='pending')
                            <span class="badge text-bg-warning">{{ $booking->status }}</span>
                            @else
                            <span class="badge text-bg-success">{{ $booking->status }}</span>
                            @endif
                           
                        </td>
                        <td>
                           @if($booking->payment_status=='pending')
                            <span class="badge text-bg-warning">{{ $booking->payment_status }}</span>
                            @else
                            <span class="badge text-bg-success">{{ $booking->payment_status }}</span>
                           @endif
                        </td>
                    </tr>                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@php
    $title = 'Bookings - Elyvato';
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
        <h1 class="fw-bold mb-0">My Bookings</h1>
    </div>
</div>

{{-- bookings list --}}
<div class="overflow-x-hidden">
    <div class="row gap-3 align-items-center justify-content-between mb-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('user.booking.list') }}" class="rounded position-relative mb-3">
                <input 
                    class="form-control pe-5 bg-transparent focus-shadow-none" 
                    type="search" 
                    name="search" 
                    placeholder="Search by booking or SOW" 
                    value="{{ request('search') }}">
                <button class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset" type="submit">
                    <i class="ri-search-2-line"></i>
                </button>
            </form>

        </div>
        <div class="col-md-3">
            <form method="GET" action="{{ url('/booking-list') }}">
                <select name="sort_by" class="form-select focus-shadow-none bg-transparent" onchange="this.form.submit()">
                    <option value="">Sort by</option>
                    <option value="new">New (Last 1 Week)</option>
                    <option value="old">Old (Before 1 Week)</option>
                </select>
            </form>

        </div>

        <div class="col-md-2">
            <a href="{{url('booking-list')}}" class="btn btn-main float-right">Reset Filter </a>
        </div>
    </div>
    <div class="border rounded-2 p-3">
        <div class="table-responsive">
            <table class="table table-bordered text-sm mb-0">
                <thead>
                    <tr>
                    <th scope="col" class="bg-light">#</th>
                    <th scope="col" class="bg-light">Gig Name</th>
                    <!--<th scope="col" class="bg-light">Initial Payment %</th>-->
                    <th scope="col" class="bg-light">Initial Paid Amount</th>
                    <th scope="col" class="bg-light">Total Amount</th>
                    <th scope="col" class="bg-light">Booking Status</th>
                    <th scope="col" class="bg-light">Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                 
                    @if (!empty($booking) && count($booking) > 0)
                        @php $i = 1; @endphp
                        @foreach ($booking as $val)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>
                            <a href="{{route('user.booking.details',['id' => encrypt($val->id)])}}">
                                {{ $val->statementOfWork->title ?? $val->booking_id }}
                            </a>
                           
                            <p class="mb-0 text-sm text-secondary">
                                {{formatDateReadable($val->created_on)}}
                            </p>
                        </td>
                        {{--<td>{{ $val->statementOfWork->initial_payment_percentage ?? 'N/A' }}%</td>--}}
                        <td>{{ $val->initial_paid_amount ?? 'N/A' }} </td>
                        <td>{{ $val->total_amount ?? 'N/A' }}</td>
                        <td>
                            @if($val->status=='pending')
                                <span class="badge text-bg-warning">Pending</span>
                            @else
                                <span class="badge text-bg-success">Success</span>
                            @endif
                        </td>
                        <td>
                           @if($val->payment_status=='pending')
                                <span class="badge text-bg-warning">Pending</span>
                            @else
                                <span class="badge text-bg-success">Success</span>
                            @endif
                        </td>
                    </tr>                    
                     @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center text-muted">No bookings found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- Pagination Section -->
    <div class="mt-3 d-flex gap-3 flex-wrap justify-content-between align-items-center">
        @if($booking->hasMorePages())
        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                <li class="page-item {{ $booking->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link text-sm focus-shadow-none" href="{{ $booking->previousPageUrl() ?? '#' }}">Previous</a>
                </li>

                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $booking->lastPage(); $i++)
                    <li class="page-item {{ $booking->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link text-sm focus-shadow-none" href="{{ $booking->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Next Page Link --}}
                <li class="page-item {{ !$booking->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link text-sm focus-shadow-none" href="{{ $booking->nextPageUrl() ?? '#' }}">Next</a>
                </li>
            </ul>
        </nav>
        @endif

        <p class="mb-0 text-sm">
            Showing 
            <span class="text-muted">{{ $booking->firstItem() }} - {{ $booking->lastItem() }}</span> 
            of 
            <span class="text-muted">{{ $booking->total() }}</span>.
        </p>
    </div>
</div>

@endsection

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
        <h1 class="fw-bold mb-0">Ticket List</h1>
    </div>
</div>




<div class="overflow-x-hidden">
    <div class="border rounded-2 p-3">
        <div class="w-100 d-flex align-items-center justify-content-between gap-2 flex-wrap mb-3">
            
            <a href="{{url('user/raise-ticket')}}" class="btn btn-sm btn-outline-main">Raise Ticket</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-sm mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="bg-light">#</th>
                        <th scope="col" class="bg-light"> TicketID</th>
                        <th scope="col" class="bg-light">Status</th>
                        <th scope="col" class="bg-light">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $index => $ticket)
                   
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td> <a href="{{url('user/ticket/details/'.encrypt($ticket->id))}}">{{$ticket->ticket_id}}</a> </td>
                        <td>
                            @if($ticket->ticket_close=='close')
                             <span class="badge bg-danger">Closed</span>
                             @else
                             <span class="badge bg-success">Open</span>
                            @endif
                        </td>
                        <td>{{formatDateReadable($ticket->created_at)}}</td>
                    </tr>                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


 

@endsection

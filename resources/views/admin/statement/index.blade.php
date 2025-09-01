@php
    $page_name = 'Statement';
    $routeUrl = 'statement';
    $permission = 'service';
@endphp

@extends('layouts.main')
@section('title', 'ElyvatoContent| '.$page_name.' list')
<style>

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #d12323;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: #fff;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #4CAF50; /* Green for "live" */
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #4CAF50;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .media-wrapper {
    position: relative;
    display: inline-block;
    margin: 5px;
}

.remove-btn {
    position: absolute;
    top: -5px;
    right: -5px;
    background: red;
    color: white;
    border-radius: 50%;
    font-size: 14px;
    width: 18px;
    height: 18px;
    line-height: 17px;
    text-align: center;
    cursor: pointer;
}
</style>
@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $page_name }} page</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">{{ $page_name }}</li>
              </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif
          @if(session('error'))
              <div class="alert alert-danger">
                  {{ session('error') }}
              </div>
          @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $page_name }} data</h3>
                    @if(auth()->user()->hasPermission('create_'.$permission))
                      <a class="float-right" href="{{url('create-statement')}}" >
                          <button type="button" class="btn btn-block btn-primary btn-sm ml-2">Add New</button>
                      </a>
                    @endif
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Service</th>
                      <th>Sub Service</th>
                      <th>Price</th>
                      <th>Estimate Time</th>
                      <th>Image</th>
                      <th>Active</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($statements as $statement)

                      <tr>
                        <td>{{ $statement->title }}</td>
                        <td>{{ $statement->service->name ?? '-' }}</td>
                        <td>{{ $statement->subservice->name ?? '-' }}</td>
                        <td>${{ number_format($statement->price, 2) }}</td>
                        <td>{{ $statement->estimated_time }}</td>
                        {{--<td>
                            @if(!empty($statement->allFiles))
                                @foreach ($statement->allFiles as $files)

                                  @if($files->file_type=='image')
                                  <a href="{{url($files->image_path)}}" target="_blank">
                                    <img src="{{asset($files->image_path)}}" style="width: 50px;" alt="img">
                                  </a>
                                  @elseif($files->file_type === 'pdf')
                                      <a href="{{ asset($files->image_path) }}" target="_blank">View PDF</a>
                                    @elseif($files->file_type=='video')
                                    <a href="{{$files->video}}">Video</a>
                                  @elseif($files->file_type=='audio')
                                    <audio controls>
                                        <source src="{{ asset($files->audio_path) }}" type="audio/mpeg">
                                    </audio>
                                  @else
                                  Not uploaded
                                  @endif
                                @endforeach
                            @endif
                        </td>--}}
                        <td>
                          @if(!empty($statement->allFiles) && $statement->allFiles->count())
                              @foreach ($statement->allFiles as $files)
                                  @if($files->file_type == 'image')
                                      <div class="media-wrapper" data-id="{{ $files->id }}">
                                          <a href="{{ url($files->image_path) }}" target="_blank">
                                              <img src="{{ asset($files->image_path) }}" style="width: 50px;" alt="Image">
                                          </a>
                                          <span class="remove-btn" data-id="{{ $files->id }}" data-type="image">&times;</span>
                                      </div>
                                  @elseif($files->file_type == 'video')

                                      {{--<div class="media-wrapper" data-id="{{ $files->id }}">
                                          <a href="{{ $files->video }}" target="_blank"> Video</a>
                                          <span class="remove-btn" data-id="{{ $files->id }}" data-type="video">&times;</span>
                                      </div>--}}

                                      @php
                                        preg_match('/embed\/([a-zA-Z0-9_-]+)/', $files->video, $matches);
                                        $videoId = $matches[1] ?? null;
                                      @endphp

                                    @if($videoId)
                                        <div class="media-wrapper" data-id="{{ $files->id }}">
                                            <a href="https://www.youtube.com/watch?v={{ $videoId }}" target="_blank">🎥 Video</a>
                                            <span class="remove-btn" data-id="{{ $files->id }}" data-type="video">&times;</span>
                                        </div>
                                    @else
                                        
                                      <div class="media-wrapper" data-id="{{ $files->id }}">
                                            <span>Invalid video link </span>
                                            <span class="remove-btn" data-id="{{ $files->id }}" data-type="video">&times;</span>
                                      </div>

                                    @endif
                                  @endif
                              @endforeach
                          @else
                              <span>No files uploaded</span>
                          @endif
                      </td>

                        <td>
                          @if($statement->is_active == '1')
                            <span class="badge bg-success">Active</span>
                          @else
                            <span class="badge bg-secondary">Inactive</span>
                          @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($statement->created_on)->format('d M Y') }}</td>
                        <td>
                          <!-- Example Edit Button -->
                          <a href="{{ route('statements.edit', $statement->id) }}" class="btn btn-sm btn-primary">Edit</a>
                          <!-- Example Delete Form -->
                          <form action="{{ route('statements.destroy', $statement->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="button" value="Delete Statement" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="8" class="text-center">No statements found.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                </ul>
              </div>
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->

        </div>





      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@push('scripts')
<script>
  $(document).ready(function(){
    $('.remove-btn').click(function() {
     
        let fileId = $(this).data('id');
        let fileType = $(this).data('type');
        let wrapper = $(this).closest('.media-wrapper');

        if(confirm('Are you sure you want to delete this ' + fileType + '?')) {
            $.ajax({
                url: '{{ route("delete.file") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: fileId
                },
                success: function(response) {
                    if(response.success){
                        wrapper.remove();
                        alert(fileType + ' removed successfully!');
                    } else {
                        alert('Error: Could not delete file.');
                    }
                }
            });
        }
    });
});
</script>
@endpush
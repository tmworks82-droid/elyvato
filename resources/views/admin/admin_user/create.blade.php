@php
    $page_name = 'Admin User';
    $routeUrl = 'admin_user';
    $permission = 'users';
@endphp

@extends('layouts.main')
@section('title', 'User Elyvato Dashboard | '.$page_name.' list')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Admin User</li>
              <li class="breadcrumb-item active">Create New</li>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Admin User</h3>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin_user.store') }}" method="POST"  enctype="multipart/form-data">
                 @csrf
                 
                <!-- /.card-header -->
                <div class="row card-body">
                    <div class="col-sm-4 form-group">
                      <label>Select Role</label>
                      <select class="form-control select2 select2-danger" name="role_id" id="role_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                          <option value="" >Select Role</option>
                          @foreach($roles as $item)
                                <option value="{{ $item->id }}" {{ old('role_id') == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                          @endforeach
                      </select>  
                    </div>
                    
                    
                    @if(getRoleNamebyId(Auth::user()->role_id)->name_slug=='super-admin' || getRoleNamebyId(Auth::user()->role_id)->name_slug=='admin')
                    <div class="col-sm-4 form-group">
                      <label for="priority" class="form-label">
                            Priority <span class="text-danger">(Required for Account Manager)</span>
                        </label>
                      <select class="form-control select2 select2-danger" name="priority" id="priority" data-dropdown-css-class="select2-danger" style="width: 100%;">
                         <option value="">-- Select Priority --</option>
                        <option value="High"   {{ old('priority', $item->priority ?? '') == 'High' ? 'selected' : '' }}>High</option>
                        <option value="Medium" {{ old('priority', $item->priority ?? '') == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="Low"    {{ old('priority', $item->priority ?? '') == 'Low' ? 'selected' : '' }}>Low</option>
                      </select>  
                    </div>
                    @endif
                    

                    <div class="col-sm-4 form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter name" required>
                    </div>

                    <div class="col-sm-4 form-group">
                      <label>username:</label>
                      <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Enter username" required>
                    </div>
                    
                    <div class="col-sm-4 form-group">
                        <label>Email:</label>
                      <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email">
                    </div>  

                    <div class="col-sm-4 form-group">
                        <label>Mobile:</label>
                      <input type="number" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Enter mobile">
                    </div>  

                    <div class="col-sm-4 form-group">
                                <label>Profile Picture:</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @if(!empty($profiles->image))
                                <img src="{{$profiles->image}}" alt="profile" style="width:100px;">
                                @endif
                      </div>

                    <div class="mb-3 col-md-4">
                      <label for="company_name" class="form-label">Bio</label>
                      <textarea name="bio" class="form-control" rows="4" id="bio" maxlength="500">{{ old('bio', $profiles->profile->bio ?? '') }}</textarea>
                      <small class="text-muted">Max 30 words allowed.</small>

                    </div>

                    <div class="mb-3 col-md-4">
                      <label for="company_name" class="form-label">Company Name</label>
                      <input type="text" class="form-control" id="company_name" name="company_name" required value="{{ $profiles->company_name ?? '' }}">
                  </div>
          
                  <!-- GST Number -->
                  <div class="mb-3 col-md-4">
                      <label for="gst_number" class="form-label">GST Number</label>
                      <input type="text" class="form-control" id="gst_number" name="gst_number" value="{{ $profiles->gst_number ?? '' }}">
                  </div>
          
                  <!-- Address Line 1 -->
                  <div class="mb-3 col-md-4">
                      <label for="address_line1" class="form-label">Address Line 1</label>
                      <input type="text" class="form-control" id="address_line1" name="address_line1" value="{{ $profiles->address_line1 ?? '' }}">
                  </div>
          
                  <!-- Address Line 2 -->
                  <div class="mb-3 col-md-4">
                      <label for="address_line2" class="form-label">Address Line 2</label>
                      <input type="text" class="form-control" id="address_line2" name="address_line2" value="{{ $profiles->address_line2 ?? '' }}">
                  </div>

                   <!-- Pincode -->
                  <div class="mb-3 col-md-4">
                      <label for="pincode" class="form-label">Pincode</label>
                      <input type="text" class="form-control" id="pincode" name="pincode" value="{{ $profiles->pincode ?? '' }}">
                  </div>

                  <!-- Country -->
                  <div class="mb-3 col-md-4">
                      <label for="country" class="form-label">Country</label>
                      <input type="text" class="form-control" id="country" name="country" value="{{ $profiles->country ?? 'India' }}">
                  </div>
          
                  <!-- State -->
                  <div class="mb-3 col-md-4">
                      <label for="state" class="form-label">State</label>
                      <input type="text" class="form-control" id="state" name="state" value="{{ $profiles->state ?? '' }}">
                  </div>

                  <!-- City -->
                  <div class="mb-3 col-md-4">
                      <label for="city" class="form-label">City</label>
                      <input type="text" class="form-control" id="city" name="city" value="{{ $profiles->city ?? '' }}">
                  </div>
        
          
                  
        
          
                  <!-- Industry Type -->
                  <div class="mb-3 col-md-4">
                      <label for="industry_type" class="form-label">Industry Type</label>
                      <input type="text" class="form-control" id="industry_type" name="industry_type" value="{{ $profiles->industry_type ?? '' }}">
                  </div>
                  
                
                    <div class="col-sm-4 form-group">
                        <label>Password:</label>
                      <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Enter password">
                    </div>
                
              </div>
                <!-- /.card-body -->              
                <div class="card-footer">
                    <button type="submit" name="button" value="create new user" class="btn btn-primary">Submit</button>
                </div>

              </form>
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
   document.getElementById('pincode').addEventListener('blur', function () {
            let pin = this.value;
            if (pin.length === 6) {
                fetch(`https://api.postalpincode.in/pincode/${pin}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data[0].Status === "Success") {
                            const postOffice = data[0].PostOffice[0];
                            document.getElementById('city').value = postOffice.District;
                            document.getElementById('state').value = postOffice.State;
                        } else {
                            alert("Invalid PIN code");
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert("Error fetching location");
                    });
            }
        });

        document.getElementById('bio').addEventListener('input', function () {
            const words = this.value.trim().split(/\s+/).filter(Boolean);
            const wordCount = words.length;
            document.getElementById('bio').textContent = `${wordCount} / 30 words`;
            if (wordCount > 30) {
                alert('Bio cannot exceed 30 words!');
                this.value = words.slice(0, 30).join(' ');
            }
        });
</script>
@endpush
{{-- charset and viewport --}}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- title, description, robots, and canonical --}}
<title>{{ $title }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="{{ $metaDescription }}" />
<meta name='robots' content='{{ $robotsMeta }}' />
<link rel="canonical" href="{{ rtrim($canonical, '/') }}" />
{{-- og grpahic meta --}}
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ $title }}" />
<meta property="og:description" content="{{ $metaDescription }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:image" content="{{ url('/') . $featuredImage }}" />
{{-- twitter card meta --}}
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@elyvato" />
<meta name="twitter:creator" content="@elyvato" />


    <!-- <script 
      type="text/javascript"
      src="https://d3mkw6s8thqya7.cloudfront.net/integration-plugin.js"
      id="aisensy-wa-widget"
      widget-id="aaa3rn"
    >
    </script> -->
	
{{-- Styles bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

{{-- styles remixicon --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css">

{{-- google fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">-->
<link rel="stylesheet" href="{{ asset('front/assets/css/sweetalert2.min.css') }}">
{{-- styles custom --}}
<link rel="stylesheet" href="{{ asset('front/assets/css/main.css') }}">
<style>
    .searchdiv {
  /*width: 91%;*/
  border: 1px solid transparent;
  border-radius: 4px;
  transition: border 0.3s;
}

.searchdiv:has(input:focus) {
  border: 1px solid coral;
}
</style>
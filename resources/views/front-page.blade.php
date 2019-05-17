@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
  {{the_post_thumbnail('full', ['class' => 'absolute inset-0 w-full object-cover h-full'])}}
  <div class="w-full relative z-20" >
        <div class="xl:flex items-center" style="min-height: 33.625rem">
          <div class="px-6 text-left md:w-1/2 ">
            
            @include('partials.content-page')
            <div class="flex mt-6 justify-start md:justify-center xl:justify-start">
              <a href="/about" class="rounded-lg px-4 md:px-5 xl:px-4 py-3 md:py-4 xl:py-3 bg-blue-700 hover:bg-blue-600 md:text-lg xl:text-base text-white font-semibold leading-tight shadow-md">Find out more</a>
              @if (!is_user_logged_in())
              <a href="/login" class="ml-4 rounded-lg px-4 md:px-5 xl:px-4 py-3 md:py-4 xl:py-3 bg-white hover:bg-gray-200 md:text-lg xl:text-base text-gray-800 font-semibold leading-tight shadow-md">Login</a>
              @endif
            </div>
          </div>
          
        </div>
      </div>
  @endwhile
@endsection


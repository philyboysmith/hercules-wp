@extends('layouts.app')

@section('content')



<div class="max-w-5xl mx-auto">
  @while(have_posts()) @php the_post() @endphp
  @include('partials.content-single-'.get_post_type())
  @endwhile
</div>
@endsection

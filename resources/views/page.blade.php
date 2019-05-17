@extends('layouts.app')

@section('content')



<div class="max-w-5xl mx-auto">
  @while(have_posts()) @php the_post() @endphp
  <div class="breadcrumbs text-gray-600 text-sm mb-8" typeof="BreadcrumbList" vocab="https://schema.org/">
  <?php if (function_exists('bcn_display')) {
    bcn_display();
}?>
  @include('partials.page-header')
</div>
    @include('partials.content-page')
  @endwhile
  </div>
@endsection

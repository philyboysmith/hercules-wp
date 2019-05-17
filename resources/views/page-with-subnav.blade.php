<?php /* Template Name: Page with Subnavigation */

function getTopLevelId()
{
    $ancestors = get_ancestors(get_the_ID(), 'page');

    $topLevelId = end($ancestors);
    if (!$topLevelId):
      $topLevelId = get_the_ID();
    endif;

    return $topLevelId;
}

function getSideNav($topLevelId, $currentPageId)
{
    $args = array(
      'post_type' => 'page',
      'posts_per_page' => -1,
      'post_parent' => $topLevelId,
      'order' => 'ASC',
      'orderby' => 'menu_order',
  );

    $parent = new WP_Query($args);

    $html = '<h5><a class="sidebar-link mb-3 lg:mb-2 text-gray-500 uppercase tracking-wide font-bold text-sm lg:text-xs">'.get_post($topLevelId)->post_title.'</a></h5>';

    if ($parent->have_posts()) {
        $html .= '<ul style="list-style:none;">';

        while ($parent->have_posts()) {
            $parent->the_post();
            $html .= get_the_ID() == $currentPageId ? '<li class="current-menu-item ">' : '<li>';
            $html .= '<a class="sidebar-link px-2 -mx-2 py-1 transition-fast relative block hover:translate-r-2px hover:text-gray-900 text-gray-600 font-medium" href="'.get_permalink().'" title="'.get_the_title().'">';
            if (get_the_ID() == $currentPageId) {
                $html .= '<span class="text-blue-600">'.get_the_title().'</span>';
            } else {
                $html .= get_the_title();
            }
            $html .= '</a></li>';
        }

        $html .= '</ul>';
    }
    wp_reset_query();

    return $html;
}
?>

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
    <div class="flex flex-col-reverse md:flex-row">
      <div class="w-64 pr-6">
        <?php

$topLevelId = getTopLevelId();
$sideBarNav = getSideNav($topLevelId, get_the_ID());

echo $sideBarNav;

?>
      </div>

      <div class="flex-1">
        @include('partials.content-page')
      </div>
    </div>
  @endwhile
  </div>
@endsection

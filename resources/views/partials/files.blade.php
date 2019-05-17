<?php

function fa($mime_type)
{
    // List of official MIME Types: http://www.iana.org/assignments/media-types/media-types.xhtml
    $icon_classes = array(
      // Media
      'image' => 'fa-file-image',
      'audio' => 'fa-file-audio',
      'video' => 'fa-file-video',
      // Documents
      'application/pdf' => 'fa-file-pdf',
      'application/msword' => 'fa-file-word',
      'application/vnd.ms-word' => 'fa-file-word',
      'application/vnd.oasis.opendocument.text' => 'fa-file-word',
      'application/vnd.openxmlformatsfficedocument.wordprocessingml' => 'fa-file-word',
      'application/vnd.ms-excel' => 'fa-file-excel',
      'application/vnd.openxmlformatsfficedocument.spreadsheetml' => 'fa-file-excel',
      'application/vnd.oasis.opendocument.spreadsheet' => 'fa-file-excel',
      'application/vnd.ms-powerpoint' => 'fa-file-powerpoint',
      'application/vnd.openxmlformatsfficedocument.presentationml' => 'fa-file-powerpoint',
      'application/vnd.oasis.opendocument.presentation' => 'fa-file-powerpoint',
      'text/plain' => 'fa-file-text',
      'text/html' => 'fa-file-code',
      'application/json' => 'fa-file-code',
      // Archives
      'application/gzip' => 'fa-file-archive',
      'application/zip' => 'fa-file-archive',
    );
    foreach ($icon_classes as $text => $icon) {
        if (strpos($mime_type, $text) === 0) {
            return $icon;
        }
    }

    return 'fa-file';
}

?>

@if (have_rows('files'))

<table class="w-full text-left table-collapse">
    <thead>
        <tr>
            <th></th>
            <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Title</th>
            <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Category</th>
            <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100 w-48 "></th>
        </tr>
    </thead>
    <tbody class="align-baseline">

  @while(have_rows('files')) @php the_row() @endphp


  @php $file = get_sub_field('file') @endphp


  <tr>
      <td class="p-2 border-t border-gray-300 text-xs text-blue-600 whitespace-no-wrap text-lg"><i class="fas {{fa($file['mime_type'])}}"></i></td>
      <td class="p-2 border-t border-gray-300 text-xs text-blue-600 whitespace-no-wrap">{{$file['title']}}</td>
      <td class="p-2 border-t border-gray-300 text-xs text-blue-600 whitespace-no-wrap">{{the_sub_field('category')}}</td>
      
      <td class="p-2 border-t border-gray-300 text-xs text-blue-600 whitespace-no-wrap w-48 ">
          <a class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded text-xs w-48 text-center block" href="?attachment={{$file['id']}}&download_file=1">
              <i class="fas fa-download"></i>
              Download ({{number_format( $file['filesize']) / 1000}}MB)
          </a>
      </td>
  </tr>


  @endwhile
</tbody>
</table>

@else


<p>No files yet.</p>

@endif


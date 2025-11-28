@if ($paginator->hasPages())
<ul class="pagination">

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="paginate_button page-item previous disabled">
            <a class="page-link">Previous</a>
        </li>
    @else
        <li class="paginate_button page-item previous">
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link">Previous</a>
        </li>
    @endif

    {{-- Page Number Links --}}
    @foreach ($elements as $element)
        {{-- "..." separator --}}
        @if (is_string($element))
            <li class="paginate_button page-item disabled">
                <a class="page-link">{{ $element }}</a>
            </li>
        @endif

        {{-- Array of page links --}}
        @if (is_array($element))

            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();

                // Tentukan range yang ingin ditampilkan (maksimal 6 tombol)
                $start = max(1, $current - 2);
                $end = min($last, $current + 2);

                // Pastikan selalu 6 tombol jika memungkinkan
                if (($end - $start) < 5) {
                    $extra = 5 - ($end - $start);
                    $start = max(1, $start - $extra);
                    $end = min($last, $end + $extra);
                }
            @endphp

            {{-- Render tombol halaman --}}
            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $current)
                    <li class="paginate_button page-item active">
                        <a class="page-link">{{ $page }}</a>
                    </li>
                @else
                    <li class="paginate_button page-item">
                        <a href="{{ $paginator->url($page) }}" class="page-link">{{ $page }}</a>
                    </li>
                @endif
            @endfor
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li class="paginate_button page-item next">
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link">Next</a>
        </li>
    @else
        <li class="paginate_button page-item next disabled">
            <a class="page-link">Next</a>
        </li>
    @endif

</ul>
@endif

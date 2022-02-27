
@if ($paginator->hasPages())
    <div class="pager d-flex justify-content-start align-items-center m-2">

        @if ($paginator->onFirstPage())
            <div class="btn btn-disabled p-2 border rounded border-success m-2"><span>← Previous</span></div>
        @else
            <div class="border rounded border-success m-2 p-2"><a class="text-decoration-none" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></div>
        @endif



        @foreach ($elements as $element)

            @if (is_string($element))
                <div class="btn btn-disabled p-2 border rounded border-success m-2"><span>{{ $element }}</span></div>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <div class="active my-active border rounded border-success m-2 bg-success btn btn-outline-success"><span>{{ $page }}</span></div>
                    @else
                        <div class="border rounded border-success m-2 btn btn-outline-success text-success"><a class="text-decoration-none" href="{{ $url }}">{{ $page }}</a></div>
                    @endif
                @endforeach
            @endif
        @endforeach



        @if ($paginator->hasMorePages())
            <div class="p-2 border rounded border-success m-2"><a class="text-decoration-none" href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></div>
        @else
            <div class="btn btn-disabled p-2 border rounded border-success m-2"><span>Next →</span></div>
        @endif
    </div>
@endif

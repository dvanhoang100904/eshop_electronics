@if ($pagination->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            Hiển thị từ <strong>{{ $pagination->firstItem() }}</strong> đến
            <strong>{{ $pagination->lastItem() }}</strong>
            trong tổng số <strong>{{ $pagination->total() }}</strong> người dùng
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item {{ $pagination->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $pagination->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @foreach ($pagination->getUrlRange(1, $pagination->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $pagination->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li class="page-item {{ $pagination->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $pagination->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endif

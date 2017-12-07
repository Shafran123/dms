<ul class="pagination justify-content-center mb-4">
    <li class="page-item {{ isset($previousPageUrl) ? '' : 'disabled' }}">
        <a class="page-link" href="{{ isset($previousPageUrl) ? $previousPageUrl : '#' }}">&larr; Newer</a>
    </li>
    <li class="page-item {{ isset($nextPageUrl) ? '' : 'disabled' }}">
        <a class="page-link" href="{{ isset($nextPageUrl) ? $nextPageUrl : '#' }}">Older &rarr;</a>
    </li>
</ul>
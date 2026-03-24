<div>
    <h3 class="text-secondary uk-text-uppercase fw-600">
        related blogs & articles
    </h3>
    <ul class="uk-related-ul">
        @foreach ($related as $value)
            <li>
                <a href="{{ route('page.pagedetail', $value->uri) }}" class="two-line">
                    {{$value->post_title}}
                </a>
            </li>
        @endforeach
    </ul>
</div>

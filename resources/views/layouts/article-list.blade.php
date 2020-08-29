@foreach($article_data as $data)
    <div class="article-list material">
        <a href="/mypage/{{ $data -> user -> id }}">
            <img src="/storage/user-icons/{{ $data -> user -> icon }}" alt="icon">
        </a>
        <div class="article-supplement">
            <a href="/article/{{ $data['id'] }}">
                <h2>{{ $data['title'] }}</h2>
            </a>
            <div class="favorite-count">
                <p>{{ date('Y/n/j G:i',strtotime($data['updated_at'])) }}</p>
                <i class="material-icons heart">favorite</i>
                <p>{{ count($data -> favoriteArticle) }}</p>
            </div>
        </div>
    </div>
@endforeach
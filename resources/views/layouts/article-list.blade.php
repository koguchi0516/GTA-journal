@foreach($article_data as $data)
    <div class="article-list">
        <a href="/mypage/{{ $data -> user -> id }}">
            <img src="/user-icons/{{ $data -> user -> icon }}" alt="icon">
        </a>
        <div class="article-supplement">
            <a href="/article/{{ $data['id'] }}" class="link-btn">
                <h3>{{ $data['title'] }}</h3>
            </a>
            <div class="favorite-count">
                <p>{{ date('Y/n/j G:i',strtotime($data['updated_at'])) }}</p>
                <i class="material-icons">favorite</i>
                <p>{{ count($data -> favoriteArticle) }}</p>
            </div>
        </div>
    </div>
@endforeach
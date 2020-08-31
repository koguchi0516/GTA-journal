@foreach($article_data as $data)
    <div class="article-list material">
        <a href="/mypage/{{ $data -> user -> id }}">
            <img src="/storage/user-icons/{{ $data -> user -> icon }}" alt="icon">
        </a>
        <div class="article-supplement">
            <h2>
                <a href="/article/{{ $data['id'] }}">{{ $data['title'] }}</a>
            </h2>
            <div class="favorite-count">
                <p>{{ date('Y/n/j G:i',strtotime($data['updated_at'])) }}</p>
                <i class="material-icons heart">favorite</i>
                <p>{{ count($data -> favoriteArticle) }}</p>
            </div>
        </div>
    </div>
@endforeach
@foreach($article_data as $data)
    <div class="article-list material">
        <a href="{{ route('mypage.',['user_id' => $data -> user -> id]) }}">
            <img src="{{ Storage::url($data -> user -> icon) }}" alt="icon">
        </a>
        <div class="article-supplement">
            <h2>
                <a href="{{ route('show_article.',['article_title_id' => $data['id']]) }}">{{ $data['title'] }}</a>
            </h2>
            <div class="favorite-count">
                <p>{{ date('m月d日 G時i分',strtotime($data['updated_at'])) }}</p>
                <i class="material-icons heart">favorite</i>
                <p>{{ count($data -> favoriteArticle) }}</p>
            </div>
        </div>
    </div>
@endforeach
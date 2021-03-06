<div class="add-container material">
    <div class="add-article-parts">
        <div class="add-btn-container btn-flat-logo" id="addH3" onclick="addText(this)">
            <p>見出し</p>
            <i class="material-icons">add</i>
        </div>
        <div class="add-btn-container btn-flat-logo" id="addP" onclick="addText(this)">
            <p>本文</p>
            <i class="material-icons">add</i>
        </div>
        <div class="add-btn-container btn-flat-logo" id="addImg" onclick="addText(this)">
            <p>画像</p>
            <i class="material-icons">add</i>
        </div>
    </div>
    <div class="add-category">
        <p class="pc">カテゴリ</p>
        @include('layouts.select-category')
    </div>
    <div class="article-button-container">
        <input class="btn-flat-logo" type="submit" value="{{ $display }}">
        <input class="btn-flat-logo" type="submit" name='{{ $aim }}' value="{{ $message }}">
    </div>
</div>
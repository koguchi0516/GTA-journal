<div id="check-modal" class="modal">
    <div class="modal-content material">
        <div class="modal-content-header">
            <h3>このアカウントを削除しますか</h3>
            <i class="material-icons" id="CheckCloseBtn">clear</i>
        </div>
        <p>アカウントに登録された情報と、投稿が全て削除されます</p>
        
        <div class="check-contain">
            <a id="delete-url" href="/deleteAccount/{{ $user_id }}">
                <p class="report-button check">はい</p>
            </a>
            <p id="check-no" class="report-button check">いいえ</p>
        </div>
    </div>
</div>
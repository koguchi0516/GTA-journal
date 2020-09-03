<p class="admin-title">報告者</p>

<div class="report-container material">
    <a href="/mypage/{{ $data['report']['user_id'] }}" class="report-user-data">
        <img src="/storage/user-icons/{{ $data['report'] -> user -> icon }}"></img>
        <p>{{ $data['report'] -> user -> name }}</p>
    </a>
    <div class="report-list-data">
        <p>このユーザーからの報告数 : {{ $data['report_count'] }}件</p>
    </div>
</div>
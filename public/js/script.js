window.onload = function (){
    var closeBtn = document.getElementById('closeBtn');
    var reportIcon = document.getElementById('report-icon');
    var modal = document.getElementById('modal');
    
    closeBtn.addEventListener('click', function () {
    modal.style.display = 'none';
    })

    window.addEventListener('click', function (e) {
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    })
}

function openBtn(ele){
    var keyId = ele.id;
    var targetContentId = document.getElementById('target-content-' + keyId).textContent;
    var postTargetContentId = document.getElementById('target_content_id');
    postTargetContentId.value = targetContentId;
    
    var modal = document.getElementById('modal');
    modal.style.display = 'block';
}
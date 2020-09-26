// モーダル削除
window.onload = function (){
    var closeBtn = document.getElementById('closeBtn'),
        modal = document.getElementById('modal'),
        checkNo = document.getElementById('check-no'),
        checkCloseBtn = document.getElementById('CheckCloseBtn'),
        checkModal = document.getElementById('check-modal');
        
    window.addEventListener('click', function (e) {
        if (e.target == checkModal) {
            checkModal.style.display = 'none';
        }
    })
    
    checkCloseBtn.addEventListener('click', function () {
    checkModal.style.display = 'none';
    })
        
    checkNo.addEventListener('click', function () {
    checkModal.style.display = 'none';
    })

    closeBtn.addEventListener('click', function () {
    modal.style.display = 'none';
    })
    
    window.addEventListener('click', function (e) {
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    })
}

// 報告モーダル表示
function openBtn(ele){
    var reportId = ele.id,
        postTargetContentId = document.getElementById('target_content_id'),
        modal = document.getElementById('modal');

    if(reportId !== '') postTargetContentId.value = reportId;
    modal.style.display = 'block';
}

// 削除確認モーダル表示
function checkOpenBtn(ele){
    var checkId = ele.id.split('-'),
        modal = document.getElementById('check-modal'),
        checkContentId = document.getElementById('check_content_id'),
        deleteUrl = document.getElementById('delete-url');
        
    deleteUrl.href = deleteUrl.href + checkId[0] + '/' +checkId[1];
    modal.style.display = 'block';
}

function userDelete(){
    var modal = document.getElementById('check-modal');
    modal.style.display = 'block';
}

//自動ログイン
function autoFill(){
    document.getElementById('user_code').value = 'shohei-0516';
    document.getElementById('password').value = 'koguchi0516';
}

//管理者自動ログイン
function autoFillAdmin(){
    document.getElementById('name').value = 'koguchi-0516';
    document.getElementById('password').value = 'k.61507991';
}

// 投稿内容のメニュー（報告、削除、編集）
function reportIcon(ele){
    var flag = ele.children[1].innerText,
        brother = ele.parentNode,
        parent = brother.parentNode,
        target = parent.children[1];
        
        if(flag == 0){
            ele.children[1].innerText = 1;
            target.style.display = 'block';
        }else{
            ele.children[1].innerText = 0;
            target.style.display = 'none';
        }
}

// pcメニュー
function menuOpen(){
    var icon = document.getElementById('open-menu'),
        menuAccordion = document.getElementById('menu-accordion'),
        menuClick = document.getElementById('menu_click');
        
    if (document.getElementById('menu_click').value == 'Close') {
        icon.textContent = 'arrow_drop_down';
        menuAccordion.style.display = 'none';
        menuClick.value = 'Open'
    } else {
        icon.textContent = 'arrow_drop_up';
        menuAccordion.style.display = 'block';
        menuClick.value = 'Close';
    }
}

// mobileメニュー
function mobileMenu(){
    var flag = document.getElementById('mobile-menu-flag'),
        mobileMenu = document.getElementById('mobile-menu');
    
    if (flag.value == 'Close') {
        mobileMenu.style.display = 'none';
        flag.value = 'Open'
    } else {
        mobileMenu.style.display = 'block';
        flag.value = 'Close'
    }
}

// 記事投稿パーツ削除
function postDelete(ele) {
    var deleteNum = ele.id.substr(12),
        textContents = document.getElementById('text-contents'),
        deleteItem = document.getElementById(`post-item-${deleteNum}`);
    textContents.removeChild(deleteItem);
}

// 記事投稿パーツ追加
function addText(ele) {
    var lastPostNum = document.getElementById('last-post-num').value,
        idCounter;
        
    if(lastPostNum == ''){
        idCounter = 0;
    }else{
        idCounter = parseInt(lastPostNum) + 1;
    }
        
    var textContents = document.getElementById('text-contents'),
        parentDiv = document.createElement('div'),
        inputText = document.createElement('input'),
        inputHidden = document.createElement('input'),
        postNum = document.createElement('input'),
        childDiv = document.createElement('div'),
        iconP = document.createElement('p'),
        iconI = document.createElement('i'),
        textArea = document.createElement('textarea'),
        inputImg = document.createElement('input');

    parentDiv.setAttribute('class', 'h3-tag-container');
    parentDiv.id = `post-item-${idCounter}`;
    iconI.setAttribute('class', 'material-icons');
    iconI.innerHTML = 'close';
    inputHidden.setAttribute('type', 'hidden');
    childDiv.setAttribute('class', 'delete-icon delete-img-tag');
    childDiv.id = `delete-item-${idCounter}`;
    childDiv.setAttribute('onclick', 'postDelete(this)');
    inputHidden.setAttribute('name', 'type[]');
    inputImg.setAttribute('type', 'file');
    inputImg.setAttribute('class', 'post-img')
    inputImg.setAttribute('name', `post-${idCounter}`);
    postNum.setAttribute('type', 'hidden');
    postNum.setAttribute('name', 'post-num[]');
    postNum.setAttribute('value', `${idCounter}`);

    switch (ele.id) {
        case 'addH3':
            inputText.setAttribute('class', 'h3-tag text');
            inputText.setAttribute('type', 'text');
            inputText.setAttribute('placeholder', '見出し');
            inputText.setAttribute('name', `post-${idCounter}`);
            inputHidden.setAttribute('value', 'h3');
            parentDiv.appendChild(inputText);
            break;
        case 'addP':
            textArea.setAttribute('class', 'p-tag');
            textArea.setAttribute('name', `post-${idCounter}`);
            textArea.setAttribute('placeholder', '本文');
            inputHidden.setAttribute('value', 'p');
            parentDiv.appendChild(textArea);
            break;
        case 'addImg':
            inputHidden.setAttribute('value', 'img');
            parentDiv.appendChild(inputImg);
            break;
    }
    
    parentDiv.appendChild(inputHidden);
    parentDiv.appendChild(postNum);
    iconP.appendChild(iconI);
    childDiv.appendChild(iconP);
    parentDiv.appendChild(childDiv);
    textContents.appendChild(parentDiv);
    document.getElementById('last-post-num').value = idCounter;
}
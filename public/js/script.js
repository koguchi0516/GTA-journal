var idCounter = 0,
    lastPostNum;
    
window.onload = function (){
    var closeBtn = document.getElementById('closeBtn'),
        reportIcon = document.getElementById('report-icon'),
        modal = document.getElementById('modal'),
        menu = document.getElementById('menu-accordion');

    closeBtn.addEventListener('click', function () {
    modal.style.display = 'none';
    })
    
    window.addEventListener('click', function (e) {
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    })
    
    lastPostNum = document.getElementById('last-post-num').value;
    if(!lastPostNum == '') idCounter = lastPostNum++;
    // 一番下に記載、フレンド申請の報告のモーダルが閉じなくなる
}

function addText(ele) {
    if (idCounter > 99) exit;
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
    iconI.innerHTML = 'remove_circle_outline';
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
    console.log(idCounter);
    idCounter++;
    document.getElementById('last-post-num').value = idCounter;
}

function postDelete(ele) {
    var deleteNum = ele.id.substr(12),
        textContents = document.getElementById('text-contents'),
        deleteItem = document.getElementById(`post-item-${deleteNum}`);
    textContents.removeChild(deleteItem);
}

function openBtn(ele){
    var keyId = ele.id,
        targetContentId = document.getElementById('target-content-' + keyId).textContent,
        postTargetContentId = document.getElementById('target_content_id');
    postTargetContentId.value = targetContentId;
    
    var modal = document.getElementById('modal');
    modal.style.display = 'block';
}

function menuOpen() {
    if (document.getElementById('menu_click').value == 'Close') {
        document.getElementById('menu-accordion').style.display = 'none';
        document.getElementById('menu_click').value = 'Open'
        document.getElementById('open-menu').textContent = 'arrow_drop_down';
    } else {
        document.getElementById('menu-accordion').style.display = 'block';
        document.getElementById('menu_click').value = 'Close'
        document.getElementById('open-menu').textContent = 'arrow_drop_up';
    }
}
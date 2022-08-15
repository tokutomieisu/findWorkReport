//ラジオボタンの切り替え
function formSwitch4() {
    hoge = document.getElementsByName('classification4')
    if (hoge[0].checked) {
        // 好きな食べ物が選択されたら下記を実行します
        document.getElementById('groupWorklList').style.display = "";
        document.getElementById('groupDiscussionList').style.display = "none";
        document.getElementById('ohtersList').style.display = "none";
    } else if (hoge[1].checked) {
        // 好きな場所が選択されたら下記を実行します
        document.getElementById('groupWorklList').style.display = "none";
        document.getElementById('groupDiscussionList').style.display = "";
        document.getElementById('ohtersList').style.display = "none";
    } else if (hoge[2].checked) {
        document.getElementById('groupWorklList').style.display = "none";
        document.getElementById('groupDiscussionList').style.display = "none";
        document.getElementById('ohtersList').style.display = "";
    } else {
        document.getElementById('groupWorklList').style.display = "none";
        document.getElementById('groupDiscussionList').style.display = "none";
        document.getElementById('ohtersList').style.display = "none";
    }
}


window.addEventListener('load', formSwitch4());
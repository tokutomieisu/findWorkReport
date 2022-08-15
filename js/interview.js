//ラジオボタンの切り替え
function formSwitch3() {
    hoge = document.getElementsByName('classification3')
    if (hoge[0].checked) {
        // 好きな食べ物が選択されたら下記を実行します
        document.getElementById('individualList').style.display = "";
        document.getElementById('groupList').style.display = "none";
        document.getElementById('boardMemberList').style.display = "none";
    } else if (hoge[1].checked) {
        // 好きな場所が選択されたら下記を実行します
        document.getElementById('individualList').style.display = "none";
        document.getElementById('groupList').style.display = "";
        document.getElementById('boardMemberList').style.display = "none";
    } else if (hoge[2].checked) {
        document.getElementById('individualList').style.display = "none";
        document.getElementById('groupList').style.display = "none";
        document.getElementById('boardMemberList').style.display = "";
    } else {
        document.getElementById('individualList').style.display = "none";
        document.getElementById('groupList').style.display = "none";
        document.getElementById('boardMemberList').style.display = "none";
    }
}


window.addEventListener('load', formSwitch3());
//ラジオボタンの切り替え
function formSwitch() {
    hoge = document.getElementsByName('classification')
    if (hoge[0].checked) {
        // 好きな食べ物が選択されたら下記を実行します
        document.getElementById('esList').style.display = "";
        document.getElementById('compositionList').style.display = "none";
        document.getElementById('writeList').style.display = "none";
        document.getElementById('skillList').style.display = "none";
    } else if (hoge[1].checked) {
        // 好きな場所が選択されたら下記を実行します
        document.getElementById('esList').style.display = "none";
        document.getElementById('compositionList').style.display = "";
        document.getElementById('writeList').style.display = "none";
        document.getElementById('skillList').style.display = "none";
    } else if (hoge[2].checked) {
        // 好きな場所が選択されたら下記を実行します
        document.getElementById('esList').style.display = "none";
        document.getElementById('compositionList').style.display = "none";
        document.getElementById('writeList').style.display = "";
        document.getElementById('skillList').style.display = "none";
    } else if (hoge[3].checked) {
        // 好きな場所が選択されたら下記を実行します
        document.getElementById('esList').style.display = "none";
        document.getElementById('compositionList').style.display = "none";
        document.getElementById('writeList').style.display = "none";
        document.getElementById('skillList').style.display = "";
    } else {
        document.getElementById('esList').style.display = "none";
        document.getElementById('compositionList').style.display = "none";
        document.getElementById('writeList').style.display = "none";
        document.getElementById('skillList').style.display = "none";
    }
}
window.addEventListener('load', formSwitch());
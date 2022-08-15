//ラジオボタンの切り替え
function formSwitch2() {
    hoge = document.getElementsByName('classification2')
    if (hoge[0].checked) {
        // 好きな食べ物が選択されたら下記を実行します
        document.getElementById('jointList').style.display = "";
        document.getElementById('onCampusList').style.display = "none";
        document.getElementById('offCampusList').style.display = "none";
    } else if (hoge[1].checked) {
        // 好きな場所が選択されたら下記を実行します
        document.getElementById('jointList').style.display = "none";
        document.getElementById('onCampusList').style.display = "";
        document.getElementById('offCampusList').style.display = "none";
    } else if (hoge[2].checked) {
        document.getElementById('jointList').style.display = "none";
        document.getElementById('onCampusList').style.display = "none";
        document.getElementById('offCampusList').style.display = "";
    } else {
        document.getElementById('jointList').style.display = "none";
        document.getElementById('onCampusList').style.display = "none";
        document.getElementById('offCampusList').style.display = "none";
    }
}


window.addEventListener('load', formSwitch2());
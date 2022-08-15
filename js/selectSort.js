document.getElementById('industry').onchange = function() {
    //業種を取得
    let valIndustry = document.getElementById('industry').value;

    //職種を取得
    let valOccupation = document.getElementById('occupation');

    //当てはまる職種のみ表示(残りを非表示)
    if (valIndustry == 'in001') {
        valOccupation.options[0].style.display = "";
        valOccupation.options[1].style.display = "";
        valOccupation.options[2].style.display = "";
        valOccupation.options[3].style.display = "";
        valOccupation.options[4].style.display = "none";
        valOccupation.options[5].style.display = "none";
        valOccupation.options[6].style.display = "none";
        valOccupation.options[7].style.display = "none";
        valOccupation.options[8].style.display = "none";
        valOccupation.options[9].style.display = "none";
        valOccupation.options[0].selected = true; //選択状態にする(前回の選択分が残らないようにするため)
    }
    if (valIndustry == 'in002') {
        valOccupation.options[0].style.display = "";
        valOccupation.options[1].style.display = "none";
        valOccupation.options[2].style.display = "none";
        valOccupation.options[3].style.display = "none";
        valOccupation.options[4].style.display = "";
        valOccupation.options[5].style.display = "";
        valOccupation.options[6].style.display = "";
        valOccupation.options[7].style.display = "none";
        valOccupation.options[8].style.display = "none";
        valOccupation.options[9].style.display = "none";
        valOccupation.options[0].selected = true; //選択状態にする(前回の選択分が残らないようにするため)
    }
    if (valIndustry == 'in003') {
        valOccupation.options[0].style.display = "";
        valOccupation.options[1].style.display = "none";
        valOccupation.options[2].style.display = "none";
        valOccupation.options[3].style.display = "none";
        valOccupation.options[4].style.display = "none";
        valOccupation.options[5].style.display = "none";
        valOccupation.options[6].style.display = "none";
        valOccupation.options[7].style.display = "";
        valOccupation.options[8].style.display = "";
        valOccupation.options[9].style.display = "";
        valOccupation.options[0].selected = true; //選択状態にする(前回の選択分が残らないようにするため)
    }

    //業種が選択されていないとき(初期状態)
    if (valIndustry == 'in000') {
        valOccupation.options[0].style.display = "";
        valOccupation.options[1].style.display = "";
        valOccupation.options[2].style.display = "";
        valOccupation.options[3].style.display = "";
        valOccupation.options[4].style.display = "";
        valOccupation.options[5].style.display = "";
        valOccupation.options[6].style.display = "";
        valOccupation.options[7].style.display = "";
        valOccupation.options[8].style.display = "";
        valOccupation.options[9].style.display = "";
        valOccupation.options[0].selected = true; //選択状態にする(前回の選択分が残らないようにするため)
    }
};

window.onload = function() {
    document.getElementsByName('industry')[0].onchange();
};
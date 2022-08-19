var str1 = "";
var str2 = "";

function isRegNum1(obj) {
    str1 = obj.value; /* 入力値 */
    if (str1 != "" && str2 != "") {
        document.getElementById("btn").disabled = false;
    } else {
        document.getElementById("btn").disabled = true;
    }
}

function isRegNum2(obj) {
    str2 = obj.value; /* 入力値 */
    if (str1 != "" && str2 != "") {
        document.getElementById("btn").disabled = false;
    } else {
        document.getElementById("btn").disabled = true;
    }
}

function cartAdd(obj) {
    var btn = document.getElementById("btn");
    if (btn.disabled == true) {
        obj.value = "カート追加済";
    }
}

$("document").ready(function() {});

function getCheckedLabelText() {
    var inputCount = elementCount();

    for (var i = 0; i < inputCount; i++) {
        if ($("#" + i).prop('checked') == true) {
            $("#lbl_" + i).text() = "カート追加済";
        }
    }
}

function elementCount() {
    var cnt = 0;
    $("input").each(function() {
        ++cnt;
    });
    return cnt;
}
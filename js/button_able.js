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
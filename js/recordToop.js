var str1 = "";

function isRegNum1(obj) {
    str1 = obj.value; /* 入力値 */
    if (str1 != "") {
        document.getElementById("btnjs").disabled = false;
    } else {
        document.getElementById("btnjs").disabled = true;
    }
}

window.addEventListener("load", function() {
    isRegNum1(document.getElementById("day"));
});


// window.addEventListener('load', isRegNum1("date"));
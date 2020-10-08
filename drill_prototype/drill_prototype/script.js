let answerValue;
let numAsked = 0;
let numCorrect = 0;
let percent = 0;

function ask() {
    var a = Math.floor(Math.random() * 10) + 1;
    var b = Math.floor(Math.random() * 10) + 1;
    var op = ["*", "+", "/", "-"][Math.floor(Math.random() * 4)];
    var prompt = "How much is " + a + " " + op + " " + b + "?";
    document.getElementById("questionText").innerHTML = prompt;
    answerValue = eval(a + op + b);
    console.log(answerValue);
    return answerValue;
}

function answer() {
    var c = document.getElementById("answerBox").value;
    c = parseFloat(c);
    console.log(c);
    numAsked++;
    if (c === answerValue) {
        numCorrect++;
        document.getElementById("feedbackText").innerHTML = "Correct!".fontcolor("green");
        document.getElementById("feedbackValue").innerHTML = answerValue;
    } else {
        document.getElementById("feedbackText").innerHTML = "Wrong!".fontcolor("red");
        document.getElementById("feedbackValue").innerHTML = answerValue;
    }
    percent = (numCorrect / numAsked) * 100;
    document.getElementById("numA").innerHTML = numAsked;
    document.getElementById("numC").innerHTML = numCorrect;
    document.getElementById("Per").innerHTML = percent + "%";
}

document.getElementById("submit").addEventListener("click", function (event) {
    event.preventDefault();
    answer();
});

document.getElementById("ask").addEventListener("click", function (event) {
    event.preventDefault();
    ask();
});
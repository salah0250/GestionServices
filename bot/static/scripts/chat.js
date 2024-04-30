//Content
var coll = document.getElementsByClassName("collapsible");

for (let i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");

        var content = this.nextElementSibling;

        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}
//Heure
function getTime() {
    let today = new Date();
    hours = today.getHours();
    minutes = today.getMinutes();
	if(minutes<10){
		minutes="0"+minutes;
	}
	let time = hours + ":" + minutes;
    return time;
}

// 1er message
function firstBotMessage() {
    let firstMessage = "Bonjour, <br> ici vous avez le reponse au <br>questions fréquemment posées";
	document.getElementById("botStarterMessage").innerHTML = '<p class="botText"><span>' + firstMessage + '<button onclick="myFunction(\'trouver\')">\
    Comment trouver des services?</button> <br> <button onclick="myFunction(\'proposer\')">Comment proposer mes services?</button><br>\
    <button onclick="myFunction(\'contacter\')">Comment contacter un autre utilisateur pour un service?</button> <br> \
    <button onclick="myFunction(\'evaluer\')">Comment puis-je évaluer la qualité des services offerts par un fournisseur ?</button><br>\
     <button onclick="myFunction(\'supprimer\')">Comment puis-je modifier ou supprimer une annonce pour mes services?</button></span> </p>' ;
	let time = getTime();
    $("#chat-timestamp").append(time); 
}

firstBotMessage();
//parametre est la question
function myFunction(input) {
    let userText = input;
	getHardResponse(userText);
}

function getHardResponse(userText) {
    let botResponse = getBotResponse(userText);
    let botHtml = '<p class="botText"><span> '+ botResponse + '</span></p>';
    $("#chatbox").append(botHtml);
    
    //document.getElementById("chat-bar-bottom").scrollIntoView(false);

    document.getElementById("chat-bar-bottom").scrollIntoView(true);
}

//Gets the text text from the input box and processes it
function getResponse() {
    let userText = $("#textInput").val();

    if (userText == "") {
		/*let botHtml = '<p class="botText"><span> inserer quelque chose </span></p>';
		$("#chatbox").append(botHtml);*/
		document.getElementById("chat-bar-bottom").scrollIntoView(true);
		return ;
    }

    let userHtml = '<p class="userText"><span>' + userText + '</span></p>';

    $("#textInput").val(""); //vider la case
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);
    setTimeout(() => {
        getHardResponse(userText);
    }, 1000)
}

function buttonSendText(sampleText) {
    let userHtml = '<p class="userText"><span>' + sampleText + '</span></p>';

    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);
}

function sendButton() {
    getResponse();
}
// Function enter
$("#textInput").keypress(function (e) {
    if (e.which == 13) {
        getResponse();
    }
});
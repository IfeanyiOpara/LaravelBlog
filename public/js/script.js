var tabButton = document.querySelectorAll(".tabContainer .buttonContainer button");
var tabPanel = document.querySelectorAll(".tabContainer .tabPanel");

function showPanel(panelIndex, colorCode){
    tabButton.forEach(function(node){
        node.style.backgroundColor="#6181F4";
        node.style.color = "";
    });

    tabButton[panelIndex].style.backgroundColor = colorCode;
    tabButton[panelIndex].style.color = "white";

    tabPanel.forEach(function(node){
        node.style.display="none";
    });

    tabPanel[panelIndex].style.display="block";
    tabPanel[panelIndex].style.backgroundColor=colorCode;
}

showPanel(0, '#CED0D8' );   
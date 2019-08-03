let navAccount = document.getElementById("navAccounts");
let navAction = document.getElementById("navActions");
let navRobot = document.getElementById("navRobot");

$(document).ready(function(){
  
  $('#optionView').load('view/account.html',function(responseTxt, statusTxt, xhr){
    if(statusTxt == "success")
      initAccounts();
    if(statusTxt == "error")
      alert("Error: " + xhr.status + ": " + xhr.statusText);
  });

 
  
  navAccount.onclick = function() {
    $('#optionView').load('view/account.html',function(responseTxt, statusTxt, xhr){
      if(statusTxt == "success")
        initAccounts();
        activateItem(navAccount);
      if(statusTxt == "error")
        alert("Error: " + xhr.status + ": " + xhr.statusText);
    });

  }
 
  navAction.onclick = function() {
    $('#optionView').load('view/actions.html',function(responseTxt, statusTxt, xhr){
      if(statusTxt == "success")
        initActions();
        activateItem(navAction);
      if(statusTxt == "error")
        alert("Error: " + xhr.status + ": " + xhr.statusText);
    });
   

  }
 
  navRobot.onclick = function() {
    $('#optionView').load('view/robots.html',function(responseTxt, statusTxt, xhr){
      if(statusTxt == "success")
        initRobot();
        activateItem(navRobot);
      if(statusTxt == "error")
        alert("Error: " + xhr.status + ": " + xhr.statusText);
    });
  

  }

});

function activateItem(navActive){
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  navActive.className += " active";
}

let modalAccount;

let btnAddAccount;

let spanAccount; 

var listAccounts; 


function initAccounts(){

  modalAccount   = document.getElementById("mAccount");
  btnAddAccount  = document.getElementById("btnAddAccount");
  spanAccount    = document.getElementsByClassName("close")[0];

  loadAccountList();

  btnAddAccount.onclick = function() {
    document.getElementById("formAccount").reset();

    modalAccount.style.display = "block";
 }
  
 spanAccount.onclick = function() {
  modalAccount.style.display = "none";
  }
  
  $('#formAccount').submit(function (e) {

    e.preventDefault();
    validateAndSubmit();
  });

 
}

function getAccountList(callback) {   
    $.post("api/account.php",
    {
      id: "1",
      req: "list"
    },
    function(data, status){
      
      console.log("Data: " + data + "\nStatus: " + status);
      if (status == "success") {
        callback(data);
      }else{
        var res = JSON.parse(data);
        alert(res.message);
      }

    });
}

function loadAccountList() {
    getAccountList(function(response) {
      var res = JSON.parse(response);
      console.log(res);
      listAccounts = res.data;
    showAccountList(listAccounts);
  });
}

function showAccountList(listAccounts){
  let x = "";

  console.log("count > "+listAccounts.length);
  for(i in listAccounts){
    let account = listAccounts[i];
    var acId = "ac_tr_"+i;

    
    console.log("account > "+acId+"");
    
    x+="<tr id= "+acId+" >"+
          "<td>"+account.username+"</td>"+
          "<td>"+account.name+"</td>"+
          "<td>"+account.email+"</td>"+
          "<td>"+account.phone+"</td>"+ 
          "<td>"+account.password+"</td>"+
       "</tr>";


   }
   document.getElementById("accountList").innerHTML = x;
}
 
function validateAndSubmit() {



   let inPswd     = document.getElementById("fPswd");
   let inConfPaswd = document.getElementById("fConformPswd");

   if(inPswd.value != inConfPaswd.value ){
      alert("Password is not matching!");
      return false;
   }

   registerAccount();

  
   
 }
 




function registerAccount() {

 
  let inName     = document.getElementById("fName");
  let inUsername = document.getElementById("fUsername");
  let inPswd     = document.getElementById("fPswd");
  let inPhone    = document.getElementById("fPhone");
  let inEmail    = document.getElementById("fEmail");
       
        var account = {
          "name":inName.value,
          "username":inUsername.value,
          "password":inPswd.value,
          "email":inEmail.value,
          "phone":inPhone.value,
        }
      


  $.post("api/account.php",
  {
    id: "1",
    req: "add",
    data: JSON.stringify(account)
  },
  function(data, status){
    
    console.log("Data: " + data + "\nStatus: " + status);
    if (status == "success") {
      var res = JSON.parse(data);
      if(res.success=="1"){
        loadAccountList();
        modalAccount.style.display = "none";
      }else{
        alert(res.message);
      }
    }else{
      var res = JSON.parse(data);
      alert(res.message);
    }

  });


}
 





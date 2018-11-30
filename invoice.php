<?php  
include('server.php');

if (!isset($_SESSION['id'])) {  $_SESSION['msg'] = "You must log in first";  header('location: test.php');  }  ?>
<html> 
<title>INVOICE</title> 
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<meta http-equiv="X-UA-Compatible" content="ie=edge"> 
<link rel="stylesheet" href="new.css"> 
<link rel="stylesheet" href="style.css"> 
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata"> 
<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> 
<style> 
body, html 
{ height: 100%; font-family:"Inconsolata", sans-serif; } 
.cust{ margin-top: 300px; } 
button{ margin: 0px 10px; } 
.delBtn{ background-color: red; color: white; } 
.crtBtn{ text-align: center; } input{ border-radius: 5px; outline: none; } 
input:focus{ border-color: green; }
 </style> <body> 
 <header>  <div class = "wrapper">
            <div class = "nav">
                  <uk>
                  <button onclick="location.href='HomePage.php'" type="button">
                  HOME</button>
                  </uk>
                  <ul>
                  <button onclick="location.href='user.php'" type="button">
                  USERS</button>
                  <button onclick="location.href='salesperson.php'" type="button">
                  SALESPERSON</button>
                  <button onclick="location.href='products.php'" type="button">
                  PRODUCTS</button>
                  <button onclick="location.href='index.php'" type="button">
                  CUSTOMERS</button>
                  <button onclick="location.href='invoice.php'" type="button">
                  INVOICE</button>
                  <button onclick="location.href='survey.php'" type="button">
                  SURVEY</button>
                  <button onclick="location.href='HomePage.php?logout'" type="del" class="
                  del_btn">LOGOUT</button>
                  </ul>
            </div>
      </div>   </header> 
 <div> <div class="drop"> <h3>SELECT A CUSTOMER</h3> <?php  $sql ="SELECT id FROM CUSTOMERS"; $record = mysqli_query($db,"SELECT id FROM CUSTOMERS"); echo '<select id ="sid" name="sid" onChange ="selectChange(this)">'; while ($row = mysqli_fetch_array($record)) { echo"<option value='".$row['id']."'>".$row['id']."</option>"; } echo"</select>"; ?> </div> 
 <script type="text/javascript"> function selectChange(selected){ //Change Customer when selection changes 

var opt = selected.options[selected.selectedIndex].value; var attr = document.createAttribute("selected"); //remove selected from all options 
for(var i=0; i<selected.options.length; i++) selected.options[i].removeAttribute("selected"); //add selected to the selected option 
selected.options[selected.selectedIndex].setAttributeNode(attr); //Get Products, Selected Customer and invoices related to the customer drom DB //AJAX 
var request = new XMLHttpRequest; request.onreadystatechange = function() { if (request.readyState == 4 && request.status == 200) { var json = JSON.parse(this.responseText); //make Customer Table 
makeCustomerTable(JSON.parse(json[0])); //Make Invoice Table 
makeInvoice(JSON.parse(json[1]),JSON.parse(json[0]),JSON.parse(json[2])); 
//Assign response arrays to global variables to be used later 
window.globalProds = JSON.parse(json[2]); 
window.globalInvoices = JSON.parse(json[1]); 
window.globalCustomer = JSON.parse(json[0]); 
} 
} 
request.open('GET', 'server.php?customID=' + opt, true); 
request.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8'); 
request.send(); 
} //Called the first time to get the data of first selected customer 
selectChange(document.getElementById("sid")); 
function makeCustomerTable(customer){ 
    //Remove customer table if it already exists, so that new customer table can be made 
var min = document.getElementsByClassName("cust")[0];
 if(min){ 
     min.parentElement.removeChild(min); 
     } //Create Customer table 
document.getElementsByTagName("body")[0].innerHTML += '<table class="cust"><thead><tr><th>SHOPID</th><th>SHOPNAME</th><th>ADDRESS</th><th>CONTACT</th><th>CONTACTNUM</th><th>AREA</th><th>COORDINATES</th><th>CREATED</th></tr><tr><td>'+customer.id+'</td><td>'+customer.SHOPNAME+'</td><td>'+customer.ADDRESS+'</td><td>'+customer.CONTACT+'</td><td>'+customer.CONTACTNUM+'</td><td>'+customer.AREA+'</td><td>'+customer.COORDINATES+'</td><td>'+customer.CREATED_BY+'</td></tr></thead></table>'; }
 function makeInvoice(invoice,customer,products){ 
     //Remove invoice table if already exists, so that invoices of new customer can be made 
 var min = document.getElementsByClassName("invoice")[0];
  if(min){
       min.parentElement.removeChild(min); 
       } //Create headings of Invoice Table 


 document.getElementsByTagName("body")[0].innerHTML += '<table class="invoice"><thead><tr><th>ORDER#</th><th>CUSTOMER ID</th><th>DATE</th><th>PRODUCT CODE</th><th>QUANTITY</th><th>RATE</th><th>AMOUNT</th><th>ACTIONS</th></tr>'; //If Customer already has any invoice add them to table 
 
     for(var i=0; i<invoice.length; i++){
          document.getElementsByClassName("invoice")[0].innerHTML += '<tr><td class="order">'+invoice[i].OrderNum+'</td><td class="customID">'+customer.id+'</td><td><input class="date" value='+invoice[i].Date+' type="date"></input></td><td><select class="pclass" onChange="changeRate(this)"></select></td><td><input type="number" min="0" value='+invoice[i].Quantity+' class="quant" onInput="changeAmount(this)"></td><td class="rate">'+products[0].Salesprice+'</td><td class="amount">'+invoice[i].Amount+'</td><td><button onclick="createInvoice(this)">EDIT</button><button class="delBtn" onclick="deleteInvoice(this)">DELETE</button></td></tr>'; 
          } 
           //Add the last create invoice row 
          console.log(products);
 document.getElementsByClassName("invoice")[0].innerHTML += '<tr><td class="order"></td><td class="customID">'+customer.id+'</td><td><input class="date" type="date"></input></td><td><select class="pclass" onChange="changeRate(this)"></select></td><td><input type="number" min="0" class="quant" onInput="changeAmount(this)"></td><td class="rate">'+products[0].Salesprice+'</td><td class="amount"></td><td class="crtBtn"><button onclick="createInvoice(this)">CREATE</button></td></tr>'; //Add options to product selection of each invoice 
 var prods = document.getElementsByClassName("pclass");
  for(var i=0; i<prods.length; i++)
  { for(var j=0; j<products.length; j++) 
  document.getElementsByClassName("pclass")[i].innerHTML +="<option value="+products[j].id+">"+products[j].id+"</option>";
   } //If an invoice exists set the selected value of product to that of DB //Set the rate according to the selected product 
 for(var i=0; i<invoice.length; i++){
      var attr = document.createAttribute("selected"); 
      var pclassSelect = document.getElementsByClassName("pclass")[i]; 
      pclassSelect.value = invoice[i].PCode;
       pclassSelect.options[pclassSelect.selectedIndex].setAttributeNode(attr); 
       var rate = document.getElementsByClassName("rate")[i]; 
       for(var j=0; j<products.length; j++) 
       if(products[j].id == pclassSelect.value){ 
           rate.innerText = products[j].Salesprice; 
           } 
           } 
           } //On Product option change, change rate 
    function changeRate(e){ 
     var opt = e.options[e.selectedIndex].value;
      for(var i=0 ;i<window.globalProds.length; i++){
           if(window.globalProds[i].id == opt)
            e.parentNode.parentNode.getElementsByClassName("rate")[0].innerText = window.globalProds[i].Salesprice;
            } //Set amount to zero 
 e.parentNode.parentNode.getElementsByClassName("amount")[0].innerText = 0; } //On Quantity change change amount 
 function changeAmount(e){ var prodRate = e.parentNode.parentNode.getElementsByClassName("rate")[0].innerText; e.parentNode.parentNode.getElementsByClassName("amount")[0].innerText = prodRate * e.value; } //This function is used for sending AJAX for creating or updating invoices from DB //And for live updation of frontend 
 function createInvoice(e){ var row = e.parentNode.parentNode; var request = new XMLHttpRequest; request.onreadystatechange = function() { if (request.readyState == 4 && request.status == 200) { if(e.innerText !="EDIT"){ var lastOrder = this.responseText; //Add order to frontend global variable for Invoices 
 window.globalInvoices.push({ OrderNum: lastOrder, Date: row.getElementsByClassName("date")[0].value, PCode: row.getElementsByClassName("pclass")[0].value, Quantity: row.getElementsByClassName("quant")[0].value, Rate: row.getElementsByClassName("rate")[0].innerText, Amount: row.getElementsByClassName("amount")[0].innerText, CustID: row.getElementsByClassName("customID")[0].innerText }); //Re-render the frontend invoice table with globally stored data 
 makeInvoice(window.globalInvoices,window.globalCustomer,window.globalProds); } 
 else 
 alert(this.responseText); } } 
 if(e.innerText =="EDIT") 
 request.open('POST', 'server.php?do=update', true); 
 else 
 request.open('POST', 'server.php?do=create', true); 
 request.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8'); request.send("orderNum=" + row.getElementsByClassName("order")[0].innerText +"&date=" + row.getElementsByClassName("date")[0].value +"&pcode=" + row.getElementsByClassName("pclass")[0].value +"&quant=" + row.getElementsByClassName("quant")[0].value +"&rate=" + row.getElementsByClassName("rate")[0].innerText +"&amount=" + row.getElementsByClassName("amount")[0].innerText +"&customID=" + row.getElementsByClassName("customID")[0].innerText); } //Called when delete button is pressed 
 function deleteInvoice(e){ var row = e.parentNode.parentNode; orderID = row.getElementsByClassName("order")[0].innerText; 
 orderID = orderID.substring(0,orderID.length-1); var request = new XMLHttpRequest; request.onreadystatechange = function() { if (request.readyState == 4 && request.status == 200) { //Remove the deleted order from frontend 
 for(var i=0; i<window.globalInvoices.length; i++){ if(window.globalInvoices[i].OrderNum == orderID){ window.globalInvoices.splice(i,1); break; } } //Re-render the frontend invoice table with globally stored data 
 makeInvoice(window.globalInvoices,window.globalCustomer,window.globalProds); 
 alert("Order Num " + orderID + ' deleted'); } } 
 request.open('GET', 'server.php?do=delete&delID=' + orderID, true); 
 request.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8'); 
 request.send(); } 
 </script> 
 <?php if (isset($_POST['sid'])) { $sid = $_POST['sid']; header('location: HomePage.php'); } ?> </body> </html>
let jsons = document.getElementsByClassName("shortDescription");
console.log(typeof(jsons));
console.log(JSON.parse(jsons[0].innerHTML));


console.log(jsons.length);

for (var i = 0; i < jsons.length; i++) {
    disciplinesPerCurriculumTable(JSON.parse(jsons[i].innerHTML), i);
}


function disciplinesPerCurriculumTable(json, num) {
    // EXTRACT VALUE FOR HTML HEADER. 
   // ('Book ID', 'Book Name', 'Category' and 'Price')
   var col = [];
   for (var i = 0; i < json.length; i++) {
       for (var key in json[i]) {
           if (col.indexOf(key) === -1) {
               col.push(key);
           }
       }
   }

   // CREATE DYNAMIC TABLE.
   var table = document.createElement("table");

   // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

   var tr = table.insertRow(-1);                   // TABLE ROW.

   for (var i = 0; i < 5; i++) {
       var th = document.createElement("th");      // TABLE HEADER.
       th.innerHTML = col[i];
       tr.appendChild(th);
   }

   var th = document.createElement("th");      // TABLE HEADER.
       th.innerHTML = "Преглед";
       tr.appendChild(th);

   // ADD JSON DATA TO THE TABLE AS ROWS.
   for (var i = 0; i < json.length; i++) {
       
       tr = table.insertRow(-1);
       
       let id = json[i]['id'];
     
       
       for (var j = 0; j < 5; j++) {

               var tabCell = tr.insertCell(-1);
   
               if (json[i][col[j]] === 'object') {
               
                   for (let [key, value] of Object.entries(json[i][col[j]])) {
                     tabCell.innerHTML = `${key}: ${value}`;
                   }
               } else {
                   tabCell.innerHTML = json[i][col[j]];
               }
       }
  
       var tabCellLink = tr.insertCell(-1);
       tabCellLink.innerHTML = "<a onclick=loadDiscipline(" + id + ") href=\"#\">View discipline details </a>";
       
   }

   // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
   var divContainer = document.createElement("div");
   divContainer.setAttribute("id", num);
   divContainer.setAttribute("class", "displayDisciplineInfo");
   divContainer.innerHTML = "";
   divContainer.appendChild(table);
   document.getElementById("showData").appendChild(divContainer);
}
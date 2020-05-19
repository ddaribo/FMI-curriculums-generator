//function showAdmin2() {
    /*var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","disciplines/test",true);
    xmlhttp.send();*/

    /*fetch('../test/4')
    .then(response => response)
    .then(response => {
        alert("here!")
        document.getElementById("content").innerHTML = response;
        console.log(response); 
    });*/
 //}

 let disciplineId = document.getElementById("disciplineId").innerHTML;

 let shortLink = document.getElementById("short");
 let detailedLink = document.getElementById("detailed");
 let adminLink = document.getElementById("admin");

 shortLink.addEventListener("click", function(){
     event.preventDefault();
     this.classList.add("activeNavLink");
     detailedLink.classList.remove("activeNavLink");
     adminLink.classList.remove("activeNavLink");

     var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("disciplineCV").innerHTML = this.responseText;
        console.log(this.responseText);
      }
    };
    xmlhttp.open("GET","../short/" + disciplineId,true);
    xmlhttp.send();
    });

    detailedLink.addEventListener("click", function(){
        event.preventDefault();
        this.classList.add("activeNavLink");
        shortLink.classList.remove("activeNavLink");
        adminLink.classList.remove("activeNavLink");
   
        var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
           document.getElementById("disciplineCV").innerHTML = this.responseText;
           console.log(this.responseText);
         }
       };
       xmlhttp.open("GET","../detailed/" + disciplineId ,true);
       xmlhttp.send();
       });

       adminLink.addEventListener("click", function(){
        event.preventDefault();
        this.classList.add("activeNavLink");
        detailedLink.classList.remove("activeNavLink");
        shortLink.classList.remove("activeNavLink");
   
        var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
           document.getElementById("disciplineCV").innerHTML = this.responseText;
           console.log(this.responseText);
         }
       };
       xmlhttp.open("GET","../admin/" + disciplineId,true);
       xmlhttp.send();
       });





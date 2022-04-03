$(document).ready(function () {

    function fetchAjax(url, method, cbSucc, page,cbErr, dataUI,...rest) {
        $.ajax({
            url: url,
            method: method,
            dataType: "json",
            data: dataUI,
            success: function (data) {
                cbSucc(data,page);
            },
            error: function (xhr) {
                cbErr(xhr,...rest)
            }
        });
    }
    // get params from url to navigate pages
    var page = window.location.search;
    
    //show ham menu on all pages except admin page
    if(page.indexOf("admin") == -1 && page.indexOf("order") == -1){
        menuToggle();
        cartToggle();
    }
   
    //ham menu
   function menuToggle(){
    let ham = document.querySelector(".menu-btn");
    ham.addEventListener("click", () => {
        document.querySelector(".menu ul").classList.toggle("show");
        document.body.classList.toggle("no-scroll");
 
    })
   }
   var proba = false;
   //cart
   let cartContent = document.querySelector(".cart-content");
   function cartToggle(){
        cart.addEventListener("click" , () =>{
         cartContent.classList.toggle("hidden");
         document.body.classList.toggle('no-scroll');
        })
        closeCart.addEventListener("click" , () =>{
         cartContent.classList.toggle("hidden");
         document.body.classList.toggle('no-scroll');
        })
        // addToCart.addEventListener("click" , () =>{
        //  setTimeout(()=>{
        //      console.log(`1`);
        //     cartContent.classList.toggle("hidden");
        //     document.body.classList.toggle('no-scroll');
        //  },2000)
        // })
   }
     //globalne funkcije
    function succResp(data,page) {
        msg.innerHTML = `<p class="alert alert-success mt-5">${data.msg}</p>`;
        setTimeout(() => {
            window.location.href = `index.php?${page}`;
        }, 2000);
    }
    function errResp(xhr,...rest){
        msg.innerHTML = `<p class="alert alert-danger mt-5">${JSON.parse(xhr.responseText).msg}</p>`;
        // clear msg
        setTimeout( () => {
            msg.innerHTML = '';
        }, 3000)
        // clear inputs
        for(x of rest){
            clearInput(x);
        }
    }
    // validate regex
    function validRegex(obj, regex) {
        if (!regex.test(obj.value)) {
            obj.classList.add("err");
            obj.classList.remove("succ");
            obj.nextElementSibling.classList.remove("hide");
            err++;
        } else {
            obj.classList.remove("err");
            obj.classList.add("succ");
            obj.nextElementSibling.classList.add("hide");
        }
    }
    // validate inputs
    function validInput(input,compere) {
        if (input.value == compere) {
            input.classList.add("err");
            input.classList.remove("succ");
            input.nextElementSibling.classList.remove("hide");
            err++;
        } else {
            input.classList.remove("err");
            input.classList.add("succ");
            input.nextElementSibling.classList.add("hide");
        }
    }
    function clearInput(obj) {
        obj.value = "";
        obj.classList.remove("succ");
    }
    function errPrint(xhr){
        console.log(xhr);
    }
    //regex
    let reEmail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    let rePassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    let reFristName = /^([A-Z][a-z]{2,15})+$/;
    let reLastName = /^([A-Z][a-z]{2,20})+$/;
    let err = 0;
 
    // register page
    if (page == "?page=register") {
        //get selectors
        let fname = document.querySelector('#fname')
        let lname = document.querySelector('#lname');
        let email = document.querySelector('#emailRegister');
        let password = document.querySelector('#password');
        let passwordConf = document.querySelector('#passwordConf');
        //event register
        btnReg.addEventListener("click", () => {
            err = 0;

            validRegex(fname, reFristName);
            validRegex(lname, reLastName);
            validRegex(email, reEmail);
            validRegex(password, rePassword);

            if (password.value !== passwordConf.value || passwordConf.value == "") {
                err++;
                passwordConf.classList.add("err");
                passwordConf.classList.remove("succ");
                passwordConf.nextElementSibling.classList.remove("hide");
            } else {
                passwordConf.classList.remove("err");
                passwordConf.classList.add("succ");
                passwordConf.nextElementSibling.classList.add('hide');
            }
            if (!err) {
                let dataUI = {
                    fnameUI: fname.value,
                    lnameUI: lname.value,
                    emailUI: email.value,
                    passwordUI: password.value,
                    passwordConfUI: passwordConf.value
                }
                fetchAjax("models/registration.php", "POST", succResp,"page=login", errResp, dataUI,fname,lname,email,password,passwordConf);
            }

        });
    } 
    if (page == "?page=login" || location.href.indexOf("?page=login") != -1) {
        
        let email = document.querySelector('#emailLog');
        let password = document.querySelector('#passwordLog')

        btnLog.addEventListener("click", () => {
            err = 0;
            validRegex(email, reEmail);
            validRegex(password, rePassword);
            if (!err) {
                let dataUI = {
                    emailUI: email.value,
                    passwordUI: password.value,
                }
                fetchAjax("models/login.php", "POST", succResp, "page=events", errResp, dataUI,email,password);
            }
    
        });
    }
    if(page == "?page=profile"){
        // let currentPassword = "";
        //     newPassword = newPass.value,
        //     reNewPassword = reNewPass.value;
        btnChange.addEventListener("click" , () => {
            err = 0;
            if(!rePassword.test(currentPass.value)){
                msg.innerHTML = '<p class="alert alert-danger mt-4">Trenutna lozinka je nepostojuca jer je neispravat format lozinke.</p>';
                err++;
            }
            if(newPass.value !== reNewPass.value || reNewPass.value == ""){
              msg.innerHTML += `<p class="alert alert-danger mt-3">Lozinke se ne poklapaju.</p>`
              err++;
            }else{
                if(!rePassword.test(newPass.value)){
                    msg.innerHTML += '<p class="alert alert-danger mt-4">Nova lozinka nije u ispravnom formatu.</p>';
                    err++;
                }
            }
            if(!err){
                let dataUI = {
                    currPass : currentPass.value,
                    newPass : newPass.value,
                    renewPass : reNewPass.value,
                    email : hiddenEmail.value
                }
                 fetchAjax("models/user/changePassword.php", "POST", succResp,"", errResp, dataUI,currentPass,newPass,reNewPass);
            }
            setTimeout(() => {
                msg.innerHTML = '';
            },2000)
        })
            
    }
    let reEventName = /^[A-Z][A-z\d]{1,20}(\s[A-Z][A-z\d]{1,20})*$/,
     reArtist = /^[A-z\d]{2,15}(\s[A-Za-z\d]{2,20})*(,[A-z\d]{2,15}(\s[A-Za-z\d]{2,20})*)*$/,
     reAdress = /^([A-ZŠĐĆČŽ][a-zšđčćž]{2,15}|[0-9])+(\s[A-ZŠĐĆČŽ[a-zšđčćž0-9\.\-]{2,20})+$/,
     rePrice = /^([1-9][0-9]{1,3}\.[0-9]{2}|0)$/
    
    if (page == "?page=admin-insert" || page.indexOf("admin-edit") != -1) {
        btnInsert.addEventListener("click", () => {
            // reset err
            err = 0;
            // vars
            let name = document.querySelector("#name"),
             adress = document.querySelector("#adress"),
             city = document.querySelector("#city"),
             artist = document.querySelector("#artist"),
             date = document.querySelector("#date"),
             time = document.querySelector("#time"),
             desc = document.querySelector("#taDesc"),
             file = document.querySelector("#file"),
             price =  document.querySelector("#eventPrice");
            
            // validation
            validRegex(name, reEventName);
            validRegex(adress, reAdress);
            validRegex(artist, reArtist);
            validRegex(price, rePrice);

            if (file.files[0] == undefined) {
                file.classList.add("err");
                file.nextElementSibling.classList.remove("hide");
                err++;
            } else {
                file.classList.remove("err");
                file.classList.add("succ");
                file.nextElementSibling.classList.add("hide");
            }
            validInput(time,"");
            validInput(date,"");
            validInput(desc,"");
            validInput(city,"0");

            if (!err) {
                let dataUI = new FormData();
                dataUI.append("nameUI", name.value);
                dataUI.append("adressUI", adress.value);
                dataUI.append("cityUI", city.value);
                dataUI.append("artistUI", artist.value);
                dataUI.append("dateUI", date.value);
                dataUI.append("timeUI", time.value);
                dataUI.append("descUI", desc.value);
                dataUI.append("fileUI", file.files[0]);
                dataUI.append("priceUI", price.value);
                // ajax metoda sa svojstvima za file
                $.ajax({
                    url : "models/event/insert.php",
                    method : "POST",
                    data : dataUI,
                    contentType : false,
                    processData : false,
                    success : function(data){
                        succResp(data,"page=admin-insert");
                    },
                    error : function(xhr){
                        errResp(xhr,name,adress,artist,date,time,desc,file,price);
                        city.classList.remove("succ");
                        city.options.selectedIndex = 0;
                    }
                });
            }
        })
       
    }
    if(page == "?page=events" || page==""){
          // filter by city or name
          search.addEventListener("keyup",() => {
            let data = {
               serachParamUI : search.value
           }
           filterEvents(data,"filter","page-link-filterd");
           showClearFilter();
       });
       // filter by date
       filterDate.addEventListener("change" , () => {
           let data = {
               dateUI : filterDate.value
           }
           filterEvents(data,"filterDate","page-link-filterd-date");
           showClearFilter();
       });
       // clear all filters 
      function showClearFilter(){
       if(search.value != "" || filterDate.value != ""){
           // show clear all link
           clearFilters.classList.remove("d-none");
           // show inital events
           clearFilters.children[0].children[0].addEventListener("click",() => {
              let data = {
               serachParamUI : ""
              }
              filterEvents(data,"filter","page-link-pagination");
              // remove clear all link
              clearFilters.classList.add("d-none");
              filterDate.value = "";
              search.value = "";
           })
       }else{
           // remove clear all link
           clearFilters.classList.add("d-none");
       }
      }
        // events for pagination links
        $(document).on("click",".page-link-pagination",function(e){
            e.preventDefault();
            let data = {
                limitEvent : this.dataset.limit
            }
            filterEvents(data,"pagination","page-link-pagination")
            $('html').animate({'scrollTop':'0'},1)
        });
         // events for pagination links when data is filterd
        $(document).on("click",".page-link-filterd",function(e){
            e.preventDefault();
            let data = {
            limitEvent : this.dataset.limit,
            serachParamUI : search.value
        }
        filterEvents(data,"filter","page-link-filterd");

        $('html').animate({'scrollTop':'0'},1)
        });
         // events for pagination links when data is filterd with date
        $(document).on("click",".page-link-filterd-date",function(e){
            e.preventDefault();
            let data = {
                limitEvent :  this.dataset.limit,
                dateUI : filterDate.value
            }
            filterEvents(data,"filterDate","page-link-filterd-date");
    
            $('html').animate({'scrollTop':'0'},1)
        });
      
    }
    function filterEvents(data,pageParam,linkClass){
         fetchAjax(`models/event/${pageParam}.php`, "POST", printEvents,linkClass, printEmpty, data);
    }
     function printEvents(data,pageLinksClass){
        let html = "";
        let output = '';
        let dir = "assets/img-small/";
        if(data.events.length){
            for(d of data.events){
                html += `<div class="col-md-12 item d-flex justify-content-between align-items-center w-100">
                <div class="item-img w-30">
                    <img src="${dir + d.putanja}"  alt="${d.ime}">
                </div>
                <div class="item-info text-center">
                    <p>${d.datum} ${d.vreme}</p>
                    <h4 class="text-white font-weight-bold">${d.ime}</h4>
                </div>
                <a href="index.php?page=eventDetails&id=${d.id_event}" class="btn btn-purple">Detaljnije</a>
            </div>`;
            }
            // events per page
            let offset = 4;
            // number of pages
            let pageLinks = Math.ceil(data.pages / offset);
            for(var i = 0; i < pageLinks; i++){
                output += `<li class="page-item"><a class="page-link ${pageLinksClass}" data-limit="${i}" href="#">${i + 1}</a></li>`
           }

        }else{
            html += `<h3 class='my-5 mx-auto text-white lead text-uppercase'>Trenutno nema dogadja za prikaz...</h3>`
        }
        events.innerHTML = html;
        paginationLinks.innerHTML = output;
    }
    function printEmpty(xhr){
        events.innerHTML = "<h3 class='my-5 mx-auto text-white lead text-uppercase'>Trenutno nema dogadja za prikaz...</h3>"
    }
    if(page.indexOf("?page=eventDetails") != -1) {
        // event for adding items in cart
        addToCart.addEventListener("click",(e) => {
            e.preventDefault();
            let data = {
                id : addToCart.dataset.id
            }
            fetchAjax("models/user/addToCart.php", "POST", succCart, "", errPrint, data);
        });
        function succCart(data){
            // change btn text
            addToCart.innerHTML = data.msg;
            printCartItems(data);
            // return initial btn text
            setTimeout(() => {
                addToCart.innerHTML = 'Dodaj u korpu';
            },2000)
            // add classes to show cart and disable srollbar
            korpa.className = "cart-content";
            document.body.className = "no-scroll";
        }
   
    }
    function printCartItems(data){
         // print num of items in cart(navigation)
         cart.innerHTML = `Korpa(${Object.keys(data.arr).length})`;
        let output = '';
        for(d in data.arr){
            let item = data.arr[d];
            output += `<div class="container">
            <div class="row py-3 align-items-center border-bottom">
                <div class="col-md-12 text-right">
                    <a href="#" data-id=${item.id} class="deleteItemCart text-white size-small">X</a>
                </div>
                <div class="col-md-12 col-lg-5">
                    <img src="assets/uploaded_img/${item.img}" style="width:200px" alt="${item.name}">
                </div>
                <div class="col-md-12 col-lg-5 cart-item-content text-center ml-2">
                    <h5 class="h4">${item.name}</h5>
                    <div class="text-white mt-3">
                        <span class="mr-1">${item.quantity}  X </span>
                        <span>${item.price} RSD</span>
                    </div>
                </div>
            </div></div>
            `;
        }
    
       if(cart.textContent.trim() != "Korpa(0)"){
        output += `<div class="mt-4 mb-5"><a href="index.php?page=order" class="btn btn-purple w-100">Zavrsi kupovinu</a></div>`
       }
        // print items
        cartItems.innerHTML = output;
    }
 
    // event is in global scope because user can delete item from cart from any page
     if(page.indexOf("admin") == -1){
        korpa.addEventListener("click",(e)=>{
            if(e.target.classList.contains("deleteItemCart")){
                 e.preventDefault();
                 let data = {
                     id : e.target.dataset.id
                 }
                 fetchAjax("models/user/removeFromCart.php", "POST", printCartItems, "", errPrint, data);
            }
         });
    }
     if(page.indexOf("?page=order") != -1){
         let quantity = document.querySelectorAll(".cartQuantity");
         let price = document.querySelectorAll(".cartPrice");
         let delivery = document.querySelector(".delivery");
         let sum = 0;
         for(var i = 0; i < quantity.length; i++){
             sum += parseInt(quantity[i].textContent) * parseInt(price[i].textContent);
         }
         sum += parseInt(delivery.textContent);
         sumPrice.textContent = sum;
         priceOrder.value = sum;
     }
    if(page == "?page=admin-select"){
        $(document).on("click",".page-link",function(e){
            e.preventDefault();
            let limit = this.dataset.limit;
        
            let data = {
                limitEvent : limit
            }
            fetchAjax("models/event/pagination.php", "POST", printEventsTable,"", errPrint, data);
    
            function printEventsTable(data){
                let html = ``;
                let rb = 1;
               if(data.events.length){
                for(d of data.events){
                    html += `<tr>
                    <td>${rb}</td>
                    <td>${d.ime}</td>
                    <td>${d.datum}</td>
                    <td>${d.naziv}</td>
                    <td><a href="index.php?page=admin-edit&id=${d.id_event}" class="btn btn-primary  white-color">Izmeni</a></td>
                    <td><a href="#" class="btn btn-danger deleteEvent white-color" data-id="${d.id_event}">Obrisi</a></td>
                </tr>`;
                rb++;
                }
               }else{
                html += `<h3 class='my-4 text-white text-uppercase'>Trenutno nema dogadja za prikaz.</h3>`
            }
            eventsTable.innerHTML = html;
            }
            function errPrint(xhr){
                console.log(xhr);
            }
        });
        $(document).on("click",".deleteEvent",function(e){
            e.preventDefault();
            let id = this.dataset.id;
            
            let data = {
                idUI : id
            }
    
            fetchAjax("models/event/delete.php", "POST", printOthers, "",printOthersErr, data);
        })
        function printOthers(data){
            let html = ``;
            let rb = 1;
           if(data.events.length){
            for(d of data.events){
                html += `<tr>
                <td>${rb}</td>
                <td>${d.ime}</td>
                <td>${d.datum}</td>
                <td>${d.naziv}</td>
                <td><a href="index.php?page=admin-edit&id=${d.id_event}>" class="btn btn-primary white-color">Izmeni</a></td>
                <td><a href="#" class="btn btn-danger deleteEvent white-color" data-id="${d.id_event}">Obrisi</a></td>
            </tr>`;
            rb++;
            }
           }else{
            html += `<h3 class='my-4 text-white text-uppercase'>Trenutno nema dogadja za prikaz.</h3>`
        }
        eventsTable.innerHTML = html;
        res.innerHTML = `<p class="alert alert-success mt-5">${data.msg}</p>`
        setTimeout(()=>{
            res.innerHTML = '';
        },2000);
        }
        function printOthersErr(xhr){
            eventsTable.innerHTML = `<h3 class='my-4 text-white text-uppercase'>Trenutno nema dogadja za prikaz.</h3>`;
        }
    }
    if(page == "?page=admin-users"){
        $(document).on("click",".page-link",function(e){
            e.preventDefault();
            let limit = this.dataset.limit;
        
            let data = {
                limitUsers : limit
            }
            fetchAjax("models/event/pagination.php", "POST", printUsers, "",errPrint, data);
        });
        function printUsers(data){
            let html = ``;
            let rb = 1;
           if(data.users.length){
            for(d of data.users){
                html += `
                <tr>
                <td>${rb}</td>
                <td>${d.ime}  ${d.prezime}</td>
                <td>${d.email}</td>
                <td><a href="#" class="btn btn-danger deleteUser white-color" data-id="${d.id_korisnik}">Obrisi</a></td>
            </tr>
            `;
            rb++;
            }
           }else{
            html += `<h3 class='my-4 text-white text-uppercase'>Trenutno nema korisnika za prikaz.</h3>`
            setTimeout(()=>{
                window.location.reload();
            },1000);
        }
        usersTable.innerHTML = html;
        }
        // function errPrint(xhr){
        //     console.log(xhr);
        // }
        $(document).on("click",".deleteUser",function(e){
            e.preventDefault();
            let id = this.dataset.id;
            let data = {
                idUI : id
            }
    
            fetchAjax("models/user/delete.php", "POST", printUsersLeft,"", errPrint, data);
        })
        function printUsersLeft(data){
            let html = ``;
            let rb = 1;
           if(data.users.length){
            for(d of data.users){
                html += `
                <tr>
                <td>${rb}</td>
                <td>${d.ime}  ${d.prezime}</td>
                <td>${d.email}</td>
                <td><a href="#" class="btn btn-danger deleteUser white-color" data-id="${d.id_korisnik}">Obrisi</a></td>
            </tr>
            `;
            rb++;
            }
           }else{
            html += `<h3 class='my-4 text-white text-uppercase'>Trenutno nema korisnika za prikaz.</h3>`
        }
        usersTable.innerHTML = html;
        res.innerHTML = `<p class="alert w-100 alert-success mt-5">${data.msg}</p>`
        setTimeout(()=>{
            res.innerHTML = '';
        },2000);
        }
        }
  
});
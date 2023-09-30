function changePage() {
    //alert("hi");
    var signUpBox = document.getElementById("signUpBox");
    signUpBox.classList.toggle("d-none");
    document.getElementById("signInBox").className = "col-12 col-lg-6 d-block";
    /* document.getElementById("title2").style.fontSize="30px";*/
    /* document.getElementById("title1").style.marginTop="2vh";*/
    // document.getElementById("logo").className = "col-12 col-lg-12 logo"

}
function gotoSignUp() {
    document.getElementById("signInBox").classList.toggle("d-none");
    document.getElementById("signUpBox").className = "col-12 col-lg-6 d-block"

}

function signUp() {
    //alert("hello");
    var signUpBox = document.getElementById("signUpBox");
    signUpBox.classList.toggle("d-none");
    document.getElementById("signInBox").className = "col-12 col-lg-6 d-block";
    /*document.getElementById("title1").style.marginTop="2vh";*/
    document.getElementById("logo").className = "col-12 col-lg-12 logo";
   
    

}

var ev;
function emailVerification(){
    var email=document.getElementById("e");
    var f=new FormData();
    f.append("e",email.value);
    var alertdiv=document.getElementById("alertdiv");
    
    var r=new XMLHttpRequest();

    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t =this.responseText;
            if(t=="success"){
                var emailVerificationModal=document.getElementById("verificationModal");
                ev=new bootstrap.Modal(emailVerificationModal);
                ev.show();
            }else{
                alertdiv.className="alert alert-info d-block";
                alertdiv.innerHTML=t;
            }
        }
    }
    r.open("POST","emailVerificationProcess.php",true);
   
    r.send(f);
    
}
function verify(){
    var verification=document.getElementById("vcode");
    var r=new XMLHttpRequest();
    ev.hide();

    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            if(t=="EmailVerified!"){
                alert(t);
                // ev.hide();
              }else{
                alert(t);
            }
        }
    }

    r.open("GET","verificationProcess.php?v="+verification.value,true);
    r.send();
}
function userSigningUp(){
    var alertdiv=document.getElementById("alertdiv");
    var fname =document.getElementById("f");
    var lname=document.getElementById("l");
    var email=document.getElementById("e");
    var password=document.getElementById("p");
    var address1=document.getElementById("a1");
    var address2=document.getElementById("a2");
    var mobile=document.getElementById("m");
    var city=document.getElementById("c");
    var gender=document.getElementById("g");
    var v1=document.getElementById("vcode");

    var form=new FormData;

    form.append("f",fname.value);
    form.append("l",lname.value);
    form.append("e",email.value);
    form.append("p",password.value);
    form.append("a1",address1.value);
    form.append("a2",address2.value);
    form.append("m",mobile.value);
    form.append("c",city.value);
    form.append("g",gender.value);
    form.append("v1",v1.value);
   
    var request=new XMLHttpRequest();

    request.onreadystatechange=function(){
        if(request.readyState==4){
            var t=request.responseText;
            if(t=="success"){
              window.location="index.php";

            }else{
                alertdiv.className="alert alert-info d-block"
                alertdiv.innerHTML=t;
            }
        }
    }

    request.open("POST","signUpProcess.php",true);
    request.send(form);
}

function userSigningUp(){
    var alertdiv=document.getElementById("alertdiv");
    var fname =document.getElementById("f");
    var lname=document.getElementById("l");
    var email=document.getElementById("e");
    var password=document.getElementById("p");
    var address1=document.getElementById("a1");
    var address2=document.getElementById("a2");
    var mobile=document.getElementById("m");
    var city=document.getElementById("c");
    var gender=document.getElementById("g");
    var v1=document.getElementById("vcode");

    var form=new FormData;

    form.append("f",fname.value);
    form.append("l",lname.value);
    form.append("e",email.value);
    form.append("p",password.value);
    form.append("a1",address1.value);
    form.append("a2",address2.value);
    form.append("m",mobile.value);
    form.append("c",city.value);
    form.append("g",gender.value);
    form.append("v1",v1.value);
   
    var request=new XMLHttpRequest();

    request.onreadystatechange=function(){
        if(request.readyState==4){
            var t=request.responseText;
            if(t=="success"){
               changePage();
            //    alert("account creation was successful!");
            //    alert("Your Account was Created.Sign In to Proceed.");
             

            }else{
                alertdiv.className="alert alert-info d-block"
                alertdiv.innerHTML=t;
            }
        }
    }

    request.open("POST","signUpProcess.php",true);
    request.send(form);
}
function signIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");
    var alertdiv2= document.getElementById("alertdiv2");
    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location ="index.php";
            } else {
                
                alertdiv2.className="alert alert-info d-block";
                alertdiv2.innerHTML=t;
            }
        }
    }

    r.open("POST", "signInProcess.php", true);
    r.send(f);
}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if(t =="success"){
                // alert("reload");

                
                window.location.reload();

            } else {
                //alert(t);
            }
        }
    };

    r.open("GET", "signout.php", true);
    r.send();

}
function showPassword1() {

    var i = document.getElementById("npi");
    var eye = document.getElementById("e1");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function showPassword2() {

    var i = document.getElementById("rnp");
    var eye = document.getElementById("e2");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function forgotPasswordInputValidation(){
    var email2=document.getElementById("email2");
    var password2=document.getElementById("password2");
    var alertdiv2= document.getElementById("alertdiv2");

    var f=new FormData();
    f.append("email",email2);
    
    
    var request=new XMLHttpRequest();
    request.onreadystatechange=function(){
        if(request.readyState==4){
            var t=request.responseText;
            if(t=="noemail"){
                alertdiv2.className="alert alert-info d-block";
                alertdiv2.innerHTML="Enter your email";

            }else{
                forgotPassword();
                
            }

        }
    }
    request.open("POST","forgotPasswordInputValidationProcess.php",true);
    request.send(f);

}
function passwordEmailVerifcation(){
    //alert("hello");
    var fpemail=document.getElementById("fpemail").value;
    
    var f=new FormData();
    f.append("e",fpemail);
    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            if(t=="Success"){
                alert("Please check your Email");
            }else{
                alert("Somethig went wrong");
            }
        }
    }
    r.open("POST","forgotPasswordEmail.php",true);
    r.send(f);
}
function forgotPassword() {

    var email = document.getElementById("email2");
        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "Success") {
                    alert("Verification code has sent to your email. Please check your inbox");
                  
                }else {
                    alert(t);
                }
    
            }
        }
    
        r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
        r.send();
}
//add Product
function loadBrand(){
    //alert("hi");
    var category=document.getElementById("category").value;
    // alert(category);
    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            // alert(t);
            document.getElementById("brand").innerHTML=t;
        }

    }

    r.open("GET","loadBrands.php?c="+category,true);
    r.send();
}

function loadModel(){
    //alert("Hi");
    var brandid=document.getElementById("brand").value;
    //alert(brandid);
    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            document.getElementById("model").innerHTML=t;
        }

    }

    r.open("GET","loadModels.php?b="+brandid,true);
    r.send();
    

}
function addcolour(){
    // alert("hi");
    var colour=document.getElementById("clr_in").value;
    // alert(colour);
    var r = new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
           
            if(t=="success"){
                window.location.reload();
            }else{
                alert(t);
            }
        }
    }

    r.open("GET","addColour.php?c="+colour,true);
    r.send();


}
function changeProductImage(){
    
    var image=document.getElementById("imageuploader");

    image.onchange=function(){
        var file_count=image.files.length;

        if(file_count<=3){

            for (var x=0;x<file_count;x++){
                var file=this.files[x];
                var url=window.URL.createObjectURL(file);

                document.getElementById("i"+x).src=url;
            }
        }else{
            alert("Please select 3 or less than 3 images");
        }
    }

}
function addProduct(){
    //alert("hi");
    var categoryid=document.getElementById("category").value;
  
    var brandid=document.getElementById("brand").value;
    var modelid=document.getElementById("model").value;
    var title=document.getElementById("title").value;
    
    var condition=0;
    if(document.getElementById("b").checked){
        condition=1;
    }else if(document.getElementById("u").checked){
        condition=2;
    }else if(document.getElementById("r").checked){
        condition=3;

    }else{
        condition=0;
    }
    var qty=document.getElementById("qty").value;
    var cost=document.getElementById("cost").value;
    var delcol=document.getElementById("delcolombo").value;
    var colour=document.getElementById("colour").value;
    var delout=document.getElementById("delouter").value;
    var desc=document.getElementById("desc").value;
    var image=document.getElementById("imageuploader");

    var f= new FormData();
    f.append("c",categoryid);
    f.append("brand",brandid);
    f.append("m",modelid);
    f.append("t",title);
    f.append("condition",condition);
    f.append("colour",colour);
    f.append("qty",qty);
    f.append("cost",cost);
    f.append("delcol",delcol);
    f.append("delout",delout);
    f.append("desc",desc);

    var file_count=image.files.length;

    for(var x=0; x<file_count;x++){
        f.append("image"+x,image.files[x]);
    }

    var request=new XMLHttpRequest();
    request.onreadystatechange=function(){
        if(request.readyState==4){
            var t=request.responseText;
            
            if(t=="Product images saved successfully"){
               window.location.reload();
            }else{
                alert(t);
            }
        }
    }
    
    request.open("POST","addProducts.php",true);
    request.send(f);   

}

// var pm;
// function viewProductModal(id){
//     //alert("hi");
//     var m = document.getElementById("viewProductModal"+id);
//     //alert(m);
//     pm = new bootstrap.Modal(m);
//     pm.show();
// }
function addToCart(id){
    //alert("cart");
    var pid=id;
    var r = new XMLHttpRequest();
    r.onreadystatechange=function(){
        if (r.readyState==4){
            var t =r.responseText;
            if(t=="success"){
                window.location.reload();
                alert("Product successfully added to the cart");
                
                document.getElementById("cartNotification").innerHTML
            }else{
                alert(t);
            }
        }
    }
    r.open("GET","addToCartProcess.php?pid="+id,true);
    r.send();
}
function addToCartFromProductView(id){
    var pid=id;
    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            if(t=="success"){
                window.location.reload();
            }else{
                alert(t);
            }
        }
    }


    r.open("GET","addToCartFromProductView.php?pid="+id,true);
    r.send();
}
function signIn1() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");
    var alertdiv2= document.getElementById("alertdiv2");
    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                
                alertdiv2.className="alert alert-info d-block";
                alertdiv2.innerHTML=t;
            }
        }
    }

    r.open("POST", "signInProcess.php", true);
    r.send(f);
}
function productminus(id){
    var pid=id;
    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            window.location.reload();
            document.getElementById("label1").innerHTML=t;
            //alert(t);
        }
    }
    r.open("GET","productminus.php?pid="+pid,true);
    r.send();

}

function minus(id){
    var pid=id;

    //alert(pid);
     var r =new XMLHttpRequest();
     r.onreadystatechange = function () {
        if (r.readyState == 4) {
           window.location.reload();
          
            var t =r.responseText;
            document.getElementById("label1").innerHTML=t;
            //alert(t);
           
           
        }}

     r.open("GET","minus.php?pid="+pid,true);
     r.send();
  
}
function productplus(id){
    //alert("hello");
    var pid=id;
    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            window.location.reload();
            var t=r.responseText;
            document.getElementById("label1").innerHTML=t;
            
            //alert(t);
        }
    }

    r.open("GET","productplus.php?pid="+pid,true);
    r.send();
}
function plus(id){
    var pid=id;

    //alert(pid);
     var r =new XMLHttpRequest();
     r.onreadystatechange = function () {
        if (r.readyState == 4) {
           window.location.reload();
          
            var t =r.responseText;
            if(t=="Products are over"){
                alert(t);
            }
           
           
           
        }}

     r.open("GET","plus.php?pid="+pid,true);
     r.send();
  
}
function removeFromcart(id){
    var pid=id;
    //alert(pid);
    var r =new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            window.location.reload();
            //var t=r.responseText;
            //alert(t)
        }
    }


    r.open("GET","removeFromCart.php?pid="+pid,true);
    r.send();
    //alert("Hi");
}

// function singleProductView(id){
//     var pid=id;
//     alert(pid);
//     var r =new XMLHttpRequest();
//     r.onreadystatechange=function(){
//         if(r.readyState==4){
//             //window.location.reload();
//             var t=r.responseText;
//             alert(t)
//         }
//     }


//     r.open("GET","productView.php?pid="+pid,true);
//     r.send();
//     //alert("Hi");
// }
function change2(){
    var shipping=document.getElementById("shipping")
    shipping.className="row mb-5 d-none"
    var description = document.getElementById("description");
    description.className="row mb-5 d-block"
}

function change3(){
    var description=document.getElementById("description")
    description.className="row mb-5 d-none"
    var shipping = document.getElementById("shipping");
    shipping.className="row mb-5 d-block"
}
function loadMainImg(id) {
    document.getElementById("mainimg1").className="d-none";
    var sample_img = document.getElementById("productImg" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.style.backgroundImage = "url(" + sample_img + ")";

}
function mainImg(mid){
    //document.getElementById("mainimg1").classList.toggle("d-none");
    var m_id=mid;
    var main_img1=document.getElementById("productImg" + id).src;
    main_img1.style.backgroundImage = "url(" + main_img1 + ")";
}

function addToWatchlist(id){
    //alert("hi");
    var wid=id;
    //alert(wid);
    var r =new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            if(t=="added"){
                //alert("hello");
                var red=document.getElementById("heart"+wid);
                red.className="bi bi-heart-fill text-danger fs-5";
                //window.location.reload();
                //alert("Added to the watchlist");
            }else if(t=="deleted"){
                var black=document.getElementById("heart"+wid);
                black.className="bi bi-heart-fill text-dark fs-5";
                window.location.reload();
                //alert("Already in the watchlist");
            }else{
                alert(t);
            }
        }
    }
  

    r.open("GET","addToWatchlist.php?id="+wid,true);
    r.send();
}
function addToGiftBox(id){
    //alert("hello");
    var pid=id;
    var r =new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            alert(t);
        }
    }
    r.open("GET","addToGiftBoxProcess.php?id="+pid,true);
    r.send();
}

function signIn2(){
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");
    var alertdiv2= document.getElementById("alertdiv2");
    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location="allProducts.php"
            } else {
                
                alertdiv2.className="alert alert-info d-block";
                alertdiv2.innerHTML=t;
            }
        }
    }

    r.open("POST", "signInProcess.php", true);
    r.send(f);

}
function signIn3(){
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");
    var alertdiv2= document.getElementById("alertdiv2");
    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location="index.php"
            } else {
                
                alertdiv2.className="alert alert-info d-block";
                alertdiv2.innerHTML=t;
            }
        }
    }

    r.open("POST", "signInProcess.php", true);
    r.send(f);
}

function removeFromWatchlist(id){
    //alert("hi")
    var pid=id;
    //alert(pid);
    var r =new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            window.location.reload();
            var t=r.responseText;
            alert(t)
        }
    }


    r.open("GET","removeFromWatchlist.php?pid="+pid,true);
    r.send();
    //alert("Hi");
}
function payNow(id){
    var pid=id;
    //var price=document.getElementById.value;

    var form=new FormData();
    //form.append("price",price);
    form.append("pid",pid);
    //alert(pid);
    //alert(price);
     var r=new XMLHttpRequest();
     r.onreadystatechange=function(){
        if(r.readyState==4){
            
            window.location="payment_method.php?pid="+pid;
        }
     }
    
    r.open("POST","payment_method.php",true);
    r.send(form);
}
function printInvoice(){
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}
function adminVerification(){
    var email = document.getElementById("e");

    var f = new FormData();
    f.append("e",email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "Success"){
                var adminVerificationModal = document.getElementById("verificationModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            }else{
                alert(t);
            }
        }
    }

    r.open("POST","adminVerificationProcess.php",true);
    r.send(f);
}
function verify(){
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "success"){
                av.hide();
                window.location = "adminPanel.php";
            }else{
                alert (t);
            }
            
        }
    }

    r.open("GET","adminVerifyProcess.php?v="+verification.value,true);
    r.send();

}
function toAdmin(){
    //alert("hi");
    window.location='adminSignIn.php';
}
function basicSearch(x) {
    //alert("Hi");
    var pid=x;
    var txt = document.getElementById("basic_search_txt");
    //alert(txt.value);
    var select = document.getElementById("basic_search_select");
    //alert(select.value);
    var f = new FormData();
    f.append("t", txt.value);
    f.append("s", select.value);
    f.append("page",pid);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            //alert(t);
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicSearch.php", true);
    r.send(f);

}
var npm;
function openPay(){
    //alert("hi");
    var pm=document.getElementById("payModal");
    npm=new bootstrap.Modal(pm);
    npm.show();
}
function purchase(id){
    alert("hi");
    var pid=id;


}
function purchaseProduct(id){
   
    var pid=id;

    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            window.location="purchaseProduct.php?pid="+pid;
        }
    }
    r.open("GET","purchaseProduct.php?pid="+pid,true);
    r.send();
}
var paym;
function openPay2(){
    //alert("hi");
    var pm=document.getElementById("paymentModal");
    paym=new bootstrap.Modal(pm);
    paym.show();
}
function purchaseCart(total){
   //alert("hi");
   //var pid=id;
   //alert(pid);
   //var qty=document.getElementById()
   var t=total;
   var r=new XMLHttpRequest();
   r.onreadystatechange=function(){
    if(r.readyState==4){
        var t= r.responseText;
        if(t=="success"){
            window.location='cartBill.php';
        }
    }
   }
   r.open("GET","cartPurchaseProcess.php?t="+t,true);
   r.send();


}

var cpaym;
function cartPay(){
    //alert("hi");
    var pm=document.getElementById("cartPayModal");
    cpaym=new bootstrap.Modal(pm);
    cpaym.show();
}
function trial(){
    alert("hi");
}
function purchaseCartProduct(){
   
    alert("Hi");
    //window.location='cartCheckout.php';
}
function removeFromCart(){
    
    var request=new XMLHttpRequest();
    
    request.onreadystatechange=function(){
        alert("hello");

        if(request.readyState==4){
            var t=request.responseText;
            alert(t);
            if(t=="success"){
                window.location='cart.php';
            }else{
                alert(t);
            }

        }

    }
    r.open("POST","removeFromCartProcess.php",true);
    r.send();



};
function sort1(x) {

    var search = document.getElementById("s");
    var time = "0";

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var qty = "0";

    if (document.getElementById("h").checked) {
        qty = "1";
    } else if (document.getElementById("l").checked) {
        qty = "2";
    }

    var condition = "0";

    if (document.getElementById("b").checked) {
        condition = "1";
    } else if (document.getElementById("u").checked) {
        condition = "2";
    } else if(document.getElementById("re").checked){
        condition="3";
    }

    var f = new FormData();
    f.append("s", search.value);
    f.append("t", time);
    f.append("q", qty);
    f.append("c", condition);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sort").innerHTML = t;
        }

    }

    r.open("POST", "sortProcess.php", true);
    r.send(f);

}
function clearsort() {
    window.location.reload();
}
function sendId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "updateProduct.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "sendIdProcess.php?id=" + id, true);
    r.send();

}
function changeStatus(id) {

    var product_id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            if (t == "deactivated" || t == "activated") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "changeStatusProcess.php?p=" + product_id, true);
    r.send();

}
function sendId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "updateProduct.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "sendIdProcess.php?id=" + id, true);
    r.send();

}
function updateMyProfile(){
    //alert("hi");
    var img=document.getElementById("profileimage").value;
    var f=document.getElementById("profilefname").value;
    var l=document.getElementById("profilelname").value;
    var m=document.getElementById("profilemob").value;
    var a1=document.getElementById("profileadd1").value;
    var a2=document.getElementById("profileadd2").value;
    var p=document.getElementById("profileProvince").value;
    var d=document.getElementById("profileDistrict").value;
    var c=document.getElementById("profileCity").value;
    //alert(img);
    var form=new FormData();
    form.append("img",img);
    form.append("f",f);
    form.append("l",l);
    form.append("m",m);
    form.append("a1",a1);
    form.append("a2",a2);
    form.append("p",p);
    form.append("d",d);
    form.append("c",c);

    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            if(t=="success"){
                window.location.reload();
            }
        }
          
    }
    
    r.open("POST","updateMyProfieProcess.php",true);
    r.send(form);
}


function saveInvoice(orderId,id,mail,amount,qty){

    var f = new FormData();
    f.append("o",orderId);
    f.append("i",id);
    f.append("m",mail);
    f.append("a",amount);
    f.append("q",qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "1"){

                window.location = "invoice.php?id="+orderId;

            }else{
                alert (t);
            }
        }
    }

    r.open("POST","saveInvoice.php",true);
    r.send(f);

}
function resetPassword(){
    //alert("Hello");
    var fpemail=document.getElementById("fpemail").value;
    var vcode=document.getElementById("fpvcode").value;
    var pw=document.getElementById("fpnp").value;
    var np=document.getElementById("fprnp").value;

    var form=new FormData();
    form.append("v",vcode);
    form.append("p",pw);
    form.append("n",np);
    form.append("e",fpemail);

    var request=new XMLHttpRequest();
    request.onreadystatechange=function(){
        if(request.readyState==4){
            var t=request.responseText;
            if(t=="success"){
                alert("Password Reset is Success");
            }else{
                alert(t)
            }
            
        }
    }
    request.open("POST","forgotPasswordProcess.php",true);
    request.send(form);
}
function showPassword3(){
    var i = document.getElementById("fpnp");
    var eye = document.getElementById("e1");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}
function showPassword4(){
    var i = document.getElementById("fprnp");
    var eye = document.getElementById("e2");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function advancedSearch(x){
    var txt = document.getElementById("t");
    var category = document.getElementById("c1");
    var brand = document.getElementById("b1");
    var model = document.getElementById("m");
    var condition = document.getElementById("c2");
    var color = document.getElementById("c3");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("s");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("con", condition.value);
    f.append("col", color.value);
    f.append("pf", from.value);
    f.append("to", to.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            //alert(t);
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);
}

function backToCart(i){
    //alert("hello");
    var id=i;
    //alert(id);
    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            //alert(t);
            if(t=="success"){
                window.location='cart.php';
            }
        }
    }
    r.open("GET","backToCartProcess.php?oid="+id,true);
    r.send();
}
function updateFeedback(id){
    //alert("hi");
    var pid=id;
    var fb=document.getElementById("feedback").value;
    //alert(pid);
    var form=new FormData();
    form.append("pid",pid);
    form.append("fb",fb);

    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            //alert(t);
            if(t=="success"){
                window.location.reload();
                alert("Feedback was added!")
            }else{
                alert(t);
            }
        }
    }
    r.open("POST","addFeedbackProcess.php",true);
    r.send(form);
}
var cfb;
function message(){
    //alert("hi");
    var sfb=document.getElementById("seefb");
    //alert(sfb);
    cfb=new bootstrap.Modal(sfb);
    cfb.show();
}
function updateProduct(){
    var title = document.getElementById("uptitle");
    var qty = document.getElementById("upqty");
    var dwc = document.getElementById("updelcolombo");
    var doc = document.getElementById("updelouter");
    var description = document.getElementById("updesc");
    var images = document.getElementById("upimageuploader");

    var f = new FormData();
    f.append("t", title.value);
    f.append("q", qty.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("d", description.value);

    var file_count = images.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("i" + x, images.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "myProducts.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProcess.php", true);
    r.send(f);

}
function sendMsg(){
    //alert("send");
    var msg=document.getElementById("msgToAdmin").value;
    
    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            if(t=="success"){
                window.location.reload();
                var sfb=document.getElementById("seefb");
    //alert(sfb);
                cfb=new bootstrap.Modal(sfb);
                cfb.show();
            }else{
                alert(t); 
            }
            
        }
    }
    r.open("GET","sendMsgToAdmin.php?msg="+msg,true);
    r.send();
}
function backToProductView(id){
    var pid=id;
    window.location='productView.php?pid='+pid;
}
function buySingleProduct(id){
    //alert("hi");
    var pid=id;
     var r=new XMLHttpRequest();
     r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            if(t=="success"){
                window.location='bill.php';
            }else{
                alert(t);
            }
          
        }
     }
     r.open("GET","buySingleProduct.php?pid="+pid,true);
     r.send();
}
function backToProductView(i){
    var id=i;
    //alert(id);
    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            //alert(t);
            if(t=="success"){
                window.location='allProducts.php';
            }
        }
    }
    r.open("GET","backToProductViewProcess.php?oid="+id,true);
    r.send();

}
function viewMessages(email){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            document.getElementById("chat_box").innerHTML = t;
        }
    }
    
    r.open("GET","viewMsgProcess.php?e="+email,true);
    r.send();
}
function changeUserStatus(){
   
    var email=document.getElementById("userstatus").value;
    //alert(email);
    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            //alert(t);
            if(t=="success1"){
                document.getElementById("userstatus").innerHTML="Active"
            }
            if(t=="success2"){
                document.getElementById("userstatus").innerHTML="Deactive"
            }
        }
    }
    r.open("GET","changeUserStatusProcess.php?e="+email,true);
    r.send();
}
function changeProductStatus(id){
    var pid=id;
    //alert(pid);
    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            //alert(t);
            if(t=="success1"){
                document.getElementById("cpstatus").innerHTML="Active"
            }
            if(t=="success2"){
                document.getElementById("cpstatus").innerHTML="Deactive"
            }
        }
    }
    r.open("GET","changeProductStatusProcess.php?pid="+pid,true);
    r.send();
}
function directToProduct(id){
    window.location='productView.php?pid='+id;
}
function signoutAdmin(){
    //alert("Hi");
    var r = new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            window.location.reload();
            
        }
    }
    r.open("GET","signOutAdmin.php",true);
    r.send();
}
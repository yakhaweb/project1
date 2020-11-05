 


//Скрипт по моделям автомобилей   

    $(document).ready(function(){
       
    $('#block-category > ul > li > a').click(function(){
    if($(this).attr('class') !='active'){
        $('#block-category > ul > li > ul').slideUp(400);
        $(this).next().slideToggle(400);
            $('#block-category > ul > li > a').removeClass('active');
            $(this).addClass('active');
            $.cookie('select_cat', $(this).attr('id'));
            }
            else{
                
            $('#block-category > ul > li > a').removeClass('active');
            $('#block-category > ul > li > ul').slideUp(400);
            $.cookie('select_cat', '');
            }
    });
    if($.cookie('select_cat')!=''){
    $('#block-category > ul > li > #'+$.cookie('select_cat')).addclass('active').next().show();
}
});

//Скрипт по отправке забытого пароля используя е-маил   

    $(document).ready(function(){
       
      $('#button-remind').click(function(){
        var recall_email=$("#remind-email").val();
        if(recall_email==""||recall_email.length>20){
            $("#remind-email").css("borderColor","#FDB6B6");
        }      
        else{
            $("#remind-email").css("borderColor","#DBDBDB");
            $("#button-remind").hide();
            $(".auth-loading").show();
            
                $.ajax({
            type:"POST",
            url:"/include/remind-pass.php",
            data:"email="+recall_email,
            dataType:"html",
            cache: false,
            success: function(data){
                if(data=='yes'){
                     $(".auth-loading").hide();
                     $("#button-remind").show();
                     $('#message-remind').attr("class","message-remind-success").html("На Ваш e-mail выслан пароль.").slideDown(400);
                     setTimeout("$('#message-remind').html('').hide(),$('#block-remind').hide(),$('#input-email-pass').show()", 3000);
                     
                }
                else{
                    $(".auth-loading").hide();
                    $("#button-remind").show();
                    $('#message-remind').attr("class","message-remind-error").html(data).slideDown(400);
                }
                }
            });
        }
      });
});
//Скрипт по выпаданию меню изменения регистрационных данных   

   $(document).ready(function(){
        /*$('#auth-user-info').toggle(
        function(){
            $("#block-user").fadeIn(100);
        },
         function(){
            $("#block-user").fadeOut(100);
        }
        )*/
    
      $("#auth-user-info").click(function(){
    $("#block-user").slideToggle(200);
  });
});

//Скрипт по выходу из зарегестрированного пользователя    Выход    

   $(document).ready(function(){
   
    $('#logout').click(function(){
        $.ajax({
             type:"POST",
            url:"/include/logout.php",
            dataType:"html",
            cache: false,
            success: function(data){
                if(data == 'logout'){
                    location.reload();                     
                }
            }
            
        });
    }); 
});
//Скрипт по выпаданию списка с товарами в поиске
     $(document).ready(function(){
        
        $('#input-search').bind('textchange', function(){
            var input_search=$("#input-search").val();
            if(input_search.length >= 3 && input_search.length<=150){
        
         $.ajax({
            type:"POST",
            url:"/include/search.php",
            data:"text="+input_search,
            dataType:"html",
            cache: false,
            success: function(data){
                if(data > ''){
                    $("#result-search").show().html(data);                     
                }
                else{
                    $("#result-search").hide();
                }
            }
         });
      }
      else{
        $("#result-search").hide();
      }
   });
 });
 
 //Скрипт по проверке данных по доставке
     $(document).ready(function(){
       
        function isValidEmailAddress(emailAddress){
            var pattern=new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
        }
        $('#confirm-button-next').click(function(e){
            var order_fio=$("#order_fio").val();
            var order_email=$("#order_email").val();
            var order_phone=$("#order_phone").val();
            var order_address=$("#order_address").val();
        
        if(!$(".order_delivery").is(":checked")){
            $(".label_delivery").css("color","#E07B7B");
            send_order_delivery='0';
        }
        else{
           $(".label_delivery").css("color","black");
            send_order_delivery='1'; 
        }
     if(order_fio==""||order_fio.length>50){
            $("#order_fio").css("borderColor","#FDB6B6");
            send_order_fio='0';
        }
        else{
           $("#order_fio").css("borderColor","#DBDBDB");
            send_order_fio='1'; 
        }
        if(order_email==""||isValidEmailAddress(order_email)==false){
            $("#order_email").css("borderColor","#FDB6B6");
            send_order_email='0';
        }
        else{
           $("#order_email").css("borderColor","#DBDBDB");
            send_order_email='1'; 
        }
         if(order_phone==""||order_phone.length>50){
            $("#order_phone").css("borderColor","#FDB6B6");
            send_order_phone='0';
        }
        else{
           $("#order_phone").css("borderColor","#DBDBDB");
            send_order_phone='1'; 
        }
          if(order_address==""||order_address.length>150){
            $("#order_address").css("borderColor","#FDB6B6");
            send_order_address='0';
        }
        else{
           $("#order_address").css("borderColor","#DBDBDB");
            send_order_address='1'; 
        }
        if(send_order_delivery=="1" && send_order_fio=="1" && send_order_email=="1" && send_order_phone=="1" && send_order_address=="1"){
            return true;
        }
        e.preventDefault();
        });
        
        });
        
 //добавление товара в корзину
     $(document).ready(function(){
        loadcart();
        $('.add-cart-style-list,.add-cart-style-grid,.add-cart,.add-cart-style-random').click(function(){
        var tid=$(this).attr("tid");    
            $.ajax({
            type:"POST",
            url:"/include/addtocart.php",
            data:"id="+tid,
            dataType:"html",
            cache: false,
            success: function(data){
              loadcart();
            }
        });
     });
 
 
  //функция loadcart из добавления товаров в корзину
     
       function loadcart(){    
            $.ajax({
            type:"POST",
            url:"/include/loadcart.php",
            dataType:"html",
            cache: false,
            success: function(data){
              if(data=="0"){
                $("#block-basket > a").html("Корзина пуста");
              }
              else{
                $("#block-basket > a").html(data);
                
              }
            }
        });
     }
 
 
 //функция  по группировке цифр в цене по разрядам 
     
        function fun_group_price(intprice){
            //группировка цифр по разрядам
            var result_total=String(intprice);
            var lenstr=result_total.length;
            
            switch(lenstr){
                case 4:{groupprice=result_total.substring(0,1)+" "+result_total.substring(1,4); break;}
                case 5:{groupprice=result_total.substring(0,2)+" "+result_total.substring(2,5); break;}
                case 6:{groupprice=result_total.substring(0,3)+" "+result_total.substring(3,6); break;}
                case 7:{groupprice=result_total.substring(0,1)+" "+result_total.substring(1,3)+" "+result_total.substring(4,7); break;}
                default:{groupprice=result_total;}
            
            }
            return groupprice;
        }
 });
  
//добавление товара в корзине через + и -1111111111111111111111111111111111111
 
 $(document).ready(function(){
    
        $('.count-minus').click(function(){
            
        var iid=$(this).attr("iid");
              $.ajax({
            type:"POST",
            url:"/include/count-minus.php",
            data:"id="+iid,
            dataType:"html",
            cache: false,
            success: function(data){
              $("#input-id"+iid).val(data);
              loadcart();
        //переменная с ценой продукта
        var priceproduct=$("#tovar"+iid+" > p").attr("price");
        //цену умножаем на колличество товаров
        result_total=Number(priceproduct)* Number(data);
        
        $("#tovar"+iid+" > p").html(fun_group_price(result_total)+" грн");
        $("#tovar"+iid+" > h5 > .span-count").html(data);
              
         itog_price();     
            }
        });       
     });
  
  
 $('.count-plus').click(function(){
        var iid=$(this).attr("iid");
              $.ajax({
            type:"POST",
            url:"/include/count-plus.php",
            data:"id="+iid,
            dataType:"html",
            cache: false,
            success: function(data){
              $("#input-id"+iid).val(data);
              loadcart();
        //переменная с ценой продукта
        var priceproduct=$("#tovar"+iid+" > p").attr("price");
        //цену умножаем на колличество товаров
        result_total=Number(priceproduct)*Number(data);
        
        $("#tovar"+iid+" > p").html(fun_group_price(result_total)+" грн");
        $("#tovar"+iid+" > h5 > .span-count").html(data);
              
         itog_price();     
            }
        });       
     });
  
  
  $('.count-input').keypress(function(e){
    if(e.keyCode==13){
        var iid=$(this).attr("iid");
        var incount=$("#input-id"+iid).val();
              $.ajax({
            type:"POST",
            url:"/include/count-input.php",
            data:"id="+iid+"&count="+incount,
            dataType:"html",
            cache: false,
            success: function(data){
              $("#input-id"+iid).val(data);
              loadcart();
        //переменная с ценой продукта
        var priceproduct=$("#tovar"+iid+" > p").attr("price");
        //цену умножаем на колличество товаров
        result_total=Number(priceproduct)*Number(data);
        
        $("#tovar"+iid+" > p").html(fun_group_price(result_total)+" грн");
        $("#tovar"+iid+" > h5 > .span-count").html(data);
              
         itog_price();     
            }
        });
        }       
     });
     
  
 function itog_price(){
  $.ajax({
            type:"POST",
            url:"/include/itog_price.php",
            dataType:"html",
            cache: false,
            success: function(data){
            $(".itog-price > strong").html(data);
            }
        });
        }
        
  function loadcart(){    
  $.ajax({
            type:"POST",
            url:"/include/loadcart.php",
            dataType:"html",
            cache: false,
            success: function(data){
              if(data=="0"){
                $("#block-basket > a").html("Корзина пуста");
              }
              else{
                $("#block-basket > a").html(data);
                
              }
            }
        });
     }
  function fun_group_price(intprice){
            //группировка цифр по разрядам
            var result_total=String(intprice);
            var lenstr=result_total.length;
            
            switch(lenstr){
                case 4:{groupprice=result_total.substring(0,1)+" "+result_total.substring(1,4); break;}
                case 5:{groupprice=result_total.substring(0,2)+" "+result_total.substring(2,5); break;}
                case 6:{groupprice=result_total.substring(0,3)+" "+result_total.substring(3,6); break;}
                case 7:{groupprice=result_total.substring(0,1)+" "+result_total.substring(1,3)+" "+result_total.substring(4,7); break;}
                default:{groupprice=result_total;}
            
            }
            return groupprice;
        }
  });
  


 
 

    
    

 




 
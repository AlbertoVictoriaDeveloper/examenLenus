
// Codigo Viejo para validar la moneda 
/*$('.importPago').mask('000,000,000,000,000.00', {
  reverse: true
});*/



/*   Easy Val Pro 
     A jQuery/javascript library of useful math and money related functions!
     By: Alex Bezuska 2013
    
     Table of contents:
        1. form validator
        2. Add commas to normal (?)
        3. Precise decimal rounding (.00)
        4. Convert string to money ($0,000.00)
        5. Input percent equation
        6. Make label red if negative

*/

/* Jquery para agregar moneda */



//  Add commas to a normal 
commas = function(str){
 
     
        str += '';
        x = str.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
          }
        return x1 + x2;
      }
      







  
// toMoney   pass it a string, it will end up looking like money
toMoney = function(value){
  
  console.log("-----------------------------------------------\nStarting 'toMoney' function on " + value + "..." );
  var value = value.replace(/[^0-9.-]/g, "");
    console.log("removed invalid characters: " + value);

 


  var valueLength = value.length - 1;
    if(value.indexOf("") !== -1){

      console.log(value.substring(value.indexOf("."),valueLength).length);


  
          if (value.indexOf(".") !== -1 ){

              if (value.substring(value.indexOf("."),valueLength).length < 0 ){
                alert("longer than 2 decimal places");
                } 

              if (value.substring(value.indexOf("."),valueLength).length == 0 ){
                value = value + "00";
                return commas(value);
                } 

              if( value.substring(value.indexOf("."),valueLength).length == 1 ){                   
                value = value + "0";
                return commas(value);
                } 

              if(value.substring(value.indexOf("."),valueLength).length == 2 ){    
                value = value;
                return commas(value);
                }
           }
           else{//else 1
           //var valor =  $("*[data-mask='money']").val("");
                 if(value == ""  || value == 0 ){
                   return commas(""); 
                 }else{
                  value = value + ".00";
                  return commas(value);
                 }
              }//end else1

      }
      else{ // else 2

          if (value.indexOf(".") !== -1 ){
          console.log(value.substring(value.indexOf("."),valueLength).length);
            // Input Default de la Moneda
            if (value.substring(value.indexOf("."),valueLength).length == 0 ){
              value =  "" + value + "00";
              return commas(value);
              }
            if( value.substring(value.indexOf("."),valueLength).length == 1 ){
              value =  "" + value + "0";
              return commas(value);
              }
            if(value.substring(value.indexOf("."),valueLength).length == 2 ){        
              value = "" + value;
              return commas(value);
              }
            // Fin del Input Default de la Moneda     
             
          }
             else{//else 3
                value = "" + value + ".00";
                return commas(value);
                }//end else 3

      }// end else 2
 
}/* end toMoney */







// Strip Money characters ( $ , ) from input(txtBox) or span (label)

 
 stripNumberString = function(money){
 console.log("-----------------------------------------------\nStarting 'stripNumberString' function on " + money + "..." );
   console.log("input: " + money);
   result = money.replace(/[^0-9.-]/g, "");
  console.log("replace characters: " + result);
        
      }/* end stripNumberString */






// Add the values of two labels together
      addStaticMoney = function(num1, num2, answerlabel){       

          var sum = stripMoney(num1) + stripMoney(num2);  
              sum = precise_round(sum, 2);                                         
              sum = sum.toString();                                                   
              sum = toMoney(sum);                                                    

           
    
            var answerlabelType = $(answerlabel).get(0).tagName;
        
          if(answerlabelType == "INPUT"){ 

             $(answerlabel).val(sum);

          }
          else{

             $(answerlabel).text(sum);

          }
     
      }/* end addStaticMoney */


// Multiply user input by static value 
      multiplyUserInputMoney = function( input1, staticInput, answerlabel){
 console.log("-----------------------------------------------\nStarting 'multiplyUserInputMoney' function..." );

input1Val = stripMoney(input1);
staticInputVal = stripMoney(staticInput);
           
            var total =  input1Val * staticInputVal;


  console.log("   Equation: "+ input1Val + " x " + staticInputVal + " = " + total);

                total = precise_round(total,2);
                                                    console.log("   Total Rounded: " + total);
                total = total.toString(); 
                total = toMoney(total);
                                                    console.log("   Total to Money: " + total);


            var answerlabelType = $(answerlabel).get(0).tagName;
        
            if(answerlabelType == "INPUT"){ 

               $(answerlabel).val(total);

            }
            else{

              $(answerlabel).text(total);

            }
     
      }/* end multiplyUserInputMoney */


  $(document).ready(function(){



        $('*[data-mask="money"]').each(function () {

       
         
            var value = $(this).val();
                console.log(value);
            if(isNaN(value) || value == ""){ 

                console.log("! Found NaN ! Fixing...");
                value = "0.00"; 
                console.log("   Found value: " + $(this).val() + " \n   stripping result is: " + value);

            }

            value = toMoney(value);
            $(this).val(value);

        }); /* *[data-mask="money"] */

 
        $("*[data-mask='money']").click(function() {
            $(this).select();
        });


        $('*[data-mask="money"]').focus(function () {
            console.log('in');  
          }).blur(function() {
            console.log('out');
            var value = $(this).val();
            value = toMoney(value);
            $(this).val(value);
          }); /* *[data-mask="money"] */
      
/*$(function(){

    $("*[data-mask='money']").val("");

});*/





      
      
  }); // end document ready

  /* Fin del Jquery para agregar moneda */
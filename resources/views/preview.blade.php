<html>
<head>
<style>
      
    body{
        font-family: arial, sans-serif;
        font-size: 17px;
    }
    td,th{
        font-size: 12px;
    }
    
    table,p {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    background-color:white;
    }

/*    p.sign_student {
        margin-top:165;
       
        font-family: arial, sans-serif;
        font-size: 14px;
    }*/
  
    
</style>
 


</head>
<?php 
$str="Name: ".Auth::user()->stud_name;
$str.="\n Reg: ".Auth::user()->stud_registerno;

?>


<body>

     <center><img src="{{asset('storage/redemb.jpg')}}" alt="Logo" width="110" height="90" class="center"></center>
   
    <center> <b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</b></center>
    <center><p style="font-size: 13px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p></center>

   
              
              
        
                       <p style="text-align: right;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"> (Photo to be attested by HOD/CD)</p>

        
        
          
       
              <br><br> <br><br>
              
                   <table>
                        <tr> <td>{!!DNS2D::getBarcodeHTML($str, 'QRCODE','2','2')!!}</td></tr>
                        <tr><td style="text-align: right;"> <img src="{{asset('storage/digital_signature.jpg')}}" alt="sign"  width="150" height="50"></td></tr>
                        <tr><th style="text-align: right;">PRO-VICE CHANCELLOR</th></tr>
                    </table>   
            
            
           
        
</body>
</html>
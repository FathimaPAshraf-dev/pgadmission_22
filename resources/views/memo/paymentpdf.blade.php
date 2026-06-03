<html>
<head>
<style>
      
    body{
        font-family: arial, sans-serif;
        font-size: 17px;
    }
    td,th{
        font-size: 13px;
        text-align: left;
    }
    
    table,p {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    background-color:white;
    }
    table.tb_quali td{
        text-align: center;
    }
    li{
        font-size: 13px;
    }
/*    p.sign_student {
        margin-top:165;
       
        font-family: arial, sans-serif;
        font-size: 14px;
    }*/
  
    
</style>
 


</head>


<body>

     <center><img src="{{asset('storage/redemb.jpg')}}" alt="Logo" width="110" height="90" class="center"></center>
   
    <center> <b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</b></center>
    <center><p style="font-size: 13px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p></center>

   
                
                 <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 14px;">
                     <u><b>M.PHIL / PH.D ADMISSION 2020-21 </b></u> 
                 </p>
                 <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;">
                 Online Fee Receipt
                 </p>
                 <br>
                 <div class="col-sm-12">
                     <div class="card-body table-responsive" >
                         @foreach ($load as $key) 
                        <table border="1" class="table table-striped">
                        

                         <tr>
                            <th>Mode Of Payment  </th>
                             <td>Online</td>
                         </tr>   
                          <tr>
                            <th>Application Id </th>
                             <td>{{$key->adm_appid}}</td>
                         </tr> 
                          <tr>
                            <th>Student Name </th>
                             <td>{{$key->rank_stud_name}}</td>
                         </tr>  
                          <tr>
                            <th>Admitted Program </th>
                             <td>{{$key->adm_appname}}</td>
                         </tr> 
                        
                        
                          <tr>
                            <th>Admitted Centre</th>
                             <td>{{$key->allot_cent}}</td>
                         </tr> 
                          @endforeach
                          @foreach ($response as $key1) 
                          <tr>
                            <th>University Service name</th>
                             <td>{{$key1->ucity_service}}</td>
                         </tr> 
<!--                          <tr>
                            <th>Bank Name</th>
                             <td>{{$key1->res_bankname}}</td>
                         </tr>  -->
                          <tr>
                            <th>Transaction ID </th>
                             <td>{{$key1->merchanttxnid}}</td>
                         </tr>  
                          <tr>
                            <th>Date Of Payment</th>
                             <td>{{$key1->res_txn_date}}</td>
                         </tr> 
                          <tr>
                            <th>Bank Ref. No</th>
                             <td>{{$key1->res_bid}}</td>
                         </tr> 
                          <tr>
                            <th>Admission fee </th>
                             <td>{{$key1->trans_amt}}</td>
                         </tr>  
                          <tr>
                            <th>Transaction Status</th>
                             <td>{{$key1->res_verified}}</td>
                     
                        </tr>
                       

                        </table>
                         @endforeach
                     </div>
                     </div>
              

  <p style="font-size: 11px;"><i>Document generated on:{{$curnt_date}} {{$time}}</i></p>         
</body>
</html>
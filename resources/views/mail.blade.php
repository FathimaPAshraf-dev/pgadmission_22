<html>
<head>


<style type="text/css">
    #table1{
         font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
 
    }
    
    
 
#table1 th {
  padding-top: 15px;
  padding-bottom: 15px;
  text-align: center;
  background-color: #6b174e;
  color: white;
 font-size: 15px;

}   
#table1 td {
 
     background-color:  #e6e1e3;
     

}   

#table1 td, #table1 th {
  border: 1px solid #ddd;
  padding: 12px;
  text-align: center;
  font-size: 15px;
 

}
#table1 tr:nth-child(even){background-color: #f2f2f2;}

#table1 tr:hover {background-color: #ddd;}

  #table2{
         font-family: "Times New Roman", Times, serif;
          border-collapse: collapse;
 
    }
 
#table2 th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #e6e1e3;
  color: white;
  font-size: 17px;
  border: 1px solid #ddd;
  padding: 8px;
}   

#table2 td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
  font-size: 14px;

}
#table2 tr:nth-child(even){background-color: #f2f2f2;}

#table2 tr:hover {background-color: #ddd;}

</style>
</head>
<p style="font-size: 15px;"><b>Respected Sir,</b></p>
<p style="font-size: 15px; color: black"><b>Details of Student</b></p>
<div class="form-group">
  <table class="table table-bordered" id="table1" border="1">
  <thead>
    <tr>
      <th scope="col">Register Number</th>
      <th scope="col">Email</th>
      <th scope="col">Contact Number</th>
   </tr>
  </thead>
  <tbody>
    <tr>
   
        <td><b><font color="black">{{$stud_regno}}</font></b></td>
      <td><b><font color="black">{{$stud_email}}</font></b></td>
      <td><b><font color="black">{{$stud_mob}}</font></b></td>
    </tr>
  
  </tbody>
</table>
</div>
<br><br>
<div class="form-group">
  <table class="table table-bordered" id="table2" border="1">
  <thead>
    <tr>
        <th><font color="black"><b>Subject&nbsp; :&nbsp; {!! $subject !!}</b></font></th>
   </tr>
    <tr>
     <td><font color="black">{!! $msg !!}</font></td>
   </tr>
  </thead>
 
</table>
</div>
</html>



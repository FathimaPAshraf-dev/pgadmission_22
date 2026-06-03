     
    
    <table id="exam" class="table table-bordered table-hover" >
                                <thead>
                             
                                <th>Exam Name</th>
                                <th>Exam Month</th>
                                <th>Exam Year</th>
                                <th>Hallticket Status</th>
                                 <th><input type="checkbox" name="select_all" value="1" id="select-all"></th>
                                </thead>
                                @foreach($exam as $key)
                                <tr>
                                    <td>{{$key->exam_name}}</td>
                                    <td>{{$key->exam_month}}</td>
                                    <td>{{$key->exam_year}}</td>
                                    <td>{{$key->hallticket_status}}</td>
                                    <td><input type="checkbox" name="examcheck" id="examcheck" value=""></td>
                                </tr>
                                
                                @endforeach
                              
    </table>
<button type="submit" name="" id="frm-exam" value="">Submit</button>
    


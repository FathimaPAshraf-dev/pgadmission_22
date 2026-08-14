<html>

<head>
    <style>
    body {
        font-family: arial, sans-serif;
        font-size: 17px;
    }

    td,
    th {
        font-size: 13px;
        text-align: center;
    }

    table,
    p {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        background-color: white;
    }

    li {
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

    <center><img src="{{public_path("storage/redemb.jpg")}}" alt="Logo" width="110" height="90" class="center"></center>

    <center> <b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</b></center>
    <center><b style="font-size: 13px;font-family:arial, sans-serif;">NAAC Re-accredited with A+ Grade</b></center>
    <center>
        <p style="font-size: 13px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p>
    </center>



    <p style="text-align: center;  font-family: arial, sans-serif;font-size: 14px;">
        <u><b>PG ADMISSION 2026- FEE RECEIPT</b></u>
    </p>

    <div class="col-sm-12">
        <div class="card-body table-responsive">
            <table border="1" class="table table-striped">


                <tr>
                    <th>Name</th>
                    <th>Application ID</th>
                    <th>Community</th>
                    <th>Programme</th>
                    <th>Allotted Centre</th>
                    <th>Admission Fee</th>
                    <th>Fee Paid at</th>

                </tr>

                <tr>
                    @foreach($details as $key)
                    <td style="text-align: center;">{{$key->pgapp_name}}
                    </td>

                    <td style="text-align: center;">{{$key->pgapp_id}} </td>
                    <td style="text-align: center;">{{$key->pgapp_community}}</td>
                    <td style="text-align: center;">{{$key->pgm}}</td>

                    <td style="text-align: center;">{{$key->centre}}</td>
                    <td style="text-align: center;">{{$key->adm_fees}}</td>
                    @if(isset($key->transferred_centre))
                    <td style="text-align: center;">{{$key->transferred_centre}}</td>
                    @else
                    <td style="text-align: center;">{{$key->centcode}}</td>
                    @endif
                    @endforeach
                </tr>

            </table>

        </div>
    </div>
    <p style="font-size: 13px;text-align: center""><u><b>Admission Fee Structure</b></u></p>
                 <div class=" col-sm-12">
    <div class="card-body table-responsive">
        <table border="1" class="table table-striped">
            <tr>
                <th>Fee Code</th>
                <th>Fee Description</th>
                <th>Amount</th>
            </tr>


            @foreach($feestructure as $key)
            <tr>
                <td style="text-align: center;">{{$key->feecode}}</td>

                <td style="text-align: center;">{{$key->fee_desc}} </td>
                <td style="text-align: center;">{{$key->amount}} </td>
            </tr>
            @endforeach




        </table>

    </div>
    </div>

    <p style="font-size: 13px;text-align: center"><u><b>Payment Details</b></u></p>
    <table class="" border="1">
        <tr>
            <td>Mode of Payment</td>
            @foreach($details as $key)
            @if($key->pgapp_id == 'ADMPG2500555' || $key->pgapp_id == 'ADMPG2502930' || $key->pgapp_id == 'ADMPG2503118'
            || $key->pgapp_id == 'ADMPG2502247' || $key->pgapp_id == 'ADMPG2501458' || $key->pgapp_id == 'ADMPG2500899'
            || $key->pgapp_id == 'ADMPG2500692')
            <td>Offline</td>
            @else
            <td>Online</td>
            @endif
            @endforeach
        </tr>

        @foreach($admfee as $key)
        <tr>
            <td>Application Number</td>
            <td>{{$key->client_code}}</td>
        </tr>
        <tr>
            <td>University Transaction id</td>
            <td>{{$key->tid}}</td>
        </tr>
        <tr>
            <td>University Service name</td>
            <td>{{$key->ucity_service}}</td>
        </tr>
        
        <tr>
            <td>Date of payment</td>
            <td>{{ $key->tdate}}</td>
        </tr>
        <tr>
            <td>OrderID</td>
            <td>{{$key->order_id}}</td>
        </tr>

        <tr>
            <td>Pay Amount</td>
            <td>{{$key->amount}}</td>
        </tr>
        <tr>
            <td>Payment Status</td>
            <td>
               Sucesss
            </td>
        </tr>

        @endforeach

    </table>




    <p style="font-size: 11px;"><i>Document generated on : {{$curnt_date}} {{$timenow}}</i></p>

</body>

</html>
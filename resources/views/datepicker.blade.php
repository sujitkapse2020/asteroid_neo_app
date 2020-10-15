{{-- @extends('master') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}} ">    

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />   

    <title>{{ $title }}</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="mt-5">
                <h2>Asteroid Neo -  Chart date</h2>
                <hr>                
                <br><br>

                 <form action="{{url('get_chart_date')}}" method="post"> 
                    {{ csrf_field() }}

                    <label>Select Date</label> 
                    <input type="text" class=" ml-3" name="chart_date" id="select_date">
                    <input type="submit" value="Submit">
                </form>
                <i style="color:red">{{ !empty($error) ? $error : '' }}</i>
            </div>
        </div>

    </div>
    <script src="{{asset('js/app.js')}} "></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
   
        <script>
            $(function() {
                $('input[name="chart_date"]').daterangepicker({
                    opens: 'left'
                }, function(start, end, label) {
                        console.log("A new date selection was made: " + start.format('yyyy-mm-dd') + ' to ' + end.format('yyyy-mm-dd'));
                });
        });
        </script>
   
</body>

</html>
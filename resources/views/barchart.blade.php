{{-- @extends('master') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">


    <title>{{ $title }}}</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="mt-5">
    <h2>Asteroid Neo -  Chart details</h2>
    <hr>
    <a href="{{url('show_chart_date')}}">Back</a>
    <br><br>
    <ul>
        <li> Fastest Asteroid Id :&nbsp;&nbsp;{{$fastestAseroidId }}</li>
        <li> Fastest Asteroid Speed(in KM/Hour) :&nbsp;&nbsp;{{ $fastestAseroid}}</li>
         <li>Closest Asteroid Id :&nbsp;&nbsp; {{$closestAseroidId }}</li>  
         <li>Closest Asteroid Distance(in KM) :&nbsp;&nbsp; {{$closestAseroid}}</li>     
    </ul>
    <br>
  
    <div style="width: 700px;height: 700px;" >
        <canvas id="myChart" width="400" height="400" style="border: solid;color: red;"></canvas>
    </div>
    </div>

</div>

</div>


    <script src="{{asset('js/app.js')}} "></script>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

    <script>
        var noOfAstroids = <?php  echo json_encode($neo_count_by_date_arry_values); ?>;
        var astroidsAppeardate = <?php  echo json_encode($neo_count_by_date_arry_keys); ?>;
       //alert(astroidsAppeardate[0]);
        
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:astroidsAppeardate,
                //labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [
                    {
                        label: '# of Asteroids',
                        // lineTension:1,
                        data: noOfAstroids,
                        //data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>

</html>
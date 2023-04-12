@extends('template')
@section('styles')
  @parent

  <link rel="stylesheet" href="public/css/stylePrev.css">
  <link rel="stylesheet" href="{{ asset('public/css/stylePrev.css') }}">
  <style>
   .container{
    background-color: #00A0E0;            /*  // #87BB34; */
    color:#FDF8F8;
    height:100vh;
    width:100%;
    }

   h2{
   padding-top: 20px;
    text-align: center;
    color: #19647E;
   }

    .table {
    margin:30px auto;
    align-items: center;
    border-collapse: collapse;
    width: 80%;
    max-width: 80%;
    text-align: center;
    background-color: #19647E;

    border-radius: 20px;
    /* color:  #FDF8F8;   */                     /*  #CF004B; */
  }
/*
    th,td,tr,tbody,thead{
    border-radius: 20px;

} */

#chart_div{
    width: 80%;
    margin:30px auto;
    max-width: 80%;
    align-items: center;
}
      #chart_div svg {
    border-radius: 20px;
    width: 100%;
    align-items: center;
    }
  </style>


@endsection
@section('contenu')


@if (isset($error))
        @if ($error == 1)
            <p>Erreur, la base de données est inaccessible</p>
        @elseif ($error == 2)
            <p>Veuillez choisir une ville existante</p>
        @endif
    @elseif (isset($data))

    @php
    $heure = ltrim(\Carbon\Carbon::now()->format('H'), '0');
    $data = json_decode($data->json);
    @endphp

<h2>A {{ $data->city_info->name }} le {{ $data->current_condition->date }}</h2>

   {{--  <h1>{{ $data->city_info->name }}</h1>
<h2>{{ $data->current_condition->date }}</h2> --}}
<div id="chart_div" style="width: 100%; height: 500px"></div>

<table class ="table">
    <tr>
      @foreach (range(0,4) as $i)
      <th>{{$data->{'fcst_day_'. $i}->day_long}}</th>
      @endforeach
    </tr>
    <tr>
      @foreach (range(0,4) as $i)
      <td><img src="{{$data->{'fcst_day_'. $i}->icon}}" alt="Icone du temps"></td>
      @endforeach
    </tr>
    <tr>
      @foreach (range(0,4) as $i)
      <td>{{$data->{'fcst_day_'. $i}->tmin}}°C / {{$data->{'fcst_day_'. $i}->tmax}}°C</td>
      @endforeach
    </tr>

  </table>



@endif

@endsection

@section('scripts2')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

    var data = {!! json_encode($data) !!};
    console.log(data);
    var dataArray = [  ['Heure', 'Température']
];

for (var i = 0; i <= 23; i++) {

    var heure = i + 'H';
  var temperature = data.fcst_day_0.hourly_data[heure + '00'].TMP2m;
  dataArray.push([heure, temperature]);


}

console.log(dataArray);
 function drawChart() {
    var data = google.visualization.arrayToDataTable(dataArray);

    var options = {
            title: 'Previsionnel des T°C de la journée',
            titleTextStyle: {
            color: '#FDF8F8'
            },
            width: '100%',
            height: 'auto',
            titlePosition: 'center',
            curveType: 'function',
            legend: { position: 'bottom' },
            legendTextStyle: {
             color: '#FDF8F8'
             },
            backgroundColor: '19647E',

            series: {
                 0: { color: '#ffff00',labels: { show: true } },
                 1: { color: '#19647E' },
                lineWidth: 0
                },
            hAxis: {
                baselineColor: 'transparent',
                gridlines: {color: 'transparent'},
                textStyle: {color: '#FDF8F8'},

            },
            vAxis: {
             baselineColor: 'transparent',
            gridlines: { color: 'transparent' },
            textStyle: {color: '#FDF8F8'},
             fontSize:6
            }
        };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);

  }

</script>

@endsection

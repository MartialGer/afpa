@extends('template')

@section('content')

   <div class="h-screen w-screen relative flex flex-col" style="background-color:#00A0E0">

    @if (isset($error))
      @if ($error == 1)
        <p class="pt-20 text-center" style="color:#FDF8F8">Erreur, la base de données est inaccessible</p>
      @elseif ($error == 2)
        <p class="pt-20 text-center" style="color:#FDF8F8">Veuillez choisir une ville existante</p>
      @endif

    @elseif (isset($data))

      @php
        $heure = ltrim(\Carbon\Carbon::now()->format('H'), '0');
        $data = json_decode($data->json);
      @endphp

      <div class="mt-5 mx-auto inline-block border-2 border-solid border-black rounded-lg" style="background-color:#19647E">
         <h1 class="p-5 text-center text-4xl" style="color:#FDF8F8;">A {{ $data->city_info->name }} le {{ \Carbon\Carbon::parse($data->current_condition->date)->locale('fr_FR')->isoFormat('dddd D MMMM') }}</h1>
      </div>

      <div id="chart_div" class="p-5 mx-auto max-w-80 h-500 w-4/5 rounded-lg border-2 border-solid border-black" style="height: 40%; margin-top: 3%; background-color:#19647E"></div>

      <div class="p-5 m-10 mx-auto max-w-80 w-4/5 rounded-lg border-2 border-solid border-black" style="background-color:#19647E">
       <table class="col-12 col-sm-6 col-lg-4 mx-auto items-center border-collapse bg-blue-gray-600 overflow-hidden w-4/5">
          <tr>
            @foreach (range(0,4) as $i)
            <th class="text-center" style="color:#FDF8F8">{{ $data->{'fcst_day_'. $i}->day_long }}</th>
            @endforeach
          </tr>
          <tr>
            @foreach (range(0,4) as $i)
              <td class="text-center"><img class="object-contain rounded-lg w-1/2 mx-auto" src="{{ $data->{'fcst_day_'. $i}->icon }}" alt="Icone du temps"></td>
             @endforeach
          </tr>
          <tr>
            @foreach (range(0,4) as $i)
             <td class="text-center" style="color:#FDF8F8">{{ $data->{'fcst_day_'. $i}->tmin }}°C / {{ $data->{'fcst_day_'. $i}->tmax }}°C</td>
            @endforeach
          </tr>
        </table>
      </div>
    @endif
  </div>
@endsection

@section('scripts')
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
            title: 'Previsionnel des température de la journée',
            titleTextStyle: {
            color: '#fdf8f8'
            },
            width: 'auto',
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
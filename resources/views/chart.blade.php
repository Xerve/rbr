

@extends('app')

@section('header_script')

<link href="{{ asset('css/apexcharts.css') }}" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/apexcharts.min.js') }}"></script>


<style type="text/css">
    section {
        padding:20px;
        min-width: 800px;
    }
</style>

@endsection


@section('content')
<section>

	<div id="chart">
	</div>
    
</section>

<script type="text/javascript">
  
        var options = {
          series: [{
          name: 'Ilość postów',
          data: [
          @foreach($posts as $post)
          {{$post->count_posts}}
          @if(!$loop->last),@endif
          @endforeach
          ]
        }],
        chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            columnWidth: '50%',
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: 2
        },
        
        grid: {
          row: {
            colors: ['#fff', '#f2f2f2']
          }
        },
        xaxis: {
          labels: {
            rotate: -45
          },
          categories: [
           @foreach($posts as $key => $post)
	          '{{$key}} {{$post->author->name}}'
	          @if(!$loop->last),@endif
	          @endforeach
          ],
          tickPlacement: 'on'
        },
        yaxis: {
          title: {
            text: 'Najpopularniejsi użytkownicy z ostatnich 7 dni',
          },
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: "horizontal",
            shadeIntensity: 0.25,
            gradientToColors: undefined,
            inverseColors: true,
            opacityFrom: 0.85,
            opacityTo: 0.85,
            stops: [50, 0, 100]
          },
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      

</script>

@endsection

@extends('layouts.inicio')
@section('title', 'Resumen de Ventas')
@section('css')

@endsection

@section('content')
<div class="container">
    <section class="invoice-edit-wrapper section">
        <div class="card">
            <div class="card-content">
                <div class="input-field col s12">
                    <select onchange="consultaMes(this)">
                        @foreach ($meses as $key=>$item)                            
                        <option value="{!!$key+1  <10 ? '0'.$key+1  : $key+1 !!} ">{!!$item !!}</option>
                        @endforeach
                       
                    </select>
                </div>

                <div id="grafico" class="col s12">

                </div>
            </div>
        </div>
    </section>
</div>
@endsection



@section('scripts')
<script src="{{ asset('js/chartjs/chart.min.js') }}"></script>



<script type="text/javascript">
    $(document).ready(function() {
        let nombre_mes=  $("select option:selected");

     consultaMes(nombre_mes);
    });

    function consultaMes(mes) {
        let mes_seleccionado= $(mes).val();
        let nombre_mes=  $("select option:selected").text();
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/ventas/resumen',
            type: "post",
            dataType: "json",
            data : {mes_seleccionado : mes_seleccionado,
                nombre_mes:nombre_mes},
            success: function(data) {
                grafico(data);
            },
            cache: false
        });
    }

    function grafico(data) {

        Highcharts.chart('grafico', {
            chart: {
                type: 'area'
            },
            title: {
                text: 'Ventas Totales Mes: <b>$'+data.series.totalVentas
            },
            subtitle: {
                text: 'Mes Seleccionado: <b>'+data.series.name
                },
            
            xAxis: {
                categories: data.categories
            },
            tooltip: {
                pointFormat: 'Total: <b>${point.y}</b>'
            },
            legend: {
                  
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {

                area: {
                    stacking: 'normal',
                    lineColor: '#4527a0',
                    lineWidth: 2,
                    marker: {
                        lineWidth: 2,
                        lineColor: '#4527a0'
                    }
                }
            },


            series: [data.series],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    }
</script>
@endsection
@extends('template')

@section('currentPageName')
    Home
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 border rounded border-dark p-3 m-2">
                <p class="text-center">Number of assets per asset type</p>
                <hr>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/colors.js') }}"></script>

    <script>
        const data = @json($numberOfAssetsPerAssetType['data']);

        const ctx = document.getElementById('myChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($numberOfAssetsPerAssetType['labels']),
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    borderWidth: 1,
                    hoverOffset: 25,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 12,
                                weight: 'bold',
                            },
                            color: '#333',
                            boxWidth: 12,
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#fff',
                        borderWidth: 1,
                        caretSize: 8,
                        padding: 10,
                    }
                },
                elements: {
                    arc: {
                        borderWidth: 0,
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                },
                cutout: '50%',
            }
        });
    </script>
@endsection

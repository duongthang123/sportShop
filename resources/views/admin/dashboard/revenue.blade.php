@extends('admin.layouts.index')

@section('title', 'Thống kê doanh thu')
@section('content')
    <div class="card-body">
        <h1>Thống kê doanh thu</h1>
        <div class="card-body table-responsive p-0">
            <div class="row">
                <div class="col-6 mb-4 mt-2">
                    <form action="{{route('dashboard.revenue-day')}}" method="POST" class="d-flex justify-content-start">
                        @csrf
                        <div class="form-group">
                            <input type="date" name="key"
                                   @if(isset($date)) value="{{ $date }}" @endif
                                   class="form-control" placeholder="Tìm kiếm đơn hàng">
                        </div>
                        <button type="submit" class="btn btn-primary" style="max-height: 38px; margin-left: 4px">Tìm kiếm</button>
                    </form>
                </div>
                <div class="col-6 mb-4 mt-2">
                    <form action="{{route('dashboard.revenue-month')}}" method="POST" class="d-flex justify-content-start">
                        @csrf
                        <div class="form-group">
                            <select name="month" class="form-control"
                                    style="cursor: pointer; max-width: 240px">
                                <option selected>Theo Tháng</option>
                                @foreach(config('const.month') as $key => $monthName)
                                    <option value="{{$key}}"
                                        @if(isset($month)) {{ $month == $key ? 'selected' : '' }} @endif
                                    >{{$monthName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="max-height: 38px; margin-left: 4px">Lọc</button>
                    </form>
                </div>
            </div>


            <h4 style="font-weight: 550">
                {{ isset($title) ? $title : '' }}
            </h4>
            @if(isset($results))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 200px;">Số đơn hàng</th>
                            <th>Tổng doanh thu</th>
                            <th style="width: 200px">Số đơn thành công</th>
                            <th style="width: 200px">Số đơn hủy</th>
                        </tr>
                    </thead>

                    <tbody>
                            <tr style="">
                                <td style="width: 200px;">{{ $results['total_orders'] }}</td>
                                <td>{{ number_format($results['total_money']) }}</td>
                                <td style="width: 200px">{{ $results['successful_orders'] }}</td>
                                <td style="width: 200px">{{ $results['cancelled_orders'] }}</td>
                            </tr>
                    </tbody>
                </table>
            @endif


            @if(isset($revenues))
                <h3 class="header">Biểu đồ doanh thu</h3>
                <canvas id="revenueChart" width="400" height="200"></canvas>
            @endif
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @if(isset($revenues))
        <script>
            var ctx = document.getElementById('revenueChart').getContext('2d');
            var revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($months) !!},
                    datasets: [{
                        label: 'Doanh thu theo tháng',
                        data: {!! json_encode($revenues) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endif

@endpush

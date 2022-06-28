@extends('layouts.admin')
@section('header', 'Home')

@section('content')

<div class="row">
	<div class="col-lg-3 col-6">
		<div class="small-box bg-info">
			<div class="inner">
				<p>Total Buku</p>
			</div>
			<div class="icon">
				<i class="fa fa-book"></i>
			</div>
			<a href="{{ url('buku') }}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-lg-3 col-6">
		<div class="small-box bg-success">
			<div class="inner">
				
				<p>Total Anggota</p>
			</div>
			<div class="icon">
				<i class="fa fa-book"></i>
			</div>
			<a href="{{ url('anggota') }}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-lg-3 col-6">
		<div class="small-box bg-warning">
			<div class="inner">
				
				<p>Data Penerbit</p>
			</div>
			<div class="icon">
				<i class="fa fa-book"></i>
			</div>
			<a href="{{ url('penerbit') }}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-lg-3 col-6">
		<div class="small-box bg-danger">
			<div class="inner">
				
				<p>Data Peminjaman</p>
			</div>
			<div class="icon">
				<i class="fa fa-book"></i>
			</div>
			<a href="{{ url('peminjam') }}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="card card-danger">
			<div class="card-header">
				<h3 class="card-title">Grafik Penerbit</h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-times"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				<canvas id="donutChart" style="min-height: 250px; min-height: 250px; max-height: 250px; max-width: 100%;"></canvas>
			</div>
		</div>
		
	</div>

	<div class="col-lg-6">
		<div class="card card-success">
			<div class="card-header">
				<h3 class="card-title">Grafik Peminjaman</h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-card-widget="remove">
						<i class="fas fa-times"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="chart">
					<canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
<script src="{{ asset('assets../../plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/char.js/Chart.min.js') }}"></script>
<script type="text/javascript">

</script>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>
<table class="table">
	<thead>
	  <tr>
		<th scope="col">Tanggal</th>
		<th scope="col">MasukQty</th>
		<th scope="col">KeluarQty</th>
		<th scope="col">SaldoQty</th>
		<th scope="col">MasukRp</th>
		<th scope="col">KeluarRp</th>
		<th scope="col">SaldoRp</th>
	  </tr>
	</thead>
	<tbody>
	@foreach($kartuStok as $m)
	  <tr>
		<th scope="row">{{$m->tanggal}}</th>
		<td>{{$m->masuk}}</td>
		<td>{{$m->keluar}}</td>
		<td>{{$m->saldoQty}}</td>
		<td>{{number_format($m->masukRp)}}</td>
		<td>{{number_format($m->keluarRp)}}</td>
		<td>{{number_format($m->saldoRp)}}</td>
	  </tr>
	  @endforeach
	</tbody>
  </table>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
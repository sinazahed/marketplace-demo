<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OrderShipped</title>
</head>
<body>
    <!DOCTYPE html>
<html>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>

<h2>سفارش جدید</h2>

<p>یک سفارش جدید توسط {{ $user->name }} برای شما ثبت شده است</p>
<table style="width:100%">
  <tr>
    <th>محصولات</th>
    <th>قیمت</th>
    
  </tr>
  
  @foreach ($products as $product)
    <tr>
        <td>{{ $product->title }}</td>
        <td>{{ number_format($product->price) }}</td>
    </tr>
  @endforeach
</table>
<h4>مبلغ کل سفارش {{number_format( $order->total) }} تومان<h4>  


</body>
</html>
</body>
</html>
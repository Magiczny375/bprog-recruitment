<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista produktów</title>
    <style>
        table {
            border:1px solid #b3adad;
            border-collapse:collapse;
            padding:5px;
        }
        table th {
            border:1px solid #b3adad;
            padding:5px;
            background: #f0f0f0;
            color: #313030;
        }
        table td {
            border:1px solid #b3adad;
            text-align:center;
            padding:5px;
            background: #ffffff;
            color: #313030;
        }
    </style>
</head>
<body>
<center>
<table>
    <thead>
    <tr>
        <th width="50%">ID</th>
        <th>Nazwa</th>
        <th>Cena</th>
    </tr>
    </thead>
    <tbody>
    @forelse($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            @isset($product->discountPrice()->value)
            <td>{{ $product->discountPrice()->value }}PLN (<del>{{ $product->standardPrice()->value }}PLN</del>)</td>
            @else
            <td>{{ $product->standardPrice()->value }}PLN</td>
            @endisset
        </tr>
    @empty
        <tr>
            <td colspan="3">Brak danych w bazie.</td>
        </tr>
    @endforelse
    </tbody>
</table>
</center>
</body>
</html>

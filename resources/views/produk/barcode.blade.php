<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>
    <style>
        .text-center {
            text-align: center;
            border: 1px solid #bbbbbb;
        }
        .barcode{
            margin-left: 26px;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            @foreach ($dataProduk as $produk)
                <td class="text-center">
                    <p>{{ $produk->nama_produk }} - Rp. {{ format_uang($produk->harga_jual) }}</p>
                    <img src="data:image/png;base64, {{ DNS1D::getBarcodePNG("$produk->kode_produk", 'C39') }}" alt="{{ $produk->kode_produk }}" height="60" width="180"/>
                    {{ $produk->kode_produk }}
                </td>
                @if ($no++ % 3 == 0)
                    <tr></tr>
                @endif
            @endforeach
        </tr>
    </table>
</body>
</html>
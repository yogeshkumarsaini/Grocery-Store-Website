<?php

require 'vendor/autoload.php';

use Dompdf\Dompdf;

include 'config/db.php';

$order_id = (int)$_GET['id'];

$order = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM orders WHERE id='$order_id'")
);

$items = mysqli_query($conn,
"SELECT oi.*,p.product_name
FROM order_items oi
JOIN products p
ON oi.product_id=p.id
WHERE order_id='$order_id'");

$html='
<h2>Invoice #'.$order_id.'</h2>
<hr>
';

$html.='
<table border="1"
width="100%"
cellpadding="8">

<tr>
<th>Product</th>
<th>Qty</th>
<th>Price</th>
</tr>
';

while($item=mysqli_fetch_assoc($items))
{
$html.='
<tr>
<td>'.$item['product_name'].'</td>
<td>'.$item['quantity'].'</td>
<td>'.$item['price'].'</td>
</tr>
';
}

$html.='</table>';

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4');

$dompdf->render();

$dompdf->stream(
"invoice-$order_id.pdf"
);
<?
header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=orders.csv');
echo "\xEF\xBB\xBF"; // UTF-8 BOM

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Клиент', 'Телефон', 'E-mail', 'Товар', 'Цена', 'Количество', 'Итог. стоимость'),";");

//$data = $model->search()->getData();
$data = Order::model()->findAll();
foreach ($data as $row)
{
    foreach ($row->products as $product)
    {
        $result = [];
        $result[] = $row->name;
        $result[] = $row->phone;
        $result[] = $row->email;
        $result[] = $product->product_name;
        $result[] = $product->price;
        $result[] = $product->quantity;
        $result[] = $product->getTotalPrice();
        fputcsv($output, $result, ";");
    }
}


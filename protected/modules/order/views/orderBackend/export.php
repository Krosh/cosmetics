<?
header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=orders.csv');
echo "\xEF\xBB\xBF"; // UTF-8 BOM

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('№ заказа', 'Дата заказа', 'Статус заказа', 'Клиент', 'Телефон', 'E-mail', 'Товар', 'Цена', 'Количество', 'Стоимость доставки', 'Скидка по промокоду', 'Итог. стоимость',
    'Способ оплаты','Статус оплаты','Способ доставки','Адрес доставки','Комментарий'),";");

//$data = $model->search()->getData();
$data = Order::model()->findAll();
/** @var Order $row */
foreach ($data as $row)
{
    /** @var Product $product */
    foreach ($row->products as $product)
    {
        $result = [];

        $result[] = $row->id;
        $result[] = $row->date;
        $result[] = $row->status->name;
        $result[] = $row->name;
        $result[] = $row->phone;
        $result[] = $row->email;
        $result[] = $product->product_name;
        $result[] = $product->price;
        $result[] = $product->quantity;
        $result[] = $row->delivery_price;
        $result[] = $row->coupon_discount;
        $result[] = $row->getTotalPriceWithDelivery();
        $result[] = $row->payment->name;
        $result[] = $row->getPaidStatus();
        $result[] = $row->delivery->name;
        $result[] = $row->getAddress();
        $result[] = $row->comment;
        fputcsv($output, $result, ";");
    }
}


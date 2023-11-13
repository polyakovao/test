<?php
require_once 'connection.php';

class Goods extends Connection
{
    public function loadGoods()
    {
        $dbh = $this->setConnection();
        /*
         * i'm not shure about do it exactrly in ONE select. And as for me it much better do
         * select like:
         * select goods.name, additional_fields.name, additional_field_values.name ...etc
            from goods, additional_goods_field_values, additional_fields, additional_field_values
            where additional_goods_field_values.additional_field_id = additional_fields.id
              and additional_goods_field_values.additional_field_value_id = additional_field_values.id
              and goods.id = additional_goods_field_values.good_id
         * and then fetch it all and rebuild in php, just because its more simple to understand
         * so if i'm wrong at select plz contact with task details, i'm sure i can do in any way it will be described
        */
        $sql = "
            WITH agr as(
                select good_id, additional_goods_field_values.additional_field_id, additional_goods_field_values.additional_field_value_id, additional_fields.name as af_name, additional_field_values.name  as afv_name
                from additional_goods_field_values, additional_fields, additional_field_values
                where additional_goods_field_values.additional_field_id = additional_fields.id
                  and additional_goods_field_values.additional_field_value_id = additional_field_values.id
            )
            SELECT goods.name,
                   (select af_name from agr where agr.good_id = goods.id and agr.additional_field_id = 1) as name1,
                   (select afv_name from agr where agr.good_id = goods.id and agr.additional_field_id = 1) as caption1,
                   (select af_name from agr where agr.good_id = goods.id and agr.additional_field_id = 2) as name2,
                   (select afv_name from agr where agr.good_id = goods.id and agr.additional_field_id = 2) as caption2
            FROM goods
            ;
        ";

        $stmt = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($stmt);
    }
}

$goods = new Goods();
echo $goods->loadGoods();

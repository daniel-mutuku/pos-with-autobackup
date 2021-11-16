ERROR - 2021-11-16 14:09:16 --> 
ERROR - 2021-11-16 14:09:43 --> 1
ERROR - 2021-11-16 14:10:25 --> Query error: Unknown column 'effecr' in 'where clause' - Invalid query: SELECT SUM(`amount`) AS `amount`
FROM `product_adjustments`
WHERE `product_id` = '1'
AND `effecr` = 'add'
ERROR - 2021-11-16 14:10:25 --> Severity: error --> Exception: Call to a member function row_array() on boolean C:\xampp\htdocs\project\app\models\Inventory_model.php 136
ERROR - 2021-11-16 15:01:49 --> Severity: error --> Exception: Call to undefined method Inventory_model::paysupplier() C:\xampp\htdocs\project\app\controllers\Inventory.php 301

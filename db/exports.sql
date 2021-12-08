
INSERT INTO `suppliers` (`name`, `email`, `id_no`, `phone_no`, `location`, `branch_id`, `id`) VALUES ('Daniel Mutuku', 'mike@gmail.com', '36474358', '0724654191', 'Nairobi, Kenya', '2', '205825298');

INSERT INTO `product_adjustments` (`product_id`, `amount`, `effect`, `type`, `id`) VALUES ('262562760', '10', 'add', 'stock_purchase', '206212169');

INSERT INTO `supplier_supplies` (`supplier_id`, `total_price`, `adjustment_id`, `id`) VALUES ('205825298', '150000', 206212169, '206218327');

INSERT INTO `clients` (`name`, `phone`, `branch_id`, `id`) VALUES ('Walkin Client', '0717576900', '2', '217563569');

INSERT INTO `invoices` (`id`, `branch_id`, `client_id`, `invoice_amt`, `discount`, `particulars`, `type`) VALUES ('218103415', 2, '217563569', 27400, '0600', '[{\"prodId\":\"262562760\",\"prodName\":\"HP\",\"prodQty\":1,\"prodCost\":\"28000.00\",\"prodTax\":0,\"prodTot\":\"28000.00\",\"avQty\":10}]', 'Cash');

INSERT INTO `product_adjustments` (`amount`, `effect`, `id`, `product_id`, `type`) VALUES (1,'reduce','218102403','262562760','sale');

INSERT INTO `invoice_payments` (`id`, `client_id`, `mode`, `amount`) VALUES ('218105904', '217563569', 'cash', '27400');

INSERT INTO `product_adjustments` (`product_id`, `amount`, `effect`, `type`, `id`) VALUES ('261775482', '10', 'reduce', 'stock_return', '285767295');

INSERT INTO `supplier_payments` (`supplier_id`, `amount`, `method`, `id`) VALUES ('205825298', '100000', 'cash', '200096978');

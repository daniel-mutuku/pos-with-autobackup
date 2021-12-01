
UPDATE `login` SET `password` = '87146a1e2d55adc9694184fb5f5543ad'
WHERE `staff_id` = '298413204'

UPDATE `login` SET `password` = '9e061dc6c341bfb89f01f5bcd11dc99f'
WHERE `staff_id` = '298413204'

INSERT INTO `product_adjustments` (`product_id`, `amount`, `effect`, `type`, `id`) VALUES ('1', '10', 'add', 'stock_purchase', '238935108')

INSERT INTO `supplier_supplies` (`supplier_id`, `total_price`, `adjustment_id`, `id`) VALUES ('1', '150000', 238935108, '238932716')

INSERT INTO `product_adjustments` (`product_id`, `amount`, `effect`, `type`, `id`) VALUES ('1', '10', 'add', 'stock_purchase', '238949857')

INSERT INTO `supplier_supplies` (`supplier_id`, `total_price`, `adjustment_id`, `id`) VALUES ('1', '150000', 238949857, '238948192')

INSERT INTO `clients` (`name`, `phone`, `branch_id`, `id`) VALUES ('Jane', '0712345667', '2', '269702718')

INSERT INTO `invoices` (`id`, `branch_id`, `client_id`, `invoice_amt`, `discount`, `particulars`, `type`) VALUES ('211268109', 2, '214491532', 20000, '2000', '[{\"prodId\":\"1\",\"prodName\":\"Samsung M20\",\"prodQty\":1,\"prodCost\":\"22000.00\",\"prodTax\":0,\"prodTot\":\"22000.00\",\"avQty\":20}]', 'Cash')

INSERT INTO `product_adjustments` (`amount`, `effect`, `id`, `product_id`, `type`) VALUES (1,'add','211268734','1','sale')

INSERT INTO `invoice_payments` (`id`, `client_id`, `mode`, `amount`) VALUES ('211266370', '214491532', 'cash', '20000')

INSERT INTO `invoices` (`id`, `branch_id`, `client_id`, `invoice_amt`, `discount`, `particulars`, `type`) VALUES ('246019732', 2, '269702718', 21000, '1000', '[{\"prodId\":\"1\",\"prodName\":\"Samsung M20\",\"prodQty\":1,\"prodCost\":\"22000.00\",\"prodTax\":0,\"prodTot\":\"22000.00\",\"avQty\":21}]', 'Credit')

INSERT INTO `product_adjustments` (`amount`, `effect`, `id`, `product_id`, `type`) VALUES (1,'add','246018305','1','sale')

INSERT INTO `invoices` (`id`, `branch_id`, `client_id`, `invoice_amt`, `discount`, `particulars`, `type`) VALUES ('249233251', 2, '269702718', 20000, '2000', '[{\"prodId\":\"1\",\"prodName\":\"Samsung M20\",\"prodQty\":1,\"prodCost\":\"22000.00\",\"prodTax\":0,\"prodTot\":\"22000.00\",\"avQty\":18}]', 'Credit')

INSERT INTO `product_adjustments` (`amount`, `effect`, `id`, `product_id`, `type`) VALUES (1,'reduce','249233256','1','sale')

INSERT INTO `invoice_payments` (`id`, `client_id`, `mode`, `amount`) VALUES ('249231894', '269702718', 'cash', '20000')

DELETE FROM `invoices`
WHERE `id` = '246019732'

INSERT INTO `product_adjustments` (`amount`, `effect`, `id`, `product_id`, `type`) VALUES (1,'add','274347145','1','sale_return')

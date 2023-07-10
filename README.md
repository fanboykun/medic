## Management System For Pharmacy

### Database Scheme :
medicines:
-id
-name
-storage
-stock
-unit_id
-category_id
-expired(datetime)
-description
-purchase_price
-selling_price
-supplier_id

unit:
-id
-name

category:
-id
-name
-description

supplier:
-id
-name
-address
-phone


sales:
-id
-invoice
-medicine_sale()
-saler_name
-purchase_date
-sell_date
-total_sell

medicine_sale:
-medicine_id
-sale_id
-selling_price
-quantity

pruchase:
-id
-invoice
-supplier_id
-purchase_date
-total_purchase

medicine_purchase:
-medicine_id
-purchase_id
-quantity
-purchase_price



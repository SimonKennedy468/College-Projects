/*What orders are elegible for return*/
select * FROM orders where date_of_purchase > SYSDATE - 30;

/*show all items for sale accross both tables*/
select Item, Fitting, item_price, stock FROM Fixtures 
UNION ALL
SELECT Item, Fitting, item_price, stock from Bulbs;

/*select cheaper fixtures by fitting, and show what bulbs can be used for them*/
select * FROM Fixtures join Bulbs using (fitting) 
    where Fixtures.item_price < (select avg(item_price) from Fixtures);

/*Count number of orders that need fittings*/
select count(requested_fitting) from orders where requested_fitting = 'Y';

/*list items that havent been sold*/
select Item, item_price from Fixtures where Item not in (select Item from orders)
UNION
select Item, item_price from Bulbs where Item not in (select Item from orders);
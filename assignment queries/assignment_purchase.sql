/*show items currently in product tables*/
SELECT * from Fixtures;
SELECT * from bulbs;


/*Prompt user for table to update. 
decrease stock by minus 1 so long as there is stock*/
UPDATE &&what_catagory
    set stock = CASE
        when stock > 0 Then stock - 1
        when stock <= 0 Then stock + 0
        end
    /*user selects item to purchase*/
    where Item = '&&item_input';

/*insert new order to orders table.
set item to usr_input from previous substitution variable, order number 
from the sequence created in previous script.
propmt for input for distance from store and option for fitting*/
Insert into orders(Item, order_number, distance, requested_fitting)
    values('&&item_input',order_increment.nextval,&&distance, '&requested_fitting');

/*if the distance is over 40 but Y was entered for requested_fitting, reset to N*/
UPDATE orders
    set requested_fitting = 'N'
        where distance > 40;

/*Undefine substitution variables for next run of script*/
Undefine item_input;
undefine Fit_choice;
Undefine distance;
Undefine what_catagory;

/*show updated orders table*/
select * from orders;

commit;
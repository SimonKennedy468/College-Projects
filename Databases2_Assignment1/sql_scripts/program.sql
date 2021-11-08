--program to assign a drver to a vehicle and shipment

select * from driver;
select * from shipment;
select * from vehicle;

update vehicle
    set driver_num = CASE
        when driver_num is null Then &&which_driver
        when driver_num is not null Then driver_num
        end
    where registration = '&&what_truck';
    
if((select address from customer) = (select home_depot from driver where staff_number = &&which_driver)) then
    update shipment
        set veh_registration = '&&what_truck';
    commit;
end if;
    
select driver_num from vehicle where registration = '&&what_truck';
undefine which_driver;
undefine what_truck;
commit;


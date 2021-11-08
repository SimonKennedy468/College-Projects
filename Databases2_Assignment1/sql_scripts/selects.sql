--all drivers driving a volvo and delivered a package on this date

select staff_name from driver where staff_number in(select driver_num from vehicle where make = 'Volvo')
intersect
select staff_name from driver where staff_number in(select assigned_driver from shipment where end_date = TO_DATE('2021-10-13', 'YYYY-MM-DD'));


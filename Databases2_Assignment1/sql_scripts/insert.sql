insert into customer values('Ken OBrien', 'CORK', 1);
insert into customer values('Oliver OConnor', 'GALWAY', 2);

insert into driver values(1, 'Danny Lawless', 'DUBLIN', TO_DATE('2006-09-01', 'YYYY-MM-DD'));
insert into driver values(2, 'Paul Brown', 'CORK', TO_DATE('2014-11-22', 'YYYY-MM-DD'));
insert into driver values(3, 'Jaane McGoldRick', 'GALWAY', TO_DATE('2000-02-26', 'YYYY-MM-DD'));

insert into shipment values(TO_DATE('2021-10-13', 'YYYY-MM-DD'), TO_DATE('2021-10-13', 'YYYY-MM-DD'), 1, 1, 1);
insert into shipment values(TO_DATE('2021-10-13', 'YYYY-MM-DD'), TO_DATE('2021-10-13', 'YYYY-MM-DD'), 2, 2, 2);
insert into shipment values(TO_DATE('2021-10-13', 'YYYY-MM-DD'), TO_DATE('2021-10-13', 'YYYY-MM-DD'), 3, 3, 3);

insert into vehicle(registration, make, first_service, recent_service, recent_milage) values(12345, 'Volvo', TO_DATE('2021-10-13', 'YYYY-MM-DD'), TO_DATE('2021-10-13', 'YYYY-MM-DD'), 50);
insert into vehicle(registration, make, first_service, recent_service, recent_milage) values(67890, 'Honda', TO_DATE('2021-10-13', 'YYYY-MM-DD'), TO_DATE('2021-10-13', 'YYYY-MM-DD'), 100);
insert into vehicle(registration, make, first_service, recent_service, recent_milage) values(13579, 'Freighter', TO_DATE('2021-10-13', 'YYYY-MM-DD'), TO_DATE('2021-10-13', 'YYYY-MM-DD'), 75);

select * from driver;
select * from customer;
select * from vehicle;
select * from shipment;
commit;
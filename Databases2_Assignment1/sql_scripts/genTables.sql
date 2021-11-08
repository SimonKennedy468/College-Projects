
drop table customer;
drop table driver;
drop table vehicle;
drop table shipment;

CREATE TABLE customer (
    customer_name        VARCHAR2(20 CHAR) NOT NULL,
    adderss     VARCHAR2(50 CHAR) NOT NULL,
    customer_id INTEGER NOT NULL PRIMARY KEY
);

CREATE TABLE driver (
    staff_number INTEGER NOT NULL,
    staff_name   VARCHAR2(20 CHAR) NOT NULL PRIMARY KEY,
    home_depot   VARCHAR2(20 CHAR) NOT NULL,
    start_date   DATE NOT NULL
);


CREATE TABLE shipment (
    start_date           DATE,
    end_date             DATE,
    customer_id          INTEGER,
    veh_registration     INTEGER NOT NULL PRIMARY KEY,
    shipment_id          INTEGER NOT NULL UNIQUE
);

CREATE TABLE vehicle (
    registration        INTEGER PRIMARY KEY,
    make                VARCHAR2(15 CHAR) NOT NULL,
    first_service       DATE NOT NULL,
    recent_service      DATE,
    recent_milage       INTEGER NOT NULL,
    driver_num          INTEGER DEFAULT(NULL)
);



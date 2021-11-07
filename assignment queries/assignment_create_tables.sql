/*Drop all tables*/
DROP TABLE Bulbs;
DROP TABLE Fixtures;
DROP TABLE orders;
DROP SEQUENCE order_increment;

/*Create table to store fixture products
Item is primary key*/
CREATE TABLE Fixtures
        (Item VARCHAR2(20) NOT NULL PRIMARY KEY,
        suppiler VARCHAR(36),
        /*Check if room added is kitchen, bedroom, living room or garden*/
        Room VARCHAR(3)
            CHECK(Room IN('KIT','BED','LIV','GAR'))NOT NULL, 
        /*Check that standard fitting is used*/
        Fitting VARCHAR2(4)
            CHECK(Fitting IN('B22d','E14','E27','G4','G9'))NOT NULL ,
        /*Is the item attached to the ceiling or stood on its own*/
        ceiling_or_freestanding CHAR DEFAULT 'F'
            CHECK(ceiling_or_freestanding IN ('C','F')),
        /*price saved as float to 2 numbers*/
        item_price NUMBER(4,2),
        stock NUMBER(3)
        );    
/*Create table to store lightbulb products
Item is primary key*/
CREATE TABLE Bulbs
        /*Item is saved as primary key*/
        (Item VARCHAR2(20) NOT NULL PRIMARY KEY,
        /*Check that standard fitting is used*/
        Fitting VARCHAR2(4)
        CHECK(Fitting IN('B22d','E14','E27','G4','G9')), 
        watts NUMBER (4),
        rated_hours NUMBER (5),
        item_price NUMBER(4,2),
        stock NUMBER(2)
        );
    
/*create sequence to create unique order number*/
CREATE SEQUENCE order_increment
    START WITH 1
    INCREMENT BY 1;

/*Create table to track customer orders*/
CREATE TABLE orders
        (
        /*Item is saved as primary key*/
        Item VARCHAR(20),
        order_number int NOT NULL,
        /*save date of purchase as current date*/
        date_of_purchase DATE DEFAULT SYSDATE,
        /*save distance as number*/
        distance NUMBER(3),
        /*check if user says Y or N to item fitting, default to N*/
        requested_fitting CHAR DEFAULT 'N'
            CHECK(requested_fitting IN('Y','N'))
        );
commit;


        
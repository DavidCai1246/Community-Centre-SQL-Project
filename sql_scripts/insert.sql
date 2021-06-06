INSERT INTO Community_Centre
VALUES ('Vancouver Community Centre', 'Vancouver Road', '08:00:00', '17:00:00'),
('Surrey Community Centre', 'Surrey Road', '08:00:00', '17:00:00'),
('Coquitlam Community Centre', 'Coquitlam Road', '08:00:00', '17:00:00'),
('Richmond Community Centre', 'Richmond Road', '08:00:00', '17:00:00'),
('Port Moody Community Centre', 'Port Moody Road', '08:00:00', '17:00:00');

INSERT INTO Parking_Stall
VALUES (999, 2.0, 'Regular', 'Vancouver Community Centre'),
(998, 2.0, 'Regular', 'Vancouver Community Centre'),
(997, 2.0, 'Regular', 'Vancouver Community Centre'),
(996, 2.0, 'Regular', 'Vancouver Community Centre'),
(995, 2.0, 'Accessible', 'Vancouver Community Centre');

INSERT INTO Equipment
VALUES (889, 'Vancouver Community Centre', 'Basketball', TRUE),
(888, 'Vancouver Community Centre', 'Soccer Ball', TRUE),
(887, 'Vancouver Community Centre', 'Volley Ball', TRUE),
(886, 'Vancouver Community Centre', 'Badminton Racket', TRUE),
(885, 'Vancouver Community Centre', 'Tennis Ball', TRUE);

INSERT INTO Memberships
VALUES (1, 12, 'Timmy Member', 'Timmy Road', null, null),
(2, 13, 'Jimmy Member', 'Jimmy Road', null, null),
(3, 16, 'Kimmy Member', 'Kimmy Road', null, 999),
(4, 17, 'Rimmy Member', 'Rimmy Road', null, 999),
(5, 32, 'Shimmy Member', 'Shimmy Road', null, 999);

INSERT INTO Employee
VALUES (11, 20, 23, 'Jeff Staff', 'Jeff Road', 40, 998, 'Vancouver Community Centre'),
(12, 22, 25, 'Sam Contractor', 'Sam Road', 40, 997, 'Vancouver Community Centre'),
(13, 25, 32, 'Sarah Staff', 'Sarah Road', 40, 996, 'Vancouver Community Centre'),
(14, 0, 18, 'Ben Volunteer', 'Ben Road', 40, null, 'Vancouver Community Centre'),
(15, 0, 18, 'Den Volunteer', 'Den Road', 40, null, 'Vancouver Community Centre');

INSERT INTO Volunteer
VALUES (14, 'SFU'),
(15, 'UBC');

INSERT INTO Staff
VALUES (11, 'Camp Leader'),
(13, 'Manager');

INSERT INTO Contractor
VALUES (12, '2021-01-01', '2021-09-01');

INSERT INTO Food_Services
VALUES ('Mcdonalds', 'By the pool', 'Vancouver Community Centre', 779),
('Burger King', 'First Floor', 'Vancouver Community Centre', 778),
('A&W', 'Second Floor', 'Vancouver Community Centre', 777),
('Harveys Hashbrowns', 'Third Floor', 'Vancouver Community Centre', 776),
('Genkis Deli', 'Roof', 'Vancouver Community Centre', 775);

INSERT INTO EatsEmployee
VALUES (11, 779, 'Burger', '2021-03-01'),
(12, 778, 'Fries', '2021-03-02'),
(13, 778, 'Hashbrown', '2021-03-02'),
(14, 775, 'Turkey Meat', '2021-03-01'),
(15, 775, 'Chicken', '2021-03-01');

INSERT INTO EatsMembership
VALUES (1, 779, 'Burger', '2021-03-01'),
(1, 779, 'Fries', '2021-03-01'),
(1, 777, 'Burger', '2021-03-01'),
(5, 776, 'Burger', '2021-03-01'),
(5, 775, 'Burger', '2021-03-01');






CREATE TABLE Community_Centre(
Name CHAR(50),
Location CHAR(50),
Open_Time Time,
Close_Time Time,
PRIMARY KEY(Name)
);

#Change from Parking_Stall_Has
CREATE TABLE Parking_Stall(
Parking_Num INTEGER,
Duration Real DEFAULT 2.00,
Type CHAR(20),
Community_Centre CHAR(50),
PRIMARY KEY (Parking_Num),
FOREIGN KEY (Community_Centre) REFERENCES Community_Centre(Name) ON DELETE CASCADE ON UPDATE CASCADE
);

#Change from Equipment_Contains
CREATE TABLE Equipment(
Equipment_ID INTEGER,
Community_Centre CHAR(50) NOT NULL,
Type CHAR(20),
In_Use Boolean DEFAULT FALSE,
PRIMARY KEY (Equipment_ID),
FOREIGN KEY (Community_Centre) REFERENCES Community_Centre(Name) ON DELETE CASCADE ON UPDATE CASCADE
);

#Change from Memberships_Uses_Parks
CREATE TABLE Memberships(
Membership_ID INTEGER,
Age INTEGER,
Name CHAR(20),
Address CHAR(30),
Equipment_ID INTEGER UNIQUE,
Parking_Num INTEGER,
PRIMARY KEY (Membership_ID),
FOREIGN KEY (Equipment_ID) REFERENCES Equipment(Equipment_ID) ON UPDATE CASCADE,
FOREIGN KEY (Parking_Num) REFERENCES Parking_Stall(Parking_Num) ON UPDATE CASCADE
);

CREATE TABLE Employee(
Employee_ID INTEGER,
Salary INTEGER,
Age INTEGER not null,
Name CHAR(20) not null,
Type CHAR(20) not null,
Address CHAR(30),
Hours INTEGER not null,
Parking_Num INTEGER,
Community_Centre CHAR(50) not null,
PRIMARY KEY (Employee_ID),
FOREIGN KEY (Parking_Num) REFERENCES Parking_Stall(Parking_Num) ON DELETE CASCADE,
FOREIGN KEY (Community_Centre) REFERENCES Community_Centre(Name) ON DELETE CASCADE
);

#Change from Volunteer_WorksIn
CREATE TABLE Volunteer(
Employee_ID INTEGER,
School CHAR(50),
PRIMARY KEY (Employee_ID),
FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID) ON DELETE CASCADE
);

#Change from Staff_WorksIn
CREATE TABLE Staff(
Employee_ID INTEGER,
Role CHAR(30),
PRIMARY KEY(Employee_ID),
FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID) ON DELETE CASCADE
);
 
#Change from Contractor_WorksIn
CREATE TABLE Contractor(
Employee_ID INTEGER,
Contract_Start Date,
Contract_End Date,
PRIMARY KEY(Employee_ID),
FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID) ON DELETE CASCADE
);

#Change from Food_Services_Contains
CREATE TABLE Food_Services(
Food_Service_Name CHAR(50),
Location CHAR(50),
Community_Centre CHAR(50),
Food_Service_ID INTEGER,
PRIMARY KEY(Food_Service_ID),
FOREIGN KEY(Community_Centre) REFERENCES Community_Centre(Name) ON DELETE CASCADE
);

CREATE TABLE EatsEmployee(
Employee_ID INTEGER,
Food_Service_ID INTEGER,
Food CHAR(30),
TimeAte Date,
PRIMARY KEY (Employee_ID, Food_Service_ID, TimeAte),
FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID) ON DELETE CASCADE,
FOREIGN KEY (Food_Service_ID) REFERENCES Food_Services(Food_Service_ID) ON DELETE CASCADE
);

CREATE TABLE EatsMembership(
Membership_ID INTEGER,
Food_Service_ID INTEGER,
Food CHAR(30),
TimeAte Date,
PRIMARY KEY(Food_Service_ID, Membership_ID, Food, TimeAte),
FOREIGN KEY(Membership_ID) REFERENCES Memberships(Membership_ID) ON DELETE CASCADE,
FOREIGN KEY(Food_Service_ID) REFERENCES Food_Services(Food_Service_ID) ON DELETE CASCADE
);

CREATE TABLE Room(
Type CHAR(20),
Size INTEGER NOT NULL,
Community_Centre CHAR(50) NOT NULL,
Is_Reserved Boolean,
Room_ID INTEGER,
ReservedBy INTEGER,
PRIMARY KEY (Room_ID),
FOREIGN KEY (Community_Centre) REFERENCES Community_Centre(Name) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (ReservedBy) REFERENCES Staff(Employee_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

#Change from Events_HeldIn_OrganizedBy
CREATE TABLE Events(
Date_of_Event Date,
Event_ID INTEGER,
Room_ID INTEGER,
Employee_ID INTEGER,
PRIMARY KEY (Event_ID),
FOREIGN KEY (Room_ID) REFERENCES Room(Room_ID) ON DELETE CASCADE,
FOREIGN KEY (Employee_ID) REFERENCES Staff(Employee_ID) ON DELETE CASCADE
);

CREATE TABLE Fitness_Classes(
Event_ID INTEGER,
Instructor_Name CHAR(10),
PRIMARY KEY(Event_ID),
FOREIGN KEY (Event_ID) REFERENCES Events(Event_ID) ON DELETE CASCADE
);

CREATE TABLE Intramural_League (
Event_ID INTEGER,
Sports_Type CHAR(20),
PRIMARY KEY(Event_ID),
FOREIGN KEY (Event_ID) REFERENCES Events(Event_ID) ON DELETE CASCADE
);

CREATE TABLE Community_Outreach (
Event_ID INTEGER,
Attendance INTEGER,
PRIMARY KEY(Event_ID),
FOREIGN KEY (Event_ID) REFERENCES Events(Event_ID) ON DELETE CASCADE
);

CREATE TABLE Attends(
Membership_ID INTEGER,
Event_ID INTEGER,
PRIMARY KEY(Membership_ID,Event_ID),
FOREIGN KEY (Membership_ID) REFERENCES Memberships(Membership_ID) ON DELETE CASCADE,
FOREIGN KEY (Event_ID) REFERENCES Events(Event_ID) ON DELETE CASCADE
);

CREATE TABLE Sponsor_Funds (
Name CHAR(20),
Amount REAL,
Event_ID INTEGER,
PRIMARY KEY (Name, Event_ID),
FOREIGN KEY (Event_ID) REFERENCES Events(Event_ID) ON DELETE CASCADE
);
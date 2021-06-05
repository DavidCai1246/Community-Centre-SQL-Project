CREATE TABLE Employee(
Employee_ID Integer,
Salary Integer,
Age Integer,
Name Char(20),
Address Char(30),
Hours Integer,
Parking_Num Integer,
Community_Centre Char(20),
PRIMARY KEY(Employee_ID),
FOREIGN KEY (Parking_Num) REFERENCES Parking_Stall_Has(Parking_Num) ON DELETE CASCADE,
FOREIGN KEY (Community_Centre) REFERENCES Community_Centre(Name) ON DELETE CASCADE
)

#Change from Volunteer_WorksIn
CREATE TABLE Volunteer(
Employee_ID Integer,
School char(20),
PRIMARY KEY(Employee_ID),
FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID) ON DELETE CASCADE
)

#Change from Staff_WorksIn
CREATE TABLE Staff(
Employee_ID Integer,
PRIMARY KEY(Employee_ID),
FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID) ON DELETE CASCADE
)
 
#Change from Contractor_WorksIn
CREATE TABLE Contractor(
Employee_ID Integer,
Contract_Start Date,
Contract_End Date,
PRIMARY KEY(Employee_ID),
FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID) ON DELETE CASCADE
)

CREATE TABLE EatsEmployee(
Employee_ID Integer,
Food_Service_ID Integer,
Food char(30),
TimeAte Date,
PRIMARY KEY (Employee_ID, Food_Service_ID, TimeAte),
FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID) ON DELETE SET NULL
FOREIGN KEY (Food_Service_ID) REFERENCES Food_Services_Contains(ID) ON DELETE CASCADE
)

CREATE TABLE EatsMembership(
Membership_ID Integer,
Food_Service_ID Integer,
Food char(30),
TimeAte Date,
PRIMARY KEY(Food_Service_ID, Membership_ID, TimeAte),
FOREIGN KEY(Membership_ID) REFERENCES Memberships(Membership_ID) ON DELETE SET NULL,
FOREIGN KEY(Food_Service_ID) REFERENCES Food_Services_Contains(ID) ON DELETE CASCADE
)

CREATE TABLE Community_Centre(
Name char(20),
Location char(20),
Open_Time Time,
Close_Time Time,
PRIMARY KEY(Location, Name),
)

#Change from Food_Services_Contains
CREATE TABLE Food_Services(
Food_Service_Name char(20),
Location char(20),
Community_Centre char(20),
Food_Service_ID Integer,
PRIMARY KEY(Food_Service_ID),
FOREIGN KEY(Community_Centre) REFERENCES CommunityCentre(Name) ON DELETE CASCADE
)

CREATE TABLE Room(
Type char(20),
Size Integer NOT NULL,
Community_Centre char(20) NOT NULL,
Is_Reserved Boolean,
Room_ID Integer,
ReservedBy Integer,
PRIMARY KEY (Room_ID),
FOREIGN KEY (Community_Centre) REFERENCES Community_Centre(Name) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (ReservedBy) REFERENCES Staff_WorksIn(Employee_ID) ON DELETE CASCADE ON UPDATE CASCADE,
)

#Change from Parking_Stall_Has
CREATE TABLE Parking_Stall(
Parking_Num Integer,
Duration Real DEFAULT 2.00,
Type char(20)
Community_Centre Char(20),
PRIMARY KEY (Parking_Num),
FOREIGN KEY (Community_Centre) REFERENCES Community_Centre(Name) ON DELETE CASCADE ON UPDATE CASCADE,
)

#Change from Events_HeldIn_OrganizedBy
CREATE TABLE Events(
Date_of_Event Date,
Event_ID Integer,
Room_ID Integer NOT NULL,
Employee_ID Integer,
PRIMARY KEY (Event_ID),
FOREIGN KEY (Room_ID) REFERENCES Rooms (Room_ID) ON DELETE CASCADE,
FOREIGN KEY (Employee_ID) REFERENCES Staff_Worksin (Employee_ID) ON DELETE CASCADE
)

CREATE TABLE Fitness_Classes(
Event_ID Integer,
Instructor Name char(10),
PRIMARY KEY(Event_ID),
FOREIGN KEY (Event_ID) REFERENCES Events(Event_ID) ON DELETE CASCADE
)

CREATE TABLE Intramural_League (
Event_ID Integer,
Sports_Type char(20),
PRIMARY KEY(Event_ID),
FOREIGN KEY (Event_ID) REFERENCES Events(Event_ID) ON DELETE CASCADE
)

CREATE TABLE Community_Outreach (
Event_ID Integer,
Attendance Integer,
PRIMARY KEY(Event_ID),
FOREIGN KEY (Event_ID) REFERENCES Events(Event_ID) ON DELETE CASCADE
)

CREATE TABLE Attends(
Membership_ID Integer,
EventID Integer,
PRIMARY KEY(Membership_ID,EventID)
FOREIGN KEY (Membership_ID) REFERENCES Memberships(Membership_ID) ON DELETE CASCADE,
FOREIGN KEY (Event_ID) REFERENCES Events(Event_ID) ON DELETE CASCADE
)

#Change from Equipment_Contains
CREATE TABLE Equipment(
Equipment_ID Integer,
Community_Centre Char(20) NOT NULL,
Type Char(20),
In_Use Boolean DEFAULT 'False',
PRIMARY KEY (Equipment_ID),
FOREIGN KEY (Community_Centre) REFERENCES Community_Centre(Name) ON DELETE CASCADE ON UPDATE CASCADE
)

#Change from Memberships_Uses_Parks
CREATE TABLE Memberships(
Membership_ID Integer,
Equipment_ID Integer,
Parking_Num Integer,
PRIMARY KEY (Membership_ID),
FOREIGN KEY (Equipment_ID) ON UPDATE CASCADE,
FOREIGN KEY (Parking_Num) REFERENCES Parking_Stall(Parking_Num) ON UPDATE CASCADE
)

CREATE TABLE Sponsor_Funds (
Name Char(20),
Amount REAL,
EventID Integer,
PRIMARY KEY (Name, EventID),
FOREIGN KEY (EventID) REFERENCES Events(Event_ID) ON DELETE CASCADE
)
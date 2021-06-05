#Change from Volunteer_WorksIn
CREATE TABLE Volunteer(
Employee_ID Integer,
Salary Integer,
Age Integer,
Name Char(10),
Address Char(30),
Hours Integer,
Parking# Integer,
Communtiy_Centre Char(20),
Location char(20),
School char(20),
PRIMARY KEY(Employee_ID),
CANDIDATE KEY(Employee_ID),
FOREIGN KEY Parking# REFERENCES Parking_Stall_Has(Parking#)
	ON DELETE CASCADE
FOREIGN KEY Community Centre REFERENCES Community Centre(Name)
	ON DELETE CASCADE
FOREIGN KEY Location REFERENCES Community Centre(Location)
	ON DELETE CASCADE
)

use mysql;
use carparkingwebsite;
CREATE TABLE `userdetails` (
  `emailid` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  primary key(emailid)
);
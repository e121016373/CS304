SET FOREIGN_KEY_CHECKS=0;

drop table if exists Person;
 create table Person
	(SIN int not null PRIMARY KEY,
	Password varchar(20) not null,
	Username varchar(30) not null,
	Name varchar(30) not null,
	Contact_Info varchar(100) not null,
	Physiological_Info VarChar (1000) null,
	Work_Experience Char(255) null,
	Education VarChar (1000) null);
	

drop table if exists Connection; 
create table Connection
	(User_SIN int not null,
	Connection_SIN int not null,
	FOREIGN KEY (User_SIN) REFERENCES Person(SIN) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (Connection_SIN) REFERENCES Person(SIN) ON DELETE CASCADE ON UPDATE CASCADE,
	PRIMARY KEY(User_SIN,Connection_SIN));

drop table if exists Company;
create table Company
	(CompanyName varchar(50) not null PRIMARY KEY, 
    CompanySize int not null,
    Company_Info varchar(300) not null,
	Field varchar(30) not null);


drop table if exists Review;
create table Review
	(SIN int not null,
	CompanyName varchar(50) not null,
	Rating int null,
	Comment varchar(1000) null,
    FOREIGN KEY (SIN) REFERENCES Person(SIN) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (CompanyName) REFERENCES Company(CompanyName) ON DELETE CASCADE ON UPDATE CASCADE,
	PRIMARY KEY(SIN,CompanyName));

drop table if exists Applicant;
create table Applicant
	(SIN int not null PRIMARY KEY,
	Industry char(100) null,
    FOREIGN KEY (SIN) REFERENCES Person(SIN));

drop table if exists Request;
create table Request
	(Sender_Username varchar(30) not null PRIMARY KEY,
	Receiver_Username varchar(30) not null);

drop table if exists Employer;
create table Employer
	(SIN int not null PRIMARY KEY,
	CompanyName varchar(50) not null,
    FOREIGN KEY (SIN) REFERENCES Person(SIN),
    FOREIGN KEY (CompanyName) REFERENCES Company(CompanyName) ON DELETE CASCADE ON UPDATE CASCADE);
 
drop table if exists PostedJob;
create table PostedJob
	(JobID int not null PRIMARY KEY,
	CompanyName varchar(50) not null,
	Requirements varchar(500) not null,
	Description varchar(500) not null,
	Location char(30) not null,
	Type char(10) null,
	Salary int null,
	Employer_SIN int not null,	
    FOREIGN KEY (Employer_SIN) REFERENCES Person(SIN),
	FOREIGN KEY (CompanyName) REFERENCES Company(CompanyName));

drop table if exists Application;
create table Application
	(ApplicationID int not null,
	Applicant_SIN int not null,
	JobID int not null,
	CoverLetter varchar(1000) not null,
	Resume varchar(1000) not null,
	PRIMARY KEY(ApplicationID,Applicant_SIN),	
    FOREIGN KEY (Applicant_SIN) REFERENCES Person(SIN),
	FOREIGN KEY (JobID) REFERENCES PostedJob(JobID));

drop table if exists Evaluation;
create table Evaluation
	(EvaluationID varchar(50) not null PRIMARY KEY,
	Length char(50) not null,
	Date date not null,
	Time time not null,
	Employer_SIN int not null,
	ApplicationID int null,
    FOREIGN KEY (Employer_SIN) REFERENCES Person(SIN),
    FOREIGN key (ApplicationID) REFERENCES Application(ApplicationID));

drop table if exists OnSiteInterview;
create table OnSiteInterview
	(EvaluationID varchar(50) not null PRIMARY KEY,
	Location char(50) not null,
	FOREIGN KEY (EvaluationID) REFERENCES Evaluation(EvaluationID));


drop table if exists PhoneInterview;
create table PhoneInterview
	(EvaluationID varchar(50) not null PRIMARY KEY,
    PhoneNumber varchar(50) not null,
	FOREIGN KEY (EvaluationID) REFERENCES Evaluation(EvaluationID) ON DELETE CASCADE ON UPDATE CASCADE);

drop table if exists ExamInterview;
create table ExamInterview
	(EvaluationID varchar(50) not null PRIMARY KEY,
	Location char(50) not null,
	FOREIGN KEY (EvaluationID) REFERENCES Evaluation(EvaluationID) ON DELETE CASCADE ON UPDATE CASCADE);

drop table if exists Offer;
create table Offer
	(OfferID varchar(50) not null PRIMARY KEY,
	EvaluationID varchar(50) not null,
	Salary int not null,
	StartDate date not null,
    FOREIGN KEY (EvaluationID) REFERENCES Evaluation(EvaluationID) ON DELETE CASCADE ON UPDATE CASCADE);


insert into Person
values('20180102', 'kkkkkk', 'JeffreeStar', 'Jeffree Smith', 'Phone: 778123456', 'Male, 24 years old', 'I have been working in a restaurant for 2 years.', 'High School');

insert into Person
values('20180201', 'kkkkkk', 'milestone', 'Bob Marley', 'phone: 7781234234', 'Male, 26 years old', 'I have been working in a bank as a supervisor for 4 years.', 'Bachelor of commerce');
 
insert into Person
values('20180301', 'kkkkkk', 'kikiloveme', 'Jessica chou', 'Phone: 7781324321', 'Female, 22 years old', 'I have been intered for 8 months in CIBC bank as a software developer.', 'Bachelor of science');

insert into Person
values('20180401', 'season', 'nomarllyET', 'Sonia mendes', 'Phone: 6043229182,Email: Soniakiki@gmail.com', 'Female, 34 years old', 'I am working in the human resource department of EDC company for about 8 years','Bachelor of Arts');

insert into Person
values('20180501', 'Dublin', 'cd1234', 'Milly Kales', 'Email: shilly2343@hotmail.com', 'Female, 28 years old', 'I have been working in Nordstrom as a sales for 3 years.', 'Bachelor of Arts');

insert into Person
values('20180601', '1213uh', 'HRlocal111', 'Steven Larson', 'phone: 77812342884', 'Male, 36 years old', 'I am the engineer of electronic department for 10 years', 'Master of electronic');
 
insert into Company
values('HUAWEI', '10000', '
It is a supplier of information and communication solutions in the Peoples Republic of China and is headquartered in Shenzhen, Guangdong Province.', 'Technologies');

insert into Company
values('GOOGLE', '8000', '
Founded on September 4, 1998, Google Inc. was founded by Larry Page and Sergey Brin and is recognized as the world largest search engine company,Google is a multinational technology company based in the United States. Its business includes Internet search, cloud computing, advertising technology, etc. It also develops and provides a large number of Internet-based products and services. Its main profit comes from advertising services such as AdWords.', 'Technologies');

insert into Company
values('AMAZON', '9200', 'It is the largest online e-commerce company in the United States, located in Seattle, Washington. It was one of the first companies to start e-commerce on the Internet. Amazon was founded in 1995. At the beginning, it only operated online book sales. Now it has expanded into a wide range of other products and has become the worlds largest online retail product. Business and the worlds second largest Internet company', 'business');

insert into Company
values('APPLE', '12000', 'Apple Inc. is a high-tech company in the United States. Founded on April 1, 1976 by Steve Jobs, Steve Wozniak, and Ron Wayne, and named Apple Computer Inc. Named Apple on January 9, 2007, headquartered in Cupertino, California.
At the beginning of Apples founding, the main development and sales of personal computers, as of 2014 dedicated to the design, development and sales of consumer electronics, computer software, online services and personal computers', 'High-Tech');

insert into Company
values('Tencent', '18000', 'It is one of the largest Internet integrated service providers in China and one of the Internet companies with the largest number of service users in China.
Tencents diversified services include: social and communication services QQ and WeChat/WeChat, social networking platform QQ space, Tencent Games QQ game platform, portal Tencent.com, Tencent news client and network video service Tencent video.', 'Internet Providers');

insert into Company
values('Nordstrom', '3000','It is a high-end chain department store in the United States. Nordstroms products include clothing, accessories, bags, jewelry, cosmetics, perfumes, household items and more.', 'Department Store');

insert into Company
values('Starbucks', '5000', 'It is the name of a chain coffee company in the United States. It was established in 1971 and is the worlds largest coffee chain. Its headquarters is located in Seattle, Washington, USA. Starbucks retail products include more than 30 of the worlds top coffee beans, hand-made espresso and a variety of coffee hot and cold drinks, fresh and delicious variety of pastry foods, and a wide variety of coffee machines, coffee cups and other commodities.', 'Coffee Shop');

insert into Company
values('McDonalds', '32000', 'McDonalds is a large global multinational restaurant chain founded in 1955 in Chicago, USA, with approximately 30,000 stores in the world. It mainly sells hamburgers, as well as fast food such as French fries, fried chicken, soda, ice, salad, and fruit.', 'Fast Food');
 
insert into Review
values('20180102', 'Starbucks', '9', 'It is my favourite coffe shop in the world.And I always buy a cup of coffee on my way home!Love it!');
 
insert into Review
values('20180301', 'HUAWEI', '8', 'I have been worked as an inter in HUAWEI for two month,It is a good company and the working environment is great!But everybody are working so hard that makes me feel so nervous and have so much pressure.');
 
insert into Applicant
values('20180102', 'server');

insert into Applicant
values('20180301', 'Software');

insert into Applicant
values('20180501', 'Sales');

insert into Applicant
values('20180201', 'Business');
 
insert into Employer
values('20180401', 'AMAZON');

insert into Employer
values('20180601', 'Tencent');

insert into PostedJob
values('0189', 'AMAZON','Applicant should have sale experience for over 1 year and need to be good at communication', 'This job is  in the customer services department which dealing with refund and complaint.', 'Vancouver', 'Representative', '17','20180401');

insert into PostedJob
values('2314','Tencent', 'We are looking for engineer which good at python and java.Applicant should be major in computer science or software engineer and at least have bachelor degree', 'The main job is to analysis the data and testing the source code', 'vancouver', 'Software Developer', '24','20180601');


insert into Application
values('2908', '20180501','0189','I am Milly Kales,I am 28 years old and I graduated from Simon Fraser University and major in general arts.My height is 5.3 and I born in vancouver.','I have three years of working experience in department stores. I am good at communicating with guests and solving problems from the perspective of the guests. I am good at teamwork and used to be the top ten in the annual sales of nordstrom cosmetics division. I can speak English and French.');

insert into Application
values('2714', '20180301','2314','I am Jessica chou,I am 22 years old and I graduated from University of British Columbia and major in Computer Sciencw.My height is 5.4 and I born in Korea.','I have been internship at Huawei for two months, mainly working on front-end design and resource package maintenance. At the same time, I have achieved excellent results in all subjects in the school. I focus on the learning process and will adopt multiple opinions in my work. I have a good attitude towards my work and my studies. Easy to get along with, strong sense of teamwork and responsibility, willing to team members and make progress together; work hard, and will be completed carefully for all tasks assigned.
Strong logical thinking ability, can reasonably plan the relationship between work and life.');


insert into Evaluation
values('1876', '1 hour','2018-11-15','12:30:00','20180401','20180501');


insert into Evaluation
values('1879', '2 hour','2018-11-14','12:30:00','20180601','20180301');

insert into OnSiteInterview
values('1876','2525 West Mall,Vancouver,BC');


insert into PhoneInterview
values('1876','7783247912');

insert into ExamInterview
values('1879','1961 E Mall,Vancouver,BC');

insert into Offer
values('RX1286','1876','16','2018-11-30');

insert into Request
values('kikiloveme','cd1234');






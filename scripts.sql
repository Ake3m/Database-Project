--create tables

create table login_info(
    email_address varchar(255) primary key,
    password varchar(255) not null
);

create table user_info(
uid int primary key auto_increment,
first_name varchar(255) not null,
middle_name varchar(255),
last_name varchar(255) not null,
gender char(1) not null,
email_address varchar(255) not null,
date_of_birth date not null,
phone_number int not null,
health_insurance_number varchar(10),
address varchar(255) not null,
foreign key(email_address) references login_info(email_address)
);


--doctor information
create table doctor_information(
    doctor_id int primary key auto_increment=100,
    first_name varchar(255) not null,
    last_name varchar(255) not null,
    professional_statement varchar(4000) not null,
    active_since date not null
);

insert into doctor_information(first_name, last_name, professional_statement, active since)values
('Kaiwen', 'Li')

create table qualification(
    id int primary key auto_increment,
    doctor_id int,
    qualification_name varchar(255) not null,
    institute_name varchar(255) not null,
    procurement_date date not null,
    foreign key(doctor_id) references doctor_information(doctor_id)
);
 

create table specialization(
    id int primary key,
    specialization_name varchar(255) not null
);

create table doctor_specialization(
    id int auto_increment primary_key,
    doctor_id int not null, 
    specialization_id int not null, 
    foreign key(doctor_id) references doctor_information(doctor_id),
    foreign key(specialization_id) references specialization(id)
);

create table hospital_affiliation(
    id int auto_increment primary key,
    doctor_id int not null,
    hospital_name varchar(255) not null,
    city varchar(50) not null,
    country varchar(50) not null, 
    start_date date not null,
    end_date date,
    foreign key(doctor_id) references doctor_information(doctor_id)
);

--patient-review
create table doctor_review(
    id int auto_increment primary key,
    user_id int not null,
    doctor_id int not  null,
    is_review_anonymous char(1) not null,
    wait_time_rating int not null,
    bedside_manner_rating int not null,
    ovrall_rating int not null,
    review varchar(255),
    review_date date not null,
    foreign key(user_id) references user_info(user_id),
    foreign key(doctor_id) references doctor_information(doctor_id)
)


--office information
create table offices(
    office_id int auto_increment primary key,
    office_number varchar(3) not null unique,
);

create table sections(
    section_id int auto_increment primary key, 
    section_name varchar(50) not null
);

create table arrangement(
    arrangement_id int auto_increment primary key,
    office_id int not null,
    section_id int not null,
    foreign key(office_id) references offices(office_id),
    foreign key(section_id) references sections(section_id)
);

--appointment section
create table appointment_status(
    id int auto_increment primary key,
    status varchar(10) not null
);

create table works(
    id int auto_increment primary key,
    doctor_id int not null,
    work_date date not null,
    shift varchar(50) not null,
    arranged_office_id int not null,
    foreign key(doctor_id) references doctor_information(doctor_id),
    foreign key(arranged_office_id) references arrangement(arrangement_id),
);

create table appointment(
    id int auto_increment primary key,
    appointment_date date not null,
    doctor_id int not null,
    user_id int not null,
    probable_start_time time not null,
    actual_end_time time,
    appointment_status_id int not null,
    appointment_date date not null,
    office_id int not null,
    foreign key(user_id) references user_info(user_id),
    foreign key(doctor_id) references doctor_information(doctor_id),
    foreign key(appointment_status_id) references appointment_status(id),
    foreign key(office_id) references offices(office_id)
    -- CHECK (HOUR(probable_start_time)>=9 AND HOUR(probable_start_time)<12),
    -- CHECK (HOUR(probable_start_time)>=14 AND HOUR(probable_start_time)<17),
    -- constraint check_endtime_after_startTime CHECK (actual_end_time>probable_start_time)
);


--alter  table segments
ALTER TABLE login_info
ADD account_type char(1) not null;

ALTER TABLE doctor_information
ADD email_address varchar(255) not null unique;

ALTER TABLE doctor_information
ADD FOREIGN KEY(email_address) REFERENCES login_info(email_address);


--make changes to tables with foreign key constraints 
SET FOREIGN_KEY_CHECKS = 0;
SET GLOBAL FOREIGN_KEY_CHECKS=0;

SET FOREIGN_KEY_CHECKS = 1;
SET GLOBAL FOREIGN_KEY_CHECKS=1;
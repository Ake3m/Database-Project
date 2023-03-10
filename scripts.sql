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


CREATE TABLE shift_duration(
    shift_id int  auto_increment primary key,
    shift_name varchar(50) not null, 
    start_time time not null,
    end_time time not null
)

CREATE TABLE works(
    id int auto_increment primary key,
    doctor_id int not null,
    day_of_week varchar(50) not null,
    shift_id int not null,
    foreign key(doctor_id) references doctor_information(doctor_id),
    foreign key(shift_id) references shift_duration(shift_id)
);

--altering foreign keys
alter table doctor_specialization drop foreign key doctor_specialization_ibfk_1;
alter table doctor_specialization add foreign key(doctor_id) references doctor_information(doctor_id) on delete cascade;

alter table hospital_affiliation drop foreign key hospital_affiliation_ibfk_1;
alter table hospital_affiliation add foreign key(doctor_id) references doctor_information(doctor_id) on delete cascade;

alter table qualification drop foreign key qualification_ibfk_1;
alter table qualification add foreign key(doctor_id) references doctor_information(doctor_id) on delete cascade;

alter table works drop foreign key works_ibfk_1;
alter table works add foreign key(doctor_id) references doctor_information(doctor_id) on delete cascade;

--new constraints for customer
alter table user_info drop foreign key user_info_ibfk_1;
alter table user_info add foreign key(email_address) references login_info(email_address) on delete cascade;


alter table appointment drop foreign key appointment_ibfk_2;
alter table appointment add foreign key(patient_id) references user_info(uid) on delete cascade;

alter table appointment drop foreig key appointment_ibfk_3
alter table appointment add foreign key(doctor_id) references doctor_information(doctor_id) on delete cascade;

--new constraints for dotor specialization
alter table doctor_specialization drop foreign key doctor_specialization_ibfk_2;
alter table doctor_specialization add foreign key(specialization_id) references specialization(id) on delete cascade;

--create appointment table

CREATE TABLE appointment(
    appointment_id int auto_increment,
    appointment_date date,
    patient_id int,
    doctor_id int,
    consultation_number int,
    appointment_status_id int not null,
    start_time time not null,
    end_time time not null,
    FOREIGN KEY(appointment_status_id) REFERENCES appointment_status(id),
    FOREIGN KEY(patient_id) REFERENCES user_info(uid),
    FOREIGN KEY(doctor_id) REFERENCES doctor_information(doctor_id),
    CONSTRAINT PK_appointment PRIMARY KEY(appointment_date, doctor_id, consultation_number);
);


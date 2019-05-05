
create database JAK;

use JAK;

create table person (
    ID INT NOT NULL AUTO_INCREMENT,
    username varchar(32), passwordHash CHAR(60), joined DATE,
    PRIMARY KEY (ID, username));

create table student (
    ID INT NOT NULL,
    major varchar(32), classification INT,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID) REFERENCES person (ID));

create table faculty (
    ID INT NOT NULL,
    department varchar(32),
    PRIMARY KEY (ID),
    FOREIGN KEY (ID) REFERENCES person(ID));

create table project (
    ID INT NOT NULL AUTO_INCREMENT,
    startDate DATE, endDate DATE, leadID INT,
    name varchar(64),
    PRIMARY KEY (ID),
    FOREIGN KEY (leadID) REFERENCES person(ID));
                      
create table experiment (
    experimentNo INT NOT NULL AUTO_INCREMENT,
    ProjectID INT NOT NULL,
    startDate DATE,
    category INT,
    PRIMARY KEY (experimentNo, ProjectID),
    FOREIGN KEY (ProjectID) REFERENCES project(ID));
                         
create table environment (
    ID INT NOT NULL AUTO_INCREMENT,
    name varchar(32), rewardLow FLOAT,
    rewardHigh FLOAT, path varchar(256),
    PRIMARY KEY (ID));
                          
create table equipment (
    ID INT NOT NULL AUTO_INCREMENT,
    name varchar(32), category INT,
    location varchar(32),
    PRIMARY KEY (ID));
                        
create table agent (
    ID INT NOT NULL AUTO_INCREMENT,
    actionSpace varchar(32),
    observationSpace varchar(32), path varchar(256),
    PRIMARY KEY (ID));
                    
create table Model (
    ID INT NOT NULL AUTO_INCREMENT,
    name varchar(32), category INT, path varchar(256),
    PRIMARY KEY (ID));

create table EquipmentBelongsTo (
    equipmentID INT NOT NULL,
    userID INT NOT NULL,
    FOREIGN KEY (equipmentID) REFERENCES equipment(ID),
    FOREIGN KEY (userID) REFERENCES Faculty(ID)
);

create table agentUsesmodel (agentID INT, modelID INT,
                             FOREIGN KEY (agentID) REFERENCES agent(ID),
                             FOREIGN KEY (modelID) REFERENCES Model(ID));

create table workson (UserID INT, ProjectID INT,
                      FOREIGN KEY (UserID) REFERENCES person(ID),
                      FOREIGN KEY (ProjectID) REFERENCES project(ID));

create table experimentusesenvironment (ProjectID INT, experimentID INT, environmentID INT,
                                        FOREIGN KEY (ProjectID, experimentID) REFERENCES experiment(ProjectID, experimentNo),
                                        FOREIGN KEY (environmentID) REFERENCES environment(ID));

create table environmenthasspace (EnvironmentID INT, space varchar(64), isAction BINARY,
                                  FOREIGN KEY (EnvironmentID) REFERENCES environment(ID));

create table agentparticipates (projectID INT, experimentNo INT, agentID INT,
                                FOREIGN KEY (projectID, experimentNo) REFERENCES experiment(ProjectID, experimentNo));

create table result (ProjectID INT, experimentNo INT, completed BINARY, path varchar(256),
                     PRIMARY KEY (ProjectID, experimentNo),
                     FOREIGN KEY (ProjectID, experimentNo) REFERENCES experiment(ProjectID, experimentNo));



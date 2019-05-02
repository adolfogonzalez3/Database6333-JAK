
create database JAK;

use JAK;

create table person (ID INT, name varchar(32), passwordHash INT,
                     passwordSalt VARCHAR(16), joined DATE,
                     PRIMARY KEY (ID));

create table student (ID INT, major varchar(32), classification INT,
                      PRIMARY KEY (ID),
                      FOREIGN KEY (ID) REFERENCES person (ID));

create table faculty (ID INT, department varchar(32),
                      PRIMARY KEY (ID),
                      FOREIGN KEY (ID) REFERENCES person(ID));

create table project (ID INT, startDate DATE, endDate DATE, leadID INT,
                      name varchar(64),
                      PRIMARY KEY (ID));
                      
create table experiment (ProjectID INT, experimentNo INT, startDate DATE,
                         category INT,
                         PRIMARY KEY (ProjectID, experimentNo),
                         FOREIGN KEY (ProjectID) REFERENCES project(ID));
                         
create table environment (ID INT, name varchar(32), rewardLow FLOAT,
                          rewardHigh FLOAT, path varchar(256),
                          PRIMARY KEY (ID));
                          
create table equipment (ID INT, name varchar(32), category INT,
                        location varchar(32),
                        PRIMARY KEY (ID));
                        
create table agent (ID INT, actionsSpace varchar(32),
                    observationSpace varchar(32), path varchar(256),
                    PRIMARY KEY (ID));
                    
create table Model (ID INT, name varchar(32), category INT, path varchar(256),
                    PRIMARY KEY (ID));

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



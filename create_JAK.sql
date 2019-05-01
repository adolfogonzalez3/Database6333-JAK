
create database JAK;

use JAK;

create table Person (ID INT, name varchar(32), passwordHash INT,
                     passwordSalt VARCHAR(16), joined DATE);

create table Student (ID INT, major varchar(32), classification INT);

create table Faculty (ID INT, department varchar(32));

create table Project (ID INT, startDate DATE, endDate DATE, leadID INT,
                      name varchar(64));
                      
create table Experiment (ID INT, experimentNo INT, startDate DATE,
                         category INT);
                         
create table Environment (ID INT, name varchar(32), rewardLow FLOAT,
                          rewardHigh FLOAT, path varchar(256));
                          
create table Equipment (ID INT, name varchar(32), category INT,
                        location varchar(32));
                        
create table Agent (ID INT, actionsSpace varchar(32),
                    observationSpace varchar(32), path varchar(256));
                    
create table Model (ID INT, name varchar(32), category INT, path varchar(256));

create table AgentUsesModel (agentID INT, modelID INT);

create table WorksOn (UserID INT, ProjectID INT);

create table ExperimentUsesEnvironment (ProjectID INT, experimentID INT, environmentID INT);

create table EnvironmentHasSpace (EnvironmentID INT, space varchar(64), isAction BINARY);

create table AgentParticipates (projectID INT, experimentN0 INT, agentID INT);

create table Result (ProjectID INT, experimentNo INT, completed BINARY, path varchar(256));



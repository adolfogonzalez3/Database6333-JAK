
from enum import Enum
from time import gmtime, strftime
from collections import namedtuple
from random import randint, choice, random


person_sql = ("insert into person (username, passwordHash, joined) values "
              "('{}','{}','{}');")
student_sql = ("insert into student (ID, major, classification) values "
              "(@PersonID,'{}',{:d});")
faculty_sql = "insert into faculty (ID, department) values (@PersonID,'{}');"
project_sql = ("insert into project (startDate, endDate, leadID, name) values "
               "('{}','{}',@PersonID,'{}');")
experiment_sql = ("insert into experiment (ProjectID, startDate, category) "
                  "values (@ProjectID,'{}',{:d});")
environment_sql = ("insert into environment (name,rewardLow,rewardHigh,path) "
                   "values ('{}',{:f},{:f},'{}');")
equipment_sql = ("insert into equipment (name, category, location) values "
                 "('{}',{:d},'{}');")
agent_sql = ("insert into agent (actionspace, observationspace, path) "
             "values ('{}','{}','{}');")
model_sql = ("insert into model (name, category, path) values "
             "('{}',{:d},'{}');")
equipmentBelongsTo = ("insert into EquipmentBelongsTo (equipmentID, userID) "
                      "values (@EquipmentID,@PersonID);")

agentUsesModel_sql = ("insert into agentUsesModel (agentID, modelID) values "
                      "(@AgentID,@ModelID);")
worksOn_sql = ("insert into worksOn (UserID, ProjectID) values "
               "(@PersonID,@ProjectID);")
experimentusesenvironment_sql = ("insert into experimentusesenvironment values"
                                 " (@ProjectID,@ExperimentID,@EnvironmentID);")
environmenthasspace_sql = ("insert into environmenthasspace values "
                           "(@EnvironmentID,'{}',{:d});")
agentparticipates_sql = ("insert into agentparticipates "
                         "(projectID,experimentNo,agentID) values "
                         "(@ProjectID,@ExperimentNo,@AgentID);")
result_sql = ("insert into result (ProjectID,experimentNo,completed,path) "
              "values (@ProjectID,@ExperimentNo,{},'{}');")


MAJORS = ['CSCI', 'ME', 'EE']

def create_person():
    sql_statements = []
    name = generate_random_str()
    passHash = generate_random_str(60)
    joined = strftime("%a, %d %b %Y %H:%M:%S +0000", gmtime())
    sql_statements.append(person_sql.format(name, passHash, joined))
    sql_statements.append('SET @PersonID = LAST_INSERT_ID();')
    return sql_statements

def create_student():
    return create_person() + [student_sql.format(choice(MAJORS), randint(1, 6))]

def create_faculty():
    return create_person() + [faculty_sql.format(choice(MAJORS))]

def create_project():
    sql_statements = []
    start = strftime("%a, %d %b %Y %H:%M:%S +0000", gmtime())
    end = strftime("%a, %d %b %Y %H:%M:%S +0000", gmtime())
    project_name = generate_random_str()
    sql_statements.append(project_sql.format(start, end, project_name))
    sql_statements.append('SET @ProjectID = LAST_INSERT_ID();')
    return sql_statements

def create_environment():
    sql_statements = []
    name = generate_random_str(32)
    low = random()
    high = low + random()
    path = generate_random_str(256)
    sql_statements.append(environment_sql.format(name, low, high, path))
    sql_statements.append('SET @EnvironmentID = LAST_INSERT_ID();')
    return sql_statements

def create_experiment():
    sql_statements = []
    start = strftime("%a, %d %b %Y %H:%M:%S +0000", gmtime())
    sql_statements.append(experiment_sql.format(start, 0))
    sql_statements.append('SET @ExperimentNo = LAST_INSERT_ID();')
    return sql_statements

def create_equipment():
    sql_statements = []
    name = generate_random_str(32)
    location = generate_random_str(32)
    sql_statements.append(equipment_sql.format(name, 0, location))
    sql_statements.append('SET @EquipmentID = LAST_INSERT_ID();')
    return sql_statements

def create_agent():
    sql_statements = []
    action = generate_random_str(32)
    observation = generate_random_str(32)
    path = generate_random_str(256)
    sql_statements.append(agent_sql.format(action, observation, path))
    sql_statements.append('SET @AgentID = LAST_INSERT_ID();')
    return sql_statements

def create_model():
    sql_statements = []
    name = generate_random_str(32)
    path = generate_random_str(256)
    sql_statements.append(model_sql.format(name, 0, path))
    sql_statements.append('SET @ModelID = LAST_INSERT_ID();')
    return sql_statements

def create_equipmentBelongsTo():
    return [equipmentBelongsTo]

def create_agentUsesModel():
    return [agentUsesModel_sql]

def create_worksOn():
    return [worksOn_sql]

def create_experimentusesenvironment():
    return [experimentusesenvironment_sql]

def create_environmenthasspace():
    space = generate_random_str(64)
    isAction = True
    return [environmenthasspace_sql.format(space, isAction)]

def create_agentparticipates():
    return [agentparticipates_sql]

def create_result():
    path = generate_random_str(256)
    return [result_sql.format('FALSE', path)]

def generate_random_str(length=16):
    return "".join([chr(randint(65, 91)) for _ in range(length)])

if __name__ == "__main__":

    insertion_list = []
    for i in range(5):
        insertion_list.extend(create_environment())
        insertion_list.extend(create_environmenthasspace())
        insertion_list.extend(create_equipment())
        insertion_list.extend(create_model())
        insertion_list.extend(create_agent())
        insertion_list.extend(create_agentUsesModel())
        
        insertion_list.extend(create_faculty())
        insertion_list.extend(create_equipmentBelongsTo())
        insertion_list.extend(create_project())
        insertion_list.extend(create_worksOn())
        insertion_list.extend(create_student())
        insertion_list.extend(create_worksOn())
        insertion_list.extend(create_experiment())
        insertion_list.extend(create_experimentusesenvironment())
        insertion_list.extend(create_agentparticipates())
        insertion_list.extend(create_result())


    print("\n".join(insertion_list))
    with open('fill_JAK.sql', 'wt') as sql:
        sql.write('use JAK;\n')
        sql.write('\n'.join(insertion_list))

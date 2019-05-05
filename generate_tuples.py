
from random import randint, choice
from time import gmtime, strftime


person_sql = "insert into person (username, passwordHash, joined) values ('{}','{}','{}');"
student_sql = "insert into student (ID, major, classification) values (LAST_INSERT_ID(),'{}',{:d});"
faculty_sql = "insert into faculty (ID, department) values (LAST_INSERT_ID(),'{}');"
project_sql = "insert into project (startDate, endDate, leadID, name) values ('{}','{}',LAST_INSERT_ID(),'{}');"
experiment_sql = "insert into experiment (ProjectID, experimentNo, startDate, category) values (LAST_INSERT_ID(),{:d},'{}',{:d});"

def generate_random_str(length=16):
    return "".join([chr(randint(65, 91)) for _ in range(length)])

MAJORS = ['CSCI', 'ME', 'EE']


if __name__ == "__main__":

    insertion_list = []
    for i in range(5):
        name = generate_random_str()
        passHash = generate_random_str(60)
        joined = strftime("%a, %d %b %Y %H:%M:%S +0000", gmtime())
        insertion_list.append(person_sql.format(name, passHash, joined))
        insertion_list.append(student_sql.format(choice(MAJORS), randint(1, 4)))

    for i in range(5):
        name = generate_random_str()
        passHash = generate_random_str(60)
        joined = strftime("%a, %d %b %Y %H:%M:%S +0000", gmtime())
        start = strftime("%a, %d %b %Y %H:%M:%S +0000", gmtime())
        end = strftime("%a, %d %b %Y %H:%M:%S +0000", gmtime())
        project_name = generate_random_str()
        insertion_list.append(person_sql.format(name, passHash, joined))
        insertion_list.append(faculty_sql.format(choice(MAJORS)))
        insertion_list.append(project_sql.format(start, end, project_name))
        insertion_list.append(experiment_sql.format(i, start, 0))



    print("\n".join(insertion_list))
    with open('fill_JAK.sql', 'wt') as sql:
        sql.write('use JAK;\n')
        sql.write('\n'.join(insertion_list))

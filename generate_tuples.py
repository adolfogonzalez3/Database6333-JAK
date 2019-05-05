
from random import randint, choice
from time import gmtime, strftime

person_sql = "insert into person (username, passwordHash, passwordSalt, joined) values ('{}',{:d},'{}','{}');"
student_sql = "insert into student (ID, major, classification) values (LAST_INSERT_ID(),'{}',{:d});"
faculty_sql = "insert into faculty (ID, department) values (LAST_INSERT_ID(),'{}');"
project_sql = "insert into project (startDate, endDate, leadID, name) values ('{}','{}',{:d},'{}');"
experiment_sql = "insert into experiment values ({:d},{:d},'{}',{:d});"


def generate_random_str(length=16):
    return "".join([chr(randint(65, 91)) for _ in range(length)])

MAJORS = ['CSCI', 'ME', 'EE']

if __name__ == "__main__":

    insertion_list = []
    for i in range(5):
        name = generate_random_str()
        salt = generate_random_str(8)
        passHash = hash(name + salt)
        joined = strftime("%a, %d %b %Y %H:%M:%S +0000", gmtime())
        insertion_list.append(person_sql.format(name, passHash, salt, joined))
        insertion_list.append(student_sql.format(choice(MAJORS), randint(1, 4)))

    for i in range(5):
        name = generate_random_str()
        salt = generate_random_str(8)
        passHash = hash(name + salt)
        joined = strftime("%a, %d %b %Y %H:%M:%S +0000", gmtime())
        insertion_list.append(person_sql.format(name, passHash, salt, joined))
        insertion_list.append(faculty_sql.format(choice(MAJORS)))


    print("\n".join(insertion_list))
    with open('fill_JAK.sql', 'wt') as sql:
        sql.write('use JAK;\n')
        sql.write('\n'.join(insertion_list))

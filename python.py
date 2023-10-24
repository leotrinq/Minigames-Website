import random

for i in range(1, 201):
    score_cd = round(random.uniform(0.2, 3),2)
    score_timer = round(random.uniform(0.5, 8),2)
    score_qte = round(random.uniform(0.5, 3),2)
    print("(",i,",","'",1,"'",",", "'",score_cd,"'","),")
    print("(",i,",","'",2,"'",",", "'",score_timer,"'","),")
    print("(",i,",","'",3,"'",",", "'",score_qte,"'","),")

for i in range(1, 201):
    username = "user" + str(i)
    password = "test"
    print("(",i,",","'",username,"'",",", "'",password,"'","),")
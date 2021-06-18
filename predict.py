@app.route('/',methods = ['GET'])
import torch
import torch.nn as nn
from  torch.autograd  import Variable
import torch.optim as optim 
import pandas as pd
import os
os.chdir("C:\\Users\hp\Desktop\dell")
users = pd.read_csv('users.csv' ).values.tolist()
user_id = [users[i][0] for i in range(len(users))]
loyal_customer = pd.read_csv('loyal.csv' , header = None ).values.tolist()[0]
orders = pd.read_csv('orders.csv' , header = None ).values.tolist()
class model(nn.Module):    
    def __init__(self):
        super(model , self ).__init__()
        self.layers = nn.Sequential(
                nn.Linear(3, 18),
                nn.ReLU(),
                nn.Linear(18 , 144),
                nn.ReLU(),
                nn.Linear(144, 288),
                nn.ReLU(),
                nn.Linear(288 , 144),
                nn.ReLU(),
                nn.Linear(144, 72),
                nn.ReLU(),
                nn.Linear(72, 36),
                nn.ReLU(),
                nn.Linear(36, 18),
                nn.ReLU(),
                nn.Linear(18 , 9),
                nn.ReLU(),
                nn.Linear(9 , 1),                
                nn.Sigmoid())
    def forward(self , x ):
        return self.layers(x)       
main_model = model()
main_model.load_state_dict(torch.load('main_model_saved.pkl'))
main_model.eval()
def predict(x):
    orders_of_x = []
    for i in orders:
        if i[1] == x :
            orders_of_x.append(i)
    s = []
    for i in range(len(orders_of_x)):
        input = []
        input.append(orders_of_x[i][2] /1182243)
        input.append(orders_of_x[i][3] /1607)
        input.append(orders_of_x[i][4] /2258)
        input = Variable(torch.FloatTensor(input))
        pred = main_model.forward(input).data[0].tolist()
        if pred > 0.5 :
            pred = 1
        else :
            pred = 0 
        s.append(pred)
    print(s)
    s= sum(s)/len(s)
    if s > 0.5 :
        return 1
    else:
        return 0


from flask import Flask, request
app = Flask(__name__)

@app.route('/',methods = ['GET'])
def hello_world():
    body = request.get_data()
    header = request.headers
    x = request.args['x1']
    return predict(x)
if __name__ == '__main__':
   app.run()

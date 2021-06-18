# -*- coding: utf-8 -*-
"""
Created on Thu Nov 15 10:36:36 2018

@author: MUJ
"""

import pandas as pd
import numpy as np
import matplotlib.pyplot as plt

#Importing the dataset
data=pd.read_csv("customers.csv")

features=data.iloc[:,3:].values
labels=data.iloc[:,2].values

from sklearn.cross_validation import train_test_split
features_train,features_test,labels_train,labels_test=train_test_split(features,labels,test_size=0.1,random_state=0)

#scaling of data
from sklearn.preprocessing import StandardScaler
sc=StandardScaler()
features_train=sc.fit_transform(features_train)
features_test=sc.transform(features_test)

#system is trained using linear regression
from sklearn.linear_model import LinearRegression
regressor=LinearRegression()
regressor.fit(features_train,labels_train)


#prediction done  over test data
pred=regressor.predict(features_test)

#prediction over next lot of data
x=pd.read_csv("rfmmed.csv")
testd=x.iloc[99:,1:]
testd=sc.transform(testd)
pred1=regressor.predict(testd)

score=regressor.score(features_train,labels_train)
print(score)
score=regressor.score(features_test,labels_test)
print(score)

#print(regressor.coef_)
df_loyal=data[data['loyalty_points']>=2]
df_not_loyal=data[data['loyalty_points']<=1]


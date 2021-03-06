import requests
import geopy
from geopy.geocoders import Nominatim   #Подключаем Openstreetmap


coordinat=Nominatim()

# n=coordinat.geocode('')
# print(n.latitude,n.longitude)

vysov='Нижний Новгород, площадь Революции, 2А' #56.321779, 43.946457

x=coordinat.geocode(vysov)
vysov1=[x.latitude,x.longitude] #Получаем координаты вызова
#Для наглядности впишем их вручную, а также координаты двух подстанций

vysov1=[56.321779, 43.946457]

podst1=[56.316674, 43.944766] #Нижний Новгород, ул.Фильченкова, 42 здесь вставить результат запроса
podst2=[56.244610, 43.862220] #Нижний Новгород, пр.Ильича, 5

podst=[podst1,podst2]
car1=4
car2=3
type1_car1=0
type1_car2=1

d1=[]
for i in podst:
    d=abs(vysov1[0]-i[0])+abs(vysov1[1]-i[1])*100
    d1.append(d)

short1=[100000,0,car1]
short2=[100000,0,car2]

for i in range(0,len(d1)-1):
    if d1[i]>d1[i+1] and d1[i]<=short2[0]:
        short2[0]=d1[i]
        short2[1]=i #Запоминаем номер подстанции
    if d1[i]<d1[i+1] and d1[i]<short1[0]:
        short1[0] = d1[i]
        short1[1] = i  # Запоминаем номер подстанции
    if d1[i+1]<short2[0]:
        short2[0] = d1[i+1]
        short2[1] = i  # Запоминаем номер подстанции

dx=abs(short1[0]-short2[0])

if dx<(short1[0]*0.1): #Если расстояние отличается менее чем на 10 процентов, тогда рекомендуем больницу с большим кол-вом машин
    if short2[2]>short1[2]:
        if short2[1]==1:
            print('Рекомендуемая подстанция отправления бригады', short2[1]+1, ' - Нижний Новгород, ул.Фильченкова, 42')
        else:
            print('Рекомендуемая подстанция отправления бригады', short2[1] + 1, ' - Нижний Новгород, пр.Ильича, 5')
    else:
        if short1[1]==1:
            print('Рекомендуемая подстанция отправления бригады', short1[1]+1, ' - Нижний Новгород, ул.Фильченкова, 42')
        else:
            print('Рекомендуемая подстанция отправления бригады', short1[1] + 1, ' - Нижний Новгород, пр.Ильича, 5')
else:
    if short1[1] == 1:
        print('Рекомендуемая подстанция отправления бригады', short1[1] + 1, ' - Нижний Новгород, ул.Фильченкова, 42')
    else:
        print('Рекомендуемая подстанция отправления бригады', short1[1] + 1, ' - Нижний Новгород, пр.Ильича, 5')

print('Расстояние до вызова ',round(d,3),' км')


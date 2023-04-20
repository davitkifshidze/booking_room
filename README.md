# Booking Room

პროექტის ფუნციონირებაში მოსაყვანად მიჰყევით ინსტრუქციას


#### მოახდინეთ კომპოზერის ინსტალაცია


```bash
  composer install
```


- .env.example შიგთავისი გადაიტანეთ .env-ში და მოახდინეთ შესაბამისი მონაცმებიც გაწერა

- შექმენით ბაზა შესაბამისი სახელით რომელსაც გაუწერთ .env ფაილში

#### გაუშვით შემდეგი ბრძანება თეიბლების შესაქმნელად

```bash
  php artisan migrate
```

#### გაუშვით შემდეგი ბრძანება მონაცემთა ბაზაში ინფორმაციის შესატანად

```bash
  php artisan db:seed
```


- ბრძანების გაშვების შემდგომ admins თეიბლში ჩაემატება ადმინისტრატორი შესაბამისი მონაცემებით


## ადმინისტრატორის მონაცმები

| email                     | password                  |
| ------------------------- | ------------------------- |
| booking_room@gmail.com    | admin |



### მოახდინეთ პროექტის გაშვება შემდეგი ბრძანების საშვალებით

```bash
  php artisan serve
```


### დამხმარე სექცია

- თუ პროექტის შექმნისას წარმოიშვა გარკვეული სახის პრობელემები დაგეხამრებათ შემდეგი ბრძანებები

```bash
  php artisan key:generate
```
```bash
  php artisan config:cache
```





- პროექტში გვაქვს ძირითადი სამი ინტერფეისი: ადმინისტარტორის, მომხმარებლის და პლანშეტი ინტერფეისი.


## როუტები


#### ადმინპანელის საბაზისო როუტები
```http
  GET  /admin
  GET  /admin/login
  POST /admin/login
  GET  /admin/dashboard
  GET  /admin/logout
```


#### ადმინპანელში მომხმარბელების როუტები

```http
  GET     /admin/user
  POST    /admin/user/create
  delete  /admin/user/{id}
  get     /admin/user/{id}/edit
  put     /admin/user/{id}
```

| Parameter | Type     | Description                                 |
| :-------- | :------- | :------------------------------------------ |
| `id`      | `integer`| მომხმარებლის იდენტიფიკატორი              |


#### ადმინპანელში ოთახების როუტები

```http
  GET     /admin/room
  POST    /admin/room/create
  delete  /admin/room/{id}
  get     /admin/room/{id}/edit
  put     /admin/room/{id}
```

| Parameter | Type     | Description                                 |
| :-------- | :------- | :------------------------------------------ |
| `id`      | `integer`| ოთახის იდენტიფიკატორი                     |



#### ადმინპანელში ჯავშნის როუტები

```http
  GET     /admin/booking
  GET     /admin/booking/create
  POST    /admin/booking/create
  delete  /admin/booking/{id}
  get     /admin/booking/room/{id}
```

| Parameter | Type     | Description                                 |
| :-------- | :------- | :------------------------------------------ |
| `id`      | `integer`| ჯავშნის იდენტიფიკატორი                     |
| `id`      | `integer`| ოთახის იდენტიფიკატორი                     |

### მომხმარებლის ინტერფეისის როუტები

```http
  GET   /user/login
  POST  /user/login
  GET   /user/registration
  POST  /user/registration
  GET   /user/logout
  GET   /user/dashboard
```

#### მომხმარებლის ჯავშნების როუტები

```http
  GET    /user/booking
  DELETE /user/booking/{id}
  GET    /user/booking/create
  GET    /user/booking/room/{id}
  POST   /user/booking/create
```

| Parameter | Type     | Description                                 |
| :-------- | :------- | :------------------------------------------ |
| `id`      | `integer`| ჯავშნის იდენტიფიკატორი                     |
| `id`      | `integer`| ოთახის იდენტიფიკატორი                     |



### პლანშეტის ინტერფეისის როუტები

```http
  GET   /tablet

  GET    /tablet/room
  GET    /tablet/room/{id}
  GET    /tablet/room/{id}/booking
  POST   /tablet/room/user
  POST   /tablet/room/create

```
| Parameter | Type     | Description                                 |
| :-------- | :------- | :------------------------------------------ |
| `id`      | `integer`| ოთახის იდენტიფიკატორი                     |
| `id`      | `integer`| ოთახის იდენტიფიკატორი                     |

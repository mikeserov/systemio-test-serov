чтобы развернуть приложение, запустите команду:
```
cp .env.example .env && docker-compose up
```
пример HTTP-запроса к `/calculate-price`:
```
curl --location 'http://127.0.0.1:8080/calculate-price' \
--header 'Content-Type: application/json' \
--data '{
    "product": 1,
    "taxNumber": "IT12345678999",
    "couponCode": "euro_5"
}'
```
пример HTTP-запроса к `/purchase`:
```
curl --location 'http://127.0.0.1:8080/purchase' \
--header 'Content-Type: application/json' \
--data '{
    "product": 1,
    "taxNumber": "IT12345678999",
    "couponCode": "euro_3",
    "paymentProcessor": "paypal"
}'
```
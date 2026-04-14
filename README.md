# WB API

Тестовое REST API на Laravel 8 для работы с данными Wildberries.  
Получает данные из внешнего API и сохраняет в собственную БД, а также отдаёт их с фильтрацией и пагинацией.

**Стек:** PHP 8.1, Laravel 8, MySQL, Laravel Octane

---

## Авторизация

Все запросы требуют передачи токена в строке запроса:

```
?key=ваш_токен
```

---

## Сущности и эндпоинты

Для каждой сущности доступно два метода:

- `GET` — выдача данных из локальной БД с фильтрацией по датам и пагинацией
- `POST .../store` — загрузка данных из внешнего API и сохранение в локальную БД

### Продажи

```
GET  /api/sales?dateFrom=2026-03-01&dateTo=2026-04-01&limit=100&page=1&key=...
POST /api/sales/store?key=...
```

Body для store: `{ "dateFrom": "2026-03-01", "dateTo": "2026-04-01", "limit": 100 }`

### Заказы

```
GET  /api/orders?dateFrom=2026-03-01&dateTo=2026-04-01&limit=100&page=1&key=...
POST /api/orders/store?key=...
```

Body для store: `{ "dateFrom": "2026-03-01", "dateTo": "2026-04-01", "limit": 100 }`

### Склады

```
GET  /api/stocks?dateFrom=2026-04-01&limit=100&page=1&key=...
POST /api/stocks/store?key=...
```

Body для store: `{ "dateFrom": "2026-04-01", "dateTo": "2026-04-01", "limit": 100 }`

### Поставки

```
GET  /api/incomes?dateFrom=2026-03-01&dateTo=2026-04-01&limit=100&page=1&key=...
POST /api/incomes/store?key=...
```

Body для store: `{ "dateFrom": "2026-03-01", "dateTo": "2026-04-01", "limit": 100 }`

---

## Параметры запросов

| Параметр   | Описание                               | Формат        |
|------------|----------------------------------------|---------------|
| `dateFrom` | Дата начала выборки (обязательный)     | `Y-m-d`       |
| `dateTo`   | Дата конца выборки (обязательный)      | `Y-m-d`       |
| `limit`    | Размер страницы, макс. 100 для store, 500 для list | число |
| `page`     | Номер страницы                         | число         |
| `key`      | Токен авторизации                      | строка        |

---

## Установка

```bash
cd application
php artisan key:generate
php artisan migrate
```

Настройте `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=89.218.15.180
DB_PORT=3307
DB_DATABASE=wb_api
DB_USERNAME=wb_user
DB_PASSWORD=r00tr00t_SA

API_URL=http://...
API_KEY=...
```

---

## Архитектура

```
Contracts/   — интерфейс WildberriesApiClientContract
DTO/         — объекты передачи данных (StockDTO, IncomeDTO, SaleDTO, OrderDTO)
Services/    — WildberriesApiClient (http-клиент), *Service (бизнес-логика store)
```

Внешний API опрашивается постранично. Данные сохраняются через `upsert` — повторный вызов store обновит существующие записи, не создавая дубликатов.

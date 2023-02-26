# NBP task
Write a service that provides the calculated average buy rate based on data from the National Bank of
Poland. The data downloaded from the NBP are: buy rate. Upload the code to a repository. The task
should be done in PHP.

#### Endpoint
> GET /{currency}/{startDate}/{endDate}/
- Supported currencies: USD, EUR, CHF, GBP
- startDate, endDate: format RRRRMMYY

#### information and tips
- information and necessary tips to download data from the NBP on the website:
  - http://www.nbp.pl/home.aspx?f=/kursy/instrukcja_pobierania_kursow_walut.html
  - http://api.nbp.pl/
- start and end date rates are also to be taken into account




#### Example
> GET /EUR/2013-01-28/2013-01-31/
Response:
```
{
“average_price”: 4,1505
}
```

_Pure PHP, no framework nor package manager_

### run (Windows)
> php -S 127.0.0.1:8000 -t ./

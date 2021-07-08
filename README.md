Zadanie rekrutacyjne RBR na stanowisko PHP – Junior Web Developer

Aplikacja ma za zadanie pobierać dane z dostarczonego API(users, posts) oraz zapisywać je do bazy danych. Pobieranie ma być wykonywane raz dziennie.
Następnie je wyświetlać te dane w tabeli w widoku oraz wyświetlać najpopularniejszych użytkowników w ciągu ostatnich 7 dni na wykresie.

Ważne informacje:

1. Pobieranie danych jest wykonywane przy pomocy CURL.
2. Dane z users rozbiłem na 3 tabele (users, address oraz company), rozdzielenie tych danych wydaje mi się logiczne.
3. Nigdy nie korzystałem z zadań cron w laravelu (wcześniej jedynie z wykorzystaniem crona na serwerze), więc przy tej części posiłkowałem się dokumentacją.
4. Wykres danych jest wykonany przy użyciu pluginu: https://apexcharts.com/
5. Miałem spory problem z wyciągnięciem danych najbardziej aktywnych użytkowników z ostatnich 7 dni. Zrobiłem to trochę na około, ale wynik jest prawidłowy. Wykorzystałem tutaj datę z kolumny created_at. Jeżeli baza w API nie rośnie, czyli nie przybywa nowych rekordów to niestety ale to zawsze będzie tylko jeden dzień(w celu sprawdzenia działania po prostu zmieniałem daty w bazie). Tak to mniej więcej działa:
    - pobieram wszystkie posty z ostatnich 7 dni
    - grupuję je według dni dodania
    - otrzymaną kolekcję mapuje oraz grupuję według user_id
    - otrzymane kolekcje sortuje po ilości artykułów danego user_id
    - pierwsza kolekcja z danego dnia od góry jest kolekcją artykułów najpopularniejszego użytkownika

    Co prawda jest tylko jedno zapytanie do bazy, ale reszta operacji jest po stronie PHP. Przy dużej ilości danych takie rozwiązanie ze względu na użytą pamięć będzie nie zbyt optymalne.


Plik odpowiedzialny za aktualizację danych z dostarczonego API:
app/Http/Controllers/UpdateDataController.php

Pliki odpowiedzialne za cykliczne zadanie CRON:
app/Console/Commands/UpdateDataCron.php
app/Console/Kernel.php

Pliki odpowiedzialne za pobieranie i wyświetlanie danych:
app/Http/Controllers/PostController.php
app/Http/Controllers/StatisticController.php

oraz widoki:
resources/views/chart.blade.php
resources/views/posts.blade.php
resources/views/post.blade.php


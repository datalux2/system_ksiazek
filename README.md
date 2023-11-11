System książek
==============

Projekt został zrobiony za pomocą:

- Symfony 6.3.7

- PHP 8.2.4 x64

- Mysql 8.1.0 x64

- Apache 2.4.56 x64

- Bootstrap 5.3.2

Przed uruchomieniem projektu trzeba założyć bazę danych o nazwie "system_ksiazek" i uruchomić skrypt SQL w pliku system_ksiazek.sql w folderze "sql" 
w głównym folderze aplikacji na tej bazie danych. Do projektu trzeba dograć biblioteki Symfony i Symfony Webpack-Encore. W pliku .env w głównym 
folderze aplikacji ustawiamy zmienną APP_NAME na nazwę aplikacji i zmienną PAGINATION_NUM_ROWS na liczbę maksymalną wierszy wyświetlaną w ramach 
jednej strony paginacji na liście książek. Po uruchomieniu aplikacji z menu trzeba wybrać "Książki" i wówczas pojawi się lista książek. 
Jeśli na liście nie będzie książek będzie napis "Brak książek". Aby dodać książkę do bazy danych trzeba kliknąć w link "Dodaj książkę". 
Po kliknięciu w ten link pojawi się formularz dodawania książki. W tym formularzu trzeba podać imię, nazwisko, tytuł i opis. Po wciśnięciu 
przycisku "Zapisz" zostanie dodana do bazy danych nowa książka. Jeśli chcemy zaktualizować jakąś książkę to przy wybranej z listy książce trzeba 
wcisnąć link "Edytuj". Po wciśnięciu tego przycisku pojawi się formularz aktualizacji książki gdzie w polach analogicznych jak w formularzu 
dodawania książki będziemy mieli wpisane dane z bazy. W tych polach możemy zmienić dane. Po wciśnięciu przycisku "Aktualizuj" zostanie 
zaktualizowana książka. Jeśli chcemy usunąć wybraną książke to z listy książek przy wybranym wpisie wciskamy link "Usuń". Po wciśnięciu tego 
linku pojawi się okno z zapytaniem czy jesteś pewny usunąć tą książkę. Po zatwierdzeniu tego okna książka zostanie usunięta. Jeśli w tym oknie 
wciśniemy "Anuluj" to ta książka nie zostanie usunięta. Na dole listy książek jest paginator w którym możemy wybierać za pomocą linków poszczególne 
strony z listy.

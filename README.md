# Yoomoney
Интегрирует оплату через Yoomoney во Flute CMS

# Установка
1. Добавляем модуль стандартными средствами (через админ-панель или перекидыванием во `app/Modules`)
2. Устанавливаем и активируем его в админ-панели
3. Чистим обязательно кеш (Основное -> кеши -> очистить весь кеш)
4. Добавляем наш HTTP [обработчик тут](https://yoomoney.ru/transfer/myservices/http-notification?lang=ru). URL сайта указан в поле "Handle URL" при добавлении платежного шлюза во Flute.
![image](https://github.com/Flute-CMS/Yoomoney/assets/62756604/3ca1512f-0b59-4fc4-8cdf-f068bcbf88d9)
![image](https://github.com/Flute-CMS/Yoomoney/assets/62756604/2e278971-3125-4ab0-9fd5-0df5b94102af)
5. Добавляем нашу платежную систему с такими параметрами (другие можно удалить)
![image](https://github.com/Flute-CMS/Yoomoney/assets/62756604/ffeec263-31af-493b-94c9-c6f352542890)
6. Добавляем нашу платежную систему в валюту (код валюты будет использован в платежной системе):
![chrome_8UUu2DcqWl](https://github.com/Flute-CMS/Yoomoney/assets/62756604/89a25f50-4d88-4bb8-bd14-daa85dba31af)
7. Можем проверять работу в `/lk`

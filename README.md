
## Задание 

Форма обратной связи для системы iFORA.
Разработать на PHP форму обратной связи для записи на показ системы iFORA. Основные поля формы: ФИО, контактная информация, желаемые дата и время показа.
При отправке формы на адрес электронной почты администратора приходит письмо, запись сохраняется в базе данных.
Желательно для администратора сделать страницу с возможностью просмотра всех ответов.
Дополнительные требования: валидация формы, выгрузка ответов в csv, Excel.

## Решение

Приложение создано с учетом следующих допущений 
 
- Так как это тестовое задание отправка писем сделана в минималистичном варианте. В случае боевого приложения целесообразно было бы использование smtp + верстки HTML писем
- База данных сохраняет все поля формы. Сделано это так как в задании в качестве альтернативного варианта предлагается отправка email. В случае работы только с базами данных было бы целесообразно хранение данных разбить на две таблицы так как один пользователь может написать несколько запросов.
- Поскольку не был задан формат телефонных номеров форма ориентирована на российские мобильные + городские с кодом из 3 цифр (например, Москва). Примеры:
                *    +79261234567
                *    89261234567
                *    79261234567
                *    +7 926 123 45 67
                *    8(926)123-45-67
                *    123-45-67
                *    9068702
                *    9261234567
                *    79261234567
                *    (495)1234567
                *    (495) 123 45 67
                *    89261234567
                *    8-926-123-45-67
                *    8 927 1234 234
                *    8 927 12 12 888
                *    8 927 12 555 12
                *    8 927 123 8 123
- email на фронтэнде проверяется согласно RFC 5322 Official Standard (см. https://emailregex.com/email-validation-summary/)




author: Димитър Ников
title: PHP Frameworks
subtitle: Задание за курсов проект
email: dimitar.nikov@primeholding.com
url: https://www.primeholding.com
url-title: www.primeholding.com

# Съдържание
- Навигация
- Базово задание
- Разширено задание
- Контрол на достъпа
- Дизайн на приложението
- ER диаграма на базата данни

# Навигация
- → за преход към следващ слайд
- ← за преход към предходен слайд
- Ctrl* + → за преход към следващ слайд
- Ctrl* + ← за преход към предходен слайд
- Home за преход към първия слайд, End за преход към последния слайд

<br>
\* Ctrl или Shift понеже по презумпция само Shift работи за Opera браузър.
<br>

# Базово задание

<br>
Да се създаде web приложение, което реализира презентация на CRUD интерфейс (наричан по-долу grid или data grid). Приложението презентира:
<br>

- Имплементация на форма за търсене в базата данни
- Презентация на резултата от търсенето в табличен вид
- Сортиране на резултата по определени критерии
- Възможност за контрол на страницирането (представяне резултата на „порции”)

<br>
### Формата за търсене съдържа следните критерии, по които може да се търси:
<br>
- Име на студент – текстово поле, въвежда се свободен текст. Резултата се оценява, чрез допълване отдясно. Пример: при въведена фраза за търсене „Иван”, допустими резултати са: Иван Иванов, Иванка Петрова и т.н.
- Специалност – избира се от падащ списък с предварително дефирнирани специалности в базата данни. Резултата се оценява само за конкретно избрана специалност, без значение курса на студентите.
- Курс – избира се от падащ списък с предварително дефинирани комбинации от курс и специалност. Пример: Първи курс, БИТ; Първи курс, Информатика; Първи курс Математика и Информатика и т.н. Резултата се оценява само за конкретно избрана комбинация от курс и специалност

<br>
### Изисквания към резултата (т.е. съдържанието на табличните данни):
<br>
- Номер по ред
- Собствено име и фамилия на студента
- Име на курс – представлява комбинация от името на курса и името на специалността
- Данни за хорариум и оценка за три дисциплини (напр. Математика, Информатика и Физика) във следния вид:
    - Хорариум лекции във вид XX (YY), където XX е необходимия хорариум в часове зададен за конкетната дисциплина, а YY – реалното посещение на студента
    - Оценка на студента за текущата дисциплина – словом и цифром, според шестобалната система използвана в РБългария
- Обща стойност за хорариума в часове във формат XX (YY)
- Среден успех на студента

<br>
### Сортиране на данните:
<br>
- Заглавните редове (т.нар. антетка на таблицата) са хипервръзки, които могат да влияят на сортирането на резултата
- До името на колоната следва да се визуализира посоката на сортиране (по подразбиране сортирането е във възходящ ред)
- Следните колони трябва да могат да бъдат сортирани: Номер по ред, Име и фамилия, Хорариум лекции и упражнения и Оценка

<br>
### Контрол на страницирането 
Непосредствено преди и след таблицата (grid-а) с резултата са разположени контроли за странициране на резултата, които съдържат:
<br>
- Хипер връзка за бърз преход към първа страница от резултата (ако е достъпна)
- Хипер връзка за бърз преход към предходна страница от резултата (ако е достъпна)
- Пореден номер на страница от резултата, която е визуализирана плюс контрол за бърз преход до произволно избрана страница от резултата (посредством поле за въвеждане номер на страница и бутон за изпращане на данните)
- Общ брой на страниците от резултата
- Хипер връзка за бърз преход към следваща страница от резултата (ако е достъпна)
- Хипер връзка за бърз преход към последната страница от резултата (ако е достъпна)

<br>
### Примерен изглед
<br>
![Примерен изглед на грид с общи данни](images/all-in-one.png?src=centerme)

# Разширено задание

Да се разшири функционалността на web приложението, чрез добавяне на CRUD интерфейс за управление на студенти, специалности, дисциплини, курсове и оценки.
<br>
Да се имплементират необходимите гридове и форми за създаване, преглед, редактиране и изтриване (C. R. U. D.) на записите, които участват в генерирането на таблицата от първата част на заданието.
<br>
<br>
### CRUD интерфейс за управление на "Курс"

##### Грид с данни
![Data grid](images/courses-grid.png?src=centerme)

##### Форма за добавяне
![Форма за добавяне](images/courses-add.png?src=centerme)

##### Форма за редактиране
![Форма за редактиране](images/courses-edit.png?src=centerme)

##### Изтриване на Курс
![Изтриване на Курс](images/courses-delete.png?src=centerme)

<br>
<br>
### CRUD интерфейс за управление на "Специалност"

##### Грид с данни
![Data grid](images/specialities-grid.png?src=centerme)

##### Форма за добавяне
![Форма за добавяне](images/specialities-add.png?src=centerme)

##### Форма за редактиране
![Форма за редактиране](images/specialities-edit.png?src=centerme)

##### Изтриване на Специалност
![Изтриване на Специалност](images/specialities-delete.png?src=centerme)

<br>
<br>
### CRUD интерфейс за управление на "Дисциплина"

##### Грид с данни
![Data grid](images/subjects-grid.png?src=centerme)

##### Форма за добавяне
![Форма за добавяне](images/subjects-add.png?src=centerme)

##### Форма за редактиране
![Форма за редактиране](images/subjects-edit.png?src=centerme)

##### Изтриване на Дисциплина
![Изтриване на Дисциплина](images/subjects-delete.png?src=centerme)

<br>
<br>
### CRUD интерфейс за управление на "Студент"

##### Грид с данни
![Data grid](images/students-grid.png?src=centerme)

##### Форма за добавяне
![Форма за добавяне](images/students-add.png?src=centerme)

##### Форма за редактиране
![Форма за редактиране](images/students-edit.png?src=centerme)

##### Изтриване на Студент
![Изтриване на Студент](images/students-delete.png?src=centerme)

<br>
<br>
### CRUD интерфейс за управление на "Оценки"

##### Грид с данни
![Data grid](images/assessments-grid.png?src=centerme)

##### Форма за добавяне
![Форма за добавяне](images/assessments-add.png?src=centerme)

##### Форма за редактиране
![Форма за редактиране](images/assessments-edit.png?src=centerme)

##### Изтриване на Оценки
![Изтриване на Оценки](images/assessments-delete.png?src=centerme)

# Контрол на достъпа

Да се реализира ролево-базиран контрол на достъпа. По подразбиране достъпа е забранен и се разрешава достъп само до основната таблица с общи данни за оценки.
<br>
Приложението трябва да поддържа следните роли (и техните ограничения):
<br>
- Студент - има достъп за преглед до всички CRUD интерфейси без "Потребители"
- Преподавател - има достъп за управление (преглед, добавяне, редакция и изтриване) всички CRUD интерфейси без "Потребители"
- Администратор - има достъп за управление (преглед, добавяне, редакция и изтриване) до всички CRUD интерфейси

<br>
### **Бележки:** 
<br>
- Потребител с роля "Студент" може да се създава само от CRUD интерфейса за управление на студенти
- При добавяне на студент - данните трябва да се отразят в съответните таблици
- При промяна ролята на потребителя от "Студент" на по-висока процеса е необратим
- Таблиците, необходими за имплементиране контрола на достъп трябва да се добавят!

<br>
### CRUD интерфейс за управление на "Потребители"

##### Грид с данни
![Data grid](images/users-grid.png?src=centerme)

##### Форма за добавяне
![Форма за добавяне](images/users-add.png?src=centerme)

##### Форма за редактиране
![Форма за редактиране](images/users-edit.png?src=centerme)

##### Изтриване на Потребители
![Изтриване на Потребители](images/users-delete.png?src=centerme)

# Дизайн на приложението

### Общи препоръки
<br>
- Проекта да се реализира, чрез използване на Laravel Framework
- При затруднение за реализиране на custom pagination - може да се изполва някой от стандартните
- Всички промени по структурата на базата данни да бъдат добавени като migrations
- Всички примерни данни за задвижване на проекта да бъдат добавени като seeds
- В структурата на базата данни са заложени някои anti-patterns, който могат да бъдат коригирани по желание

<br>
### Изисквания към уеб дизайна
<br>
- Няма конкретни изисквания към уеб дизайна на приложението
- Няма конкретни изисквания за използване на JS/ и/или CSS/HTML faramework

<br>
### Приципен layout за изгледа на приложението
![Приципен layout за изгледа на приложението](images/design-layout.png?serc=centerme)

# ER диаграма на базата данни

![ER диаграма](images/db-schema.png?src=centerme)

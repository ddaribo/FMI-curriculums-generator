# FMI-curriculums-generator

Инсталация

Трябва да имате инсталиран xampp. Копирате папката в xampp/htdocs.
В phpmyadmin run-вате sql скрипта, който създава базата данни.
Системата е достъпна на адрес localhost/FMIcurriculums.

//TODO
- Стилизация
- Да се визуализират учебните планове и дисциплини по учебни планове - DONE
- User friendly import - DONE (евентуален goldplating да има опция с директно качване от компютъра)
=======
- Да се добави още полезно инфо към дисциплинаата - например в кой курс се изучава - +преглед и по курсове може би
- Да се визуализират учебните планове и дисциплини по учебни планове  - backend-a за това е готов, но може да се добави и изглед по-подробен изглед
- User friendly import - done
- Да се уточни как се съхраняват съдържание, конспект, библиография (те са масиви в JSON файла)
- Да се въведат някакви ауторизации - например само админ да може да експортне файла за дисциплината. Друг use-case e ако обикновен потребител или гост не може да вижда дисциплината + административното й инфо. - Done
- Ръчно да се добави админ в базата. -done
- Да се изградят различните режими на преглед на дисциплина кратък/подробен/административен - чрез toggle бутони/ асинхронни заявки / просто javascript + style:{display:none}?? - DONE

- *Функционалност за търсете*
- *Да се измисли начин как може да се изразят зависимости между различните теми от съдържанието на дисциплина. Информацията за тях ще е хардкодната. Може да се мисли в посока симулиране на графова БД в sql - стил vertex(topic):edge(depends-on):vertex(another-topic) . И да се търси туул за създаване на визуален граф по такива данни - или просто изобразяване на таблица.*


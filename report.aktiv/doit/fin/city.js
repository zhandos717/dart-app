// Создаем новый объект связанных списков
                     var syncList1 = new syncList;

                     // Определяем значения подчиненных списков (2 и 3 селектов)
                     syncList1.dataList = {

                     /* Определяем элементы второго списка в зависимости
                     от выбранного значения в первом списке */

                          'Актау':{
                              'Все':'Все',
                              '11 мкрн дом3':'11 мкрн дом3',
                              'мкр. 2 д. 9':'мкр. 2 д. 9'
                              },


                              'Актобе':{
                              'Все':'Все',
                              'Абулхаир Хана 84':'Абулхаир Хана 84',
                              'Шернияза 51':'Шернияза 51',
                              'Братья Жубановых 287': 'Братья Жубановых 287'
                              },

                              'Атырау':{
                              'Все':'Все',
                              'Сатпаева 32':'Сатпаева 32',
                              'Баймуханова 68Б':'Баймуханова 68Б'
                              },

                       'Алматы':{
                         'Акан Сери 11':'Акан Сери 11',
                         'Ауэзова 169':'Ауэзова 169',
                         'Ауэзова 32':'Ауэзова 32',
                         'Гоголя 91':'Гоголя 91',
                         'Минина 24':'Минина 24',
                         'Назарбаева 118':'Назарбаева 118',
                         'Сатпаева 109':'Сатпаева 109',
                         'Толе би 285':'Толе би 285'
                       },

                       'Астана':{
                         'Абая 8':'Абая 8',
                         'Абылай хана 6':'Абылай хана 6',
                         'Абылайхана 32/2 (Встреча)':'Абылайхана 32/2 (Встреча)',
                         'Бейбитшилик 47':'Бейбитшилик 47',
                         'Кабанбай батыра, 2':'Кабанбай батыра, 2',
                         'Кажымукана 22':'Кажымукана 22',
                         'Кенесары 65':'Кенесары 65',
                         'Сатпаева 23/1':'Сатпаева 23/1',
                         'Сыганак 18':'Сыганак 18',
                         'Тауелсыздык 45':'Тауелсыздык 45'
                       },
                       'Нур-Султан':{
                         'Абая 8':'Абая 8',
                         'Абылай хана 6':'Абылай хана 6',
                         'Абылайхана 32/2 (Встреча)':'Абылайхана 32/2 (Встреча)',
                         'Бейбитшилик 47':'Бейбитшилик 47',
                         'Кабанбай батыра, 2':'Кабанбай батыра, 2',
                         'Кажымукана 22':'Кажымукана 22',
                         'Кенесары 65':'Кенесары 65',
                         'Сатпаева 23/1':'Сатпаева 23/1',
                         'Сыганак 18':'Сыганак 18',
                         'Тауелсыздык 45':'Тауелсыздык 45'
                       },

                    

                       'Караганда':{
                         'Абдирова 19':'Абдирова 19',
                         'Майкудук 48':'Майкудук 48',
                         'Шахтеров (Ермекова) 52':'Шахтеров (Ермекова) 52'
                       },

                       'Кокшетау':{
                           'Абая 143':'Абая 143'
                       },


                       'Костанай':{
                           'Абая 173':'Абая 173'
                       },


                       'Павлодар':{
                           'Назарбаева 89':'Назарбаева 89'
                       },

                       'Семей':{
                           'Дулатова 145':'Дулатова 145'
                       },


                           'Талдыкорган':{
                           'Абая 254':'Абая 254'
                       },


                       'Тараз':{
                         'Все':'Все',
                           'Абая 170':'Абая 170',
                           'Самал 14':'Самал 14'
                       },

                       'Шымкент':{
                         'Байтурсынова 20':'Байтурсынова 20',
                         'Иляева 5/4':'Иляева 5/4',
                         'Назарбекова 11 (Нурсат)':'Назарбекова 11 (Нурсат)',
                         'Рыскулова 24/1':'Рыскулова 24/1',
                         'Рыскулова 84а':'Рыскулова 84а',
                         'Север (Терискей 9)':'Север (Терискей 9)',
                         'Уалиханова 192 (11 мкрн)':'Уалиханова 192 (11 мкрн)'
                       },
                       'Уральск':{
                         'Курмангазы 165':'Курмангазы 165',
                       }
                     };
                     // Включаем синхронизацию связанных списков
                     syncList1.sync("List1","List2");
                     // Создаем новый объект связанных списков

/**********************************************************************************************************************************************************/

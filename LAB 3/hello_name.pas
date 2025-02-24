PROGRAM HelloName(INPUT, OUTPUT);
USES Dos;
VAR
  QueryString, Name: STRING;
  PosName: INTEGER;
BEGIN
  { Вывод HTTP-заголовка }
  WRITELN('Content-Type: text/plain');
  WRITELN; { Пустая строка между заголовком и телом ответа }

  { Получение строки запроса }
  QueryString := GetEnv('QUERY_STRING');

  { Поиск параметра name= }
  PosName := Pos('name=', QueryString);
  
  IF PosName > 0 THEN
    Name := Copy(QueryString, PosName + 5, Length(QueryString)) { Извлекаем имя после 'name=' }
  ELSE
    Name := 'Anonymous';

  { Вывод результата }
  WRITELN('Hello dear, ', Name, '!')
END.

PROGRAM QUERYSTRING;
USES DOS;

FUNCTION GETQUERYSTRINGPARAMETER(key: STRING): STRING;
VAR
  queryString, param, foundKey, foundValue: STRING;
  posAmp, posEq, startPos: INTEGER;
BEGIN
  queryString := GETENV('QUERY_STRING');  { Получаем строку запроса }
  GETQUERYSTRINGPARAMETER := '';  { По умолчанию возвращаем пустую строку }
  
  startPos := 1;
  WHILE startPos <= LENGTH(queryString) DO
  BEGIN
    { Находим разделитель '&' или конец строки }
    posAmp := POS('&', COPY(queryString, startPos, LENGTH(queryString) - startPos + 1));
    IF posAmp = 0 
    THEN
      posAmp := LENGTH(queryString) - startPos + 2;
    
    { Выделяем один параметр "ключ=значение" }
    param := COPY(queryString, startPos, posAmp - 1);
    
    { Ищем символ '=' }
    posEq := POS('=', param);
    IF posEq > 0 
    THEN
      BEGIN
        foundKey := COPY(param, 1, posEq - 1);
        foundValue := COPY(param, posEq + 1, LENGTH(param) - posEq);
        IF foundKey = key 
        THEN
          BEGIN
            GETQUERYSTRINGPARAMETER := foundValue;
            EXIT  { Выходим, когда нашли нужный ключ }
          END
      END;
    
    { Переходим к следующему параметру }
    startPos := startPos + posAmp
  END
END;

VAR
  firstName, lastName, age: STRING;
BEGIN
  { Выводим обязательный HTTP-заголовок }
  WRITELN('Content-Type: text/plain');
  WRITELN;  { Пустая строка после заголовка обязательна }
  
  { Извлекаем параметры из QUERY_STRING }
  firstName := GETQUERYSTRINGPARAMETER('first_name');
  lastName := GETQUERYSTRINGPARAMETER('last_name');
  age := GETQUERYSTRINGPARAMETER('age');
  
  { Выводим полученные значения }
  WRITELN('First Name: ', firstName);
  WRITELN('Last Name: ', lastName);
  WRITELN('Age: ', age)
END.

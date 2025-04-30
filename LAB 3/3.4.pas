PROGRAM QUERYSTRING;
USES DOS;

FUNCTION GETQUERYSTRINGPARAMETER(key: STRING): STRING;
VAR
  queryString, param, foundKey, foundValue: STRING;
  posAmp, posEq, startPos: INTEGER;
BEGIN
  queryString := GETENV('QUERY_STRING');
  GETQUERYSTRINGPARAMETER := '';
  startPos := 1; 
  WHILE startPos <= LENGTH(queryString) DO
  BEGIN
    posAmp := POS('&', COPY(queryString, startPos, LENGTH(queryString) - startPos + 1));
    IF posAmp = 0 
    THEN
      posAmp := LENGTH(queryString) - startPos + 2;
    param := COPY(queryString, startPos, posAmp - 1);
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
            EXIT  
          END
      END;
    startPos := startPos + posAmp
  END
END;

VAR
  firstName, lastName, age: STRING;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;  
  firstName := GETQUERYSTRINGPARAMETER('first_name');
  lastName := GETQUERYSTRINGPARAMETER('last_name');
  age := GETQUERYSTRINGPARAMETER('age');
  WRITELN('First Name: ', firstName);
  WRITELN('Last Name: ', lastName);
  WRITELN('Age: ', age)
END.

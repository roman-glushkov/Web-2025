PROGRAM HelloName(INPUT, OUTPUT);
USES Dos;
VAR
  QueryString, Name: STRING;
  PosName: INTEGER;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  QueryString := GetEnv('QUERY_STRING');
  PosName := Pos('name=', QueryString);
  IF PosName > 0 
    THEN
    Name := Copy(QueryString, PosName + 5, Length(QueryString)) 
  ELSE
    Name := 'Anonymous';
  WRITELN('Hello dear, ', Name, '!')
END.

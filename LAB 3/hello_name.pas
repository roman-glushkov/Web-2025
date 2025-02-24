PROGRAM HelloName(INPUT, OUTPUT);
USES Dos;
VAR
  QueryString, Name: STRING;
  PosName: INTEGER;
BEGIN
  { ����� HTTP-��������� }
  WRITELN('Content-Type: text/plain');
  WRITELN; { ������ ������ ����� ���������� � ����� ������ }

  { ��������� ������ ������� }
  QueryString := GetEnv('QUERY_STRING');

  { ����� ��������� name= }
  PosName := Pos('name=', QueryString);
  
  IF PosName > 0 THEN
    Name := Copy(QueryString, PosName + 5, Length(QueryString)) { ��������� ��� ����� 'name=' }
  ELSE
    Name := 'Anonymous';

  { ����� ���������� }
  WRITELN('Hello dear, ', Name, '!')
END.

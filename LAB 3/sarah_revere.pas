PROGRAM SarahRevere(INPUT, OUTPUT);
USES Dos;
VAR
  QueryString: STRING;
BEGIN
  { ����� HTTP-��������� }
  WRITELN('Content-Type: text/plain');
  WRITELN; { ������ ������ ����� ���������� � ����� ������ }

  { ��������� QUERY_STRING }
  QueryString := GetEnv('QUERY_STRING');

  { ��������� �������� ��������� lanterns }
  IF QueryString = 'lanterns=1' THEN
    WRITELN('The British are coming by land.')
  ELSE IF QueryString = 'lanterns=2' THEN
    WRITELN('The British are coming by sea.')
  ELSE
    WRITELN('Sarah didn''t say.')
END.

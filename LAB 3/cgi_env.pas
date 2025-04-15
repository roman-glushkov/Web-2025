PROGRAM CgiEnv(INPUT, OUTPUT);
USES Dos; 
VAR
  RequestMethod, QueryString, ContentLength, UserAgent, Host: STRING;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  RequestMethod := GetEnv('REQUEST_METHOD');
  QueryString := GetEnv('QUERY_STRING');
  ContentLength := GetEnv('CONTENT_LENGTH'); 
  UserAgent := GetEnv('HTTP_USER_AGENT'); 
  Host := GetEnv('HTTP_HOST');  
  WRITELN('REQUEST_METHOD: ', RequestMethod);
  WRITELN('QUERY_STRING: ', QueryString);
  WRITELN('CONTENT_LENGTH: ', ContentLength);
  WRITELN('HTTP_USER_AGENT: ', UserAgent);
  WRITELN('HTTP_HOST: ', Host);
END.

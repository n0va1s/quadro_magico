UPDATE marcacao
SET ind_segunda = CASE 
  WHEN ind_segunda = 'S' THEN 1 
  WHEN ind_segunda = 'N' THEN -1 
  WHEN ind_segunda = 'O' THEN 4
  WHEN ind_segunda = 'B' THEN 3
  WHEN ind_segunda = 'R' THEN 2 
  WHEN ind_segunda = 'P' THEN 1 
END,
ind_terca = CASE 
  WHEN ind_terca = 'S' THEN 1 
  WHEN ind_terca = 'N' THEN -1 
  WHEN ind_terca = 'O' THEN 4
  WHEN ind_terca = 'B' THEN 3
  WHEN ind_terca = 'R' THEN 2 
  WHEN ind_terca = 'P' THEN 1 
END,
ind_quarta = CASE 
  WHEN ind_quarta = 'S' THEN 1 
  WHEN ind_quarta = 'N' THEN -1 
  WHEN ind_quarta = 'B' THEN 3
  WHEN ind_quarta = 'R' THEN 2 
  WHEN ind_quarta = 'P' THEN 1 
END,
ind_quinta = CASE 
  WHEN ind_quinta = 'S' THEN 1 
  WHEN ind_quinta = 'N' THEN -1 
  WHEN ind_quinta = 'O' THEN 4
  WHEN ind_quinta = 'B' THEN 3
  WHEN ind_quinta = 'R' THEN 2 
  WHEN ind_quinta = 'P' THEN 1 
END,
ind_sexta = CASE 
  WHEN ind_sexta = 'S' THEN 1 
  WHEN ind_sexta = 'N' THEN -1 
  WHEN ind_sexta = 'B' THEN 3
  WHEN ind_sexta = 'O' THEN 3
  WHEN ind_sexta = 'R' THEN 2 
  WHEN ind_sexta = 'P' THEN 1 
END,
ind_sabado = CASE 
  WHEN ind_sabado = 'S' THEN 1 
  WHEN ind_sabado = 'N' THEN -1 
  WHEN ind_sabado = 'O' THEN 4
  WHEN ind_sabado = 'B' THEN 3
  WHEN ind_sabado = 'R' THEN 2 
  WHEN ind_sabado = 'P' THEN 1 
END,
ind_domingo = CASE 
  WHEN ind_domingo = 'S' THEN 1 
  WHEN ind_domingo = 'N' THEN -1 
  WHEN ind_domingo = 'O' THEN 4
  WHEN ind_domingo = 'B' THEN 3
  WHEN ind_domingo = 'R' THEN 2 
  WHEN ind_domingo = 'P' THEN 1 
END
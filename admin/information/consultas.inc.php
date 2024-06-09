<?php
 $id = isset($_GET['id']) ? $_GET['id'] : '';
 $id_modal = isset($_GET['id_modal']) ? $_GET['id_modal'] : '';

//  consultas SQL para cada categoria
global $consultas;
$consultas = [
    'aluno' => 'WITH AlunoRecente AS (
      SELECT 
      aluno.foto_aluno,
      aluno.id_aluno,
        aluno.aluno,
          aluno.unico,
          aluno.id_turma,
          aluno.id_escola,
          aluno.id_orientador,
          aluno.id_encarregadoeducacao,
          aluno.data,
          aluno.ativo,
          ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
      FROM 
          aluno
      WHERE
          aluno.ativo = 1
  )
  SELECT 
  ar.foto_aluno,
  ar.id_aluno,
  ar.aluno,
      ar.unico,
      ar.id_turma,
      ar.id_escola,
      ar.id_orientador,
      ar.id_encarregadoeducacao,
      ar.data,
      ar.ativo,
      turma.*,
      escola.*,
      colaborador.*,
      encarregadoeducacao.*,
      relacao.*
  FROM 
      AlunoRecente ar
  INNER JOIN 
      turma ON ar.id_turma = turma.id_turma
  INNER JOIN 
      escola ON ar.id_escola = escola.id_escola
  INNER JOIN 
      colaborador ON ar.id_orientador = colaborador.id_colaborador
  INNER JOIN 
      encarregadoeducacao ON ar.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao
  INNER JOIN 
      relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao
  WHERE 
      ar.rn = 1;',
    'myaluno' => 'SELECT * FROM aluno INNER JOIN turma on aluno.id_turma = turma.id_turma INNER JOIN escola on aluno.id_escola = escola.id_escola INNER JOIN colaborador ON aluno.id_orientador = colaborador.id_colaborador INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao WHERE colaborador.orientador = 1 AND colaborador.ativo = 1 AND aluno.ativo = 1 AND encarregadoeducacao.ativo = 1 and aluno.id_orientador = ' . $_SESSION['userID'] . '',
    'alunoinative' => 'WITH AlunoRecente AS (
      SELECT 
      aluno.foto_aluno,
      aluno.id_aluno,
        aluno.aluno,
          aluno.unico,
          aluno.id_turma,
          aluno.id_escola,
          aluno.id_orientador,
          aluno.id_encarregadoeducacao,
          aluno.data,
          aluno.ativo,
          ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
      FROM 
          aluno
      WHERE
          aluno.ativo = 0 and aluno.removed = 0
  )
  SELECT 
  ar.foto_aluno,
  ar.id_aluno,
  ar.aluno,
      ar.unico,
      ar.id_turma,
      ar.id_escola,
      ar.id_orientador,
      ar.id_encarregadoeducacao,
      ar.data,
      ar.ativo,
      turma.*,
      escola.*,
      colaborador.*,
      encarregadoeducacao.*,
      relacao.*
  FROM 
      AlunoRecente ar
  INNER JOIN 
      turma ON ar.id_turma = turma.id_turma
  INNER JOIN 
      escola ON ar.id_escola = escola.id_escola
  INNER JOIN 
      colaborador ON ar.id_orientador = colaborador.id_colaborador
  INNER JOIN 
      encarregadoeducacao ON ar.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao
  INNER JOIN 
      relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao
  WHERE 
      ar.rn = 1;',
    'alunoremoved' => 'SELECT * FROM aluno INNER JOIN turma on aluno.id_turma = turma.id_turma INNER JOIN escola on aluno.id_escola = escola.id_escola  INNER JOIN colaborador ON aluno.id_orientador = colaborador.id_colaborador INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao WHERE  aluno.removed = 1',
    'encarregadoeducacao' => 'SELECT * FROM encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao  WHERE encarregadoeducacao.ativo = 1',
    'colaborador' => 'SELECT * FROM colaborador  INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE cargo.ativo = 1',
    'escola' => 'SELECT * FROM escola WHERE ativo = 1',
    'professor' => 'SELECT * FROM colaborador INNER JOIN especialidade ON colaborador.id_especialidade = especialidade.id_especialidade INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 3',
    'admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 2',
    'supra_admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 1',
    'turma' => 'SELECT * FROM turma  INNER JOIN escola on turma.id_escola = escola.id_escola WHERE turma.ativo = 1',
    'operacao'=> 'SELECT * FROM operacao  WHERE operacao.ativo = 1 Order by ordem ASC',
    'transporte'=> 'SELECT * FROM transporte  WHERE transporte.ativo = 1 ',
    'permissao'=> 'SELECT * FROM permissao inner join operacao on permissao.id_operacao = operacao.id_operacao inner join cargo on permissao.id_cargo = cargo.id_cargo',
    

  ];


  



    
$consultasForms = [
    'aluno' => 'SELECT * 
    FROM aluno 
    INNER JOIN colaborador ON aluno.id_orientador = colaborador.id_colaborador
    INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao
    INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao
    INNER JOIN genero ON Genero.id_genero = aluno.id_genero
    INNER JOIN localidade ON Localidade.id_localidade = aluno.id_localidade
    INNER JOIN escola ON escola.id_escola = aluno.id_escola
    INNER JOIN turma ON turma.id_turma = aluno.id_turma
    Where  aluno.id_aluno = ' . $id . '',
    'encarregadoeducacao' => 'SELECT * FROM encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao  WHERE encarregadoeducacao.ativo = 1',
    'colaborador' => 'SELECT * FROM colaborador  INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE cargo.ativo = 1',
    'escola' => 'SELECT * FROM escola WHERE id_escola = ' . $id . ' ',
    'professor' => 'SELECT * FROM colaborador INNER JOIN especialidade ON colaborador.id_especialidade = especialidade.id_especialidade INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.id_cargo = 3',
    'admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE  colaborador.id_cargo = 2',
    'supra_admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE  colaborador.id_cargo = 1',
    'turma' => 'SELECT * FROM turma  INNER JOIN escola on turma.id_escola = escola.id_escola WHERE turma.id_turma = ' . $id . '',
    'operacao'=> 'SELECT * FROM operacao  WHERE operacao.id_operacao = ' . $id . ' ',
    'transporte'=> 'SELECT * FROM transporte  WHERE transporte.ativo = '.$id.' ',
    'permissao'=> 'SELECT * FROM permissao inner join operacao on permissao.id_operacao = operacao.id_operacao inner join cargo on permissao.id_cargo = cargo.id_cargo where permissao.id_cargo = '.$id.' ',
    'pessoa'=> 'SELECT * FROM pessoa  WHERE id_pessoa = '.$id_modal.' ',  
  ];
 
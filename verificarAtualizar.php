<?php
  session_start();
  require "config.php";
  $id = filter_input(INPUT_POST, 'id');
  $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
  $razao = filter_input(INPUT_POST, 'razao');
  $contato = filter_input(INPUT_POST, 'tel', FILTER_VALIDATE_INT);
  $cep = filter_input(INPUT_POST, 'cep', FILTER_VALIDATE_INT);
  $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS);
  $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS);

  if($id && $nome && $razao && strlen($contato) == 11 && strlen($cep) == 8 && $cidade && $estado){
      $nome = ucwords(strtolower($nome));
      $razao = ucfirst(strtolower($razao));
      $cidade = ucwords(strtolower($cidade));
      $estado = strtoupper($estado);
      $sql = $pdo -> prepare("UPDATE fornecedores SET nome=:nome, razaoSocial=:razao, contato=:contato, cep=:cep, cidade=:cidade, estado=:estado WHERE id=:id");
      $sql -> bindValue(':id', $id);
      $sql -> bindValue(':nome', $nome);
      $sql -> bindValue(':razao', $razao);
      $sql -> bindValue(':contato', $contato);
      $sql -> bindValue(':cep', $cep);
      $sql -> bindValue(':cidade', $cidade);
      $sql -> bindValue(':estado', $estado);
      $sql -> execute();

      header("Location: index.php");
      exit;
  } else{
      $_SESSION['falha'] = "Falha ao atualizar cadastro!";
      header("Location: index.php");
      exit;
  }
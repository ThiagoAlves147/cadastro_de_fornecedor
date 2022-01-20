<head>
    <link href="estilo.css" rel="stylesheet">
</head>

<body>
  <?php
    session_start();
    require "config.php";
    $lista = [];
    $sql = $pdo -> query('SELECT * FROM fornecedores');
    if($sql -> rowCount() > 0){
        $lista = $sql -> fetchAll(PDO::FETCH_ASSOC);
    }
    
  ?>
  <a href="adicionar.php">Cadastrar Fornecedor</a>
  <table border="1" width="100%">
    <thead>
          <th>Id</th>
          <th>Nome</th>
          <th>Razão Social</th>
          <th>Contato</th>
          <th>Cep</th>
          <th>Cidade</th>
          <th>Estado</th>
          <th>Ações</th>
      </thead>

      <?php foreach($lista as $usuario): //Cria a tabela com os usuarios cadastrados?>
            <tbody>
                <td><?php echo $usuario['id']?></td>
                <td><?php echo $usuario['nome']?></td>
                <td><?php echo $usuario['razaoSocial']?></td>
                <td><?php echo $usuario['contato']?></td>
                <td><?php echo $usuario['cep']?></td>
                <td><?php echo $usuario['cidade']?></td>
                <td><?php echo $usuario['estado']?></td>
                <td>
                    <a href="atualizar.php?id=<?php echo $usuario['id'] ?>">Atualizar</a> <?php echo "   |   "?>
                    <a href="deletar.php?id=<?php echo $usuario['id'] ?>" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</a> 
                </td>
            </tbody>
      <?php endforeach; ?>
  </table>

  <p style="text-align: center;">
  <?php
    if(isset($_SESSION['falha'])){
      echo $_SESSION['falha'];
      $_SESSION['falha'] = " ";
    }
  ?>
  </p>
</body>

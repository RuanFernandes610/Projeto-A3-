<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastre-se</title>
    <link rel="stylesheet" href="estilo_cadastro.css">
  </head>
  <body>
    <!--área de login-->
    <section class="login-section">
      <!--área da logo-->
      <div class="logo-outer-container">
        <div class="logo-container">
          <div class="logo">
            <img src="./imagens/logo.png" alt="Venda já" />
          </div>
          <p class="logo-text normal">
            O melhor site de compra e venda do brasil!
          </p>
          <p class="logo-text bold">
            Rápido, fácil e seguro, crie já a sua conta.
          </p>
        </div>
        <img class="logo-bonequin" src="./imagens/asset 1.png" alt="Bonequin" />
      </div>
     
      <div class="login-outer-container">
        <div class="login-container">
         
          <form id="formularioCadastro" action="conexao_cadastro.php" method="POST" class="login-form-container cadastro">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" class="cadastro-input" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="cadastro-input" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" class="cadastro-input" required>
            <label>Tipo de Usuário:</label>
            <input type="radio" id="vendedor" name="tipo_usuario" value="vendedor" class="cadastro-input" required>
            <label for="vendedor">Vendedor</label>
            <input type="radio" id="comprador" name="tipo_usuario" value="comprador" class="cadastro-input" required>
            <label for="comprador">Comprador</label>
            <button type="submit" class="login-button black entrar">
              <span>Cadastre-se</span>
              <img src="./imagens/Forward.svg" alt="Entrar" />
            </button>
          </form>
         
          <div class="login-create-account-container">
            <span>Já é um membro?</span>&nbsp;
            <a class="login-create-account-link" href="Login.html">Entrar</a>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>

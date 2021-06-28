<p align="center">
  
 <img width="200px" src="http://190.89.81.70/logob.png" align="center" alt="Nicbit - isp - Gerenciamento de servidores" />
 <h2 align="center">Welcome to the red planet</h2>
 <p align="center">Gerenciador de Provedores (Radius / Mikrotik) - iniciativa livre!</p>
</p>

  <p align="center">
    <a href="#demo">Demo on line</a>
    ·
    <a href="https://github.com/bhlima/isp-nicbit/issues/new">Encontrou erro</a>
    ·
    <a href="https://github.com/bhlima/isp-nicbit/issues">Sugestões de código</a>
  </p>
</p>
</a>

# Objetivo

Sistema em Desenvolvimento, objetivo de gerenciar credenciais de autenticação para clientes radius
com enfase em sistemas mikrotik, mas com dicionário completo do radius para controlar outros sistemas
não possue implementações de pool de ips, mapas, proxis, sistema resumido em sistema financeiro, pagseguro e gerencianet, boletos, carnês, faturas, comunicação por email, cadastro de clientes e gerenciamento de corte.


# Requerimentos do sistema

-[] Servidor Freeradius com Mysql instalado
-[] Ubuntu server / Ubuntu Desktop 20.*
-[] Apache 2
-[] Mysql 
-[] PHP 7.* (Não funciona em versões anteriores)
-[] IP Público para total aproveitamento do sistema. Acesso de clientes e páginas de redirecionamento.

Este sistema não funciona em servidores Windows, variáveis de ambiente do linux são necessárias para o funcionamento do servidor.

# Instalação

Esta é uma versão em desenvolvimento não há prazo de conclusão das tarefas, caso queira
participar do desenvolvimento de um fork no repositório, será bem vindo. Para saber onde se
encontra os nodos de desenvolvimento, verifique os commits do repositório. 

-[] Clone o repositorio no diretorio  /public_html/ ou similar no seu servidor;
-[] crie um banco de dados "nicbit" no seu mysql;
-[] importe o arquivo SCHEMA.sql para dentro do seu banco de dados "nicbit";
-[] Lembre-se de dar acesso total ao usuario desse banco de dados
-[] Altere o arquivo /App/Config/app.php  com os dados do banco de dados e caminho da aplicação.
-[] Este sistema utiliza codeigniter 4 framework, qualquer duvida acesse a documentação do codeigniter.

Este sistema não funciona em servidores Windows, variáveis de ambiente do linux são necessárias para o funcionamento do servidor.


```md
Altere a senha do administrador diretamente no banco de dados e acesse o sistema. (sistema em desenvolvimento os dados de teste estão no banco de dados)
```




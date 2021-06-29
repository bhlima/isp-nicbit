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


## Versão
nicbit - isp - v 1.0.0 - Work in Progress - Não serve para produção somente para desenvolvimento.

## Requerimentos do sistema

- [Ubuntu server]
- [Apache 2]
- [Top Languages Card]
- [Mysql 8]
- [PHP 7]
- [Servidor Freeradius instalado e com mysql]

 > Este sistema não funciona em servidores Windows, variáveis de ambiente do linux são necessárias para o funcionamento do servidor.

## Instalação

 > Esta é uma versão em desenvolvimento não há prazo de conclusão das tarefas, caso queira
participar do desenvolvimento de um fork no repositório, será bem vindo. Para saber onde se
encontra os nodos de desenvolvimento, verifique os commits do repositório. 

- Clone o repositorio no diretorio  /public_html/ ou similar no seu servidor;
- Crie um banco de dados "nicbit" no seu mysql;
- Importe o arquivo SCHEMA.sql para dentro do seu banco de dados "nicbit";
- Lembre-se de dar acesso total ao usuario desse banco de dados
- Altere o arquivo /App/Config/app.php  com os dados do banco de dados e caminho da aplicação.
- Este sistema utiliza codeigniter 4 framework, qualquer duvida acesse a documentação do codeigniter.


> Altere a senha do administrador diretamente no banco de dados e acesse o sistema. (sistema em desenvolvimento os dados de teste estão no banco de dados)


## Patrocinar o Projeto
>Tenha seu nome incluido na lista de patrocinadores oficial do sistema, caso necessite de uma biblioteca particular para seus sistema financeiro com doações poderemos incui-la no projeto MAster.

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<h3><a id="user-content-features" class="anchor" href="#features" aria-hidden="true"><svg aria-hidden="true" class="octicon octicon-link" height="16" role="img" version="1.1" viewBox="0 0 16 16" width="16"><path d="M4 9h1v1h-1c-1.5 0-3-1.69-3-3.5s1.55-3.5 3-3.5h4c1.45 0 3 1.69 3 3.5 0 1.41-0.91 2.72-2 3.25v-1.16c0.58-0.45 1-1.27 1-2.09 0-1.28-1.02-2.5-2-2.5H4c-0.98 0-2 1.22-2 2.5s1 2.5 2 2.5z m9-3h-1v1h1c1 0 2 1.22 2 2.5s-1.02 2.5-2 2.5H9c-0.98 0-2-1.22-2-2.5 0-0.83 0.42-1.64 1-2.09v-1.16c-1.09 0.53-2 1.84-2 3.25 0 1.81 1.55 3.5 3 3.5h4c1.45 0 3-1.69 3-3.5s-1.5-3.5-3-3.5z"></path></svg></a><div align="center">PagSeguro</div></h3>
				<a href="https://pag.ae/7XhdLW9M3"><img src="https://stc.pagseguro.uol.com.br/public/img/botoes/doacoes/120x53-doar.gif"></a>


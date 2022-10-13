# Easy Module

[![Latest Stable Version](http://poser.pugx.org/kascat/easy-module/v)](https://packagist.org/packages/kascat/easy-module)
[![Total Downloads](http://poser.pugx.org/kascat/easy-module/downloads)](https://packagist.org/packages/kascat/easy-module)
[![Latest Unstable Version](http://poser.pugx.org/kascat/easy-module/v/unstable)](https://packagist.org/packages/kascat/easy-module)
[![License](http://poser.pugx.org/kascat/easy-module/license)](https://packagist.org/packages/kascat/easy-module)
[![PHP Version Require](http://poser.pugx.org/kascat/easy-module/require/php)](https://packagist.org/packages/kascat/easy-module)

Estrutura modular para o framework Laravel.

A estrutura modular oferece maior organização no projeto, centralizando o código de cada funcionalidade/feature
em apenas um lugar, facilitando a criação e manutenção de projetos grandes e pequenos.

O pacote **Easy Module** não limita a utilização da estrutura padrão de arquivos do Laravel,
podendo ser implementado em projetos novos e em andamento.

---

## Instalação

Para instalar o pacote **Easy Module** basta seguir os três passos a seguir:

#### 1. Instalação via composer

```shell
composer require "kascat/easy-module"
```

#### 2. Adicione a classe abaixo na sessão `providers` do arquivo `config/app.php`

```php
Kascat\EasyModule\Core\ModularServiceProvider::class
```

Exemplo:
```php
'providers' => [
    // ...Outros providers existentes

    Kascat\EasyModule\Core\ModularServiceProvider::class
]
```

#### 3. Registre a pasta `modules` na configuração `psr-4` do arquivo `composer.json` presente na raiz do seu projeto

```json
"": "modules/"
```

Exemplo:
```json
"autoload": {
  "psr-4": {
    "": "modules/",
    "App\\": "app/",
  }
},
```

## Criação de módulos

Para criar um módulo completo basta executar o comando `php artisan easy:module [nome do módulo]`
que irá gerar a estrutura padrão, porém o pacote **Easy Module** oferece uma lista de comandos,
que auxiliam na criação da estrutura e dos arquivos do seu módulo separadamente.

Os arquivos já são gerados com uma estrutura funcional de criação, leitura, edição, e exclusão
(CRUD) para a tabela do seu banco de dados que está relacionada a _model_ do módulo,
apenas será necessário configurar a _model_ e o _request_ com as propriedades da tabela.

#### Comandos:

Criação de módulo completo com os principais arquivos:
```shell
php artisan easy:module [nome do módulo]
```

Criação de _Controller_ e dos arquivos relacionados (Controller, Request, Response, Api Route):
```shell
php artisan easy:controller [nome do módulo]
```

Criação de _Model_:
```shell
php artisan easy:model [nome do módulo]
```

Criação de _Service_ e _Repository_:
```shell
php artisan easy:service [nome do módulo]
```

Criação de arquivos de rota (api.php e web.php):
```shell
php artisan easy:route [nome do módulo]
```

Criação de arquivo de comandos _artisan_ (console.php):
```shell
php artisan easy:command [nome do módulo]
```

#### Substituição de arquivos:

O mesmo comando pode ser executado mais de uma vez para um módulo,
porém os arquivos que já existirem não serão substituídos,
serão criados novos arquivos com um sufixo único no nome,
que podem ser adequados posteriormente.

Para que aconteça a substituição de um arquivo existente rode o comando com a flag `--overwrite` ou `-O`

Exemplo:
```shell
php artisan easy:module sample -O
```

## Estrutura

A estrutura modular é bem simples de se entender, cada módulo contém arquivos com uma finalidade específica.

Abaixo se encontra um exemplo da estrutura de um módulo (Sample),
gerado com o comando: `php artisan easy:module sample`

```text
> modules
  > Samples
      api.php
      Sample.php
      SampleController.php
      SampleRepository.php
      SampleRequest.php
      SampleResponse.php
      SampleService.php
```

> Caso o seu módulo não utilize algum dos arquivos criados automaticamente, ele pode ser removido,
> apenas se atente em alguma referência que possa ter ficado em outros arquivos que o utilizam.

### Responsabilidades

Abaixo segue a responsabilidade de cada arquivo no módulo.

#### Model

O arquivo/classe model segue o mesmo padrão/estrutura das models originais do Laravel,
se comunicando com a tabela do seu banco de dados, e realizando a definição
das propriedades e relacionamentos normalmente.

O nome do arquivo e da classe recebe o nome do módulo no singular, ex: `User.php` `User::class`

#### Controller

O arquivo de controller também se comporta da mesma forma que as controllers tradicionais,
ficando responsável em conter as funções que as rotas chamarão. Porém, com o diferencial
de validar as requisições e formatar as respostas com uso dos arquivos apropriados (Request e Response).

#### Request

Utilizado para realizar as validações dos dados recebidos das requisições de cada rota.

#### Response

Utilizado para realizar formatações ou modificações nos dados de resposta da rota.

#### Repository

O repository tem somente a responsabilidade de montar as _queries_ que serão executadas do banco de dados.

#### Service

O service fica com a responsabilidade de conter a lógica principal (regra de negócio) do módulo.

#### Api e Web

Os arquivos de rota `api.php` e `web.php` são utilizados para registrar as rotas do módulo,
da mesma forma que são definidas nos arquivos `routes/api.php` e `routes/web.php` do Laravel.

#### Console

O arquivo `console.php` é utilizado para criar comandos personalizados para a aplicação relacionado ao módulo,
e pode ser utilizado da mesma forma que o arquivo `routes/console.php` do Laravel,
podendo ser agendado normalmente em `app/Console/Kernel.php`.


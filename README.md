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

## Utilização

Para criar um módulo completo basta executar o comando `php artisan easy:module [nome do módulo]`
que irá gerar a estrutura padrão, porém o pacote **Easy Module** oferece uma lista de comandos,
que auxiliam na criação da estrutura e dos arquivos do seu módulo separadamente.

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
serão criados novos arquivos com um sufixo único que pode ser adequado posteriomente.

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

Abaixo segue a descrição da responsabilidade de cada arquivo e detalhes da sua utilização.

#### Model

O arquivo/classe model segue o mesmo padrão/estrutura das models originais do Laravel,
realizando a comunicação com a tabela do seu banco de dados.

O nome do arquivo/classe recebe o nome do módulo no singular, ex: `User.php` `User::class`

#### Controller


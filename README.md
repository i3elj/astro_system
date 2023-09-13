# Astro System

Um sistema de gerenciamento de restaurantes simples, eficiente e prático.

### Sumário
- [Configuraçãoo](https://github.com/i3elj/astro_system/#configuração)
  - [Dependências](https://github.com/i3elj/astro_system/#dependências)
    - [Windows](https://github.com/i3elj/astro_system/#windows)
    - [Mac](https://github.com/i3elj/astro_system/#mac)
    - [Linux](https://github.com/i3elj/astro_system/#linux)
  - [Rodando o projeto](https://github.com/i3elj/astro_system/#rodando-o-projeto)


## Configuração
### Dependências
Para que o projeto rode sem erros e problemas você precisará do docker, ddev e... só.
Por favor utilize os seguintes links para ter certeza do que está fazendo: [ddev guide](https://ddev.com/get-started/), [docker guide](https://docs.docker.com/engine/)

#### Windows
É recomendável utilizar o [WSL](https://learn.microsoft.com/en-us/windows/wsl/install) (Windows Subsystem for Linux), já que dentro dele você só precisará rodar apenas um ou dois commandos para terminar de configurar tudo. Aparentemente tudo que você precisa para instalar o WSL no Windows é rodar o seguinte commando no terminal do windows (PowerShell), porém eu recomendo utilizar o site oficial da Microsoft, se algo der errado não irei me responsabilizar.

* Instalar o wsl:
  ```powershell
  wsl --install
  ```
* Instalar o docker e o ddev usando o powershell para instalar no wsl:
  ```powershell
  Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072;
  iex ((New-Object System.Net.WebClient).DownloadString('https://raw.githubusercontent.com/ddev/ddev/master/scripts/install_ddev_wsl2_docker_inside.ps1'))
  ```
* Agora dentro do terminal do Ubuntu no wsl:
  ```bash
  ddev -v
  ```

#### Mac
No MacOs você pode utilizar do gerenciador de pacotes [brew](https://brew.sh/) para realizar a instalação de tudo:

* Para instalar o docker:
  ```bash
  brew install --cask docker
  ```
* Para instalar o ddev:
  ```bash
  brew install ddev/ddev/ddev
  ```
#### Linux
Tu não precisa de instrução nenhuma não rapá, vai usar teu gerenciador de pacote e deixe de coisa.

Mentira, caso seu gerenciador de pacotes não tenha algum pacote oficial do ddev (do docker deve ter de certeza), você pode utilizar o seguinte bash script para instalar:
```bash
curl -fsSL https://ddev.com/install.sh | bash
```
* Lembre de inicializar e habilitar o processo do docker antes de tentar rodar o ddev:
  ```bash
  sudo systemctl enable docker
  ```
  ```bash
  sudo systemctl start docker
  ```
  
* E de adicionar o usuário no grupo docker, para que você nãoo utilize `sudo`:
  ```bash
  sudo usermod -aG docker $USER
  ```
### Rodando o projeto localmente
Para rodar o projeto localmente basta seguir os seguintes passos, o mais importante é que nãoo há diferenças entre as plataformas:
* Clonar o repositório, lembrando que vai depender da branch na qual você for trabalhar:
   ```bash
   git clone https://github.com/i3elj/astro_system
   ```
* Dentro da pasta do projeto, clone o arquivo `.env.example`:
   ```bash
   cp .env.example .env
   ```
* Inicializar o container com o ddev:
   ```bash
   ddev start
   ```
* Entrar no container para realizar as migrations:
   ```bash
   ddev ssh
   ```
* Já dentro do container, rode as migrations:
   ```bash
   php migrations/postgres/run.php
   ```

Se você fez tudo certinho nenhum erro deve ter aparecido, agora basta ir para `http://astro-system.ddev.site` que você já poderá contribuir para o projeto.

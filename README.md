![Symfony 6](https://img.shields.io/badge/Symfony-6.2-blueviolet)
![PHP Version](https://img.shields.io/badge/php-8.2-blue.svg)
[![CI](https://github.com/sefhirot69/template-symfony/actions/workflows/build.yml/badge.svg)](https://github.com/sefhirot69/template-symfony/actions/workflows/build.yml)
--------------------------------------

## 🛠️ Requisitos

- 🐳 Docker
- __Opcional__: Instalar el comando `make` para mejorar el punto de entrada a nuestra aplicación.
    1. [Instalar en OSX](https://formulae.brew.sh/formula/make)
    2. [Instalar en Window](https://parzibyte.me/blog/2020/12/30/instalar-make-windows/#Descargar_make)

## ⚙️ Configuración del entorno

1. Clona el repositorio o haz un fork
2. Escribe por terminal el comando `make`. Este comando instalara todo lo necesario para arrancar la aplicación.
3. El api está disponible en la url http://localhost:41
   4. Tienes un endpoint para verificar si la aplicación funciona http://localhost:41/api/health

```Puedes cambiar el puerto de salida 41, en el fichero docker-compose por el que más te guste.```

## 🚀 Comandos Útiles

Este proyecto incluye un Makefile con algunos comandos útiles para el desarrollo. Puedes ejecutarlos con el comando *
*make** seguido del nombre del comando.

### Comandos de Docker Compose

* `make start`: Inicia los contenedores de Docker Compose.
* `make stop`: Detiene los contenedores de Docker Compose.
* `make down`: Detiene y elimina los contenedores de Docker Compose.
* `make recreate`: Reinicia los contenedores de Docker Compose.
* `make rebuild`: Reconstruye los contenedores de Docker Compose.

## Aplicación

Tenemos disponibles dos opciones para comprobar la disponibilidad de precios:

* Por endpoint http://localhost:41/api/avail?origin=MAD&destination=BIO&date=2022-06-01
* Por comando `make avail origin=string destination=string date=string`

Ejemplo de uso: ```make avail origin=MAD destination=BIO date=2023-06-01```

📝 Recuerda que puedes consultar los detalles de cada comando en el Makefile del proyecto.

¡Que lo disfrutes! 😎
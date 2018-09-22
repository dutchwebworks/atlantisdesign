# Atlantisdesign personal web site

*By Dennis Burger, Poort80 Amsterdam, may 2018*

## Prerequisites

* [NodeJS](https://nodejs.org/en/)
* [OpenSSL](https://www.openssl.org/)

## Installation

Checkout this Git repo, open a **Terminal** (or command-line) and `cd` into this directory. And run the normal NPM install inside this directory.

```bash
npm install
```

## Running this demo

To run (and host) this demo on your local machine; **and view it later on a smart device** (smartphone / tablet, on the same WiFi network as your local machine) you'll need to run a local **SSL server**. PWA's require a secure connection.

You'll need to generate a self-signed SSL certificate to run the local `http-server`. 

## Generate self-signed SSL certificate

Open a Terminal and run the command below to generate a `key.pem` and `cert.pem` files required for the `http-server`. More info can be found on [this Stackoverflow page](https://stackoverflow.com/questions/35127383/npm-http-server-with-ssl).

```bash
openssl req -newkey rsa:2048 -new -nodes -x509 -days 3650 -keyout key.pem -out cert.pem
```

## Run the server

In the `package.json` file are some NPM settings (see `start` script) for the `http-server`. Run the following NPM script to start a local `hhtp-server`.

```bash
npm run start
```

According to the `package.json` file setting the `./docs` directory is being served to the web browser. This `./docs` directory is used specificly to host this repo's demo on Github Pages.

## Open the browser

Open a web browser at the following address. Or change the IP number to your computers IP nummer and run that address on your smartdevice (smartphone or tablet) to test / view this PWA demo.

	https://127.0.0.1:3000
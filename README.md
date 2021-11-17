
# TESTE GDIGITAL  - Backend
## Sistema de Redirecionamentos Múltiplos

- Ambiente docker baseado em: [docker laravel](https://github.com/ucan-lab/docker-laravel)
- Clone o repositório e execute:
  
> `cd teste-gdigital-backend`

> `make init`


  ## Rotas
  Exemplos:

### Cadastro Link de Entrada

**Opcional** links de saída (link_outs)
> http://localhost/link/store
```json
{
	"name": "teste 1d",
    "uri": "ccs",
	"default_url": "https://www.google.com/",
	"expiration_date": "2021-11-16",
	
	"link_outs": [
		{
			"url": "https://www.php.net/manual/pt_BR/function.date.php",
			"redirect_limit": "3"
		},
		{
			"url": "https://lumen.laravel.com/docs/5.1/routing#throwing-404-errors",
			"redirect_limit": "3"
		}
	]
}
```
### Update Link de entrada
> http://localhost/link/{id}/update
```json
{
	"name": "teste 1d",
    "uri": "abcx123d5dd233",
	"default_url": "https://www.google.com/",
	"expiration_date": "2021-11-18",
	"status": false
}
```
Cadastro de link de saída
> http://localhost/linkout/store
```json
{
  "link_id": 1,
  "url": "https://www.php.net/manual/pt_BR/function.date.php",
  "redirect_limit": "3"
}
```

Update de link de saída
> http://localhost/linkout/{id}/update
```json
{
  "url": "https://www.php.net/manual/pt_BR/function.date.php",
  "redirect_limit": "3"
}
```
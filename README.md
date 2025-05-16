# 📊 Mygle ERP 2.0

<div align="center">
  <img src="assets/images/defaultLogo.png" alt="Mygle ERP Logo" width="300">
</div>

**Mygle ERP 2.0** é a evolução do sistema anterior em C#, agora transformado em um **ERP em PHP** com módulos fiscais, financeiros e de gestão de vendas.  

---

## ✨ Funcionalidades Principais  

✅ **Gestão de Vendas**  
✅ **Emissão de Notas Fiscais Eletrônicas (NF-e)**  
✅ **Relatórios Automatizados em PDF (com mPDF)**  
✅ **Controle de Estoque Integrado**  
✅ **Dashboard Financeiro**  

---

## 📦 Estrutura do Projeto  

```bash
Mygle-2.0/
├── assets/           # CSS, JS e imagens
├── controllers/      # Lógica de negócio
├── core/             # Núcleo do sistema (roteamento, autenticação)
├── libraries/mpdf60/ # Biblioteca para gerar PDFs
├── models/           # Acesso ao banco de dados
├── nfe/              # Módulo de Notas Fiscais Eletrônicas
├── vendor/           # Dependências do Composer
├── views/            # Templates PHP/HTML
├── .htaccess         # Configurações do Apache
├── composer.json     # Dependências PHP
├── config.php        # Configurações do sistema
├── environment.php   # Controle de ambientes (dev/prod)
├── index.php         # Front Controller
└── mygle.sql         # Estrutura do banco de dados
```

---

## 🚀 Como Executar o Projeto  

### **Pré-requisitos**  
- PHP 7.0+  
- MySQL 5.7+  
- Apache/Nginx  
- Composer  

### **Passo a Passo**  
1. **Clone o repositório**  
   ```bash
   git clone https://github.com/YujiSeto/Mygle-2.0.git
   cd Mygle-2.0
   ```

2. **Instale as dependências**  
   ```bash
   composer install
   ```

3. **Configure o banco de dados**  
   - Importe `mygle.sql` para o MySQL.  
   - Atualize as credenciais em `config.php`.  

4. **Inicie o servidor**  
   ```bash
   php -S localhost:8000
   ```

5. **Acesse o sistema**  
   Abra `http://localhost:8000` no navegador.

---

## 🤝 Contribuição  

Contribuições são bem-vindas! Siga os passos:  
1. Faça um fork do projeto.  
2. Crie uma branch (`git checkout -b feature/nova-funcionalidade`).  
3. Commit suas mudanças (`git commit -m 'Adiciona nova funcionalidade'`).  
4. Push para a branch (`git push origin feature/nova-funcionalidade`).  
5. Abra um Pull Request.  

--- 

<p align="center">
  ✨ <strong>Transforme sua gestão empresarial com o Mygle ERP 2.0!</strong> ✨
</p>  

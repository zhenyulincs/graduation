# 使用方法

## 服务器需安装：
> - PHP >= 7.0.0
> - OpenSSL PHP Extension
> - PDO PHP Extension
> - Mbstring PHP Extension
> - Tokenizer PHP Extension
> - XML PHP Extension

sources: <a>https://laravel.com/docs/5.5/installation</a>

## 需安装composer
<a>https://getcomposer.org/</a>

## 在根目录下执行以下命令:
```bash
composer install
cp .env.example .env
npm install
```

### 按需求编辑.env文件：
 > DB_CONNECTION=mysql <br>
 > DB_HOST=127.0.0.1 <br>
 > DB_PORT=3306 <br>
 > DB_DATABASE=graduation <br>
 > DB_USERNAME=root <br>
 > DB_PASSWORD=root <br>

### 最后执行迁移命令:
```bash
php artisan migrate
```

## 使用方法:
- 需访问public目录才能看到主页面
- 管理员后台是/public/admin
- 第一个注册的账户为超级管理员
- Api查询商品链接是/public/query?query=你的关键词


